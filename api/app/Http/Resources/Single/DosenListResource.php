<?php

namespace App\Http\Resources\Single;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class DosenListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'dospem_id' => $this->dospem_id,
            'username' => Str::ucfirst($this->username),
            'nidn' => $this->nidn,
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'dosen_fakultas' => Str::ucfirst($this->getFakultas->nama_fakultas),
            'dosen_fakultas_singkatan' => Str::upper($this->getFakultas->singkat),
        ];
    }
}
