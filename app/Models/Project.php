<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
    'title',
    'client',
    'leader_name',
    'leader_email',
    'leader_photo',
    'start_date',
    'end_date',
];

}
