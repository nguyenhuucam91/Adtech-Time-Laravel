<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table = "logs";

    protected $fillable = ['user_id', 'username', 'avatar_url', 'card_id', 'logged_at', 'time_spent', 'description', 'board_id'];

    public function getLoggedAtAttribute()
    {
        return Carbon::parse($this->attributes['logged_at'])->format('d-m-Y');
    }
}
