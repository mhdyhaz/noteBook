<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    // نمایش صفحه منو
    public function showMenu()
    {
        return view('AllMenus.menu'); 
    }
    public function create()
    {
        return view('AllMenus.create_menu'); 
    }
    public function edit()
    {
        return view('AllMenus.edit'); 
    }
}
