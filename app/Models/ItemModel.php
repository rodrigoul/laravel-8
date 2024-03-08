<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemModel extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = ['category_id' ,'name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function purchases()
    {
        return $this->hasMany(PurchaseModel::class, 'item_id');
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(CategoryModel::class, 'category_id');
    }
}
