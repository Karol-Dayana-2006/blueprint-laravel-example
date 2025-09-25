<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Enrollments;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\EnrollmentsController
 */
final class EnrollmentsControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $enrollments = Enrollments::factory()->count(3)->create();

        $response = $this->get(route('enrollments.index'));

        $response->assertOk();
        $response->assertViewIs('enrollment.index');
        $response->assertViewHas('enrollments');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('enrollments.create'));

        $response->assertOk();
        $response->assertViewIs('enrollment.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EnrollmentsController::class,
            'store',
            \App\Http\Requests\EnrollmentsStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $student = Student::factory()->create();
        $course = Course::factory()->create();
        $enrollments_date = fake()->;
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->post(route('enrollments.store'), [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'enrollments_date' => $enrollments_date,
            'status' => $status,
        ]);

        $enrollments = Enrollment::query()
            ->where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->where('enrollments_date', $enrollments_date)
            ->where('status', $status)
            ->get();
        $this->assertCount(1, $enrollments);
        $enrollment = $enrollments->first();

        $response->assertRedirect(route('enrollments.index'));
        $response->assertSessionHas('enrollment.id', $enrollment->id);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $enrollment = Enrollments::factory()->create();

        $response = $this->get(route('enrollments.edit', $enrollment));

        $response->assertOk();
        $response->assertViewIs('enrollment.edit');
        $response->assertViewHas('enrollment');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\EnrollmentsController::class,
            'update',
            \App\Http\Requests\EnrollmentsUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $enrollment = Enrollments::factory()->create();
        $student = Student::factory()->create();
        $course = Course::factory()->create();
        $enrollments_date = fake()->;
        $status = fake()->randomElement(/** enum_attributes **/);

        $response = $this->put(route('enrollments.update', $enrollment), [
            'student_id' => $student->id,
            'course_id' => $course->id,
            'enrollments_date' => $enrollments_date,
            'status' => $status,
        ]);

        $enrollment->refresh();

        $response->assertRedirect(route('enrollments.index'));
        $response->assertSessionHas('enrollment.id', $enrollment->id);

        $this->assertEquals($student->id, $enrollment->student_id);
        $this->assertEquals($course->id, $enrollment->course_id);
        $this->assertEquals($enrollments_date, $enrollment->enrollments_date);
        $this->assertEquals($status, $enrollment->status);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $enrollment = Enrollments::factory()->create();
        $enrollment = Enrollment::factory()->create();

        $response = $this->delete(route('enrollments.destroy', $enrollment));

        $response->assertRedirect(route('enrollments.index'));

        $this->assertModelMissing($enrollment);
    }
}
