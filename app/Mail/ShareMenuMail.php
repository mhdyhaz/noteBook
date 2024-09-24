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
        $menuContent = $this->menu->name . "\n";

        foreach ($this->menu->children as $child) {
            $menuContent .= "- " . $child->name . "\n";
        }

        return $this->subject('اشتراک‌گذاری منو')
                    ->view('Share.shareMenu')
                    ->with(['menuContent' => $menuContent]);
    }
}
