<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class MenuShare extends Model
{
    protected $fillable = ['menu_id', 'user_id'];

    /**
     * Get the menu that is shared.
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the user who received the shared menu.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

