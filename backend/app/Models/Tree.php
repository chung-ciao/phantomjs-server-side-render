<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Kalnoy\Nestedset\NodeTrait;

class Tree extends Model
{
	use NodeTrait;
	public $timestamps = false;
    protected $fillable = ['id', 'branch_id', 'name', 'status', 'parent_id'];
	protected $table = 'tree';
	protected $casts = [
		'id' => 'string',
        'status' => 'boolean',
        'meta_data' => 'json',
	];
    protected  $hidden = ['branch_id', '_lft', '_rgt'];

    public static function resetActionsPerformed()
    {
        static::$actionsPerformed = 0;
    }

    protected function getScopeAttributes() {
        return ['branch_id'];
    }
}
