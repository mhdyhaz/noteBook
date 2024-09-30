<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::where('user_id', auth()->id())->orderBy('id', 'desc')->get();
        return view('Tag.addTag', compact('tags'));
    }
    
    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags,name'
        ]);
    
        Tag::create([
            'name' => $request->name,
            'user_id' => auth()->id(),
        ]);
    
        return redirect()->route('Tag.addTag');
    }
    
}
