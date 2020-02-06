<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver_model extends CI_model
{

    public function getAccept()
    {
        $id_user = $this->session->userdata('id_user');
        $query = "SELECT * FROM tb_perjalanan
                        WHERE sess_id = $id_user 
                        ORDER BY id_route DESC LIMIT 1";
        return $this->db->query($query)->row_array();
    }

    public function getRute()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tb_perjalanan');
        $this->db->join('mst_kendaraan', 'id_kendaraan = tb_perjalanan.kendaraan_id');
        $this->db->join('mst_tujuan', 'id_tujuan = tb_perjalanan.tujuan_id');
        $this->db->where('sess_id', $sess_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPickup()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tb_pickup');
        $this->db->join('tb_order', 'order_kd = tb_order.kode_order');
        $this->db->where('sess_id', $sess_id);
        $this->db->where('status_pickup', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKirim()
    {
        $sess_id = $this->session->userdata('id_user');
        $this->db->select('*');
        $this->db->from('tb_pickup');
        $this->db->join('tb_order', 'order_kd = tb_order.kode_order');
        $this->db->where('sess_id', $sess_id);
        $this->db->where('sukses', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKirimData($id_order)
    {
        $this->db->select('*');
        $this->db->from('tb_pickup');
        $this->db->join('tb_order', 'order_kd = tb_order.kode_order');
        $this->db->where('id_order', $id_order);
        $query = $this->db->get();
        return $query->row_array();
    }
}
