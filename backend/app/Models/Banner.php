<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
class Banner extends Model
{
	use SortableTrait;
  public $sortable = [
    'order_column_name' => 'data_order',
    'sort_when_creating' => true,
  ];
  
	protected $table = 'banner';
	protected $casts = [
		'id' => 'string',
		'photos' => 'array',
	];
}
