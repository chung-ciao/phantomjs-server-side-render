<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Contact extends Model
{

	protected $dates = [
		'created_at',
		'updated_at',
	];
  
  protected $table = 'contact';
  protected $casts = [
		'id' => 'string',
		'status' => 'boolean',
	];
}
