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
}
