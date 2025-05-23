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

    // بارگذاری منو و فرزندان آن
    $menu = Menu::with(['tags', 'parent', 'children'])->findOrFail($request->menu_id);
    $user = Auth::user();

    // ارسال ایمیل به کاربر
    Mail::to($request->email)->send(new ShareMenuMail($menu, $user));

    // ذخیره اطلاعات اشتراک‌گذاری
    MenuShare::updateOrCreate([
        'menu_id' => $menu->id,
        'user_id' => $userToShare->id,
    ], [
        'shared_by' => Auth::id(), 
    ]);

    return response()->json(['message' => 'منو با موفقیت به اشتراک گذاشته شد']);
}

    public function sharedOther()
    {
         
        $sharedMenus = MenuShare::where('shared_by', Auth::id())
                                ->with('menu', 'menu.tags', 'menu.parent', 'user')
                                ->get();

        return view('Share.sharedOther', compact('sharedMenus'));
    }

    public function receivedSharedMenus()
    {
        
        $menus = Auth::user()->receivedSharedMenus()->with('sharedBy')->get();

        return view('Share.sharedMe', compact('menus'));
    }

public function removeSharedMenu(Request $request)
{
    $request->validate([
        'menu_id' => 'required|exists:menus,id',
    ]);

    $user = Auth::user();
  
    MenuShare::where('menu_id', $request->menu_id)
             ->where('user_id', $user->id)
             ->where('shared_by', '!=', Auth::id())  
             ->delete();

    return redirect()->route('Share.sharedMe')->with('success', 'اشتراک‌گذاری منو با موفقیت حذف شد.');
}
public function removeSharedMenuAsSender(Request $request)
{
    $request->validate([
        'menu_id' => 'required|exists:menus,id',
        'receiver_id' => 'required|exists:users,id',
    ]);

    $user = Auth::user();

    // یافتن رکورد اشتراک‌گذاری که توسط فرستنده انجام شده باشد
    $menuShare = MenuShare::where('menu_id', $request->menu_id)
                          ->where('user_id', $request->receiver_id)
                          ->where('shared_by', $user->id)
                          ->first();

   
        $menuShare->delete();
        return redirect()->back()->with('success', 'اشتراک‌گذاری منو با موفقیت حذف شد.');
    
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
}
