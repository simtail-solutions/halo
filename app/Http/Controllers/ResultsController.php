<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Applicant;
use App\Models\User;
use App\Models\Category;
use App\Models\Update;

use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Results $results, Application $application, Applicant $applicant, Category $category, Update $update, User $user, Request $request)
    {    
        
        $results = DB::table('applications')
            ->join('applicants', 'applicants.id', '=', 'applications.applicant_id')
            ->join('users', 'users.id', '=', 'applications.user_id')
            ->join('categories', 'categories.id', '=', 'applications.category_id')
            ->select('applications.*', 'applicants.apptitle', 'applicants.firstname', 'applicants.lastname', 'applicants.email', 'applicants.phone', 'categories.name', 'users.businessName')
            ->orderBy('updated_at', 'desc')
            ->where(function($query) use ($request) {
                if ($term = $request->term) {
                    $query->orWhere('category_id', '=', $term)->get();
                }
            })
            ->paginate(10);    

        return Result::all();

    }
}
