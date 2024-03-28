<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseModel extends Model
{
    protected $table = 'purchases';
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'shopping_list_id', 'quantity'];


    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');   
    }

    public function items() : BelongsTo
    {
        return $this->belongsTo(ItemModel::class, 'item_id');
    }

    public function shoppingList() : BelongsTo
    {
        return $this->belongsTo(ShoppingListModel::class, 'shopping_list_id');
    }
}
