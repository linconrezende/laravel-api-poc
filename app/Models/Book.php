<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'user_id'];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'user_id' => 'integer'
    ];
    
    public function indices()
    {
        return $this->hasMany(BookIndex::class, 'book_id', 'id')->where('index_id', null)->with('subIndices');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
