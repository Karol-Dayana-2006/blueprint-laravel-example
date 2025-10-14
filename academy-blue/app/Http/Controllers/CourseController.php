<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $courses = Course::all();

        return view('course.index', [
            'courses' => $courses,
        ]);
    }

    public function create()
    {
        $instructors = User::all();
        $categories = Category::all();
        return view('course.create',compact('instructors','categories'));
    }

    public function store(CourseStoreRequest $request)
    {
        $course = Course::create($request->validated());

        //$request->session()->flash('course.id', $course->id);

        return redirect()->route('courses.index');
    }

    public function edit(Request $request, Course $course)
    {
        return view('course.edit', [
            'course' => $course,
        ]);
    }

    public function update(CourseUpdateRequest $request, Course $course)
    {
        $course->update($request->validated());

        //$request->session()->flash('course.id', $course->id);

        return redirect()->route('courses.index');
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index');
    }
}
