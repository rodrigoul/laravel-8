<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function items()
    {
        return $this->hasMany(ItemModel::class);
    }
}
