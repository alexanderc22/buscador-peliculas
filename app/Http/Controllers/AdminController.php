<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::select('id', 'name', 'email', 'role', 'created_at')->paginate(10);
        return view('admin.dashboard', compact('users'));
    }
}
