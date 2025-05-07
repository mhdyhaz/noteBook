<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Auth::user()->menus()->with('children', 'tags', 'parent')->get();
        return view('AllMenus.menu', compact('menus'));
    }

 public function create()
{
    $menus = Auth::user()->menus;
    $tags = Tag::where('user_id', auth()->id())->get(); // فقط تگ‌های کاربر فعلی
    return view('AllMenus.createMenu', compact('menus', 'tags'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'parent_menu' => 'nullable|exists:menus,id',
            'tags' => 'nullable|array'
        ]);

        $menu = Auth::user()->menus()->create([
            'name' => $request->name,
            'parent_id' => $request->parent_menu,
        ]);

        $tagIds = [];
        if ($request->has('tags')) {
            foreach ($request->tags as $tag) {
                if (!is_numeric($tag)) {
                    // اگر تگ جدید باشد، ذخیره آن
                    $tag = Tag::firstOrCreate(['name' => $tag, 'user_id' => Auth::id()]); // user_id اضافه شد
                } else {
                    // اگر تگ موجود باشد، به صورت عددی دریافت آن
                    $tag = Tag::find($tag);
                }
                if ($tag) {
                    $tagIds[] = $tag->id;
                }
            }
        }

  
        $menu->tags()->sync($tagIds);

        return redirect()->route('AllMenus.menu');
    }

    public function list()
    {
        $menus = Auth::user()->menus()->with('children', 'tags', 'parent')->get();
        return view('AllMenus.list', compact('menus'));
    }
    public function editMenu($id)
    {
        $menu = Menu::findOrFail($id);
    
        // اطمینان از اینکه منوی والد فعلی از لیست حذف شده است

        $parentMenus = Auth::user()->menus->where('id', '!=', $menu->id);
    
        $tags = Tag::where('user_id', auth()->id())->get(); // فقط تگ‌های کاربر فعلی
        return view('AllMenus.editMenu', compact('menu', 'parentMenus', 'tags'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'parent_id' => 'nullable|exists:menus,id',
            'tags' => 'nullable|array'
        ]);

        $menu = Menu::findOrFail($id);

        // اطمینان از اینکه منو متعلق به کاربر فعلی است
        if ($menu->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'شما مجوز ویرایش این منو را ندارید.');
        }

        $menu->name = $request->input('name');
        $menu->parent_id = $request->input('parent_id');
        $menu->save();

        $tagIds = [];
        $tags = $request->input('tags', []);
        foreach ($tags as $tagName) {
            if (!is_numeric($tagName)) {
                // بررسی اینکه تگ جدید وجود ندارد و آن را ذخیره کنید
                $tag = Tag::firstOrCreate(['name' => $tagName, 'user_id' => Auth::id()]); // user_id اضافه شد
                $tagIds[] = $tag->id;
            } else {
                // اگر تگ شناسه عددی است، آن را اضافه کنید
                $tagIds[] = $tagName;
            }
        }

        $menu->tags()->sync($tagIds);

        return redirect()->route('AllMenus.list')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        $menu->shares()->delete(); 

        $menu->delete();

        return redirect()->route('AllMenus.list')->with('success', 'Menu has been successfully deleted.');
    }
}
