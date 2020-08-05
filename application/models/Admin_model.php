<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{
    public function countJmlProject()
    {
        $query = $this->db->query( "SELECT COUNT(id_project) as jml_project
                                    FROM tb_project" );
        if ($query->num_rows() > 0) {
            return $query->row()->jml_project;
        } else {
            return 0;
        }
    }

    public function countTotalMargin()
    {
        $query = $this->db->query( 

            "SELECT SUM(margin01 + margin02 + margin03 + margin04 + margin05 + margin06 + margin07 + margin08 + margin09 + margin10 + margin11 + margin12) 
             as total_margin FROM tb_cashflow" 
         );

            return $query->row()->total_margin;
    }

    public function countTotalRevenue()
    {
        $query = $this->db->query( 

            "SELECT SUM(r01 + r02 + r03 +  r04 +  r05 +  r06 +  r07 +  r08 +  r09 +  r10 +  r11 +  r12) 
             as total_revenue FROM tb_cashflow" 
         );

            return $query->row()->total_revenue;
    }

    public function countTotalExpense()
    {
        $query = $this->db->query( 

            "SELECT SUM(e01 + e02 + e03 +  e04 +  e05 +  e06 +  e07 +  e08 +  e09 +  e10 +  e11 +  e12) 
             as total_expense FROM tb_cashflow" 
         );

            return $query->row()->total_expense;
    }

    public function countTotalInstalasi()
    {
        $query = $this->db->query( 

            "SELECT SUM(i01 + i02 + i03 +  i04 +  i05 +  i06 +  i07 +  i08 +  i09 +  i10 +  i11 +  i12) 
             as total_instalasi FROM tb_cashflow" 
         );

            return $query->row()->total_instalasi;
    }

    public function countTotalDifferensial()
    {
        $query = $this->db->query( 

            "SELECT SUM(d01 + d02 + d03 +  d04 +  d05 +  d06 +  d07 +  d08 +  d09 +  d10 +  d11 +  d12) 
             as total_differensial FROM tb_cashflow" 
         );

            return $query->row()->total_differensial;
    }



    public function countJmlUser()
    {

        $query = $this->db->query(
            "SELECT COUNT(id_user) as jml_pegawai
                               FROM mst_user"
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
                               WHERE is_active = 1"
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
                               WHERE is_active = 0"
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

    public function getProjectAll()
    {
        //$id_project = $_POST['id_project'];
        $this->db->select('tb_project.*,mst_customer.nama_cust');
        $this->db->from('tb_project');
        $this->db->join('mst_customer', 'tb_project.kode_customer = mst_customer.kode_cust');
        $this->db->order_by('id_project', 'ASC');
        // $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    // public function getDistinctKontrakAll()
    // {
    //     //$id_project = $_POST['id_project'];
    //     $this->db->distinct();
    //     $this->db->select('tb_kontrak.kode_customer,mst_customer.nama_cust');
    //     $this->db->from('tb_kontrak');
    //     $this->db->join('mst_customer', 'tb_kontrak.kode_customer = mst_customer.kode_cust');
    //     // $this->db->where('status', 1);
    //     $query = $this->db->get();
    //     return $query->result_array();
    // }

    public function getCustKontrakAll()
    {
        //$id_project = $_POST['id_project'];
        $this->db->select('kode_cust, nama_cust');
        $this->db->from('mst_customer');
        $this->db->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getKontrakAll($kode_cust)
    {

        $this->db->select('tb_kontrak.*,mst_customer.nama_cust');
        $this->db->from('tb_kontrak');
        $this->db->join('mst_customer', 'tb_kontrak.kode_customer_kontrak = mst_customer.kode_cust');
        $this->db->where('tb_kontrak.kode_customer_kontrak', $kode_cust);
        // $this->db->where('status', 1);
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

    function getKodeCustomer()
    {
        $this->db->select('RIGHT(kode_cust,4) as kode', FALSE);
        $this->db->order_by('id_cust', 'DESC');
        $this->db->limit(1);

        $query = $this->db->get('mst_customer');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = "CUS-" . date('dmY') . "-" . $kodemax;
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

    function getKodePraProject()
    {
        $this->db->select('RIGHT(no_job,3) as kode', FALSE);
        $this->db->order_by('id_project', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_project');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = "MITG-" . date('Ym') . "-" . $kodemax;
        return $kodejadi;
    }

    function getKodeKontrakProject()
    {
        $this->db->select('RIGHT(no_job_kontrak,3) as kode', FALSE);
        $this->db->order_by('id_kontrak', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('tb_kontrak');
        if ($query->num_rows() <> 0) {

            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
        $kodejadi = "KN-MITG-" . date('Ym') . "-" . $kodemax;
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
        $this->db->join('transaksi_jarak', 'transaksi_jarak.transaksi_kode = tb_order.kode_order');
        $this->db->where('tb_order.status_pickup', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getTerimaOrderVolume()
    {
        $this->db->select('*');
        $this->db->from('tb_order', 'DESC');
        $this->db->join('transaksi_volume', 'transaksi_volume.transaksi_kode = tb_order.kode_order');
        $this->db->where('tb_order.status_pickup', 1);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getOrderSukses()
    {
        $this->db->select('*');
        $this->db->from('tb_order', 'DESC');
        $this->db->where('status_pickup', 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStatusKurir()
    {
        $this->db->select('*');
        $this->db->from('tb_order', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getUangMasuk()
    {
        $bulan = date('Y-m');
        $this->db->select('*');
        $this->db->from('transaksi_jarak');
        $this->db->where("DATE_FORMAT(tgl_transaksi,'%Y-%m')", $bulan);
        $query = $this->db->get();
        return $query;
    }
    public function getVolumeMasuk()
    {
        $bulan = date('Y-m');
        $this->db->select('*');
        $this->db->from('transaksi_volume');
        $this->db->where("DATE_FORMAT(tgl_transaksi,'%Y-%m')", $bulan);
        $query = $this->db->get();
        return $query;
    }

    public function hitungUangJarak()
    {
        $query = $this->db->query(
            "SELECT SUM(pembayaran) as total_bayar
                               FROM transaksi_jarak
                               WHERE CONCAT(YEAR(tgl_transaksi),'/',MONTH(tgl_transaksi))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                               "
        );
        if ($query->num_rows() > 0) {
            return $query->row()->total_bayar;
        } else {
            return 0;
        }
    }

    public function hitungUangVolume()
    {
        $query = $this->db->query(
            "SELECT SUM(pembayaran) as total_bayar
                               FROM transaksi_volume
                               WHERE CONCAT(YEAR(tgl_transaksi),'/',MONTH(tgl_transaksi))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                               "
        );
        if ($query->num_rows() > 0) {
            return $query->row()->total_bayar;
        } else {
            return 0;
        }
    }
}
