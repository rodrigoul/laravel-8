<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ShoppingListModel extends Model
{
    use HasFactory;

    protected $table = 'shopping_lists';
    protected $fillable = ['name'];

    public function purchases() : HasMany
    {
        return $this->hasMany(PurchaseModel::class, 'shopping_list_id');
    }
}
