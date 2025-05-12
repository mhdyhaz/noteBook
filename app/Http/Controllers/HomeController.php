<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('Dashboard.home'); 
    }

    public function header(){
        return view('Layouts.header');
    }
    
}
