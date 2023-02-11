<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIndex extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'page', 'index_id', 'book_id'];
    protected $hidden = [
        'index_id',
        'book_id',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'page' => 'integer',
        'index_id' => 'integer',
        'book_id' => 'integer',
    ];
}
