<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
class Product extends Model implements Sortable
{
    use SortableTrait;
    public $sortable = [
        'order_column_name' => 'data_order',
        'sort_when_creating' => true,
    ];

	protected $dates = [
		'created_at',
		'updated_at',
	];
  
    protected $table = 'product';
    protected $casts = [
        'id' => 'string',
        'status' => 'boolean',
    ];

    public function category () {
    return $this->belongsToMany('App\Models\Tree', 'product_category', 'product_id', 'category_id');
    }
}
