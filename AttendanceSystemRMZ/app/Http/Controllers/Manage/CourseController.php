<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\BaseController;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Models\Course;
use App\Models\Student;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CourseController extends BaseController
{
    /**
     * Access the index page for the students to see all students
     * @return Application|Factory|View
     */
    public function index(){
        $this->setPageTitle('Courses', 'All Courses');
        $users = User::all();
        $courses = Course::withCount('students')->with('teacher')->get();
        return view('Manage.pages.Course.index', compact('courses', 'users'));
    }

    /**
     * @param Course $courses
     * @return Application|Factory|View
     */
    public function show(Course $course){
        $this->setPageTitle($course->name, 'Show Course');
        return view('Manage.pages.Course.show', compact('course'));
    }

    /**
     * @param Course $course
     * @return Application|Factory|View
     */
    public function assignStudents(Course $course){
        $this->setPageTitle($course->name, 'Assign Students');
        $students = Student::WhereNotIn('id', $course->students->pluck('id'))->get();
        return view('Manage.pages.Course.assign-student', compact('students', 'course'));
    }

    /**
     * Save students
     * @param Course $course
     * @param Request $request
     * @return RedirectResponse
     */
    public function attachAssignedStudents(Course $course, Request $request): RedirectResponse
    {
        $course->students()->attach($request->get('students'));
        alert('Good Job', 'Students Assigned Successfully', 'success');
        // Redirect Back
        return redirect()->route('course.index');
    }

    /**
     * Remove students from the course
     * @param Course $course
     * @param Student $student
     * @return RedirectResponse
     */
    public function detachAssignedStudent(Course $course, Student $student): RedirectResponse
    {
        $course->students()->detach($student);
        alert('Good Job', $student->name . ' Removed Successfully', 'success');
        // Redirect Back
        return redirect()->back();
    }

    /**
     * @param StoreCourseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreCourseRequest $request): RedirectResponse
    {
        try {
            Course::create($request->validated());
        }
        catch (\Exception $exception){
            alert('Oops', 'Please try again', 'error');
        }
        // Show Sweet Alert Notification
        alert('Good Job', 'Course Created Successfully', 'success');
        // Redirect Back
        return redirect()->back();
    }

    /**
     * @param UpdateCourseRequest $request
     * @param Course $course
     * @return RedirectResponse
     */
    public function update(UpdateCourseRequest $request, Course $course): RedirectResponse
    {
        try {
            $course->update($request->validated());
        }
        catch (\Exception $exception){
            alert('Oops', 'Please try again', 'error');
        }
        // Show Sweet Alert Notification
        alert('Good Job', 'Course Updated Successfully', 'success');
        // Redirect Back
        return redirect()->back();
    }

    /**
     * @param Course $course
     * @return RedirectResponse
     */
    public function destroy(Course $course): RedirectResponse
    {
        try {
            $course->delete();
        }
        catch (\Exception $exception){
            alert('Oops', 'Please try again', 'error');
        }
        // Show Sweet Alert Notification
        alert('Good Job', 'Course removed Successfully', 'success');
        // Redirect Back
        return redirect()->back();
    }
}
