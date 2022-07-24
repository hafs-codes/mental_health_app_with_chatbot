<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TherapySessions extends Model
{
    use HasFactory;
    protected $fillable = ['therapistemail','therapistname','therapistphonenumber','studentemail','studentphonenumber','studentname','date','completion'];
}
