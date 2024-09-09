<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    protected $fillable = ['name', 'parent_id', 'user_id'];

    /**
     * Get the user that owns the menu.
     */
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
}
