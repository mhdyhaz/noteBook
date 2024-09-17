<?php
namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\MenuShare;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ShareMenuMail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function shareMenu(Request $request)
    {

        $request->validate([
            'email' => 'required|email',
            'menu_id' => 'required|exists:menus,id',
        ]);
    
       
        $userToShare = User::where('email', $request->email)->first();
    
        if (!$userToShare) {
            return response()->json(['message' => 'کاربری با این ایمیل یافت نشد'], 404);
        }

        $menu = Menu::with('tags', 'parent')->findOrFail($request->menu_id);
        $user = Auth::user();
    
        Mail::to($request->email)->send(new ShareMenuMail($menu, $user));
    
        MenuShare::create([
            'menu_id' => $menu->id,
            'user_id' => $userToShare->id,
            'shared_by' => Auth::id(), // ذخیره شناسه کاربر ارسال‌کننده
        ]);
        
        return response()->json(['message' => 'منو با موفقیت به اشتراک گذاشته شد']);
    }
    


    public function sharedOther()
    {
        // بازیابی منوهایی که توسط کاربر به اشتراک گذاشته شده‌اند
        $sharedMenus = MenuShare::where('shared_by', Auth::id())
                                ->with('menu', 'menu.tags', 'menu.parent', 'sharedBy')
                                ->get();
    
        return view('Share.sharedOther', compact('sharedMenus'));
    }
    
    
    
    
    
    
   public function checkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email',
    ]);

    $userExists = User::where('email', $request->email)->exists();

    if ($userExists) {
        return response()->json(['success' => true], 200);
    } else {
        return response()->json(['success' => false, 'message' => 'کاربری با این ایمیل یافت نشد'], 404);
    }
}

public function receivedSharedMenus()
{
    // دریافت منوهایی که به کاربر ارسال شده‌اند
    $menus = Auth::user()->receivedSharedMenus()->with('user')->get();

    return view('Share.sharedMe', compact('menus'));
}

public function removeSharedMenu(Request $request)
{
    $request->validate([
        'menu_id' => 'required|exists:menus,id',
    ]);

    $user = Auth::user();
    $user->receivedSharedMenus()->detach($request->menu_id);

    return redirect()->route('Share.sharedMe')->with('success', 'منو با موفقیت حذف شد.');
}



}
