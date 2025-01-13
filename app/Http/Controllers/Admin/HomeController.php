<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    //devuelve admin/index
    public function index(Request $request){
        $user = Auth::user();
        return view('admin.index', compact( 'user'));    }
}
