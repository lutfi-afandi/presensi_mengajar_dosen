<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTa extends Model
{
    public function getTa($id_ta = false)
    {
        if ($id_ta) {
            return $this->db->table('tahun_akademik as ta')
                ->where('id_ta', $id_ta)
                ->get()->getRowArray();
        } else {
            return $this->db->table('tahun_akademik as ta')
                ->get()->getResultArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table("tahun_akademik")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tahun_akademik')->where('id_ta', $data['id_ta'])
            ->update($data);
    }

    public function hapus($id_ta)
    {
        $query = "delete from tahun_akademik where id_ta = $id_ta";
        return $this->db->query($query);
    }
}
