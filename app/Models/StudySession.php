<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudySession extends Model
{
    /** @use HasFactory<\Database\Factories\StudySessionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_name',
        'topic',
        'date',
        'start_time',
        'end_time',
        'duration',
        'notes',
        'status',
    ];
    protected $casts = [
        'date' => 'date',
        'time' => 'time',
        'duration' => 'integer',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeOngoing($query)
    {
        return $query->where('status', 'started');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}
