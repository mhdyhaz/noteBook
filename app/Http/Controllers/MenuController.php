<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Menu;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function index()
    {
        // نمایش منوهای مربوط به کاربر جاری
        $menus = Auth::user()->menus;
        return view('AllMenus.menu', compact('menus'));
    }

    public function create()
    {
        // نمایش منوها و تگ‌های مربوط به کاربر جاری
        $menus = Auth::user()->menus;
        $tags = Auth::user()->tags;
        return view('AllMenus.createMenu', compact('menus', 'tags'));
    }

    public function store(Request $request)
{
    // اعتبارسنجی درخواست
    $request->validate([
        'name' => 'required',
        'parent_menu' => 'nullable|exists:menus,id',
        'tag' => 'nullable'
    ]);

    // ایجاد منو
    $menu = Auth::user()->menus()->create([
        'name' => $request->name,
        'parent_id' => $request->parent_menu,
    ]);

    // اضافه کردن تگ‌ها به منو
    $tagsList = [];
    if ($request->has('tag')) {
        $tags = explode(',', $request->tag);
        foreach ($tags as $tagName) {
            $tag = Tag::firstOrCreate(['name' => trim($tagName)]);
            $menu->tags()->attach($tag->id);
            $tagsList[] = $tagName; // ذخیره نام تگ‌ها برای پیام
        }
    }

    // ایجاد پیام موفقیت‌آمیز با نام منو و تگ‌ها
    $tagsString = implode(', ', $tagsList);
    return redirect()->back()->with('success', "Menu '{$menu->name}' created successfully with tags: {$tagsString}");
}
 }