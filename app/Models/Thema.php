<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thema extends Model
{
    use HasFactory;

    protected $table = 'themes';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
}
