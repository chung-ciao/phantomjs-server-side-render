<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TreeBranch extends Model
{  
	public $timestamps = false;
  protected $table = 'tree_branch';
  protected $casts = [
		'id' => 'string'
	];
}
