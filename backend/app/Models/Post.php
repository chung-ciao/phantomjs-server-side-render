<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
class Post extends Model implements Sortable
{
    use SortableTrait;
    public $sortable = [
        'order_column_name' => 'data_order',
        'sort_when_creating' => true,
    ];

	protected $table = 'post';
	protected $casts = [
		'id' => 'string',
	];
}
