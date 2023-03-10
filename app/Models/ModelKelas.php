<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKelas extends Model
{
    public function getKelas($id_kelas = false)
    {
        if ($id_kelas) {
            return $this->db->table('kelas')
                ->where('id_kelas', $id_kelas)
                ->get()->getRowArray();
        } else {
            return $this->db->table('kelas')
                ->get()->getResultArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table("kelas")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('kelas')->where('id_kelas', $data['id_kelas'])
            ->update($data);
    }

    public function hapus($id_kelas)
    {
        $query = "delete from kelas where id_kelas = $id_kelas";
        return $this->db->query($query);
    }
}
