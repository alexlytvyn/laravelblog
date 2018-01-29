<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
	protected $table = "articles";
	protected $primaryKey = "id";

	protected $fillable = [
		'title', 'text_short', 'text_full', 'author'
	];

	protected $dates = [
		'created_at', 'updated_at'
	];

	/* Relations */
	 public function categories()
	 {
			 return $this->belongsToMany(Category::class, 'category_articles', 'article_id',
					 'category_id');
	 }
}
