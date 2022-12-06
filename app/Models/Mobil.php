<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
  
class Mobil extends Model
{
    use HasFactory,SoftDeletes;
  
    /**
     * The attributes that are mass assignable.
     *  
     * @var array
     */
    protected $fillable = [
        'id_mobil', 'merk', 'tahun', 'harga', 'ktp_pembeli', 'ktp_pemilik'
    ];
    protected $primaryKey = 'id_mobil';
    protected $KeyType = 'bigInteger';
    public $incrementing = false;
}