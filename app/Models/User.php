<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password'];

    /**
     * Get the menus for the user.
     */
    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get the menus shared by the user.
     */
    public function sharedMenus(): HasMany
    {
        return $this->hasMany(MenuShare::class, 'shared_by');
    }

    /**
     * Get the menus shared with the user.
     */
    public function receivedSharedMenus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_shares')
                    ->withPivot('shared_by')
                    ->withTimestamps();
    }
}
