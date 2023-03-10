<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelMakul extends Model
{
    public function getMakul($id_makul = false)
    {
        if ($id_makul) {
            return $this->db->table('mata_kuliah')
                ->where('id_makul', $id_makul)
                ->get()->getRowArray();
        } else {
            return $this->db->table('mata_kuliah')
                ->get()->getResultArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table("mata_kuliah")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('mata_kuliah')->where('id_makul', $data['id_makul'])
            ->update($data);
    }

    public function hapus($id_makul)
    {
        $query = "delete from mata_kuliah where id_makul = $id_makul";
        return $this->db->query($query);
    }
}
