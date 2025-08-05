<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [ 'title', 'slug', 'body', 'is_published', 'publish_date', 'meta_description', 'tags', ];
}
