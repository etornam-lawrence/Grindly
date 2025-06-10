<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserXP extends Model
{
    /** @use HasFactory<\Database\Factories\UserXPFactory> */
    use HasFactory;

    protected $table = 'xp_levels';
    protected $fillable = [
        'level',
        'level_name',
        'xp_needed',
        'xp_reward',
    ];
    /**
     * Get the next level's XP requirement.
     *
     * @return int|null
     */
    public function nextLevelXp()
    {
        $nextLevel = self::where('level', '>', $this->level)->orderBy('level')->first();
        return $nextLevel ? $nextLevel->xp_needed : null;
    }
}
