<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseModel extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'item_id', 'shopping_list_id', 'quantity'];


    public function user()
    {
        return $this->belongsTo(User::class);   
    }

    public function items()
    {
        return $this->belongsTo(ItemModel::class);
    }

    public function shoppingList()
    {
        return $this->belongsTo(ShoppingListModel::class);
    }
}
