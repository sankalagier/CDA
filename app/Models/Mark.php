<?php

namespace App\Models;

// use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SDamian\Larasort\AutoSortable;

class Mark extends Model
{

    use AutoSortable;

    use HasFactory;

    protected $fillable = [
        'subject_id',
        'classroom_id',
        'user_id',
        'mark',
        'term'
    ];

    private array $sortables = [
        'mark',
        'subject_id',
        'classroom_id',
        'term',
        'created_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function classroom() {
        return $this->belongsTo(Classroom::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
