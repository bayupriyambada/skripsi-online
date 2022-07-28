<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class PengajuanSkripsiResource extends JsonResource
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
            'pengajuan_skripsi_id' => $this->pengajuan_skripsi_id,
            'nama_pengajuan_skripsi' => $this->nama_pengajuan_skripsi,
            'deskripsi_pengajuan_skripsi' => $this->deskripsi_pengajuan_skripsi,
            'jawaban_status_pengajuan' => $this->jawaban_status_pengajuan,
            'telah_disetujui_kaprodi' => $this->telah_disetujui_kaprodi,
            'mahasiswa_username' => Str::ucfirst($this->getMahasiswa->username),
            'mahasiswa_nimn' => $this->getMahasiswa->nimn,
        ];
    }
}
