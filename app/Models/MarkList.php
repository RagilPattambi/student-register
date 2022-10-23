<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkList extends Model
{
    use HasFactory;
    protected $fillable = [
        'student',
        'maths',
        'science',
        'history',
        'term',
        'total_marks'
    ];
    protected $primaryKey = 'mid';
}
