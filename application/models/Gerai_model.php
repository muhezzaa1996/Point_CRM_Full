<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gerai_model extends CI_model
{
    public function countJmlUser()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as jml_pegawai
                               FROM mst_user
                               WHERE level = 'User'"
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
                               WHERE is_active = 1 AND level = 'User'"
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
                               WHERE is_active = 0 AND level = 'User'"
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
                WHERE CONCAT(YEAR(date_created),'/',MONTH(date_created))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                AND level = 'User'
                GROUP BY YEAR(date_created),MONTH(date_created);"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_bulanan;
        } else {
            return 0;
        }
    }

    public function getUserEdit($id_user)
    {
        $query = $this->db->get_where('mst_user', ['id_user' => $id_user])->row_array();
        return $query;
    }

    public function getEditAsosiasi($id_asosiasi)
    {
        $query = $this->db->get_where('mst_asosiasi', ['id_asosiasi' => $id_asosiasi])->row_array();
        return $query;
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

    function getKodeCabang()
    {
        $this->db->select('RIGHT(kode_cabang,4) as kode', FALSE);
        $this->db->order_by('id_cabang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_cabang');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "CAB-" . date('dmY') . "-" . $kodemax;
        return $kodejadi;
    }

    function getKodeOrderJarak()
    {
        $this->db->select('RIGHT(kode_order,4) as kode', FALSE);
        $this->db->order_by('id_order', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_order');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "POJ-" . date('dmY-Hi') . "-" . $kodemax;
        return $kodejadi;
    }

    function getKodeOrderVolume()
    {
        $this->db->select('RIGHT(kode_order,4) as kode', FALSE);
        $this->db->order_by('id_order', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_order');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "POV-" . date('dmY-Hi') . "-" . $kodemax;
        return $kodejadi;
    }

    public function getTerimaOrder()
    {
        $this->db->select('*');
        $this->db->from('tb_order', 'DESC');
        $this->db->where('status_pickup', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
}
