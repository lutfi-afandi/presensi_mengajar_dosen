<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelAbsensi extends Model
{
    public function getAbsensi($id_absensi = false)
    {
        if ($id_absensi) {
            return $this->db->table('absensi as a')
                ->join('tahun_akademik AS t', 'a.ta_id=t.id_ta', 'LEFT')
                ->join('user AS d', 'a.dosen_id=d.id_user', 'LEFT')
                ->join('mata_kuliah AS m', 'a.makul_id=m.id_makul', 'LEFT')
                ->join('kelas AS k', 'a.kelas_id=k.id_kelas', 'LEFT')
                ->where('a.dosen_id', $id_absensi)
                ->orderBy('id_absensi', 'DESC')
                ->get()->getRowArray();
        } else {
            return $this->db->table('absensi as a')
                ->join('tahun_akademik AS t', 'a.ta_id=t.id_ta', 'LEFT')
                ->join('user AS d', 'a.dosen_id=d.id_user', 'LEFT')
                ->join('mata_kuliah AS m', 'a.makul_id=m.id_makul', 'LEFT')
                ->join('kelas AS k', 'a.kelas_id=k.id_kelas', 'LEFT')
                ->orderBy('id_absensi', 'DESC')
                ->get()->getResultArray();
        }
    }

    public function get_dari_tanggal($tg_awal, $tg_akhir)
    {
        return $this->db->query("SELECT * FROM absensi AS a 
        LEFT JOIN  tahun_akademik AS t ON a.ta_id=t.id_ta    
        LEFT JOIN  user AS d ON a.dosen_id=d.id_user 
        LEFT JOIN  mata_kuliah AS m ON a.makul_id=m.id_makul    
        LEFT JOIN  kelas AS k ON a.kelas_id=k.id_kelas    
        WHERE tanggal BETWEEN '$tg_awal' AND '$tg_akhir'
        ORDER BY a.tanggal  DESC ")->getResultArray();
    }

    public function get_rekap_per_dosen($tg_awal, $tg_akhir, $dosen_id)
    {
        return $this->db->query("SELECT * FROM absensi AS a 
        LEFT JOIN  tahun_akademik AS t ON a.ta_id=t.id_ta    
        LEFT JOIN  user AS d ON a.dosen_id=d.id_user 
        LEFT JOIN  mata_kuliah AS m ON a.makul_id=m.id_makul    
        LEFT JOIN  kelas AS k ON a.kelas_id=k.id_kelas    
        WHERE tanggal BETWEEN '$tg_awal' AND '$tg_akhir'
        AND a.dosen_id = $dosen_id
        ORDER BY a.tanggal  DESC ")->getResultArray();
    }



    public function mauHapus($id_absensi = false)
    {
        if ($id_absensi) {
            return $this->db->table('absensi as a')
                ->join('tahun_akademik AS t', 'a.ta_id=t.id_ta', 'LEFT')
                ->join('user AS d', 'a.dosen_id=d.id_user', 'LEFT')
                ->join('mata_kuliah AS m', 'a.makul_id=m.id_makul', 'LEFT')
                ->join('kelas AS k', 'a.kelas_id=k.id_kelas', 'LEFT')
                ->where('a.id_absensi', $id_absensi)
                ->get()->getRowArray();
        }
    }

    public function getAbsensi_dosen($id_dosen, $bulan = false)
    {
        if ($bulan) {
            return $this->db->table('absensi as a')
                ->join('tahun_akademik AS t', 'a.ta_id=t.id_ta', 'LEFT')
                ->join('user AS d', 'a.dosen_id=d.id_user', 'LEFT')
                ->join('mata_kuliah AS m', 'a.makul_id=m.id_makul', 'LEFT')
                ->join('kelas AS k', 'a.kelas_id=k.id_kelas', 'LEFT')
                ->where('a.dosen_id', $id_dosen)
                ->where('MONTH(a.tanggal)', $bulan)
                ->orderBy('id_absensi', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('absensi as a')
                ->join('tahun_akademik AS t', 'a.ta_id=t.id_ta', 'LEFT')
                ->join('user AS d', 'a.dosen_id=d.id_user', 'LEFT')
                ->join('mata_kuliah AS m', 'a.makul_id=m.id_makul', 'LEFT')
                ->join('kelas AS k', 'a.kelas_id=k.id_kelas', 'LEFT')
                ->where('a.dosen_id', $id_dosen)
                ->orderBy('id_absensi', 'DESC')
                ->get()->getResultArray();
        }
    }

    public function tambah($data)
    {
        return $this->db->table("absensi")->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('absensi')->where('id_absensi', $data['id_absensi'])
            ->update($data);
    }

    public function hapus($id_absensi)
    {
        $query = "delete from absensi where id_absensi = $id_absensi";
        return $this->db->query($query);
    }
}
