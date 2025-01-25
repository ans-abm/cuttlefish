<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductCategory;

class Product extends Model
{
    public function category()
	{
		return $this->belongsTo(ProductCategory::class, 'category_id');
	}
}
