<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_admin();
        $this->load->helper('rupiah');
        $this->load->helper('tglindo');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Beranda';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['user_perbulan'] = $this->admin->countUserPerbulan();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['user_aktif'] = $this->admin->countUserAktif();
            $data['user_tak_aktif'] = $this->admin->countUserTakAktif();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/index', $data);
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
            redirect('admin/index');
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
            $data['user_perbulan'] = $this->admin->countUserPerbulan();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['user_aktif'] = $this->admin->countUserAktif();
            $data['user_tak_aktif'] = $this->admin->countUserTakAktif();
            $data['list_user'] = $this->db->get('mst_user')->result_array();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Password baru tidak boleh sama dengan password lama</div>');
                redirect('admin/index');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('admin/index');
            }
        }
    }

    public function man_user()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[mst_user.username]', array(
            'is_unique' => 'Username sudah ada'
        ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
            'matches' => 'Password tidak sama',
            'min_length' => 'password min 3 karakter'
        ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Management User';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/man_user', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'hp' => $this->input->post('hp', true),
                'level' => $this->input->post('level', true),
                'username' => $this->input->post('username', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.jpg',
                'is_active' => 1
            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', 'Tambah user');
            redirect('admin/man_user');
        }
    }

    public function edit_user()
    {
        echo json_encode($this->admin->getUserEdit($_POST['id_user']));
    }

    public function proses_edit_user()
    {
        $id_user = $this->input->post('id_user');
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $hp = $this->input->post('hp');
        $level = $this->input->post('level');
        $is_active = $this->input->post('is_active');

        $this->db->set('nama', $nama);
        $this->db->set('email', $email);
        $this->db->set('hp', $hp);
        $this->db->set('level', $level);
        $this->db->set('is_active', $is_active);

        $this->db->where('id_user', $id_user);
        $this->db->update('mst_user');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/man_user');
    }

    public function del_user($id_user)
    {
        $this->db->where('id_user', $id_user);
        $this->db->delete('mst_user');
        $this->session->set_flashdata('message', 'Hapus user');
        redirect('admin/man_user');
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
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_kendaraan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_kendaraan' => $this->input->post('nama_kendaraan', true),
                'nopol' => $this->input->post('nopol', true),
                'bbm' => $this->input->post('bbm', true),
            );
            $this->db->insert('mst_kendaraan', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_kendaraan');
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
        redirect('admin/mst_kendaraan');
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
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_tujuan', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_tujuan' => $this->input->post('nama_tujuan', true),
                'kota' => $this->input->post('kota', true),
                'jarak' => $this->input->post('jarak', true),
            );
            $this->db->insert('mst_tujuan', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_tujuan');
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
        redirect('admin/mst_tujuan');
    }

    public function mst_driver()
    {
        $data['title'] = 'Data Driver';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['driver'] = $this->db->get_where('mst_user', ['level' => 'Driver'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/mst_driver', $data);
        $this->load->view('templates/footer');
    }

    public function mst_spv()
    {
        $data['title'] = 'Data Supervisor';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['driver'] = $this->db->get_where('mst_user', ['level' => 'Supervisor'])->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/data/mst_spv', $data);
        $this->load->view('templates/footer');
    }

    public function perjalanan()
    {
        $data['title'] = 'Perjalanan Dinas';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['armada'] = $this->db->get('mst_kendaraan')->result_array();
        $data['tujuan'] = $this->db->get('mst_tujuan')->result_array();
        $data['rute'] = $this->admin->getRute();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/perjalanan', $data);
        $this->load->view('templates/footer');
    }

    public function mst_cabang()
    {
        $this->form_validation->set_rules('nama_cabang', 'Nama Cabang', 'required|trim|is_unique[mst_cabang.nama_cabang]', array(
            'is_unique' => 'Nama Cabang sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Cabang';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['cabang'] = $this->db->get('mst_cabang')->result_array();
            $data['kode_cabang'] = $this->admin->getKodeCabang();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_cabang', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kode_cabang' => $this->input->post('kode_cabang', true),
                'nama_cabang' => $this->input->post('nama_cabang', true),
                'alamat_cabang' => $this->input->post('alamat_cabang', true),
                'no_telp_cab' => $this->input->post('no_telp_cab', true),
                'manager' => $this->input->post('manager', true)
            );
            $this->db->insert('mst_cabang', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_cabang');
        }
    }

    public function get_cabang()
    {
        $id_cabang = $_POST['id_cabang'];
        echo json_encode($this->db->get_where('mst_cabang', ['id_cabang' => $id_cabang])->row_array());
    }

    public function edit_cabang()
    {
        $id_cabang = $this->input->post('id_cabang', true);
        $nama_cabang = $this->input->post('nama_cabang', true);
        $alamat_cabang = $this->input->post('alamat_cabang', true);
        $no_telp_cab = $this->input->post('no_telp_cab', true);
        $manager = $this->input->post('manager', true);
        $this->db->set('nama_cabang', $nama_cabang);
        $this->db->set('alamat_cabang', $alamat_cabang);
        $this->db->set('no_telp_cab', $no_telp_cab);
        $this->db->set('manager', $manager);
        $this->db->where('id_cabang', $id_cabang);
        $this->db->update('mst_cabang');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('admin/mst_cabang');
    }

    public function mst_bank()
    {
        $this->form_validation->set_rules('id_bank', 'ID Bank', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Bank';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['bank'] = $this->db->get('mst_bank')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_bank', $data);
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
            redirect('admin/mst_bank');
        }
    }
}
