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
        $this->load->view('admin/data/mst_driver', $data);
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
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required|trim');

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

    public function get_bank()
    {
        $id_bank = $_POST['id_bank'];
        echo json_encode($this->db->get_where('mst_bank', ['id_bank' => $id_bank])->row_array());
    }

    public function edit_bank()
    {
        $id_bank = $this->input->post('id_bank', true);
        $nama_bank = $this->input->post('nama_bank', true);
        $no_rek = $this->input->post('no_rek', true);
        $cabang = $this->input->post('cabang', true);
        $kota = $this->input->post('kota', true);
        $this->db->set('nama_bank', $nama_bank);
        $this->db->set('no_rek', $no_rek);
        $this->db->set('cabang', $cabang);
        $this->db->set('kota', $kota);
        $this->db->where('id_bank', $id_bank);
        $this->db->update('mst_bank');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('admin/mst_bank');
    }

    public function mst_toko()
    {
        $this->form_validation->set_rules('diskon', 'Diskon', 'required|trim|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Toko';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['toko'] = $this->db->get('mst_toko')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_toko', $data);
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
            redirect('admin/mst_toko');
        }
    }


    public function get_toko()
    {
        $id_toko = $_POST['id_toko'];
        echo json_encode($this->db->get_where('mst_toko', ['id_toko' => $id_toko])->row_array());
    }

    public function edit_toko()
    {
        $id_toko = $this->input->post('id_toko', true);
        $pemilik = $this->input->post('pemilik', true);
        $nama_toko = $this->input->post('nama_toko', true);
        $alamat_toko = $this->input->post('alamat_toko', true);
        $telp_toko = $this->input->post('telp_toko', true);
        $diskon = $this->input->post('diskon', true);
        $npwp = $this->input->post('npwp', true);
        $this->db->set('pemilik', $pemilik);
        $this->db->set('nama_toko', $nama_toko);
        $this->db->set('alamat_toko', $alamat_toko);
        $this->db->set('telp_toko', $telp_toko);
        $this->db->set('diskon', $diskon);
        $this->db->set('npwp', $npwp);
        $this->db->where('id_toko', $id_toko);
        $this->db->update('mst_toko');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('admin/mst_toko');
    }

    public function mst_karyawan()
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
            $data['title'] = 'Data Karyawan';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['list_user'] = $this->db->get('mst_user')->result_array();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_karyawan', $data);
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
            redirect('admin/mst_karyawan');
        }
    }

    public function proses_edit_karyawan()
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
        redirect('admin/mst_karyawan');
    }

    public function mst_tarif()
    {
        $this->form_validation->set_rules('kota_asal', 'Kota Asal', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Tarif';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['tarif'] = $this->db->get('mst_tarif')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_tarif', $data);
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
            redirect('admin/mst_tarif');
        }
    }

    public function get_tarif()
    {
        $id_tarif = $_POST['id_tarif'];
        echo json_encode($this->db->get_where('mst_tarif', ['id_tarif' => $id_tarif])->row_array());
    }

    public function edit_tarif()
    {
        $id_tarif = $this->input->post('id_tarif');
        $kota_asal = $this->input->post('kota_asal');
        $kota_tujuan = $this->input->post('kota_tujuan');
        $tarif_volume = $this->input->post('tarif_volume');
        $tarif_jarak = $this->input->post('tarif_jarak');

        $this->db->set('kota_asal', $kota_asal);
        $this->db->set('kota_tujuan', $kota_tujuan);
        $this->db->set('tarif_volume', $tarif_volume);
        $this->db->set('tarif_jarak', $tarif_jarak);

        $this->db->where('id_tarif', $id_tarif);
        $this->db->update('mst_tarif');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/mst_tarif');
    }

    public function mst_biaya()
    {
        $this->form_validation->set_rules('nama_biaya', 'Nama Biaya', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Biaya Operasional';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['biaya'] = $this->db->get('mst_biaya')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_biaya', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama_biaya' => $this->input->post('nama_biaya', true),
                'jml_biaya' => $this->input->post('jml_biaya', true),
            );
            $this->db->insert('mst_biaya', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_biaya');
        }
    }

    public function get_biaya()
    {
        $id_biaya = $_POST['id_biaya'];
        echo json_encode($this->db->get_where('mst_biaya', ['id_biaya' => $id_biaya])->row_array());
    }

    public function edit_biaya()
    {
        $id_biaya = $this->input->post('id_biaya');
        $nama_biaya = $this->input->post('nama_biaya');
        $jml_biaya = $this->input->post('jml_biaya');

        $this->db->set('nama_biaya', $nama_biaya);
        $this->db->set('jml_biaya', $jml_biaya);

        $this->db->where('id_biaya', $id_biaya);
        $this->db->update('mst_biaya');
        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/mst_biaya');
    }

    public function nota_order()
    {
        $data['title'] = 'Nota Order';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['nota_order_jarak'] = $this->db->get('transaksi_jarak')->result_array();
        $data['nota_order_volume'] = $this->db->get('transaksi_volume')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/transaksi/nota_order', $data);
        $this->load->view('templates/footer');
    }

    public function terima_order()
    {
        $this->form_validation->set_rules('tgl_order', 'Tanggal Order', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Penerimaan Order';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['kode_order_jarak'] = $this->admin->getKodeOrderJarak();
            $data['kode_order_volume'] = $this->admin->getKodeOrderVolume();
            $data['terima_order'] = $this->admin->getTerimaOrder();
            $data['terima_order_volume'] = $this->admin->getTerimaOrderVolume();
            $data['order_sukses'] = $this->admin->getOrderSukses();
            $data['tarif'] = $this->db->get('mst_tarif')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/transaksi/terima_order', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'tgl_order' => $this->input->post('tgl_order', true),
                'kode_order' => $this->input->post('kode_order', true),
                'nama_pengirim' => $this->input->post('nama_pengirim', true),
                'telp_pengirim' => $this->input->post('telp_pengirim', true),
                'alamat_pengirim' => $this->input->post('alamat_pengirim', true),
                'nama_penerima' => $this->input->post('nama_penerima', true),
                'telp_penerima' => $this->input->post('telp_penerima', true),
                'alamat_penerima' => $this->input->post('alamat_penerima', true),
                'status_pickup' => 1,
                'sukses' => 1
            );
            $data2 = array(
                'tgl_transaksi' => $this->input->post('tgl_order', true),
                'transaksi_kode' => $this->input->post('kode_order', true),
                'nominal' => $this->input->post('nominal', true),
                'jarak' => $this->input->post('jarak', true),
                'pembayaran' => $this->input->post('pembayaran', true)
            );
            $this->db->insert('tb_order', $data);
            $this->db->insert('transaksi_jarak', $data2);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/terima_order');
        }
    }

    public function add_order_volume()
    {
        $data = array(
            'tgl_order' => $this->input->post('tgl_order', true),
            'kode_order' => $this->input->post('kode_order', true),
            'nama_pengirim' => $this->input->post('nama_pengirim', true),
            'telp_pengirim' => $this->input->post('telp_pengirim', true),
            'alamat_pengirim' => $this->input->post('alamat_pengirim', true),
            'nama_penerima' => $this->input->post('nama_penerima', true),
            'telp_penerima' => $this->input->post('telp_penerima', true),
            'alamat_penerima' => $this->input->post('alamat_penerima', true),
            'status_pickup' => 1,
            'sukses' => 1
        );
        $data2 = array(
            'tgl_transaksi' => $this->input->post('tgl_order', true),
            'transaksi_kode' => $this->input->post('kode_order', true),
            'nominal' => $this->input->post('nominal', true),
            'volume' => $this->input->post('volume', true),
            'pembayaran' => $this->input->post('pembayaran', true)
        );
        $this->db->insert('tb_order', $data);
        $this->db->insert('transaksi_volume', $data2);
        $this->session->set_flashdata('message', 'Tambah data');
        redirect('admin/terima_order');
    }

    public function pengiriman()
    {
        $data['title'] = 'Pengiriman Order';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['terima_order'] = $this->admin->getStatusKurir();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/transaksi/pengiriman', $data);
        $this->load->view('templates/footer');
    }

    public function penerimaan()
    {
        $data['title'] = 'Total Penerimaan';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['terima_uang'] = $this->admin->getUangMasukr();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/keuangan/penerimaan', $data);
        $this->load->view('templates/footer');
    }
}
