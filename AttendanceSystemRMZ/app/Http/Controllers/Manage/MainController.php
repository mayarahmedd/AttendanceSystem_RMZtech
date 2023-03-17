<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;


class MainController extends BaseController
{
    /**
     * Access the dashboard page
     * @return Application|Factory|View
     */
    public function index(){
        $this->setPageTitle('Dashboard', 'dashboard');
        $courses = Course::all();
        $students_count = Student::count();
        return view('Manage.pages.dashboard', compact('courses', 'students_count'));
    }
}
