<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Edition extends Model
{
    use HasFactory;

    protected $fillable = ['publication_type', 'publication_name', 'edition_date'];

    public function pages()
{
    return $this->hasMany(Page::class);
}

}
