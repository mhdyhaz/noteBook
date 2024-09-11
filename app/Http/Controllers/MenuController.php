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
        $tags = Auth::user()->tags;
        return view('AllMenus.createMenu', compact('menus', 'tags'));
    }

    public function store(Request $request)
{
    // جایی که اعتبارسنجی انجام میشه باید براش پیام ارور بذاریم تا نشون بده چه مشکلی داره
    $request->validate([
        'name' => 'required',
        'parent_menu' => 'nullable|exists:menus,id',
        'tag' => 'nullable'
    ]);
    $menu = Auth::user()->menus()->create([
        'name' => $request->name,
        'parent_id' => $request->parent_menu,
    ]);

    
      
        if ($request->has('tag')) {
            $tags = explode(',', $request->tag);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $menu->tags()->attach($tag->id);
            
        }
        }
      
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
        $parentMenus = Auth::user()->menus->where('id', '!=', $menu->id); // excluding the current menu
        $tags = Tag::all();

        return view('AllMenus.editMenu', compact('menu', 'parentMenus', 'tags'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'parent_menu' => 'nullable|exists:menus,id',
            'tag' => 'nullable'
        ]);

      
        $menu = Menu::findOrFail($id);
        $menu->update([
            'name' => $request->name,
            'parent_id' => $request->parent_menu,
        ]);

      
        $menu->tags()->detach();
        if ($request->has('tag')) {
            $tags = explode(',', $request->tag);
            foreach ($tags as $tagName) {
                $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
                $menu->tags()->attach($tag->id);
            }
        }

     
        return redirect()->route('AllMenus.menu');
    }

    public function destroy($id)
    {
        
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('AllMenus.menu');
    }
}
