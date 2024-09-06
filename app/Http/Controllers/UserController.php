<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('user.list',compact('users'));
    }

    public function save(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string',
            'status' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput()
                             ->with('error', 'Validation failed! Please check your inputs.');
        }

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->status = $request->status;
    $user->role = $request->role;
    $user->password = Hash::make($request->password);
    $user->save();
    return redirect()->back()->with('success', 'User added successfully!');
    }
    

    public function update(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
            'role' => 'required',
            'status' => 'required',
        ]);

    $user = User::find($request->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->status = $request->status;
    $user->role = $request->role;
    $user->password = $request->password ?? Hash::make($request->password);
    $user->save();
    return redirect()->back()->with('success', 'User update successfully!');
    }

    public function status_update(Request $request){
        // Validate the incoming request data
    $request->validate([
        'id' => 'required|exists:users,id',
    ]);

    // Find the user by ID
    $user = User::find($request->id);

    // Toggle the user's status
    if ($user->status == 'Active') {
        $user->status = 'Deactive';
    } else {
        $user->status = 'Active';
    }

    // Save the updated status
    $user->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'User status updated successfully!');


    }
    
    public function delete($user){
        User::find($user)->delete();
        return redirect()->back()->with('success', 'User delete successfully!');
    }
    public function role_update(Request $request){
        // Find the user by ID
        $user = User::find($request->id);
        
        if ($user) {
            // Determine the new role
            $newRole = $user->role == 'User' ? 'Employer' : 'User';
            
            // Update the user's role
            $user->role = $newRole;
            $user->save();
            
            // Redirect back with a success message
            return redirect()->back()->with('success', 'User role updated successfully to ' . $newRole . '!');
        } else {
            // Handle case where user is not found
            return redirect()->back()->with('error', 'User not found!');
        }
    }
    
    

    
}
