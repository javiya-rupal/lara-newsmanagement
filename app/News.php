<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model {

	//posts table in database
	protected $guarded = [];	
	public function author()
	{
		return $this->belongsTo('App\User','author_id');
	}

}
