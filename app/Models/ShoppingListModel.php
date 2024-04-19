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
    protected $fillable = ['name', 'user_id'];

    public function purchases() : HasMany
    {
        return $this->hasMany(PurchaseModel::class, 'shopping_list_id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
