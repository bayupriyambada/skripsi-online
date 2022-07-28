<?php

namespace App\Http\Resources\Single;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'mahasiswa_id' => $this->mahasiswa_id,
            'username' => Str::ucfirst($this->username),
            'nimn' => $this->nimn,
            'email' => $this->email,
            'jenis_kelamin' => $this->jenis_kelamin,
            'mahasiswa_fakultas' => Str::ucfirst($this->getFakultas->nama_fakultas),
            'mahasiswa_fakultas_singkatan' => Str::upper($this->getFakultas->singkat),
        ];
    }
}
