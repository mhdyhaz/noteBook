<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuShare;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resources shared with the current user.
     */
    public function sharedMe()
    {
        // دریافت منوهایی که با کاربر جاری به اشتراک گذاشته شده‌اند
        $sharedMenus = MenuShare::where('user_id', Auth::id())->with('menu')->get()->pluck('menu');

        return view('Share.sharedMe', compact('sharedMenus'));
    }

    /**
     * Display a listing of the resources shared by the current user.
     */
    public function sharedOther()
    {
        // دریافت منوهایی که کاربر جاری با دیگران به اشتراک گذاشته است
        $sharedMenus = Menu::whereIn('id', MenuShare::where('user_id', Auth::id())->pluck('menu_id'))->get();

        return view('Share.sharedOther', compact('sharedMenus'));
    }

    /**
     * Share a menu with another user.
     */
    public function shareMenu(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // ایجاد رکورد جدید در جدول shares برای به اشتراک‌گذاری منو
        MenuShare::create([
            'menu_id' => $request->menu_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back()->with('success', 'Menu shared successfully!');
    }
}

