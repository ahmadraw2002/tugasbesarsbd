<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pemilik extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'ktp_pemilik', 'nama', 'no_hp', 'alamat'
    ];
    protected $primaryKey = 'ktp_pemilik';
    protected $KeyType = 'bigInteger';
    public $incrementing = false;
}