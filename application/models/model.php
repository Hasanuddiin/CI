<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model extends CI_Model{

    public function GetDtlp($where = ''){
        return $this->db->query('select *, hubungan_keluarga.stat_hbkel from data_penduduk LEFT JOIN hubungan_keluarga 
                  ON data_penduduk.id_stat_hbkel = hubungan_keluarga.id_stat_hbkel '.$where);
    }

  
    public function GetYears($where ='')
    {
        $data = $this->db->query('select * from hubungan_keluarga '.$where);
        return $data;
    }
  
    public function GetUser($where = ''){
        return $this->db->query('select * from user '.$where);
    }
	public function GetPenduduk($where = ''){
        return $this->db->query('select * from data_penduduk '.$where);
    }

    public function LikeDtlp($like1,$like2,$like3){
        return $this->db->query("select *, hubungan_keluarga.stat_hbkel from data_penduduk LEFT JOIN hubungan_keluarga 
                  ON data_penduduk.id_stat_hbkel = hubungan_keluarga.id_stat_hbkel  WHERE 
                  no_kk LIKE '%$like1%' and nik LIKE '%$like2%' and nama_lengkap LIKE '%$like3%' ");
    }

    public function Simpan($table, $data){
        return $this->db->insert($table, $data);
    }

    public function Update($table,$data,$where){
        return $this->db->update($table,$data,$where);
    }

    public function Hapus($table,$where){
        return $this->db->delete($table,$where);
    }

}
?>