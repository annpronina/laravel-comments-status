<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRole(Request $request, User $user)
    {
        // Validate the incoming request to ensure the role exists
        $request->validate([
            'role_id' => 'required|exists:roles,id',  // Ensure the role_id exists in the roles table
        ]);

        // Attach the role to the user
        $user->roles()->attach($request->role_id);

        // Return a success message
        return response()->json(['message' => 'Role assigned successfully']);
    }
}
