<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservations';
    protected $primaryKey = 'id';

    protected $guarded = ['id'];
    
    public function invite(){
        return $this->belongsTo(Invite::class);
    }

}
