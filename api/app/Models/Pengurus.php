<?php

namespace App\Models;

use Carbon\Carbon;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject; // <-- import JWTSubject 
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pengurus extends Authenticatable implements JWTSubject
{
    use HasFactory;
    // use Authenticatable, Authorizable;
    protected $table = 'pengurus';
    protected $primaryKey = 'pengurus_id';
    public $timestamps = false;

    public function scopeData($query)
    {
        return $query
            // ->whereNull($query->qualifyColumn('dihapus_pada'))
            ->selectRaw(
                '*, ROW_NUMBER() over(ORDER BY pengurus_id DESC) no_urut'
            );
    }

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
