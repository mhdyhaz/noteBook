<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuShare extends Model
{
    protected $fillable = ['menu_id', 'user_id', 'shared_by'];

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }
    

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sharedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'shared_by');
    }
    
}
