<?php

namespace Database\Seeders;

use App\Models\Applicant;
use App\Models\Application;
use App\Models\Category;
use App\Models\User;
use App\Models\Update;

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

        $category1 = Category::create([
            'name' => 'Incomplete'
        ]);

        $category2 = Category::create([
            'name' => 'Submitted'
        ]);

        $category3 = Category::create([
            'name' => 'Declined'
        ]);

        $category4 = Category::create([
            'name' => 'Withdrawn'
        ]);

        $category5 = Category::create([
            'name' => 'Approved'
        ]);

        $user100 = User::create([
            'name' => 'Jan de Waal',
            'email' => 'jan@simtail.com',
            'phone' => '0412 555 666',
            'role' => 'referrer',
            'businessName' => 'Simtail',
            'password' => 'janPassword',
            'industry' => 'Plastic Surgery'
        ]);

        $user101 = User::create([
            'name' => 'Karlee Aitken',
            'email' => 'karlee@tbh.com.au',
            'phone' => '0483 123 123',
            'role' => 'referrer',
            'businessName' => 'The Brand Hierarchy',
            'password' => 'karleePassword',
            'industry' => 'Dental'
        ]);

        $user102 = User::create([
            'name' => 'Kalen Harvey',
            'email' => 'kalen@simtail.com',
            'phone' => '0488 333 555',
            'role' => 'referrer',
            'businessName' => 'Simtail',
            'password' => 'kalenPassword',
            'industry' => 'Varicose Veins'
        ]);

        $applicant1 = Applicant::create([
            'apptitle' => 'Ms',
            'firstname' => 'Jane',
            'lastname' => 'Smith',
            'status' => 'Married',
            'dependants' => '2',
            'streetaddress' => '369 Newcastle Street, Northbridge WA 6003',
            'phone' => '0892 141 200',
            'email' => 'boo@outlook.com.au',
            //'dob' => '2000-12-31',
            'birth_day' => '31',
            'birth_month' => 'DEC',
            'birth_year' => '2000',
            'currentDL' => false,
            'DLnumber' => '123456789',
            'MCnumber' => '98732155',
            'occupation' => 'Nurse',
            'employername' => 'RPH',
            'employercontactnumber' => '1300 123 123'
        ]);

        $applicant2 = Applicant::create([
            'apptitle' => 'Mr',
            'firstname' => 'James',
            'lastname' => 'Jones',
            'status' => 'Single',
            'dependants' => '0',
            'streetaddress' => '255 Beaufort Street, Perth WA 6000',
            'phone' => '0413 578 850',
            'email' => 'hello@gmail.com',
            //'dob' => '2000-12-31',
            'birth_day' => '31',
            'birth_month' => 'DEC',
            'birth_year' => '2000',
            'currentDL' => true,
            'DLnumber' => '599845',
            'MCnumber' => '8855488',
            'occupation' => 'Driver',
            'employername' => 'Self',
            'employercontactnumber' => '02 123 1234'
        ]);

        $applicant3 = Applicant::create([
            'apptitle' => 'Ms',
            'firstname' => 'Odette',
            'lastname' => 'Tsar',
            'status' => 'De Facto',
            'dependants' => '1',
            'streetaddress' => '1 Main Street. Mt Lawley WA 6051',
            'phone' => '0412 123 554',
            'email' => 'myemail@email.com.au',
            //'dob' => '2000-12-31',
            'birth_day' => '31',
            'birth_month' => 'DEC',
            'birth_year' => '2000',
            'currentDL' => false,
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
            'employment' => 'Part time',
            'residentialType' => 'Mortgage',
            'resTimeY' => '2 yrs',
            'resTimeM' => '9 mnths',
            'otherAddress' => 'No',
            'empTimeY' => '5 yrs',
            'empTimeM' => '2 mnths',
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
            'api_token' => bin2hex(openssl_random_pseudo_bytes(10)),
            'category_id' => $category1->id
        ]);

        $application2 = Application::create([
            'user_id' => $user101->id,
            'applicant_id' => $applicant2->id,
            'loanAmount' => '25000',
            'employment' => 'Full time',
            'residentialType' => 'Boarding',
            'resTimeY' => '4 yrs',
            'resTimeM' => '0 mnths',
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
            'api_token' => bin2hex(openssl_random_pseudo_bytes(10)),
            'category_id' => $category2->id
        ]);
        
        $application3 = Application::create([
            'user_id' => $user102->id,
            'applicant_id' => $applicant3->id,
            'loanAmount' => '3000',
            'employment' => 'Self employed',
            'residentialType' => 'Living with parents',
            'resTimeY' => '30 yrs',
            'resTimeM' => '0 mnths',
            'otherAddress' => 'none',
            'empTimeY' => '3 yrs',
            'empTimeM' => '0 mnths',
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
            'api_token' => bin2hex(openssl_random_pseudo_bytes(10)),
            'category_id' => $category2->id
        ]);    

        $update1 = Update::create([
            'application_id' => $application1->id,
            'category_id' => $category1->id
        ]);

        $update2 = Update::create([
            'application_id' => $application2->id,
            'category_id' => $category2->id
        ]);

        $update3 = Update::create([
            'application_id' => $application3->id,
            'category_id' => $category2->id
        ]);
        
    }
}
