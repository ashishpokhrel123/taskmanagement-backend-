<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'task';

    protected $fillable = [
        'task', 'user_id', 'status',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
