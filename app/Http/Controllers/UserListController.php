<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserListController extends Controller
{
    public function saveUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);
    
        return redirect()->route('userlist')->with('success', 'User added successfully.');
    }
    
    
    

    public function userlist()
    {
        $listUser = User::paginate(20); // Fetch 10 users per page, adjust as needed
        return view('userlist', compact('listUser'));
    }
   

    public function markDelete($id) {
        $listUser = User::find($id);
        if ($listUser) {
            $listUser->delete();
            return redirect()->back()->with('success', 'User deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }
    
    public function markUpdate($id, Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
        ]);
    
        $user = User::find($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            // Update password only if provided
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->save();
            return redirect('userlist')->with('success', 'User updated successfully.');
        }
        return redirect('userlist')->with('error', 'User not found.');
    }
    

}
