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

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
 

        public function sharedMenus(): HasMany
        {
            return $this->hasMany(MenuShare::class, 'shared_by');
        }
    
        public function receivedSharedMenus(): BelongsToMany
        {
            return $this->belongsToMany(Menu::class, 'menu_shares', 'user_id', 'menu_id')
                        ->withPivot('shared_by')
                        ->withTimestamps();
    }
    

 }