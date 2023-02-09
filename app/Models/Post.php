<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes;
     /**
 * The attributes that aren't mass assignable.
 *
 * @var array
 */
protected $guarded = ['id'];

public function category(){
    return $this->belongsTo(Category::class);
}

}
