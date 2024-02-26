<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = ['shopping_list_id', 'category_id' ,'name', 'quantity', 'completed'];

    public function shoppingLists()
    {
        return $this->belongsTo(ShoppingListModel::class, 'shopping_list_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseModel::class);
    }
}
