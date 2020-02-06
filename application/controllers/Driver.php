<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Driver extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_driver();
        $this->load->helper('rupiah');
        $this->load->helper('tglindo');
        $this->load->model('Driver_model', 'driver');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['order'] = $this->db->get_where('tb_order', ['status_pickup' => 1])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_driver', $data);
            $this->load->view('driver/index', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/dist/img/profile';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/dist/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $id_user = $this->input->post('id_user');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $hp = $this->input->post('hp');
            $this->db->set('nama', $nama);
            $this->db->set('email', $email);
            $this->db->set('hp', $hp);
            $this->db->where('id_user', $id_user);
            $this->db->update('mst_user');
            $this->session->set_flashdata('message', 'Update data');
            redirect('driver/index');
        }
    }

    public function ubah_password()
    {
        $this->form_validation->set_rules('current_password', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Konfirm Password Baru', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['order'] = $this->db->get_where('tb_order', ['status_pickup' => 1])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_driver', $data);
            $this->load->view('driver/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('driver/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('driver/index');
            }
        }
    }

    // public function rute()
    // {
    //     $this->form_validation->set_rules('tgl_dinas', 'Tanggal Dinas', 'required|trim');

    //     if ($this->form_validation->run() == false) {
    //         $data['title'] = 'Perjalanan Dinas';
    //         $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
    //         $data['armada'] = $this->db->get('mst_kendaraan')->result_array();
    //         $data['tujuan'] = $this->db->get('mst_tujuan')->result_array();
    //         $data['accept'] = $this->driver->getAccept();

    //         $data['rute'] = $this->driver->getRute();

    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar_driver', $data);
    //         $this->load->view('driver/rute', $data);
    //         $this->load->view('templates/footer');
    //     } else {

    //         $sess_id = $this->session->userdata('id_user');
    //         $config['upload_path']   = './assets/files/';
    //         $config['allowed_types'] = 'jpeg|jpg|png';
    //         $config['max_size']      = 2048;
    //         $this->load->library('upload', $config);
    //         $this->upload->do_upload('file1');
    //         $file1 = $this->upload->data('file_name');;
    //         $this->upload->do_upload('file2');
    //         $file2 = $this->upload->data('file_name');;
    //         $data = array(
    //             'tgl_dinas' => $this->input->post('tgl_dinas', true),
    //             'kendaraan_id' => $this->input->post('kendaraan_id', true),
    //             'tujuan_id' => $this->input->post('tujuan_id', true),
    //             'biaya_dinas' => $this->input->post('biaya_dinas', true),
    //             'ket' => $this->input->post('ket', true),
    //             'km_awal' => $this->input->post('km_awal', true),
    //             'km_akhir' => $this->input->post('km_akhir', true),
    //             'beli_bbm' => $this->input->post('beli_bbm', true),
    //             'biaya_lain' => $this->input->post('biaya_lain', true),
    //             'file1' => $file1,
    //             'file2' => $file2,
    //             'sess_id' => $sess_id,
    //             'confirm' => 1
    //         );
    //         $this->db->insert('tb_perjalanan', $data);
    //         $this->session->set_flashdata('message', 'Kirim data');
    //         redirect('driver/rute');
    //     }
    // }

    public function list_pickup()
    {
        $this->form_validation->set_rules('order_kd', 'Kode Order', 'required|trim|is_unique[tb_pickup.order_kd]', array(
            'is_unique' => 'Kode Order Sudah Ada'
        ));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'List Pick Up';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['order'] = $this->db->get_where('tb_order', ['status_pickup' => 1])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_driver', $data);
            $this->load->view('driver/list_pickup', $data);
            $this->load->view('templates/footer');
        } else {
            $sess_id =   $sess_id = $this->session->userdata('id_user');
            $data = array(
                'tgl_pickup' => $this->input->post('tgl_pickup', true),
                'order_kd' => $this->input->post('order_kd', true),
                'sess_id' => $sess_id
            );
            $this->db->insert('tb_pickup', $data);

            $id_order = $this->input->post('id_order');
            $status_pickup = 0;
            $this->db->set('status_pickup', $status_pickup);
            $this->db->where('id_order', $id_order);
            $this->db->update('tb_order');
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('driver/list_pickup');
        }
    }

    public function get_order()
    {
        $id_order = $_POST['id_order'];
        echo json_encode($this->db->get_where('tb_order', ['id_order' => $id_order])->row_array());
    }

    public function data_pickup()
    {
        $data['title'] = 'Status Pick Up';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['pickup'] = $this->driver->getPickup();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_driver', $data);
        $this->load->view('driver/data_pickup', $data);
        $this->load->view('templates/footer');
    }

    public function status_order()
    {
        $data['title'] = 'Status Barang';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['pickup'] = $this->driver->getPickup();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_driver', $data);
        $this->load->view('driver/status_order', $data);
        $this->load->view('templates/footer');
    }
}
