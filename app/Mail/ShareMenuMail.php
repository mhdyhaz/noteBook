<?php

namespace App\Mail;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShareMenuMail extends Mailable
{
    use Queueable, SerializesModels;

    public $menu;
    public $user;

    public function __construct(Menu $menu, User $user)
    {
        $this->menu = $menu;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('Share.shareMenu')
                    ->with([
                        'menuName' => $this->menu->name,
                        'parentName' => $this->menu->parent ? $this->menu->parent->name : 'بدون والد',
                        'tags' => $this->menu->tags->pluck('name')->toArray(),
                        'sharedBy' => $this->user->name,
                    ]);
    }
}
