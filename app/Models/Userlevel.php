<?php

namespace App\Models;

use App\Models\Userdetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Userlevel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi dengan table users (model: Userdetails)
    public function userdetail(){
        return $this->hasMany(Userdetail::class);
    }
}
