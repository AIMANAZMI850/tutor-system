<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tutor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class TutorController extends Controller
{
    public function saveTutor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tutors', // Ensure table name is correct
            'phone' => 'required|string|min:8',
        ]);
    
        $tutor = Tutor::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);
    
        return redirect()->route('tutorlist')->with('success', 'Tutor added successfully.');
    }
    

    public function tutorlist()
    {
        $listTutor = Tutor::paginate(5); // Fetch 10 users per page, adjust as needed
        return view('tutorlist', compact('listTutor'));
    }
   

    public function markDelete($id) {
        $listTutor = Tutor::find($id);
        if ($listTutor) {
            $listTutor->delete();
            return redirect()->back()->with('success', 'Tutor deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Tutor not found.');
        }
    }
    
    public function markUpdate($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
    
        $tutor = Tutor::find($id);
        if ($tutor) {
            $tutor->name = $request->name;
            $tutor->phone = $request->phone;
            // Update password only if provided
            if ($request->password) {
                $tutor->password = Hash::make($request->password);
            }
            $tutor->save(); // Save changes to $tutor, not $user
            return redirect('tutorlist')->with('success', 'Tutor updated successfully.');
        }
        return redirect('tutorlist')->with('error', 'Tutor not found.');
    }
    
    

}
