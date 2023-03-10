<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBerkas extends Model
{
    public function getBerkas($id_berkas = false)
    {
        if ($id_berkas) {
            return $this->db->table('berkas')
                ->join('user', 'berkas.user_id=user.id_user')
                ->where('id_berkas', $id_berkas)
                ->get()->getRowArray();
        } else {
            return $this->db->table('berkas')
                ->join('user', 'berkas.user_id=user.id_user')
                ->get()->getResultArray();
        }
    }

    public function getBerkas_dosen($id_dosen)
    {
        return $this->db->table('berkas')
            ->where('user_id', $id_dosen)
            ->get()->getResultArray();
    }

    public function getBerkas_pegawai($id_pegawai)
    {
        return $this->db->table('berkas')
            ->where('user_id', $id_pegawai)
            ->get()->getResultArray();
    }

    public function tambah($data)
    {
        return $this->db->table("berkas")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('berkas')->where('id_berkas', $data['id_berkas'])
            ->update($data);
    }

    public function hapus($id_berkas)
    {
        $query = "delete from berkas where id_berkas = $id_berkas";
        return $this->db->query($query);
    }
}
