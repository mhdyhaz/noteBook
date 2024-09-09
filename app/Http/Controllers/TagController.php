<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return view('Tag.addTag');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tags,name',
        ]);

        Tag::create(['name' => $request->name]);

        return redirect()->back()->with('success', 'Tag created successfully!');
    }
    
}
