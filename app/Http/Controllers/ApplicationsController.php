<?php

namespace App\Http\Controllers;
use DB;
use Notification;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\User;
use App\Models\CreditCard;
use App\Models\PersonalLoan;
use App\Models\Mortgage;
use App\Models\Category;
use App\Models\Update;
use App\Models\Result;

use App\Notifications\FinanceApplicationSubmitted;
use App\Notifications\AlternativeFinanceOptions;
use App\Notifications\FinanceApplicationReceived;
use App\Notifications\UpdatedFinanceApplicationReceived;
use App\Notifications\LinkToYourFinanceApplication;


use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Http\Requests\Applications\UpdateApplicationRequest;
use App\Http\Requests\Applicants\UpdateApplicantRequest;
use Illuminate\Support\Arr;


class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Application $application, Applicant $applicant, Category $category, Update $update, User $user, Request $request, Result $result)
    {    
        if(auth()->user()->isAdmin())
        {
            $query = DB::table('applications')
            ->join('applicants', 'applicants.id', '=', 'applications.applicant_id')
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->join('categories', 'categories.id', '=', 'applications.category_id')
            ->select('applications.*', 'applicants.apptitle', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name', 'users.businessName')
            ->orderBy('updated_at', 'desc')
            ->where('applications.deleted_at', NULL)
            ->where(function($query) use ($request) {
                if (!empty($term = $request->term)) {
                    $query->where('category_id', '=', $term)->get();
               }
            }); 

            if(!empty($request->search)){
                $search = ['firstname','lastname', 'applicants.phone', 'applicants.email', 'users.businessName'];
                $query->where(function($query) use($request, $search){
                  $searchWildcard = '%' . $request->search . '%';
                  foreach($search as $field){
                    $query->orWhere($field, 'LIKE', $searchWildcard);
                  }
                });
            }

            $applications = $query->paginate(15);
        }

        else {
            $thisUser = auth()->user()->id;

            $query = DB::table('applications')    
                    ->where('user_id', '=', $thisUser )           
                    ->join('applicants', 'applicants.id', 'applications.applicant_id')
                    ->join('categories', 'categories.id', 'applications.category_id')
                    ->select('applications.*', 'applicants.apptitle', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name')
                    ->orderBy('updated_at', 'desc')
            ->where('applications.deleted_at', NULL)
            ->where(function($query) use ($request) {
                if (!empty($term = $request->term)) {
                    $query->where('category_id', '=', $term)->get();
               }
            }); 

            if(!empty($request->search)){
                $search = ['firstname','lastname', 'applicants.phone', 'applicants.email'];
                $query->where(function($query) use($request, $search){
                  $searchWildcard = '%' . $request->search . '%';
                  foreach($search as $field){
                    $query->orWhere($field, 'LIKE', $searchWildcard);
                  }
                });
            }

            $applications = $query->paginate(15);
        }
          

        return view('applications.index')
            ->with('applications', $applications);
           // ->with('applications', Application::compiled());
         
        }
    public function trashed(Application $apps, Request $request) 
        {
            /**
             * Display a list of all archived applications.
             *
             * @return \Illuminate\Http\Response
             */

            $query = DB::table('applications')
            ->join('applicants', 'applicants.id', '=', 'applications.applicant_id')
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->join('categories', 'categories.id', '=', 'applications.category_id')
            ->select('applications.*', 'applicants.apptitle', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name', 'users.businessName')
            ->orderBy('updated_at', 'desc')
            ->where('applications.deleted_at', '!=', 'NULL');

            $apps = $query->paginate(20);
            
            
            $trashed = $apps;//->orderBy('updated_at','DESC')->paginate(5);

             return view('applications.index')->withApplications($trashed);

        }

        
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('applications.create')
            ->with('applications', Application::all())
            ->with('applicants', Applicant::all())
            ->with('creditCards', CreditCard::all())
            ->with('personalLoans', PersonalLoan::all())
            ->with('mortgages', Mortgage::all())
            ->with('categories', Category::all())
            ->with('updates', Update::all());

    }

 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    
     public function store(CreateApplicationRequest $request, Applicant $applicant, CreditCard $creditCard, User $user, Update $update)
    {       

        $applicant = Applicant::create([
            'apptitle' => $request->apptitle,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'status' => $request->status,
            'dependants' => $request->dependants,
            'streetaddress' => $request->streetaddress,
            'phone' => $request->phone,
            'email' => $request->email,
            'birth_day' => $request->birth_day,
            'birth_month' => $request->birth_month,
            'birth_year' => $request->birth_year,
            'currentDL' => $request->currentDL,
            'DLnumber' => $request->DLnumber,
            'MCnumber' => $request->MCnumber,
            'occupation' => $request->occupation,
            'employername' => $request->employername,
            'employercontactnumber' => $request->employercontactnumber
        ]);
        
        $application = $applicant->application()->create([
            'applicant_id' => $applicant->id,
            'user_id' => auth()->id(),
            'loanAmount' => $request->loanAmount,
            'employment' => $request->employment,
            'residentialType' => $request->residentialType,
            'resTimeY' => $request->resTimeY,
            'resTimeM' => $request->resTimeM,
            'otherAddress' => $request->otherAddress,
            'empTimeY' => $request->empTimeY,
            'empTimeM' => $request->empTimeM,
            'prevOccupation' => $request->prevOccupation,
            'prevEmployer' => $request->prevEmployer,
            'prevEmployerTimeY' => $request->prevEmployerTimeY,
            'prevEmployerTimeM' => $request->prevEmployerTimeM,
            'income' => $request->income,
            'incomeFreq' => $request->incomeFreq,
            'partnerIncome' => $request->partnerIncome,
            'partnerIncomeFreq' => $request->partnerIncomeFreq,
            'rentMortgageBoard' => $request->rentMortgageBoard,
            'rentFreq' => $request->rentFreq,
            'rentShared' => $request->rentShared,
            'category_id' => $request->category_id,
            'api_token' => bin2hex(openssl_random_pseudo_bytes(10))
            ]); 

            
            collect($request->creditCards)
                ->each(fn ($creditCard) => $application->creditCards()
                    ->create([                    
                        'financeCompany' => $creditCard['financeCompany'],
                        'creditLimit' => $creditCard['creditLimit'],
                        'consolidate' => $creditCard['consolidate']                   
                        ])
                    );

            collect($request->personalLoans)
                 ->each(fn ($personalLoan) => $application->personalLoans()
                    ->create([                    
                        'financeCompany' => $personalLoan['financeCompany'],
                        'balance' => $personalLoan['balance'],
                        'repayment' => $personalLoan['repayment'],
                        'frequency' => $personalLoan['frequency'],
                        'consolidate' => $personalLoan['consolidate'],
                        'joint' => $personalLoan['joint']
                        ])
                    );

            collect($request->mortgages)
                ->each(fn ($mortgages) => $application->mortgages()
                    ->create([                    
                        'financeCompany' => $mortgages['financeCompany'],
                        'balance' => $mortgages['balance'],
                        'repayment' => $mortgages['repayment'],
                        'frequency' => $mortgages['frequency'],
                        'investmentProperty' => $mortgages['investmentProperty'],
                        'joint' => $mortgages['joint']
                        ])
                    );                  

            $update = $application->updates()->create([
                'application_id' => $application->id,
                'category_id' => $request->category_id
            ]); 
            
            $application->user->notify(new FinanceApplicationSubmitted($application));
            if ($application->empTimeY !== null) {
                $applicant->notify(new FinanceApplicationReceived($applicant));
            } else {
                $applicant->notify(new AlternativeFinanceOptions($applicant));
            }
            
        
        //  Send mail to admin 
         \Mail::send('applications.create.adminMail', array( 
            'firstname' => $request['firstname'], 
            'lastname' => $request['lastname'],
            'api_token' => $application['api_token'],
            'user' => $application->user->businessName,
            'email' => $request['email']),  
            function($message) use ($request){ 
                $message->from($request->email); 
                $message->to('admin@admin.com', 'Admin')->subject('New Application from' . ' ' . ($request->get('firstname')) . ' ' . ($request->get('lastname'))); 
                }); 
        
        // flash message
        //dd(request()->all());
        session()->flash('success', 'Application created successfully.');

        // redirect the user

        return redirect(route('home'));

        // Close screen?? Application needed to open up in a new window with no navigation
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Application $application, Update $update, Category $category, User $user)
    {
        return view('applications.show')
        ->with('application', $application)
        ->with('updates', $update)
        ->with('category', $category)
        ->with('categories', Category::all())
        ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Application $application, Applicant $applicant, User $user)
    {
        return view('applications.edit' )
        ->with('application', $application)
        ->with('applicant', $applicant)
        ->with('user', $user);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application, Applicant $applicant, CreditCard $creditCard, User $user, Category $category, Update $update)
    {
        if ($request->hasFile('DLimage')) {
            $DLimage = $request->DLimage->store('applicants');
        } else { $DLimage = null; }
        if ($request->hasFile('payslip2')) {
            $payslip2 = $request->payslip2->store('applicants');
        } else { $payslip2 = null; }       
        $MCimage = $request->MCimage->store('applicants');
        if ($request->hasFile('payslip1')) {
            $payslip1 = $request->payslip1->store('applicants');
        } else {
            $payslip1 = null;
        }
        
        $application_id = $request->application_id;
        $applicant_id = $request->applicant_id;
        
        Applicant::where('id', $applicant_id)->update([
            'apptitle' => $request->apptitle,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'status' => $request->status,
            'dependants' => $request->dependants,
            'streetaddress' => $request->streetaddress,
            'phone' => $request->phone,
            'email' => $request->email,
            'birth_day' => $request->birth_day,
            'birth_month' => $request->birth_month,
            'birth_year' => $request->birth_year,
            'currentDL' => $request->currentDL,
            'DLnumber' => $request->DLnumber,
            'DLimage' => $DLimage,
            'MCnumber' => $request->MCnumber,
            'MCimage' => $MCimage,
            'occupation' => $request->occupation,
            'employername' => $request->employername,
            'employercontactnumber' => $request->employercontactnumber,
            'payslip1' => $payslip1,
            'payslip2' => $payslip2
        ]);

        Application::where('id', $application_id)->update([
            'loanAmount' => $request->loanAmount,
            'employment' => $request->employment,
            'residentialType' => $request->residentialType,
            'resTimeY' => $request->resTimeY,
            'resTimeM' => $request->resTimeM,
            'otherAddress' => $request->otherAddress,
            'empTimeY' => $request->empTimeY,
            'empTimeM' => $request->empTimeM,
            'prevOccupation' => $request->prevOccupation,
            'prevEmployer' => $request->prevEmployer,
            'prevEmployerTimeY' => $request->prevEmployerTimeY,
            'prevEmployerTimeM' => $request->prevEmployerTimeM,
            'income' => $request->income,
            'incomeFreq' => $request->incomeFreq,
            'partnerIncome' => $request->partnerIncome,
            'partnerIncomeFreq' => $request->partnerIncomeFreq,
            'rentMortgageBoard' => $request->rentMortgageBoard,
            'rentFreq' => $request->rentFreq,
            'rentShared' => $request->rentShared,
            'category_id' => $request->category_id
            ]); 

            
            collect($request->creditCards)
                ->each(fn ($creditCard) => $application->creditCards()
                    ->create([                    
                        'financeCompany' => $creditCard['financeCompany'],
                        'creditLimit' => $creditCard['creditLimit'],
                        'consolidate' => $creditCard['consolidate']                   
                        ])
                    );

            collect($request->personalLoans)
                 ->each(fn ($personalLoan) => $application->personalLoans()
                    ->create([                    
                        'financeCompany' => $personalLoan['financeCompany'],
                        'balance' => $personalLoan['balance'],
                        'repayment' => $personalLoan['repayment'],
                        'frequency' => $personalLoan['frequency'],
                        'consolidate' => $personalLoan['consolidate'],
                        'joint' => $personalLoan['joint']
                        ])
                    );

            collect($request->mortgages)
                ->each(fn ($mortgages) => $application->mortgages()
                    ->create([                    
                        'financeCompany' => $mortgages['financeCompany'],
                        'balance' => $mortgages['balance'],
                        'repayment' => $mortgages['repayment'],
                        'frequency' => $mortgages['frequency'],
                        'investmentProperty' => $mortgages['investmentProperty'],
                        'joint' => $mortgages['joint']
                        ])
                    );

            $update = Update::where('id', $application)->create([
                'application_id' => $request->application_id,
                'category_id' => $request->category_id
            ]);           
            
                
            $application->user->notify(new FinanceApplicationSubmitted($application));
            $application->applicant->notify(new UpdatedFinanceApplicationReceived($applicant));
            
    
         //  Send mail to admin 
         \Mail::send('applications.update.adminMail', array( 
            'firstname' => $request['firstname'], 
            'lastname' => $request['lastname'],
            'api_token' => $application['api_token'],
            'user' => $application->user->businessName,
            'email' => $request['email']),  
            function($message) use ($request){ 
                $message->from($request->email); 
                $message->to('admin@admin.com', 'Admin')->subject('New Application from' . ' ' . ($request->get('firstname')) . ' ' . ($request->get('lastname'))); 
                }); 

        // flash message

        session()->flash('success', 'Application updated successfully.');

        // redirect the user

        return redirect(route('home'));
        // close window after successful completion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $application = Application::withTrashed()->where('id', $id)->firstOrFail();

        if ($application->trashed()) {
            $application->forceDelete();
        } else {
            $application->delete(); 
        }        

        session()->flash('success', 'Application removed');

        return redirect()->back();
    }

    public function restore($id) 
        {
            /**
             * Display a list of all archived applications.
             *
             * @return \Illuminate\Http\Response
             */

            $application = Application::withTrashed()->where('id', $id)->firstOrFail()->restore();
            
            session()->flash('success', 'Application restored');

            return redirect()->back();
           

        }

    public function resendEmail(Application $application, Applicant $applicant) {

        $application = Application::where('applications.id', $application->id)->firstOrFail()->get();
        $applicant = $application->applicant;
        // Error: Property [applicant] does not exist on this collection instance. 
       
    
            // $applicantFirstName = $this->application->firstname;
            // $referrer = $this->application->user->businessName;
            // $applyLink = $this->application->api_token;
            
            $application->notify(new LinkToYourFinanceApplication($application));
    
            dd(request()->all());
    
            session()->flash('success', 'Application link resent to customer');
    
            return redirect()->back();
    
    
        }

}
