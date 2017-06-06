<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
class Design extends Model implements Sortable
{
    use SortableTrait;
    public $sortable = [
        'order_column_name' => 'data_order',
        'sort_when_creating' => true,
    ];
	protected $table = 'design';
	protected $casts = [
		'id' => 'string',
		'status' => 'boolean',
	];
}
