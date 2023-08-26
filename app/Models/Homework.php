<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SDamian\Larasort\AutoSortable;
use SDamian\Larasort\Larasort;

Larasort::setDefaultSortable('created_at');
Larasort::setSortablesDefaultOrder([
    'desc' => ['created_at'],
]);

class Homework extends Model
{
    use HasFactory;

    use AutoSortable;

    protected $fillable = [
        'classroom_id',
        'title',
        'content',
    ];

    private array $sortables = [
        'title',
        'classroom_id',
        'content',
        'created_at',
    ];

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

}
