<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemModel extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'quantity', 'completed'];

    public function shoppingLists()
    {
        return $this->belongsTo(ShoppingListModel::class);
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
