<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Spv_model extends CI_model
{

    public function countJmlUser()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as jml_pegawai
                               FROM mst_user
                               WHERE level = 'Driver'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jml_pegawai;
        } else {
            return 0;
        }
    }

    public function countUserAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as user_aktif
                               FROM mst_user
                               WHERE is_active = 1 AND level = 'Driver'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user_aktif;
        } else {
            return 0;
        }
    }

    public function countUserTakAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as user_tak_aktif
                               FROM mst_user
                               WHERE is_active = 0 AND level = 'Driver'"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user_tak_aktif;
        } else {
            return 0;
        }
    }

    public function countUserPerbulan()
    {
        $query = $this->db->query(
            "SELECT CONCAT(YEAR(date_created),'/',MONTH(date_created)) AS tahun_bulan, COUNT(*) AS jumlah_bulanan
                FROM mst_user
                WHERE CONCAT(YEAR(date_created),'/',MONTH(date_created))=CONCAT(YEAR(NOW()),'/',MONTH(NOW())) AND level = 'Driver'
                GROUP BY YEAR(date_created),MONTH(date_created);"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_bulanan;
        } else {
            return 0;
        }
    }

    public function getRute()
    {
        $this->db->select('*');
        $this->db->from('tb_perjalanan');
        $this->db->join('mst_kendaraan', 'id_kendaraan = tb_perjalanan.kendaraan_id');
        $this->db->join('mst_tujuan', 'id_tujuan = tb_perjalanan.tujuan_id');
        $this->db->join('mst_user', 'id_user = tb_perjalanan.sess_id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKonfirmasi($id_route)
    {
        $this->db->select('*');
        $this->db->from('tb_perjalanan');
        $this->db->join('mst_kendaraan', 'id_kendaraan = tb_perjalanan.kendaraan_id');
        $this->db->join('mst_tujuan', 'id_tujuan = tb_perjalanan.tujuan_id');
        $this->db->join('mst_user', 'id_user = tb_perjalanan.sess_id');
        $this->db->where('tb_perjalanan.id_route', $id_route);
        $query = $this->db->get();
        return $query->row_array();
    }
}
