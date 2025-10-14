<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;
use App\Models\Enrollment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $enrollments = Enrollment::all();

        return view('enrollment.index', [
            'enrollments' => $enrollments,
        ]);
    }

    public function create(Request $request)
    {
        return view('enrollment.create');
    }

    public function store(EnrollmentStoreRequest $request)
    {
        $enrollment = Enrollment::create($request->validated());

        //$request->session()->flash('enrollment.id', $enrollment->id);

        return redirect()->route('enrollments.index');
    }

    public function edit(Request $request, Enrollment $enrollment)
    {
        return view('enrollment.edit', [
            'enrollment' => $enrollment,
        ]);
    }

    public function update(EnrollmentUpdateRequest $request, Enrollment $enrollment)
    {
        $enrollment->update($request->validated());

        //$request->session()->flash('enrollment.id', $enrollment->id);

        return redirect()->route('enrollments.index');
    }

    public function destroy(Request $request, Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index');
    }
}
