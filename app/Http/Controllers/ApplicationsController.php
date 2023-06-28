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

use Illuminate\Support\Facades\Storage;

use App\Notifications\FinanceApplicationSubmitted;
use App\Notifications\AlternativeFinanceOptions;
use App\Notifications\FinanceApplicationReceived;
use App\Notifications\UpdatedFinanceApplicationReceived;
use App\Notifications\LinkToYourFinanceApplication;
use App\Notifications\ResumeYourApplication;
use App\Notifications\NewApplication;
use App\Notifications\ApplicationUpdates;


use App\Http\Requests\Applications\CreateApplicationRequest;
use App\Http\Requests\Applications\UpdateApplicationRequest;
use App\Http\Requests\Applicants\UpdateApplicantRequest;
use Illuminate\Support\Arr;

use MailchimpMarketing\ApiClient;

class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Application $application, Applicant $applicant, Category $category, Update $update, User $user, Request $request, Result $result)
    {    
        if(!auth()->user()) {
            return view('home');
         }
        else if(auth()->user()->isAdmin())
        {
            $query = DB::table('applications')
            ->join('applicants', 'applicants.id', '=', 'applications.applicant_id')
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->join('categories', 'categories.id', '=', 'applications.category_id')
            ->select('applications.*', 'applicants.gender', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name', 'users.businessName')
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
                    ->select('applications.*', 'applicants.gender', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name')
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
            ->select('applications.*', 'applicants.gender', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name', 'users.businessName')
            ->orderBy('updated_at', 'desc')
            ->where('applications.deleted_at', '!=', 'NULL');

            $apps = $query->paginate(20);
            
            
            $trashed = $apps;

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
            'gender' => $request->gender,
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
                        'consolidate' => $creditCard['consolidate'],
                        'amount_owing' => $creditCard['amount_owing']                  
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

            collect($request->securedLoans)
                ->each(fn ($securedLoan) => $application->securedLoans()
                    ->create([                    
                        'financeCompany' => $securedLoan['financeCompany'],
                        'balance' => $securedLoan['balance'],
                        'repayment' => $securedLoan['repayment'],
                        'frequency' => $securedLoan['frequency'],
                        'asset_value' => $securedLoan['asset_value']
                        ])
                    );

            collect($request->mortgages)
                ->each(fn ($mortgages) => $application->mortgages()
                    ->create([                    
                        'financeCompany' => $mortgages['financeCompany'],
                        'balance' => $mortgages['balance'],
                        'home_value' => $mortgages['home_value'],
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

            // Add to Mailchimp
            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us13'
            ]);

            $subscriber_hash = md5(strtolower($request->email));

            $response = $mailchimp->lists->setListMember(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "email_address" => $request->email,
                "status_if_new" => "subscribed",
                "merge_fields" => [
                    "FNAME" => $request->firstname,
                    "LNAME" => $request->lastname,
                    "PHONE" => $request->phone
                ]
            ]);

            $response = $mailchimp->lists->updateListMemberTags(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "tags" => [["name" => "Application", "status" => "active"]],
            ]);
            
            $application->user->notify(new FinanceApplicationSubmitted($application));
        
            if ($request->category_id == 1) {
                $application->applicant->notify(new ResumeYourApplication($application, $applicant));
                session()->flash('success', 'Application saved - an email has been sent to the Applicant with a link to resume application');
            } else if ($request->category_id == 3) {
                $applicant->notify(new AlternativeFinanceOptions($applicant));
                session()->flash('success', 'Application updated - client to contact Halo Finance for further options.');
            } else {
                $applicant->notify(new FinanceApplicationReceived($applicant));
                session()->flash('success','Application created successfully.');
            }
            
            \Notification::route('mail', config('mail.from.address'))->notify(new NewApplication($application, $applicant));

        // redirect the user

        return redirect(route('home'));

        
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
        } else { $DLimage = old('DLimage', $application->applicant->DLimage); }
        if ($request->hasFile('payslip2')) {
            $payslip2 = $request->payslip2->store('applicants');
        } else { $payslip2 = null; }  
        if ($request->hasFile('MCimage'))  {
            $MCimage = $request->MCimage->store('applicants');
        } else { $MCimage = old('MCimage', $application->applicant->MCimage); }       
        if ($request->hasFile('payslip1')) {
            $payslip1 = $request->payslip1->store('applicants');
        } else {
            $payslip1 = old('payslip1', $application->applicant->payslip1);
        }
        
        $application_id = $request->application_id;
        $applicant_id = $request->applicant_id;
        
        Applicant::where('id', $applicant_id)->update([
            'gender' => $request->gender,
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
                        'consolidate' => $creditCard['consolidate'],
                        'amount_owing' => $creditCard['amount_owing']                  
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

            collect($request->securedLoans)
                ->each(fn ($securedLoan) => $application->securedLoans()
                    ->create([                    
                        'financeCompany' => $securedLoan['financeCompany'],
                        'balance' => $securedLoan['balance'],
                        'repayment' => $securedLoan['repayment'],
                        'frequency' => $securedLoan['frequency'],
                        'asset_value' => $securedLoan['asset_value']
                        ])
                    );

            collect($request->mortgages)
                ->each(fn ($mortgages) => $application->mortgages()
                    ->create([                    
                        'financeCompany' => $mortgages['financeCompany'],
                        'balance' => $mortgages['balance'],
                        'home_value' => $mortgages['home_value'],
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
            

            // Add to Mailchimp
            $mailchimp = new \MailchimpMarketing\ApiClient();

            $mailchimp->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us13'
            ]);

            $subscriber_hash = md5(strtolower($request->email));

            $response = $mailchimp->lists->setListMember(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "email_address" => $request->email,
                "status_if_new" => "subscribed",
                "merge_fields" => [
                        "FNAME" => $request->firstname,
                        "LNAME" => $request->lastname,
                        "PHONE" => $request->phone
                        ]
            ]);

            $response = $mailchimp->lists->updateListMemberTags(config('services.mailchimp.lists.test'), $subscriber_hash, [
                "tags" => [["name" => "ApplicationUpdated", "status" => "active"]],
            ]);
                
            $application->user->notify(new FinanceApplicationSubmitted($application));
           
            if ($request->category_id == 1) {
                $application->applicant->notify(new ResumeYourApplication($application, $applicant));
                session()->flash('success', 'Application saved - an email has been sent to the Applicant with a link to resume application '. $request->category_id);
            } else if ($request->category_id == 3) {
                $applicant->notify(new AlternativeFinanceOptions($applicant));
                // flash message
                session()->flash('success', 'Application updated - client to contact Halo Finance for further options.');
            } else {
                $application->applicant->notify(new UpdatedFinanceApplicationReceived($applicant));
                // flash message
                session()->flash('success', 'Application updated successfully.');
            }
            
            \Notification::route('mail', config('mail.from.address'))->notify(new ApplicationUpdates($application, $applicant));
    
       return view('home');
        
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
            Storage::delete($application->applicant->DLimage);
            Storage::delete($application->applicant->MCimage);
            Storage::delete($application->applicant->payslip1);
            Storage::delete($application->applicant->payslip2);
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

            $application = Application::where('applications.id', $application->id)->firstOrFail();
            $applicant = Applicant::where('id', $application->applicant_id)->firstOrFail();

            
            $application->applicant->notify(new LinkToYourFinanceApplication($application, $applicant));
    
            session()->flash('success', 'Application link resent to customer');
    
            return redirect()->back();
    
    
        }

    public function notifications(Notifications $notifications, Application $application) {

        $notifications = Notifications::where('notifiable_id', $application->id);
    }

}
