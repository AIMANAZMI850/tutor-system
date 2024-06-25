<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function saveCourse(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
            'total_learn_hours' => 'required|string|max:255',
        ]);

        $course = Course::create([
            'name' => $validated['name'],
            'description' => $validated['desc'],
            'rating' => $validated['rating'],
            'total_learn_hours' => $validated['total_learn_hours'],
        ]);

        return redirect()->back()->with('save', 'Course added successfully.');
    }

    public function courselist()
    {
        $listCourse = Course::paginate(5);
        return view('courselist', compact('listCourse'));
    }

    public function markDelete($id)
    {
        $course = Course::find($id);
        if ($course) {
            $course->delete();
            return redirect()->back()->with('success', 'Course deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Course not found.');
        }
    }

    public function markUpdate($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'rating' => 'required|string|max:255',
        ]);

        $course = Course::find($id);
        if ($course) {
            $course->name = $request->name;
            $course->description = $request->description;
            $course->rating = $request->rating;
            $course->save();
            return redirect()->route('courselist')->with('success', 'Course updated successfully.');
        }
        return redirect()->route('courselist')->with('error', 'Course not found.');
    }
}
