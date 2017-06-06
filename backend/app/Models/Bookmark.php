<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
class Bookmark extends Model implements Sortable
{
  use SortableTrait;
  public $sortable = [
    'order_column_name' => 'data_order',
    'sort_when_creating' => true,
  ];
  public $timestamps = false;

	protected $table = 'bookmark';
	protected $casts = [
		'id' => 'string',
		'route' => 'array',
	];
    protected $hidden = [
        'email'
    ];
}
