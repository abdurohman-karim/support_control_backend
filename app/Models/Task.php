<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'text',
        'user_id',
        'chat_name',
        'chat_id',
        'is_done',
        'is_deleted',
        'is_archived',
    ];
}
