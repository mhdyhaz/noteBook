<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    protected $fillable = ['name','user_id'];

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class);
    }
}

