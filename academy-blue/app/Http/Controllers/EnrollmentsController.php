<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollmentStoreRequest;
use App\Http\Requests\EnrollmentUpdateRequest;
use App\Models\Enrollments;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EnrollmentsController extends Controller
{
    public function index(Request $request): Response
    {
        $enrollments = Enrollment::all();

        return view('enrollment.index', [
            'enrollments' => $enrollments,
        ]);
    }

    public function create(Request $request): Response
    {
        return view('enrollment.create');
    }

    public function store(EnrollmentStoreRequest $request): Response
    {
        $enrollment = Enrollment::create($request->validated());

        $request->session()->flash('enrollment.id', $enrollment->id);

        return redirect()->route('enrollments.index');
    }

    public function edit(Request $request, Enrollment $enrollment): Response
    {
        return view('enrollment.edit', [
            'enrollment' => $enrollment,
        ]);
    }

    public function update(EnrollmentUpdateRequest $request, Enrollment $enrollment): Response
    {
        $enrollment->update($request->validated());

        $request->session()->flash('enrollment.id', $enrollment->id);

        return redirect()->route('enrollments.index');
    }

    public function destroy(Request $request, Enrollment $enrollment): Response
    {
        $enrollment->delete();

        return redirect()->route('enrollments.index');
    }
}
