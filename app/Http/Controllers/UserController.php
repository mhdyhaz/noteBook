<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function sharedMe()
    {
        return view('Share.sharedMe');
    }
    public function sharedOther()
    {
        return view('Share.sharedOther');
    }
 }