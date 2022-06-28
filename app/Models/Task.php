<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'date',
        'time',
        'detail',
        'task_file',
    ];

    public function sub_tasks()
    {
        return $this->hasMany('App\Models\SubTask');
    }
}
