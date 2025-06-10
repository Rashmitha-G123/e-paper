<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
   public function edition()
{
    return $this->belongsTo(Edition::class);
}
protected $fillable = [
        'image_path',
        'page_number',
        'edition_id',
        'description',
        // add other columns here as needed
    ];
}
