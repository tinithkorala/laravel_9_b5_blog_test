<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class UserManageController extends Controller
{
    
    public function index() {

        // $all_users = User::all();
        $all_users = DB::select("SELECT * FROM users");
        // dd($all_users);
        return view('user.user_index', compact('all_users'));

    }

}
