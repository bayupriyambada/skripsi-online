<?php

namespace App\Models;

use Carbon\Carbon;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; // <-- import JWTSubject 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Foundation\Auth\User as Authenticatable;

class Mahasiswa extends Authenticatable implements JWTSubject
{
    use HasFactory;
    // use Authenticatable, Authorizable;
    protected $table = 'mahasiswa';
    protected $primaryKey = 'mahasiswa_id';
    public $timestamps = false;

    public function scopeData($query)
    {
        return $query
            ->whereNull($query->qualifyColumn('dihapus_pada'))
            ->selectRaw(
                '*, ROW_NUMBER() over(ORDER BY mahasiswa_id DESC) no_urut'
            );
    }

    public function getPengajuanSkripsi()
    {
        return $this->hasMany('App\Models\PanduanSkripsiModel' , 'mahasiswa_id');
    }
    public function getFakultas()
    {
        return $this->hasOne('App\Models\FakultasModel', 'fakultas_id' , 'fakultas_id')->select('fakultas_id' ,'singkat', 'nama_fakultas');
    }

    // public function getFakultas(){
    //     $this->hasOne()
    // }

    protected $hidden = ['password'];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
