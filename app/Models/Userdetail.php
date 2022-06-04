<?php

namespace App\Models;

use App\Models\Userlevel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Userdetail extends Model
{
    use HasFactory;

    // Field di database yang boleh diisi
    protected $guarded = ['id'];
    
    // Field yang berformat date (didaftarkan agar mudah diatur format display-nya dengan blade tamplate ) 
    protected $dates = ['birth'];

    // Relasi dengan table users (model: User)
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relasi dengan table users (model: Userlevel)
    public function userlevel(){
        return $this->belongsTo(Userlevel::class);
    }
}
