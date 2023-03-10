<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function getUser($id_user = false)
    {
        if ($id_user) {
            return $this->db->table('user')
                ->where('id_user', $id_user)
                ->where('level', '1')
                ->get()->getRowArray();
        } else {
            return $this->db->table('user')
                ->where('level', '1')
                ->get()->getResultArray();
        }
    }

    public function getDosen($id_dosen = false)
    {
        if ($id_dosen) {
            return $this->db->table('user')
                ->where('id_user', $id_dosen)
                ->where('level', '2')
                ->get()->getRowArray();
        } else {
            return $this->db->table('user')
                ->where('level', '2')
                ->get()->getResultArray();
        }
    }

    public function getPegawai($id_user = false)
    {
        if ($id_user) {
            return $this->db->table('user')
                ->where('id_user', $id_user)
                ->get()->getRowArray();
        } else {
            return $this->db->table('user')
                ->where('level', '3')
                ->get()->getResultArray();
        }
    }

    public function getAll()
    {
        return $this->db->table('user')
            ->get()->getResultArray();
    }

    public function tambah($data)
    {
        return $this->db->table("user")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('user')->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function hapus($id_user)
    {
        $query = "delete from user where id_user = $id_user";
        return $this->db->query($query);
    }

    public function login_admin($username, $password)
    {
        return $this->db->table('user')->where([
            'username' => $username,
            'password'  => $password,
        ])
            ->where('level', '1')
            ->get()->getRowArray();
    }

    public function login_dosen($username, $password)
    {
        return $this->db->table('user')->where([
            'username' => $username,
            'password'  => $password
        ])
            ->where('level', '2')
            ->get()->getRowArray();
    }

    public function login_pegawai($username, $password)
    {
        return $this->db->table('user')->where([
            'username' => $username,
            'password'  => $password
        ])
            ->where('level', '3')
            ->get()->getRowArray();
    }
}
