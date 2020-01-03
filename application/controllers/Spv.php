<?php
defined('BASEPATH') or exit('No direct script access allowed');

class spv extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_spv();
        $this->load->helper('rupiah');
        $this->load->helper('tglindo');
        $this->load->model('Spv_model', 'spv');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['user_perbulan'] = $this->spv->countUserPerbulan();
            $data['count_user'] = $this->spv->countJmlUser();
            $data['user_aktif'] = $this->spv->countUserAktif();
            $data['user_tak_aktif'] = $this->spv->countUserTakAktif();
            $data['list_user'] = $this->db->get_where('mst_user', ['level' => 'Driver'])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_spv', $data);
            $this->load->view('spv/index', $data);
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
            redirect('spv/index');
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
            $data['user_perbulan'] = $this->spv->countUserPerbulan();
            $data['count_user'] = $this->spv->countJmlUser();
            $data['user_aktif'] = $this->spv->countUserAktif();
            $data['user_tak_aktif'] = $this->spv->countUserTakAktif();
            $data['list_user'] = $this->db->get_where('mst_user', ['level' => 'Driver'])->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_spv', $data);
            $this->load->view('spv/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('spv/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('spv/index');
            }
        }
    }

    public function mst_kendaraan()
    {

        $this->form_validation->set_rules('nopol', 'No Polisi', 'required|trim|is_unique[mst_kendaraan.nopol]', array(
            'is_unique' => 'No Polisi sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Kendaraan';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kendaraan'] = $this->db->get('mst_kendaraan')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_spv', $data);
            $this->load->view('spv/mst_kendaraan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_kendaraan' => $this->input->post('nama_kendaraan', true),
                'nopol' => $this->input->post('nopol', true),
                'bbm' => $this->input->post('bbm', true),
            );
            $this->db->insert('mst_kendaraan', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('spv/mst_kendaraan');
        }
    }

    public function get_kendaraan()
    {
        $id_kendaraan = $_POST['id_kendaraan'];
        echo json_encode($this->db->get_where('mst_kendaraan', ['id_kendaraan' => $id_kendaraan])->row_array());
    }

    public function edit_kendaraan()
    {
        $id_kendaraan = $this->input->post('id_kendaraan', true);
        $nama_kendaraan = $this->input->post('nama_kendaraan', true);
        $nopol = $this->input->post('nopol', true);
        $bbm = $this->input->post('bbm', true);
        $this->db->set('nama_kendaraan', $nama_kendaraan);
        $this->db->set('nopol', $nopol);
        $this->db->set('bbm', $bbm);
        $this->db->where('id_kendaraan', $id_kendaraan);
        $this->db->update('mst_kendaraan');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('spv/mst_kendaraan');
    }

    public function mst_tujuan()
    {
        $this->form_validation->set_rules('nama_tujuan', 'Nama Tujuan', 'required|trim|is_unique[mst_tujuan.nama_tujuan]', array(
            'is_unique' => 'Nama Tujuan sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Tujuan';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['tujuan'] = $this->db->get('mst_tujuan')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_spv', $data);
            $this->load->view('spv/mst_tujuan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_tujuan' => $this->input->post('nama_tujuan', true),
                'kota' => $this->input->post('kota', true),
                'jarak' => $this->input->post('jarak', true),
            );
            $this->db->insert('mst_tujuan', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('spv/mst_tujuan');
        }
    }

    public function get_tujuan()
    {
        $id_tujuan = $_POST['id_tujuan'];
        echo json_encode($this->db->get_where('mst_tujuan', ['id_tujuan' => $id_tujuan])->row_array());
    }

    public function edit_tujuan()
    {
        $id_tujuan = $this->input->post('id_tujuan', true);
        $nama_tujuan = $this->input->post('nama_tujuan', true);
        $kota = $this->input->post('kota', true);
        $jarak = $this->input->post('jarak', true);
        $this->db->set('nama_tujuan', $nama_tujuan);
        $this->db->set('kota', $kota);
        $this->db->set('jarak', $jarak);
        $this->db->where('id_tujuan', $id_tujuan);
        $this->db->update('mst_tujuan');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('spv/mst_tujuan');
    }

    public function mst_driver()
    {
        $data['title'] = 'Data Driver';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['driver'] = $this->db->get_where('mst_user', ['level' => 'Driver'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_spv', $data);
        $this->load->view('spv/mst_driver', $data);
        $this->load->view('templates/footer');
    }

    public function rute()
    {
        $data['title'] = 'Perjalanan Dinas';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['armada'] = $this->db->get('mst_kendaraan')->result_array();
        $data['tujuan'] = $this->db->get('mst_tujuan')->result_array();
        $data['rute'] = $this->spv->getRute();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_spv', $data);
        $this->load->view('spv/rute', $data);
        $this->load->view('templates/footer');
    }

    public function confirm($id_route)
    {
        $data['title'] = 'Konfirmasi Biaya Klaim';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['confirm'] = $this->spv->getKonfirmasi($id_route);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_spv', $data);
        $this->load->view('spv/confirm', $data);
        $this->load->view('templates/footer');
    }

    public function get_image()
    {
        $id_route = $_POST['id_route'];
        echo json_encode($this->db->get_where('tb_perjalanan', ['id_route' => $id_route])->row_array());
    }

    public function verif()
    {
        $id_route = $this->input->post('id_route', true);
        $confirm = $this->input->post('confirm', true);
        $this->db->set('confirm', $confirm);
        $this->db->where('id_route', $id_route);
        $this->db->update('tb_perjalanan');
        $this->session->set_flashdata('message', 'Konfirmasi data');
        redirect('spv/confirm/' . $id_route);
    }
}
