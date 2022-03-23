<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use HasFactory;

    protected $table = 'invites';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];

    public function story(){
        return $this->hasMany(Story::class);
    }

    public function reservation(){
        return $this->hasMany(Reservation::class);
    }
}
