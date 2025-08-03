<?php

namespace App\Models;

use App\Http\Requests\SessionFormRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class StudySession extends Model
{
    /** @use HasFactory<\Database\Factories\StudySessionFactory> */
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'study_duration',
        'start_time',
        'end_time',
        'status',
        'notes'
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Notes::class);
    }
    

    /**
     * Apply session data from the validated request.
     *
     * @param array $validated
     * @return array
     */
    public static function applySessionData(array $validated): array
    {
        return array_merge($validated, [
            'title' => $validated['title'] ?? null,
            'start_time' => $validated['start_time'] ?? now(),
            'end_time' => $validated['end_time'] ?? now()->addMinutes(25),
            'study_duration' => $validated['study_duration'] ?? 25, 
            'notes' => $validated['notes'] ?? 'No notes given',
            'user_id' => Auth::id(), 
        ]);
    }

    public function progressionlvl(int $xp): int
    {
        return $this->user->current_xp += $xp;
    }

    public static function calculateXPForSession($sessionDuration)
    {
        //for every 5 minutes, you get 2xp
        for( $i = 1; $i <= $sessionDuration; $i += 25) {
            $xp[] = 10;
        }
        return array_sum($xp);
    }
}
