<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        is_user();
        $this->load->helper('rupiah');
        $this->load->helper('tglindo');
        $this->load->model('User_model', 'user');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['user_perbulan'] = $this->user->countUserPerbulan();
            $data['count_user'] = $this->user->countJmlUser();
            $data['user_aktif'] = $this->user->countUserAktif();
            $data['user_tak_aktif'] = $this->user->countUserTakAktif();
            $data['toko'] = $this->db->get('mst_toko')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('user/index', $data);
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
            redirect('user/index');
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
            $data['user_perbulan'] = $this->user->countUserPerbulan();
            $data['count_user'] = $this->user->countJmlUser();
            $data['user_aktif'] = $this->user->countUserAktif();
            $data['user_tak_aktif'] = $this->user->countUserTakAktif();
            $data['toko'] = $this->db->get('mst_toko')->result_array();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('user/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('user/index');
            }
        }
    }


    public function mst_bank()
    {
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Bank';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['bank'] = $this->db->get('mst_bank')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('user/mst_bank', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_bank' => $this->input->post('nama_bank', true),
                'no_rek' => $this->input->post('no_rek', true),
                'cabang' => $this->input->post('cabang', true),
                'kota' => $this->input->post('kota', true)
            );
            $this->db->insert('mst_bank', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('user/mst_bank');
        }
    }


    public function mst_toko()
    {
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Toko';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['toko'] = $this->db->get('mst_toko')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('user/mst_toko', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'pemilik' => $this->input->post('pemilik', true),
                'nama_toko' => $this->input->post('nama_toko', true),
                'alamat_toko' => $this->input->post('alamat_toko', true),
                'telp_toko' => $this->input->post('telp_toko', true),
                'diskon' => $this->input->post('diskon', true),
                'npwp' => $this->input->post('npwp', true)
            );
            $this->db->insert('mst_toko', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('user/mst_toko');
        }
    }


    public function mst_tarif()
    {
        $this->form_validation->set_rules('kota_asal', 'Kota Asal', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Tarif';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['tarif'] = $this->db->get('mst_tarif')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('user/mst_tarif', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kota_asal' => $this->input->post('kota_asal', true),
                'kota_tujuan' => $this->input->post('kota_tujuan', true),
                'tarif_volume' => $this->input->post('tarif_volume', true),
                'tarif_jarak' => $this->input->post('tarif_jarak', true)
            );
            $this->db->insert('mst_tarif', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('user/mst_tarif');
        }
    }
}
