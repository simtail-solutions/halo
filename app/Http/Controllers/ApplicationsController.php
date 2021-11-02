<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\Applicant;
use App\Models\User;
use App\Models\CreditCard;
use App\Models\PersonalLoan;
use App\Models\Mortgage;
use App\Models\Category;
use App\Models\Update;
use App\Notifications\NewSubmissionAdded;

use App\Http\Requests\Applications\CreateApplicationRequest;
use Illuminate\Support\Arr;


class ApplicationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Application $application, Applicant $applicant, Category $category, Update $update, User $user)
    {      
        return view('applications.index')
            //->with('applications', Application::filterByCategories()->paginate(10))
            ->with('applications', Application::all())
            ->with('applicants', Applicant::all())
            ->with('categories', Category::all())
            ->with('updates', Update::all())
            ->with('users', User::all())
            ->with('user', $user)
            ->with('applications', Application::searched()->paginate(10));

    }
        //     return view('applications.index', [
        //         'applications' => Application::filterByCategories()->paginate(10)
        //     ]);

        // }

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
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'status' => $request->status,
            'dependants' => $request->dependants,
            'streetaddress' => $request->streetaddress,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'email' => $request->email,
            'birth_day' => $request->birth_day,
            'birth_month' => $request->birth_month,
            'birth_year' => $request->birth_year,
            'currentDL' => $request->currentDL,
            'DLnumber' => $request->DLnumber,
            //'DLimage' => $DLimage,
            'MCnumber' => $request->MCnumber,
            //'MCimage' => $MCimage,
            'occupation' => $request->occupation,
            'employername' => $request->employername,
            'employercontactnumber' => $request->employercontactnumber
        ]);
        
        $application = $applicant->application()->create([
            'applicant_id' => $applicant->id,
            'user_id' => auth()->id(),
            'loanAmount' => $request->loanAmount,
            'loanTerm' => $request->loanTerm,
            'frequency' => $request->frequency,
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

            
        //dd(request()->all());
        
        $application->siteAdmin->notify(new NewSubmissionAdded($application));

        // flash message

        session()->flash('success', 'Application created successfully.');

        // redirect the user

        return redirect(route('applications.index'));

        // Need to provide a screen advising they need to supply their medicare / licence and payslips
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
    public function edit(Application $application, Applicant $applicant)
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
    public function update(UpdateApplicationRequest $request, Application $application, Applicant $applicant, CreditCard $creditCard, User $user, Category $category, Update $update)
    {
        $DLimage = $request->DLimage->store('applicants');
        $MCimage = $request->MCimage->store('applicants');

        $applicant = Applicant::update([
            'apptitle' => $request->apptitle,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'lastname' => $request->lastname,
            'status' => $request->status,
            'dependants' => $request->dependants,
            'streetaddress' => $request->streetaddress,
            'suburb' => $request->suburb,
            'state' => $request->state,
            'postcode' => $request->postcode,
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
            'employercontactnumber' => $request->employercontactnumber
        ]);
        
        $application = $applicant->application()->update([
            //'applicant_id' => $applicant->id,
            //'user_id' => auth()->id(),
            'loanAmount' => $request->loanAmount,
            'loanTerm' => $request->loanTerm,
            'frequency' => $request->frequency,
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
            'category_id' => $category->id,
            //'api_token' => $request->api_token
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

            
        dd(request()->all());

        // flash message

        session()->flash('success', 'Application created successfully.');

        // redirect the user

        return redirect(route('applications.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function category(Application $application, Category $category)
    // {
    //     $application->mostRecentCategory($category);

    //     session()->flash('success', 'Category updated');

    //     return redirect()->back();
    // }
}
