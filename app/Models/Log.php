<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $table = 'logs';
    public $timestamps = false; // pakai logged_at manual

    protected $fillable = [
        'user_id',
        'action',
        'ip_address',
        'device_browser',
        'logged_at',
    ];

    // Relasi ke user
    public function user() {
        return $this->belongsTo(User::class);
    }
}
