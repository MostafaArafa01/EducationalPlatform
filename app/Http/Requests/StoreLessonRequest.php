<?php

namespace App\Http\Requests;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreLessonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $course = Course::findOrFail($this->course_id)->first();
        // dd($course);
        return Gate::authorize('create',$course)? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'course_id' =>[
                Rule::unique('lessons','course_id')->where('title',$this->title)
            ],
            'status' => 'required|in:finished,not finished',
            'title' => 'required',
        ];
    }
}
