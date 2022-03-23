<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    use HasFactory;

    protected $table = 'stories';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    
    public function invite(){
        return $this->belongsTo(Invite::class);
    }
}
