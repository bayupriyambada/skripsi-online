<?php

namespace App\Http\Resources\Single;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class DataListMahaDosenResource extends JsonResource
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
            'dosen_mahasiwa_id' => $this->dosen_mahasiwa_id,
            'no_urut' => $this->no_urut,
            'dosen_username' => Str::ucfirst($this->getDospem->username),
            'dosen_email' => $this->getDospem->email,
            'dosen_nidn' =>$this->getDospem->nidn,
            // mahasiswa
            'mahasiswa_username' => Str::ucfirst($this->getMahasiswa->username),
            'mahasiswa_email' => $this->getMahasiswa->email,
            'mahasiswa_nimn' =>$this->getMahasiswa->nimn,
            
        ];
    }
}
