<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingListModel extends Model
{
    use HasFactory;

    protected $table = 'shopping_lists';
    protected $fillable = ['name'];

    public function items() : HasMany
    {
        return $this->hasMany(ItemModel::class, 'shopping_list_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
