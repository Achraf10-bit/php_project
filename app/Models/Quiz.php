<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['category_id', 'question', 'options', 'correct_option'];

    protected $casts = [
        'options' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function results()
    {
        return $this->hasMany(QuizResult::class);
    }
}
