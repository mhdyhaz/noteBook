<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Menu extends Model
{
    protected $fillable = ['name', 'parent_id', 'user_id'];

    /**
     * Get the user that owns the menu.
     */

     // اشاره مبکنهmenu داره به کلاس اینجاthis

     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The tags that belong to the menu.
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'menu_tag');
    }

    /**
     * Get the parent menu.
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    /**
     * Get the child menus.
     */
    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
}
