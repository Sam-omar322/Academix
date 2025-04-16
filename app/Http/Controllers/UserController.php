<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $users = user::all();
        $title = 'User List';
        return view('admin.users.index', compact('users', 'title'));
    }

    public function destroy(User $user)
    {
        if ($user->role === 'admin') {
            Session::flash('flash_message', 'لا يمكن حذف الادمن');
            return redirect()->back();
        }
    
        $user->delete();

        Session::flash('flash_message', 'تم حذف المستخدم بنجاح');
        return redirect()->route('users.index');
    }
    
}
