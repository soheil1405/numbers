<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_answer;
class AdminController extends Controller
{
    public function index(){


        




        return view('admin.dashboard.dashboard' );



    }
}
