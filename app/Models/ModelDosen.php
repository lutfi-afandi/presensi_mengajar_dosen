<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDosen extends Model
{
    public function getDosen($id_dosen = false)
    {
        if ($id_dosen) {
            return $this->db->table('dosen')
                ->where('id_dosen', $id_dosen)
                ->get()->getRowArray();
        } else {
            return $this->db->table('dosen')
                ->get()->getResultArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table("dosen")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('dosen')->where('id_dosen', $data['id_dosen'])
            ->update($data);
    }

    public function hapus($id_dosen)
    {
        $query = "delete from dosen where id_dosen = $id_dosen";
        return $this->db->query($query);
    }
}
