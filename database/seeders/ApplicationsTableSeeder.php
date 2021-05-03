<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\User;

use Illuminate\Database\Seeder;

class ApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user100 = User::create([
            'name' => 'Jan de Waal',
            'email' => 'jan@simtail.com',
            'role' => 'referrer',
            'businessName' => 'Simtail',
            'password' => 'janPassword'
        ]);

        $user101 = User::create([
            'name' => 'Karlee Aitken',
            'email' => 'karlee@tbh.com.au',
            'role' => 'referrer',
            'businessName' => 'The Brand Hierarchy',
            'password' => 'karleePassword'
        ]);

        $user102 = User::create([
            'name' => 'Jessica Powell',
            'email' => 'jessica@simtail.com',
            'role' => 'referrer',
            'password' => 'jessPassword'
        ]);

        $applicant1 = Applicant::create([
            'apptitle' => 'Ms',
            'firstname' => 'Jane',
            'middlename' => 'Audrey',
            'lastname' => 'Smith',
            'status' => 'Married',
            'dependants' => '2',
            'streetaddress' => '369 Newcastle Street',
            'suburb' => 'Northbridge',
            'state' => 'WA',
            'postcode' => '6003',
            'phone' => '0892141200',
            'email' => 'boo@outlook.com.au',
            'DOB' => '2000-12-31',
            'currentDL' => 'Yes',
            'DLnumber' => '123456789',
            'MCnumber' => '98732155',
            'occupation' => 'Nurse',
            'employername' => 'RPH',
            'employercontactnumber' => '1300 123 123'
        ]);

        $applicant2 = Applicant::create([
            'apptitle' => 'Mr',
            'firstname' => 'James',
            'lastname' => 'Smith',
            'lastname' => 'Jones',
            'status' => 'Single',
            'dependants' => '0',
            'streetaddress' => '255 Beaufort Street',
            'suburb' => 'Perth',
            'state' => 'WA',
            'postcode' => '6000',
            'phone' => '0413578850',
            'email' => 'hello@gmail.com',
            'DOB' => '2000-12-31',
            'currentDL' => 'No',
            'DLnumber' => '599845',
            'MCnumber' => '8855488',
            'occupation' => 'Driver',
            'employername' => 'Self',
            'employercontactnumber' => '02 123 1234'
        ]);

        $applicant3 = Applicant::create([
            'apptitle' => 'Ms',
            'firstname' => 'Odette',
            'middlename' => 'Audrey',
            'lastname' => 'Smith',
            'lastname' => 'Tsar',
            'status' => 'De Facto',
            'dependants' => '1',
            'streetaddress' => '1 Main Street',
            'suburb' => 'Mt Lawley',
            'state' => 'WA',
            'postcode' => '6051',
            'phone' => '0412 123 554',
            'email' => 'myemail@email.com.au',
            'DOB' => '2000-12-31',
            'currentDL' => 'True',
            'DLnumber' => '0012006',
            'MCnumber' => '5584669',
            'occupation' => 'Plumber',
            'employername' => 'ABC Plumbing',
            'employercontactnumber' => '02 9123 4412'
        ]);

        $application1 = Application::create([
            'user_id' => $user100->id,
            'applicant_id' => $applicant1->id,
            'loanAmount' => '5000',
            'loanTerm' => '2 years',
            'frequency' => 'fortnightly',
            'employment' => 'Part time',
            'residentialType' => 'Mortgage',
            'resTimeY' => '2',
            'resTimeM' => '9',
            'otherAddress' => 'No',
            'empTimeY' => '5',
            'empTimeM' => '2',
            'prevEmployer' => 'No',
            'prevEmployerTimeY' => '0',
            'prevEmployerTimeM' => '0',
            'income' => '25000',
            'incomeFreq' => 'annual',
            'partnerIncome' => '50000',
            'partnerIncomeFreq' => 'annual',
            'rentMortgageBoard' => '1500',
            'rentFreq' => 'month',
            'rentShared' => 'yes',
            'referenceName' => 'John Doe',
            'referencePhone' => '1300123456',
            'referenceSuburb' => 'Perth',
            'numCreditCards' => '3',
            'numPersonalLoans' => '1',
            'numMortgages' => '2',
            'category' => 'Submitted'
        ]);

        $application2 = Application::create([
            'user_id' => $user101->id,
            'applicant_id' => $applicant2->id,
            'loanAmount' => '25000',
            'loanTerm' => '5 years',
            'frequency' => 'monthly',
            'employment' => 'Full time',
            'residentialType' => 'Boarding',
            'resTimeY' => '4',
            'resTimeM' => '0',
            'otherAddress' => 'No',
            'empTimeY' => '6',
            'empTimeM' => '2',
            'prevEmployer' => '0',
            'prevEmployerTimeY' => '0',
            'prevEmployerTimeM' => '0',
            'income' => '20000',
            'incomeFreq' => 'month',
            'partnerIncome' => '0',
            'partnerIncomeFreq' => 'monthly',
            'rentMortgageBoard' => '300',
            'rentFreq' => 'week',
            'rentShared' => 'no',
            'referenceName' => 'Mr Abdul Sharpy',
            'referencePhone' => '089123456',
            'referenceSuburb' => 'Bayswater',
            'numCreditCards' => '3',
            'numPersonalLoans' => '1',
            'numMortgages' => '2',
            'category' => 'Incomplete'
        ]);
        
        $application3 = Application::create([
            'user_id' => $user102->id,
            'applicant_id' => $applicant3->id,
            'loanAmount' => '3000',
            'loanTerm' => '6 months',
            'frequency' => 'weekly',
            'employment' => 'Self employed',
            'residentialType' => 'Living with parents',
            'resTimeY' => '30',
            'resTimeM' => '0',
            'otherAddress' => 'none',
            'empTimeY' => '3',
            'empTimeM' => '0',
            'prevEmployer' => 'none',
            'prevEmployerTimeY' => '0',
            'prevEmployerTimeM' => '0',
            'income' => '32000',
            'incomeFreq' => 'annually',
            'partnerIncome' => '0',
            'partnerIncomeFreq' => 'none',
            'rentMortgageBoard' => '150',
            'rentFreq' => 'week',
            'rentShared' => 'no',
            'referenceName' => 'John Smith',
            'referencePhone' => '0291234688',
            'referenceSuburb' => 'Sydney',
            'numCreditCards' => '3',
            'numPersonalLoans' => '1',
            'numMortgages' => '2',
            'category' => 'Incomplete'
        ]);

        
    }
}
