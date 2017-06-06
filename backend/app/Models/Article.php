<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
class Article extends Model implements Sortable
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
  
  protected $table = 'article';
  protected $casts = [
		'id' => 'string',
		'is_lock' => 'boolean',
    'status' => 'boolean',
	];
  // 該文章的分類
  public function category () {
    return $this->belongsToMany('App\Models\Tree', 'article_category', 'article_id', 'category_id');
  }
}
