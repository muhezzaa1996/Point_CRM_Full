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
        $this->load->helper('url');
    }

    //Fungsi untuk menampilkan Dashboard
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

            $data['jml_project'] = $this->admin->countJmlProject();
            $data['total_margin'] = $this->admin->countTotalMargin();
            $data['total_revenue'] = $this->admin->countTotalRevenue();
            $data['total_expense'] = $this->admin->countTotalExpense();
            $data['total_instalasi'] = $this->admin->countTotalInstalasi();
            $data['total_differensial'] = $this->admin->countTotalDifferensial();
            $data['sales']=$this->db->get('mst_sales')->result_array();

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

    //Fungsi untuk mengganti password akun di dashboard
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

    //---------------------------------------------- Fungsi untuk manajemen user ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen bank ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen biaya ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen cabang ----------------------------- //
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

    public function del_cabang($id_cabang)
    {
        $this->db->where('id_cabang', $id_cabang);
        $this->db->delete('mst_cabang');
        $this->session->set_flashdata('message', 'Hapus cabang');
        redirect('admin/mst_cabang');
    }

    //---------------------------------------------- Fungsi untuk manajemen company ----------------------------- //
    public function mst_company()
    {
        $this->form_validation->set_rules('nama_comp', 'Nama Company', 'required|trim|is_unique[mst_company.nama_comp]', array(
            'is_unique' => 'Nama Company sudah ada'
        ));

        $this->form_validation->set_rules('kode_comp', 'Kode Company', 'required|trim|is_unique[mst_company.kode_comp]', array(
            'is_unique' => 'Kode Company sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Company';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['company'] = $this->db->get('mst_company')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_company', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kode_comp' => $this->input->post('kode_comp', true),
                'nama_comp' => $this->input->post('nama_comp', true),
                'alamat_comp' => $this->input->post('alamat_comp', true),
                'telp_comp' => $this->input->post('telp_comp', true),
                'email' => $this->input->post('email', true),
                'direktur' => $this->input->post('direktur', true)
            );
            $this->db->insert('mst_company', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_company');
        }
    }

     public function get_company()
    {
        $id_comp = $_POST['id_comp'];
        echo json_encode($this->db->get_where('mst_company', ['id_comp' => $id_comp])->row_array());
    }

    public function edit_company()
    {
        $id_comp = $this->input->post('id_comp', true);
        $kode_comp = $this->input->post('kode_comp', true);
        $nama_comp = $this->input->post('nama_comp', true);
        $alamat_comp = $this->input->post('alamat_comp', true);
        $telp_comp = $this->input->post('telp_comp', true);
        $email = $this->input->post('email', true);
        $direktur = $this->input->post('direktur', true);

        $this->db->set('nama_comp', $nama_comp);
        $this->db->set('kode_comp', $kode_comp);
        $this->db->set('alamat_comp', $alamat_comp);
        $this->db->set('telp_comp', $telp_comp);
        $this->db->set('email', $email);
        $this->db->set('direktur', $direktur);
        $this->db->where('id_comp', $id_comp);
        $this->db->update('mst_company');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('admin/mst_company');
    }

    public function del_company($id_comp)
    {
        $this->db->where('id_comp', $id_comp);
        $this->db->delete('mst_company');
        $this->session->set_flashdata('message', 'Hapus Company');
        redirect('admin/mst_company');
    }

    //---------------------------------------------- Fungsi untuk manajemen customer ----------------------------- //
    public function mst_customer()
    {
        $this->form_validation->set_rules('nama_cust', 'Nama Customer', 'required|trim|is_unique[mst_customer.nama_cust]', array(
            'is_unique' => 'Nama Customer sudah ada'
        ));
        //Jika sudah ada datanya maka tampilkan data
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Customer';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['customer'] = $this->db->get('mst_customer')->result_array();
            $data['kode_cust'] = $this->admin->getKodeCustomer();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_customer', $data);
            $this->load->view('templates/footer');
        } else {
            //Bila belum ada datanya maka tambahkan data
            $data = array(
                'kode_cust' => $this->input->post('kode_cust', true),
                'nama_cust' => $this->input->post('nama_cust', true),
                'alamat_cust' => $this->input->post('alamat_cust', true),
                'telp_cust' => $this->input->post('telp_cust', true),
                'ket_cust' => $this->input->post('ket_cust', true)
            );
            $this->db->insert('mst_customer', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_customer');
        }
    }

    public function get_customer()
    {
        $id_cust = $_POST['id_cust'];
        echo json_encode($this->db->get_where('mst_customer', ['id_cust' => $id_cust])->row_array());
    }

    public function edit_customer()
    {
        $id_cust = $this->input->post('id_cust', true);
        $nama_cust = $this->input->post('nama_cust', true);
        $alamat_cust = $this->input->post('alamat_cust', true);
        $telp_cust = $this->input->post('telp_cust', true);
        $ket_cust = $this->input->post('ket_cust', true);
        $this->db->set('nama_cust', $nama_cust);
        $this->db->set('alamat_cust', $alamat_cust);
        $this->db->set('telp_cust', $telp_cust);
        $this->db->set('ket_cust', $ket_cust);
        $this->db->where('id_cust', $id_cust);
        $this->db->update('mst_customer');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('admin/mst_customer');
    }

    public function del_customer($id_cust)
    {
        $this->db->where('id_cust', $id_cust);
        $this->db->delete('mst_customer');
        $this->session->set_flashdata('message', 'Hapus Customer');
        redirect('admin/mst_customer');
    }

    //---------------------------------------------- Fungsi untuk manajemen karyawan ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen kendaraan ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen sales ----------------------------- //
    public function mst_sales()
    {
        $this->form_validation->set_rules('kode_sales', 'Inisial Sales', 'required|trim|is_unique[mst_sales.kode_sales]', array(
            'is_unique' => 'Inisial Sales sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Data Sales';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['sales'] = $this->db->get('mst_sales')->result_array();
           // $data['kode_sales'] = $this->admin->getKodeSales();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/data/mst_sales', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kode_sales' => $this->input->post('kode_sales', true),
                'nama_sales' => $this->input->post('nama_sales', true),
                'hp' => $this->input->post('hp', true),
                'email' => $this->input->post('email', true)
            );
            $this->db->insert('mst_sales', $data);
            $this->session->set_flashdata('message', 'Tambah data');
            redirect('admin/mst_sales');
        }
    }

    public function get_sales()
    {
      //  echo "Masuk Edit Donk";
       // $id_sales = $_POST['id_sales'];
        $id_sales = $_POST['id_sales'];
        echo json_encode($this->db->get_where('mst_sales', ['id_sales' => $id_sales])->row_array());
    }

    public function edit_sales()
    {
        $id_sales = $this->input->post('id_sales', true);
       // $kode_sales=$this->input->post('kode_sales',true);
        $nama_sales = $this->input->post('nama_sales', true);
        $hp = $this->input->post('hp', true);
        $email = $this->input->post('email', true);
       // $this->db->set('kode_sales',$kode_sales);
        $this->db->set('nama_sales', $nama_sales);
        $this->db->set('hp', $hp);
        $this->db->set('email', $email);
        $this->db->where('id_sales', $id_sales);
        $this->db->update('mst_sales');
        $this->session->set_flashdata('message', 'Ubah data');
        redirect('admin/mst_sales');
    }

     public function del_sales($id_sales)
    {
        $this->db->where('id_sales', $id_sales);
        $this->db->delete('mst_sales');
        $this->session->set_flashdata('message', 'Hapus Sales');
        redirect('admin/mst_sales');
    }

    //---------------------------------------------- Fungsi untuk manajemen tarif ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen toko ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen tujuan ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen driver ----------------------------- //
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

    //---------------------------------------------- Fungsi untuk manajemen spv ----------------------------- //
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
        $data['title'] = 'Penerimaan Bulan Ini';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['terima_uang'] = $this->admin->getUangMasuk()->result_array();
        $data['terima_volume'] = $this->admin->getVolumeMasuk()->result_array();
        $data['uang_jarak'] = $this->admin->hitungUangJarak();
        $data['uang_volume'] = $this->admin->hitungUangVolume();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/keuangan/penerimaan', $data);
        $this->load->view('templates/footer');
    }

    //---------------------------------------------- Fungsi untuk manajemen project ----------------------------- //
    public function pra_project()
    {
        $this->form_validation->set_rules('no_job', 'Nomor Job', 'required|trim|is_unique[tb_project.no_job]', array(
            'is_unique' => 'Nomor job sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Forecast';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['project'] = $this->admin->getProjectAll();//$this->db->get('tb_project')->result_array();
            $data['kustomer'] = $this->db->get('mst_customer')->result_array();
            $data['kompany']=$this->db->get('mst_company')->result_array();
            $data['sales']=$this->db->get('mst_sales')->result_array();
            $data['no_job'] = $this->admin->getKodePraProject();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/transaksi/pra_project', $data);
            $this->load->view('templates/footer');
        } else {
            $username = $this->session->userdata('username');
            $snilai_projectTambahProject = $this->input->post('nilai_projectTambah');
            $nilai_projectTambahProject = preg_replace('/\D/','',$snilai_projectTambahProject);

            $data_project = array(
                'no_job'            => $this->input->post('no_job', true),
                'kode_customer'     => $this->input->post('kode_customer', true),
                'perusahaan'        => $this->input->post('perusahaan',true),
                'tgl_project'       => $this->input->post('tgl_project', true),
                'nama_project'      => $this->input->post('nama_project', true),
                'snilai_project'    => $snilai_projectTambahProject,
                'nilai_project'     => $nilai_projectTambahProject,
                'peluang'           => $this->input->post('peluang', true),
                'sales1'            => $this->input->post('sales1', true),
                'sales2'            => $this->input->post('sales2', true),
                'sales3'            => $this->input->post('sales3', true),
                'sales4'            => $this->input->post('sales4', true),
                'keterangan'        => $this->input->post('keterangan', true),
                'tgl_update'        => date('Y-m-d'),
                'username'          => $username,
                'status'            => 1,
            );

            $no_job = $this->input->post('no_job', true);
            $this->db->insert('tb_project', $data_project);

            //Query untuk mencari id_project di dalam tb_project 
            //Berguna untuk nantinya di tambahkan ke dalam tb_cashflow_temp id_projectnya
                                        $this->db->select('id_project');
                                        $this->db->from('tb_project');
                                        $this->db->where(['no_job' => $no_job]);
            $id_projectCashflow     =   $this->db->get()->row_array();
            $data_tb_cashflow       = array('id_project' => $id_projectCashflow['id_project']);
            $this->db->insert('tb_cashflow', $data_tb_cashflow);

            //Data log untuk data yg nantinya akan di simpan di tb_log
            $data_log = array(
                'no_job'            => $this->input->post('no_job', true),
                'kode_customer'     => $this->input->post('kode_customer', true),
                'perusahaan'        => $this->input->post('perusahaan',true),
                'tgl_project'       => $this->input->post('tgl_project', true),
                'nama_project'      => $this->input->post('nama_project', true),
                'snilai_project'    => $snilai_projectTambahProject,
                'nilai_project'     => $nilai_projectTambahProject,
                'peluang'           => $this->input->post('peluang', true),
                'sales1'            => $this->input->post('sales1', true),
                'sales2'            => $this->input->post('sales2', true),
                'sales3'            => $this->input->post('sales3', true),
                'sales4'            => $this->input->post('sales4', true),
                'keterangan'        => $this->input->post('keterangan', true),
                'tgl_update'        => date('Y-m-d'),
                'username'          => $username,
                'status'            => 1,
                'id_project'        => $id_projectCashflow['id_project'],
            );
            $this->db->insert('log_project', $data_log);

            //Query ini berfungsi untuk mengambil nilai id_cashflow di tb_cashflow_temp supaya bisa digunakan buat proses edit kolom tb_cashflow_temp
            //ketika user menambahkan sebuah project baru
            $id_projectResult           =   $id_projectCashflow['id_project'];
                                            $this->db->select('id_cashflow');
                                            $this->db->from('tb_cashflow');
                                            $this->db->where(['id_project' => $id_projectResult]);
            $id_cashflow                =   $this->db->get()->row_array();
            $id_cashflowResult          =   $id_cashflow['id_cashflow'];
            
        //Setelah menambahkan data project baru maka halaman cashflow akan terbentuk dan menyediakan angka 0 di semua fieldnya
        $sr01 = $this->input->post('R01');
        if(trim($sr01) == ""){
            $sr01 = "0";
        }

        $sr02 = $this->input->post('R02');
        if(trim($sr02) == ""){
            $sr02 = "0";
        }
                                                                                                               
        $sr03 = $this->input->post('R03');
        if(trim($sr03) == ""){
            $sr03 = "0";
        }

        $sr04 = $this->input->post('R04');
        if(trim($sr04) == ""){
            $sr04 = "0";
        }

        $sr05 = $this->input->post('R05');
        if(trim($sr05) == ""){
            $sr05 = "0";
        }

        $sr06 = $this->input->post('R06');
        if(trim($sr06) == ""){
            $sr06 = "0";
        }

        $sr07 = $this->input->post('R07');
        if(trim($sr07) == ""){
            $sr07 = "0";
        }

        $sr08 = $this->input->post('R08');
        if(trim($sr08) == ""){
            $sr08 = "0";
        }

        $sr09 = $this->input->post('R09');
        if(trim($sr09) == ""){
            $sr09 = "0";
        }

        $sr10 = $this->input->post('R10');
        if(trim($sr10) == ""){
            $sr10 = "0";
        }

        $sr11 = $this->input->post('R11');
        if(trim($sr11) == ""){
            $sr11 = "0";
        }

        $sr12 = $this->input->post('R12');
        if(trim($sr12) == ""){
            $sr12 = "0";
        }      

        //tidak ada titik                                           
        //yg ga ada titiknya simpan di kolom r yg bertipe integer
        $r01 = preg_replace('/\D/','',$sr01);
        $r02 = preg_replace('/\D/','',$sr02);
        $r03 = preg_replace('/\D/','',$sr03);
        $r04 = preg_replace('/\D/','',$sr04);
        $r05 = preg_replace('/\D/','',$sr05);
        $r06 = preg_replace('/\D/','',$sr06);
        $r07 = preg_replace('/\D/','',$sr07);
        $r08 = preg_replace('/\D/','',$sr08);
        $r09 = preg_replace('/\D/','',$sr09);
        $r10 = preg_replace('/\D/','',$sr10);
        $r11 = preg_replace('/\D/','',$sr11);
        $r12 = preg_replace('/\D/','',$sr12);

        //Mengupdate ke kolom integer Revenue               //Mengupdate ke kolom string Revenue
        $this->db->set('r01',$r01);                         $this->db->set('sr01',$sr01);
        $this->db->set('r02',$r02);                         $this->db->set('sr02',$sr02);
        $this->db->set('r03',$r03);                         $this->db->set('sr03',$sr03);
        $this->db->set('r04',$r04);                         $this->db->set('sr04',$sr04);
        $this->db->set('r05',$r05);                         $this->db->set('sr05',$sr05);
        $this->db->set('r06',$r06);                         $this->db->set('sr06',$sr06);
        $this->db->set('r07',$r07);                         $this->db->set('sr07',$sr07);
        $this->db->set('r08',$r08);                         $this->db->set('sr08',$sr08);
        $this->db->set('r09',$r09);                         $this->db->set('sr09',$sr09);
        $this->db->set('r10',$r10);                         $this->db->set('sr10',$sr10);
        $this->db->set('r11',$r11);                         $this->db->set('sr11',$sr11);
        $this->db->set('r12',$r12);                         $this->db->set('sr12',$sr12);

        //Expense
        $se01 = $this->input->post('E01');
        if(trim($se01) == ""){
            $se01 = "0";
        }              
        $se02 = $this->input->post('E02');
        if(trim($se02) == ""){
            $se02 = "0";
        }                 
        $se03 = $this->input->post('E03');
        if(trim($se03) == ""){
            $se03 = "0";
        }                
        $se04 = $this->input->post('E04');
        if(trim($se04) == ""){
            $se04 = "0";
        }                 
        $se05 = $this->input->post('E05');
        if(trim($se05) == ""){
            $se05 = "0";
        }                 
        $se06 = $this->input->post('E06');
        if(trim($se06) == ""){
            $se06 = "0";
        }                
        $se07 = $this->input->post('E07');
        if(trim($se07) == ""){
            $se07 = "0";
        }                 
        $se08 = $this->input->post('E08');
        if(trim($se08) == ""){
            $se08 = "0";
        }                 
        $se09 = $this->input->post('E09');
        if(trim($se09) == ""){
            $se09 = "0";
        }                
        $se10 = $this->input->post('E10');
        if(trim($se10) == ""){
            $se10 = "0";
        }                 
        $se11 = $this->input->post('E11');
        if(trim($se11) == ""){
            $se11 = "0";
        }                
        $se12 = $this->input->post('E12');
        if(trim($se12) == ""){
            $se12 = "0";
        }                 

        //Merubah ke integer untuk expense
        $e01 = preg_replace('/\D/','',$se01);       $e07 = preg_replace('/\D/','',$se07);
        $e02 = preg_replace('/\D/','',$se02);       $e08 = preg_replace('/\D/','',$se08);
        $e03 = preg_replace('/\D/','',$se03);       $e09 = preg_replace('/\D/','',$se09);
        $e04 = preg_replace('/\D/','',$se04);       $e10 = preg_replace('/\D/','',$se10);
        $e05 = preg_replace('/\D/','',$se05);       $e11 = preg_replace('/\D/','',$se11);
        $e06 = preg_replace('/\D/','',$se06);       $e12 = preg_replace('/\D/','',$se12);

        //Mengupdate ke kolom integer Expense               //Mengupdate ke kolom string Expense
        $this->db->set('e01',$e01);                         $this->db->set('se01',$se01);
        $this->db->set('e02',$e02);                         $this->db->set('se02',$se02);
        $this->db->set('e03',$e03);                         $this->db->set('se03',$se03);
        $this->db->set('e04',$e04);                         $this->db->set('se04',$se04);
        $this->db->set('e05',$e05);                         $this->db->set('se05',$se05);
        $this->db->set('e06',$e06);                         $this->db->set('se06',$se06);
        $this->db->set('e07',$e07);                         $this->db->set('se07',$se07);
        $this->db->set('e08',$e08);                         $this->db->set('se08',$se08);
        $this->db->set('e09',$e09);                         $this->db->set('se09',$se09);
        $this->db->set('e10',$e10);                         $this->db->set('se10',$se10);
        $this->db->set('e11',$e11);                         $this->db->set('se11',$se11);
        $this->db->set('e12',$e12);                         $this->db->set('se12',$se12);

        //Instalasi
        $si01 = $this->input->post('I01');
        if(trim($si01) == ""){
            $si01 = "0";
        }                 
        $si02 = $this->input->post('I02');
        if(trim($si02) == ""){
            $si02 = "0";
        }                 
        $si03 = $this->input->post('I03');
        if(trim($si03) == ""){
            $si03 = "0";
        }                 
        $si04 = $this->input->post('I04');
        if(trim($si04) == ""){
            $si04 = "0";
        }                 
        $si05 = $this->input->post('I05');
        if(trim($si05) == ""){
            $si05 = "0";
        }                
        $si06 = $this->input->post('I06');
        if(trim($si06) == ""){
            $si06 = "0";
        }               
        $si07 = $this->input->post('I07');
        if(trim($si07) == ""){
            $si07 = "0";
        }               
        $si08 = $this->input->post('I08');
        if(trim($si08) == ""){
            $si08 = "0";
        }               
        $si09 = $this->input->post('I09');
        if(trim($si09) == ""){
            $si09 = "0";
        }               
        $si10 = $this->input->post('I10');
        if(trim($si10) == ""){
            $si10 = "0";
        }               
        $si11 = $this->input->post('I11');
        if(trim($si11) == ""){
            $si11 = "0";
        }               
        $si12 = $this->input->post('I12');
        if(trim($si12) == ""){
            $si12 = "0";
        }                

        $i01 = preg_replace('/\D/','',$si01);       $i07 = preg_replace('/\D/','',$si07);
        $i02 = preg_replace('/\D/','',$si02);       $i08 = preg_replace('/\D/','',$si08);
        $i03 = preg_replace('/\D/','',$si03);       $i09 = preg_replace('/\D/','',$si09);
        $i04 = preg_replace('/\D/','',$si04);       $i10 = preg_replace('/\D/','',$si10);
        $i05 = preg_replace('/\D/','',$si05);       $i11 = preg_replace('/\D/','',$si11);
        $i06 = preg_replace('/\D/','',$si06);       $i12 = preg_replace('/\D/','',$si12);

        //Mengupdate ke kolom integer Instalasi             //Mengupdate ke kolom string Instalasi
        $this->db->set('i01',$i01);                         $this->db->set('si01',$si01);
        $this->db->set('i02',$i02);                         $this->db->set('si02',$si02);
        $this->db->set('i03',$i03);                         $this->db->set('si03',$si03);
        $this->db->set('i04',$i04);                         $this->db->set('si04',$si04);
        $this->db->set('i05',$i05);                         $this->db->set('si05',$si05);
        $this->db->set('i06',$i06);                         $this->db->set('si06',$si06);
        $this->db->set('i07',$i07);                         $this->db->set('si07',$si07);
        $this->db->set('i08',$i08);                         $this->db->set('si08',$si08);                   
        $this->db->set('i09',$i09);                         $this->db->set('si09',$si09);
        $this->db->set('i10',$i10);                         $this->db->set('si10',$si10);
        $this->db->set('i11',$i11);                         $this->db->set('si11',$si11);
        $this->db->set('i12',$i12);                         $this->db->set('si12',$si12);

        //----------------------------------------- DIFFERENSIAL -----------------------------------//
        $sd01 = $this->input->post('D01');
        if(trim($sd01) == ""){
            $sd01 = "0";
        }                
        $sd02 = $this->input->post('D02');
        if(trim($sd02) == ""){
            $sd02 = "0";
        }                    
        $sd03 = $this->input->post('D03');
        if(trim($sd03) == ""){
            $sd03 = "0";
        }              
        $sd04 = $this->input->post('D04');
        if(trim($sd04) == ""){
            $sd04 = "0";
        }              
        $sd05 = $this->input->post('D05');
        if(trim($sd05) == ""){
            $sd05 = "0";
        }             
        $sd06 = $this->input->post('D06');
        if(trim($sd06) == ""){
            $sd06 = "0";
        }             
        $sd07 = $this->input->post('D07');
        if(trim($sd07) == ""){
            $sd07 = "0";
        }            
        $sd08 = $this->input->post('D08');
        if(trim($sd08) == ""){
            $sd08 = "0";
        }          
        $sd09 = $this->input->post('D09');
        if(trim($sd09) == ""){
            $sd09 = "0";
        }        
        $sd10 = $this->input->post('D10');
        if(trim($sd10) == ""){
            $sd10 = "0";
        }           
        $sd11 = $this->input->post('D11');
        if(trim($sd11) == ""){
            $sd11 = "0";
        }            
        $sd12 = $this->input->post('D12');
        if(trim($sd12) == ""){
            $sd12 = "0";
        }          

        //Integer untuk Differensial
        $d01 = preg_replace('/\D/','',$sd01);       $d07 = preg_replace('/\D/','',$sd07);
        $d02 = preg_replace('/\D/','',$sd02);       $d08 = preg_replace('/\D/','',$sd08);
        $d03 = preg_replace('/\D/','',$sd03);       $d09 = preg_replace('/\D/','',$sd09);
        $d04 = preg_replace('/\D/','',$sd04);       $d10 = preg_replace('/\D/','',$sd10);
        $d05 = preg_replace('/\D/','',$sd05);       $d11 = preg_replace('/\D/','',$sd11);
        $d06 = preg_replace('/\D/','',$sd06);       $d12 = preg_replace('/\D/','',$sd12);

        //Mengupdate ke kolom integer Differensial          //Mengupdate ke kolom string Differensial
        $this->db->set('d01',$d01);                         $this->db->set('sd01',$sd01);
        $this->db->set('d02',$d02);                         $this->db->set('sd02',$sd02);
        $this->db->set('d03',$d03);                         $this->db->set('sd03',$sd03);
        $this->db->set('d04',$d04);                         $this->db->set('sd04',$sd04);
        $this->db->set('d05',$d05);                         $this->db->set('sd05',$sd05);
        $this->db->set('d06',$d06);                         $this->db->set('sd06',$sd06);
        $this->db->set('d07',$d07);                         $this->db->set('sd07',$sd07);
        $this->db->set('d08',$d08);                         $this->db->set('sd08',$sd08);
        $this->db->set('d09',$d09);                         $this->db->set('sd09',$sd09);
        $this->db->set('d10',$d10);                         $this->db->set('sd10',$sd10);
        $this->db->set('d11',$d11);                         $this->db->set('sd11',$sd11);
        $this->db->set('d12',$d12);                         $this->db->set('sd12',$sd12);

        //Mengambil nilai total dari field total di html
        $stotal_revenue = $this->input->post('TR');
        if((trim($stotal_revenue) == "NaN") || (trim($stotal_revenue) == "")){
            $stotal_revenue = "0";
        }                      
        $stotal_expense = $this->input->post('TE');
        if((trim($stotal_expense) == "NaN") || (trim($stotal_instalasi) == "")){
            $stotal_expense = "0";
        }                      
        $stotal_instalasi = $this->input->post('TI');
        if((trim($stotal_instalasi) == "NaN") || (trim($stotal_instalasi) == "")){
            $stotal_instalasi = "0";
        }                    
        $stotal_differensial = $this->input->post('TD');
        if((trim($stotal_differensial) == "NaN") || (trim($stotal_differensial) == "")){
            $stotal_differensial = "0";
        }

        //Merubah ke integer untuk nilai total
        $total_revenue = preg_replace('/\D/','',$stotal_revenue);
        $total_expense = preg_replace('/\D/','',$stotal_expense);
        $total_instalasi = preg_replace('/\D/','',$stotal_instalasi);
        $total_differensial = preg_replace('/\D/','',$stotal_differensial);

        //Mengupdate nilai total ke db
        $this->db->set('total_revenue',$total_revenue);                 $this->db->set('stotal_revenue',$stotal_revenue);
        $this->db->set('total_expense', $total_expense);                $this->db->set('stotal_expense', $stotal_expense);
        $this->db->set('total_instalasi', $total_instalasi);            $this->db->set('stotal_instalasi', $stotal_instalasi);
        $this->db->set('total_differensial',$total_differensial);       $this->db->set('stotal_differensial',$stotal_differensial);

        //Mengambil nilai margin dari field html
        $smargin01 = $this->input->post('M01');
        if((trim($smargin01) == "NaN") || (trim($smargin01) == "")){
            $smargin01 = "0";
        }             
        $smargin02 = $this->input->post('M02');
        if((trim($smargin02) == "NaN") || (trim($smargin02) == "")){
            $smargin02 = "0";
        }             
        $smargin03 = $this->input->post('M03');
        if((trim($smargin03) == "NaN") || (trim($smargin03) == "")){
            $smargin03 = "0";
        }           
        $smargin04 = $this->input->post('M04');
        if((trim($smargin04) == "NaN") || (trim($smargin04) == "")){
            $smargin04 = "0";
        }            
        $smargin05 = $this->input->post('M05');
        if((trim($smargin05) == "NaN") || (trim($smargin05) == "")){
            $smargin05 = "0";
        }           
        $smargin06 = $this->input->post('M06');
        if((trim($smargin06) == "NaN") || (trim($smargin06) == "")){
            $smargin06 = "0";
        }          
        $smargin07 = $this->input->post('M07');
        if((trim($smargin07) == "NaN") || (trim($smargin07) == "")){
            $smargin07 = "0";
        }          
        $smargin08 = $this->input->post('M08');
        if((trim($smargin08) == "NaN") || (trim($smargin08) == "")){
            $smargin08 = "0";
        }   
        $smargin09 = $this->input->post('M09');
        if((trim($smargin09) == "NaN") || (trim($smargin09) == "")){
            $smargin09 = "0";
        } 
        $smargin10 = $this->input->post('M10');
        if((trim($smargin10) == "NaN") || (trim($smargin10) == "")){
            $smargin10 = "0";
        }
        $smargin11 = $this->input->post('M11');
        if((trim($smargin11) == "NaN") || (trim($smargin11) == "")){
            $smargin11 = "0";
        }  
        $smargin12 = $this->input->post('M12');
        if((trim($smargin12) == "NaN") || (trim($smargin12) == "")){
            $smargin12 = "0";
        } 

        $margin01 = preg_replace('/\D/','',$smargin01);     $margin07 = preg_replace('/\D/','',$smargin07);
        $margin02 = preg_replace('/\D/','',$smargin02);     $margin08 = preg_replace('/\D/','',$smargin08);
        $margin03 = preg_replace('/\D/','',$smargin03);     $margin09 = preg_replace('/\D/','',$smargin09);
        $margin04 = preg_replace('/\D/','',$smargin04);     $margin10 = preg_replace('/\D/','',$smargin10);
        $margin05 = preg_replace('/\D/','',$smargin05);     $margin11 = preg_replace('/\D/','',$smargin11);
        $margin06 = preg_replace('/\D/','',$smargin06);     $margin12 = preg_replace('/\D/','',$smargin12);

        //mengupdate nilai margin ke db
        //Ini buat Integer                                  //Ini buat String
        $this->db->set('margin01',$margin01);               $this->db->set('sm01',$smargin01);
        $this->db->set('margin02',$margin02);               $this->db->set('sm02',$smargin02);
        $this->db->set('margin03',$margin03);               $this->db->set('sm03',$smargin03);
        $this->db->set('margin04',$margin04);               $this->db->set('sm04',$smargin04);
        $this->db->set('margin05',$margin05);               $this->db->set('sm05',$smargin05);
        $this->db->set('margin06',$margin06);               $this->db->set('sm06',$smargin06);
        $this->db->set('margin07',$margin07);               $this->db->set('sm07',$smargin07);
        $this->db->set('margin08',$margin08);               $this->db->set('sm08',$smargin08);
        $this->db->set('margin09',$margin09);               $this->db->set('sm09',$smargin09);
        $this->db->set('margin10',$margin10);               $this->db->set('sm10',$smargin10);
        $this->db->set('margin11',$margin11);               $this->db->set('sm11',$smargin11);
        $this->db->set('margin12',$margin12);               $this->db->set('sm12',$smargin12);

        $this->db->where('id_cashflow', $id_cashflowResult);
        $this->db->update('tb_cashflow');

        $this->session->set_flashdata('message', 'Tambah Data Project');
        redirect('admin/pra_project');
        }
    }

    public function get_project()
    {
        $id_project = $_POST['id_project'];
        echo json_encode($this->db->get_where('tb_project', ['id_project' => $id_project])->row_array());
    }

    public function edit_project()
    {

        $id_project         = $this->input->post('id_project');
        $tgl_project        = $this->input->post('tgl_project');
        $nama_project       = $this->input->post('nama_project');
        $kode_customer      = $this->input->post('kode_customer');
        $peluang            = $this->input->post('peluang'); 
        $perusahaan         = $this->input->post('perusahaan');

        $sales1             = $this->input->post('sales1');
        $sales2             = $this->input->post('sales2');
        $sales3             = $this->input->post('sales3');
        $sales4             = $this->input->post('sales4');
        $keterangan         = $this->input->post('keterangan');
        $alasan             = $this->input->post('alasan');
        $tgl_update         = $this->input->post('tgl_project');
        $username           = $this->session->userdata('username');

        $snilai_projectEdit = $this->input->post('nilai_projectEdit');
        $nilai_projectEdit  = preg_replace('/\D/','',$snilai_projectEdit);

        $this->db->set('tgl_project',$tgl_project);
        $this->db->set('nama_project', $nama_project);
        $this->db->set('snilai_project', $snilai_projectEdit);
        $this->db->set('nilai_project', $nilai_projectEdit);
        $this->db->set('kode_customer',$kode_customer);
        $this->db->set('perusahaan',$perusahaan);
        $this->db->set('peluang',$peluang);
        
        $this->db->set('sales1',$sales1);
        $this->db->set('sales2',$sales2);
        $this->db->set('sales3',$sales3);
        $this->db->set('sales4',$sales4);
        $this->db->set('keterangan',$keterangan);
        $this->db->set('alasan',$alasan);
        $this->db->set('tgl_update',$tgl_update);
        $this->db->set('username',$username);

        $this->db->where('id_project', $id_project);
        $this->db->update('tb_project');

        //Array ini gunanya buat di isi ke dalam tabel log
        //Proses edit hanya butuh data dari POST ga perlu sebuah array
        $dataLog = array(
                            'id_project'        => $this->input->post('id_project', true),
                            'no_job'            => $this->input->post('no_job', true),
                            'kode_customer'     => $this->input->post('kode_customer', true),
                            'perusahaan'        => $this->input->post('perusahaan',true),
                            'tgl_project'       => $this->input->post('tgl_project', true),
                            'nama_project'      => $this->input->post('nama_project', true),
                            'snilai_project'    => $snilai_projectEdit,
                            'nilai_project'     => $nilai_projectEdit,
                            'peluang'           => $this->input->post('peluang', true),
                            'sales1'            => $this->input->post('sales1', true),
                            'sales2'            => $this->input->post('sales2', true),
                            'sales3'            => $this->input->post('sales3', true),
                            'sales4'            => $this->input->post('sales4', true),
                            'keterangan'        => $this->input->post('keterangan', true),
                            'alasan'            => $this->input->post('alasan', true),
                            'tgl_update'        => date('Y-m-d'),
                            'username'          => $username,
                            'status'            => 2,
                    );

        $this->db->insert('log_project', $dataLog);

        if($peluang == 100){

            $this->db->set('status', 1);
            $this->db->where('kode_cust', $kode_customer);
            $this->db->update('mst_customer');
        }

        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/pra_project');
    }

    public function del_project($id_project)
    {
        $no_job = getNoJob($id_project);

        $nama_project = getNamaProject($id_project);

        $username = $this->session->userdata('username');
        $data = array(
                "status"=> 2
            );
        $data2 = array(
                "status"=> 3,
                "nama_project"=> $nama_project,
                "no_job"=> $no_job,
                "username" => $username,
                "tgl_update" => date('Y-m-d'),

            );
        // $this->db->insert('log_project', $data2);
        $this->db->where('id_project', $id_project);
        $this->db->delete('tb_project');
        // $this->db->update('tb_project', $data);
        
        $this->db->where('id_project', $id_project);
        $this->db->delete('tb_cashflow');

        $this->db->where('id_project', $id_project);
        $this->db->delete('log_project');

        $this->session->set_flashdata('message', 'Hapus Project');
        redirect('admin/pra_project');
    }

    //Menampilkan data cashflow
    public function get_cashflow_project()
    {

        $id_project = $_POST['id_projectResult'];

        $this->db->select('tb_project.*, mst_customer.nama_cust, tb_cashflow.*');
        $this->db->from('tb_project');
        $this->db->join('mst_customer', 'tb_project.kode_customer = mst_customer.kode_cust');
        $this->db->join('tb_cashflow', 'tb_project.id_project = tb_cashflow.id_project');
        $this->db->where(['tb_cashflow.id_project' => $id_project]);
        $cashflow = $this->db->get()->row_array();


        echo json_encode($cashflow);
    }

    //Untuk edit cashflow
    public function edit_cashflow_project()
    {

        $id_cashflow = $this->input->post('id_cashflow_cp', true);
        $id_project = $this->input->post('id_project_cp', true);

        $kontrak = $this->db->get_where('tb_project', ['id_project' => $id_project])->row_array();

        $no_job = $kontrak['no_job'];
        $kode_customer = $kontrak['kode_customer'];
        $perusahaan = $kontrak['perusahaan'];
        $tgl_project = $kontrak['tgl_project'];
        $nama_project = $kontrak['nama_project'];
        $snilai_project = $kontrak['snilai_project'];
        $nilai_project = $kontrak['nilai_project'];
        $peluang = $kontrak['peluang'];
        $sales1 = $kontrak['sales1'];
        $sales2 = $kontrak['sales2'];
        $sales3 = $kontrak['sales3'];
        $sales4 = $kontrak['sales4'];
        $keterangan = $kontrak['keterangan'];
        $alasan = $kontrak['alasan'];
        $id_project = $kontrak['id_project'];
        $username = $this->session->userdata('username');

        // var_dump($kontrak['kode_customer_kontrak']);
        
        $snilai_projectLogCashflow = $snilai_project;
        $nilai_projectLogCashflow = preg_replace('/\D/','',$snilai_projectLogCashflow);

        //Data log untuk data yg nantinya akan di simpan di tb_log
            $data_log = array(
                'no_job'            => $no_job,
                'kode_customer'     => $kode_customer,
                'perusahaan'        => $perusahaan,
                'tgl_project'       => $tgl_project,
                'nama_project'      => $nama_project,
                'snilai_project'    => $snilai_projectLogCashflow,
                'nilai_project'     => $nilai_projectLogCashflow,
                'peluang'           => $peluang,
                'sales1'            => $sales1,
                'sales2'            => $sales2,
                'sales3'            => $sales3,
                'sales4'            => $sales4,
                'keterangan'        => $keterangan,
                'alasan'            => $alasan,
                'tgl_update'        => date('Y-m-d'),
                'username'          => $username,
                'status'            => 4,
                'id_project'        => $id_project,
            );
        $this->db->insert('log_project', $data_log);         
          
        //ini ada titiknya
        //yg ada titiknya simpan di kolom sr yg bertipe varchar dan dilakukan pengkondisian supaya ketika load pertama kali bentuknya nol bukan blank                                           
        $sr01 = $this->input->post('R01');
        if(trim($sr01) == ""){
            $sr01 = "0";
        }

        $sr02 = $this->input->post('R02');
        if(trim($sr02) == ""){
            $sr02 = "0";
        }
                                                                                                               
        $sr03 = $this->input->post('R03');
        if(trim($sr03) == ""){
            $sr03 = "0";
        }

        $sr04 = $this->input->post('R04');
        if(trim($sr04) == ""){
            $sr04 = "0";
        }

        $sr05 = $this->input->post('R05');
        if(trim($sr05) == ""){
            $sr05 = "0";
        }

        $sr06 = $this->input->post('R06');
        if(trim($sr06) == ""){
            $sr06 = "0";
        }

        $sr07 = $this->input->post('R07');
        if(trim($sr07) == ""){
            $sr07 = "0";
        }

        $sr08 = $this->input->post('R08');
        if(trim($sr08) == ""){
            $sr08 = "0";
        }

        $sr09 = $this->input->post('R09');
        if(trim($sr09) == ""){
            $sr09 = "0";
        }

        $sr10 = $this->input->post('R10');
        if(trim($sr10) == ""){
            $sr10 = "0";
        }

        $sr11 = $this->input->post('R11');
        if(trim($sr11) == ""){
            $sr11 = "0";
        }

        $sr12 = $this->input->post('R12');
        if(trim($sr12) == ""){
            $sr12 = "0";
        }      

        //tidak ada titik                                           
        //yg ga ada titiknya simpan di kolom r yg bertipe integer
        $r01 = preg_replace('/\D/','',$sr01);
        $r02 = preg_replace('/\D/','',$sr02);
        $r03 = preg_replace('/\D/','',$sr03);
        $r04 = preg_replace('/\D/','',$sr04);
        $r05 = preg_replace('/\D/','',$sr05);
        $r06 = preg_replace('/\D/','',$sr06);
        $r07 = preg_replace('/\D/','',$sr07);
        $r08 = preg_replace('/\D/','',$sr08);
        $r09 = preg_replace('/\D/','',$sr09);
        $r10 = preg_replace('/\D/','',$sr10);
        $r11 = preg_replace('/\D/','',$sr11);
        $r12 = preg_replace('/\D/','',$sr12);

        //Expense
        $se01 = $this->input->post('E01');
        if(trim($se01) == ""){
            $se01 = "0";
        }              
        $se02 = $this->input->post('E02');
        if(trim($se02) == ""){
            $se02 = "0";
        }                 
        $se03 = $this->input->post('E03');
        if(trim($se03) == ""){
            $se03 = "0";
        }                
        $se04 = $this->input->post('E04');
        if(trim($se04) == ""){
            $se04 = "0";
        }                 
        $se05 = $this->input->post('E05');
        if(trim($se05) == ""){
            $se05 = "0";
        }                 
        $se06 = $this->input->post('E06');
        if(trim($se06) == ""){
            $se06 = "0";
        }                
        $se07 = $this->input->post('E07');
        if(trim($se07) == ""){
            $se07 = "0";
        }                 
        $se08 = $this->input->post('E08');
        if(trim($se08) == ""){
            $se08 = "0";
        }                 
        $se09 = $this->input->post('E09');
        if(trim($se09) == ""){
            $se09 = "0";
        }                
        $se10 = $this->input->post('E10');
        if(trim($se10) == ""){
            $se10 = "0";
        }                 
        $se11 = $this->input->post('E11');
        if(trim($se11) == ""){
            $se11 = "0";
        }                
        $se12 = $this->input->post('E12');
        if(trim($se12) == ""){
            $se12 = "0";
        }                 

        $e01 = preg_replace('/\D/','',$se01);       $e07 = preg_replace('/\D/','',$se07);
        $e02 = preg_replace('/\D/','',$se02);       $e08 = preg_replace('/\D/','',$se08);
        $e03 = preg_replace('/\D/','',$se03);       $e09 = preg_replace('/\D/','',$se09);
        $e04 = preg_replace('/\D/','',$se04);       $e10 = preg_replace('/\D/','',$se10);
        $e05 = preg_replace('/\D/','',$se05);       $e11 = preg_replace('/\D/','',$se11);
        $e06 = preg_replace('/\D/','',$se06);       $e12 = preg_replace('/\D/','',$se12);

        //Instalasi
        $si01 = $this->input->post('I01');
        if(trim($si01) == ""){
            $si01 = "0";
        }                 
        $si02 = $this->input->post('I02');
        if(trim($si02) == ""){
            $si02 = "0";
        }                 
        $si03 = $this->input->post('I03');
        if(trim($si03) == ""){
            $si03 = "0";
        }                 
        $si04 = $this->input->post('I04');
        if(trim($si04) == ""){
            $si04 = "0";
        }                 
        $si05 = $this->input->post('I05');
        if(trim($si05) == ""){
            $si05 = "0";
        }                
        $si06 = $this->input->post('I06');
        if(trim($si06) == ""){
            $si06 = "0";
        }               
        $si07 = $this->input->post('I07');
        if(trim($si07) == ""){
            $si07 = "0";
        }               
        $si08 = $this->input->post('I08');
        if(trim($si08) == ""){
            $si08 = "0";
        }               
        $si09 = $this->input->post('I09');
        if(trim($si09) == ""){
            $si09 = "0";
        }               
        $si10 = $this->input->post('I10');
        if(trim($si10) == ""){
            $si10 = "0";
        }               
        $si11 = $this->input->post('I11');
        if(trim($si11) == ""){
            $si11 = "0";
        }               
        $si12 = $this->input->post('I12');
        if(trim($si12) == ""){
            $si12 = "0";
        }                

        $i01 = preg_replace('/\D/','',$si01);       $i07 = preg_replace('/\D/','',$si07);
        $i02 = preg_replace('/\D/','',$si02);       $i08 = preg_replace('/\D/','',$si08);
        $i03 = preg_replace('/\D/','',$si03);       $i09 = preg_replace('/\D/','',$si09);
        $i04 = preg_replace('/\D/','',$si04);       $i10 = preg_replace('/\D/','',$si10);
        $i05 = preg_replace('/\D/','',$si05);       $i11 = preg_replace('/\D/','',$si11);
        $i06 = preg_replace('/\D/','',$si06);       $i12 = preg_replace('/\D/','',$si12);

        $sd01 = $this->input->post('D01');
        if(trim($sd01) == ""){
            $sd01 = "0";
        }                
        $sd02 = $this->input->post('D02');
        if(trim($sd02) == ""){
            $sd02 = "0";
        }                    
        $sd03 = $this->input->post('D03');
        if(trim($sd03) == ""){
            $sd03 = "0";
        }              
        $sd04 = $this->input->post('D04');
        if(trim($sd04) == ""){
            $sd04 = "0";
        }              
        $sd05 = $this->input->post('D05');
        if(trim($sd05) == ""){
            $sd05 = "0";
        }             
        $sd06 = $this->input->post('D06');
        if(trim($sd06) == ""){
            $sd06 = "0";
        }             
        $sd07 = $this->input->post('D07');
        if(trim($sd07) == ""){
            $sd07 = "0";
        }            
        $sd08 = $this->input->post('D08');
        if(trim($sd08) == ""){
            $sd08 = "0";
        }          
        $sd09 = $this->input->post('D09');
        if(trim($sd09) == ""){
            $sd09 = "0";
        }        
        $sd10 = $this->input->post('D10');
        if(trim($sd10) == ""){
            $sd10 = "0";
        }           
        $sd11 = $this->input->post('D11');
        if(trim($sd11) == ""){
            $sd11 = "0";
        }            
        $sd12 = $this->input->post('D12');
        if(trim($sd12) == ""){
            $sd12 = "0";
        }          

        $d01 = preg_replace('/\D/','',$sd01);       $d07 = preg_replace('/\D/','',$sd07);
        $d02 = preg_replace('/\D/','',$sd02);       $d08 = preg_replace('/\D/','',$sd08);
        $d03 = preg_replace('/\D/','',$sd03);       $d09 = preg_replace('/\D/','',$sd09);
        $d04 = preg_replace('/\D/','',$sd04);       $d10 = preg_replace('/\D/','',$sd10);
        $d05 = preg_replace('/\D/','',$sd05);       $d11 = preg_replace('/\D/','',$sd11);
        $d06 = preg_replace('/\D/','',$sd06);       $d12 = preg_replace('/\D/','',$sd12);
        
        //Mengambil nilai total dari field total di html
        $stotal_revenue = $this->input->post('TR');
        if((trim($stotal_revenue) == "NaN") || (trim($stotal_revenue) == "")){
            $stotal_revenue = "0";
        }                      
        $stotal_expense = $this->input->post('TE');
        if((trim($stotal_expense) == "NaN") || (trim($stotal_expense) == "")){
            $stotal_expense = "0";
        }                      
        $stotal_instalasi = $this->input->post('TI');
        if((trim($stotal_instalasi) == "NaN") || (trim($stotal_instalasi) == "")){
            $stotal_instalasi = "0";
        }                    
        $stotal_differensial = $this->input->post('TD');
        if((trim($stotal_differensial) == "NaN") || (trim($stotal_differensial) == "")){
            $stotal_differensial = "0";
        }

        //Merubah ke integer untuk nilai total
        $total_revenue = preg_replace('/\D/','',$stotal_revenue);
        $total_expense = preg_replace('/\D/','',$stotal_expense);
        $total_instalasi = preg_replace('/\D/','',$stotal_instalasi);
        $total_differensial = preg_replace('/\D/','',$stotal_differensial);
        
        //Mengambil nilai margin dari field html
        $smargin01 = $this->input->post('M01');
        if((trim($smargin01) == "NaN") || (trim($smargin01) == "")){
            $smargin01 = "0";
        }             
        $smargin02 = $this->input->post('M02');
        if((trim($smargin02) == "NaN") || (trim($smargin02) == "")){
            $smargin02 = "0";
        }             
        $smargin03 = $this->input->post('M03');
        if((trim($smargin03) == "NaN") || (trim($smargin03) == "")){
            $smargin03 = "0";
        }           
        $smargin04 = $this->input->post('M04');
        if((trim($smargin04) == "NaN") || (trim($smargin04) == "")){
            $smargin04 = "0";
        }            
        $smargin05 = $this->input->post('M05');
        if((trim($smargin05) == "NaN") || (trim($smargin05) == "")){
            $smargin05 = "0";
        }           
        $smargin06 = $this->input->post('M06');
        if((trim($smargin06) == "NaN") || (trim($smargin06) == "")){
            $smargin06 = "0";
        }          
        $smargin07 = $this->input->post('M07');
        if((trim($smargin07) == "NaN") || (trim($smargin07) == "")){
            $smargin07 = "0";
        }          
        $smargin08 = $this->input->post('M08');
        if((trim($smargin08) == "NaN") || (trim($smargin08) == "")){
            $smargin08 = "0";
        }   
        $smargin09 = $this->input->post('M09');
        if((trim($smargin09) == "NaN") || (trim($smargin09) == "")){
            $smargin09 = "0";
        } 
        $smargin10 = $this->input->post('M10');
        if((trim($smargin10) == "NaN") || (trim($smargin10) == "")){
            $smargin10 = "0";
        }
        $smargin11 = $this->input->post('M11');
        if((trim($smargin11) == "NaN") || (trim($smargin11) == "")){
            $smargin11 = "0";
        }  
        $smargin12 = $this->input->post('M12');
        if((trim($smargin12) == "NaN") || (trim($smargin12) == "")){
            $smargin12 = "0";
        } 

        $margin01 = preg_replace('/\D/','',$smargin01);     $margin07 = preg_replace('/\D/','',$smargin07);
        $margin02 = preg_replace('/\D/','',$smargin02);     $margin08 = preg_replace('/\D/','',$smargin08);
        $margin03 = preg_replace('/\D/','',$smargin03);     $margin09 = preg_replace('/\D/','',$smargin09);
        $margin04 = preg_replace('/\D/','',$smargin04);     $margin10 = preg_replace('/\D/','',$smargin10);
        $margin05 = preg_replace('/\D/','',$smargin05);     $margin11 = preg_replace('/\D/','',$smargin11);
        $margin06 = preg_replace('/\D/','',$smargin06);     $margin12 = preg_replace('/\D/','',$smargin12);

        //Mengupdate header cashflow
        $this->db->set('id_project',$id_project);

        //Mengupdate nilai total ke db
        $this->db->set('total_revenue',$total_revenue);                 $this->db->set('stotal_revenue',$stotal_revenue);
        $this->db->set('total_expense', $total_expense);                $this->db->set('stotal_expense', $stotal_expense);
        $this->db->set('total_instalasi', $total_instalasi);            $this->db->set('stotal_instalasi', $stotal_instalasi);
        $this->db->set('total_differensial',$total_differensial);       $this->db->set('stotal_differensial',$stotal_differensial);

        //mengupdate nilai margin ke db
        //Ini buat Integer                                  //Ini buat String
        $this->db->set('margin01',$margin01);               $this->db->set('sm01',$smargin01);
        $this->db->set('margin02',$margin02);               $this->db->set('sm02',$smargin02);
        $this->db->set('margin03',$margin03);               $this->db->set('sm03',$smargin03);
        $this->db->set('margin04',$margin04);               $this->db->set('sm04',$smargin04);
        $this->db->set('margin05',$margin05);               $this->db->set('sm05',$smargin05);
        $this->db->set('margin06',$margin06);               $this->db->set('sm06',$smargin06);
        $this->db->set('margin07',$margin07);               $this->db->set('sm07',$smargin07);
        $this->db->set('margin08',$margin08);               $this->db->set('sm08',$smargin08);
        $this->db->set('margin09',$margin09);               $this->db->set('sm09',$smargin09);
        $this->db->set('margin10',$margin10);               $this->db->set('sm10',$smargin10);
        $this->db->set('margin11',$margin11);               $this->db->set('sm11',$smargin11);
        $this->db->set('margin12',$margin12);               $this->db->set('sm12',$smargin12);

  
        //Mengupdate ke kolom integer Revenue               //Mengupdate ke kolom string Revenue
        $this->db->set('r01',$r01);                         $this->db->set('sr01',$sr01);
        $this->db->set('r02',$r02);                         $this->db->set('sr02',$sr02);
        $this->db->set('r03',$r03);                         $this->db->set('sr03',$sr03);
        $this->db->set('r04',$r04);                         $this->db->set('sr04',$sr04);
        $this->db->set('r05',$r05);                         $this->db->set('sr05',$sr05);
        $this->db->set('r06',$r06);                         $this->db->set('sr06',$sr06);
        $this->db->set('r07',$r07);                         $this->db->set('sr07',$sr07);
        $this->db->set('r08',$r08);                         $this->db->set('sr08',$sr08);
        $this->db->set('r09',$r09);                         $this->db->set('sr09',$sr09);
        $this->db->set('r10',$r10);                         $this->db->set('sr10',$sr10);
        $this->db->set('r11',$r11);                         $this->db->set('sr11',$sr11);
        $this->db->set('r12',$r12);                         $this->db->set('sr12',$sr12);

        //Mengupdate ke kolom integer Expense               //Mengupdate ke kolom string Expense
        $this->db->set('e01',$e01);                         $this->db->set('se01',$se01);
        $this->db->set('e02',$e02);                         $this->db->set('se02',$se02);
        $this->db->set('e03',$e03);                         $this->db->set('se03',$se03);
        $this->db->set('e04',$e04);                         $this->db->set('se04',$se04);
        $this->db->set('e05',$e05);                         $this->db->set('se05',$se05);
        $this->db->set('e06',$e06);                         $this->db->set('se06',$se06);
        $this->db->set('e07',$e07);                         $this->db->set('se07',$se07);
        $this->db->set('e08',$e08);                         $this->db->set('se08',$se08);
        $this->db->set('e09',$e09);                         $this->db->set('se09',$se09);
        $this->db->set('e10',$e10);                         $this->db->set('se10',$se10);
        $this->db->set('e11',$e11);                         $this->db->set('se11',$se11);
        $this->db->set('e12',$e12);                         $this->db->set('se12',$se12);
        
        //Mengupdate ke kolom integer Instalasi             //Mengupdate ke kolom string Instalasi
        $this->db->set('i01',$i01);                         $this->db->set('si01',$si01);
        $this->db->set('i02',$i02);                         $this->db->set('si02',$si02);
        $this->db->set('i03',$i03);                         $this->db->set('si03',$si03);
        $this->db->set('i04',$i04);                         $this->db->set('si04',$si04);
        $this->db->set('i05',$i05);                         $this->db->set('si05',$si05);
        $this->db->set('i06',$i06);                         $this->db->set('si06',$si06);
        $this->db->set('i07',$i07);                         $this->db->set('si07',$si07);
        $this->db->set('i08',$i08);                         $this->db->set('si08',$si08);                   
        $this->db->set('i09',$i09);                         $this->db->set('si09',$si09);
        $this->db->set('i10',$i10);                         $this->db->set('si10',$si10);
        $this->db->set('i11',$i11);                         $this->db->set('si11',$si11);
        $this->db->set('i12',$i12);                         $this->db->set('si12',$si12);

        //Mengupdate ke kolom integer Differensial          //Mengupdate ke kolom string Differensial
        $this->db->set('d01',$d01);                         $this->db->set('sd01',$sd01);
        $this->db->set('d02',$d02);                         $this->db->set('sd02',$sd02);
        $this->db->set('d03',$d03);                         $this->db->set('sd03',$sd03);
        $this->db->set('d04',$d04);                         $this->db->set('sd04',$sd04);
        $this->db->set('d05',$d05);                         $this->db->set('sd05',$sd05);
        $this->db->set('d06',$d06);                         $this->db->set('sd06',$sd06);
        $this->db->set('d07',$d07);                         $this->db->set('sd07',$sd07);
        $this->db->set('d08',$d08);                         $this->db->set('sd08',$sd08);
        $this->db->set('d09',$d09);                         $this->db->set('sd09',$sd09);
        $this->db->set('d10',$d10);                         $this->db->set('sd10',$sd10);
        $this->db->set('d11',$d11);                         $this->db->set('sd11',$sd11);
        $this->db->set('d12',$d12);                         $this->db->set('sd12',$sd12); 
       
        $this->db->where('id_cashflow', $id_cashflow);
        $this->db->update('tb_cashflow');
        // $this->db->insert('log_project', $data);
        $this->session->set_flashdata('message', 'Simpan Data Cashflow');
        redirect('admin/pra_project');
    }

    //untuk menampilkan tabel log
    public function get_log()
    {
        $id_log = $_POST['id_log'];

        echo json_encode($this->db->get_where('log_project', ['id_log' => $id_log])->row_array());
    }

    //---------------------------------------------- Fungsi untuk manajemen kontrak project ----------------------------- //
    public function cust_kontrak_project(){

        $this->form_validation->set_rules('no_jobTambah', 'Nomor Job', 'required|trim|is_unique[tb_kontrak.no_job_kontrak]', array(
            'is_unique' => 'Nomor job sudah ada'
        ));

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Kontrak Project';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['project'] = $this->admin->getProjectAll();
            $data['cust_kontrak'] = $this->admin->getCustKontrakAll();
            $data['kustomer'] = $this->db->get('mst_customer')->result_array();
            $data['kompany']=$this->db->get('mst_company')->result_array();
            $data['sales']=$this->db->get('mst_sales')->result_array();
            $data['no_job'] = $this->admin->getKodeKontrakProject();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('admin/transaksi/kontrak_project', $data);
            $this->load->view('templates/footer');
        }else{

        $username = $this->session->userdata('username');
        $snilai_projectTambahKontrak = $this->input->post('nilai_projectTambahKontrak');
        $nilai_projectTambahKontrak = preg_replace('/\D/','',$snilai_projectTambahKontrak);

            $data_kontrak = array(
                'no_job_kontrak'            => $this->input->post('no_jobTambah', true),
                'kode_customer_kontrak'     => $this->input->post('kode_customerTambah', true),
                'perusahaan_kontrak'        => $this->input->post('perusahaan',true),
                'tgl_project_kontrak'       => $this->input->post('tgl_project', true),
                'nama_project_kontrak'      => $this->input->post('nama_project', true),
                'snilai_project_kontrak'    => $snilai_projectTambahKontrak,
                'nilai_project_kontrak'     => $nilai_projectTambahKontrak,
                'peluang_kontrak'           => $this->input->post('peluang', true),
                'sales1_kontrak'            => $this->input->post('sales1', true),
                'sales2_kontrak'            => $this->input->post('sales2', true),
                'sales3_kontrak'            => $this->input->post('sales3', true),
                'sales4_kontrak'            => $this->input->post('sales4', true),
                'keterangan_kontrak'        => $this->input->post('keterangan', true),
            );

            $no_job = $this->input->post('no_jobTambah', true);
            $this->db->insert('tb_kontrak', $data_kontrak);

            //Query untuk mencari id_project di dalam tb_project 
            //Berguna untuk nantinya di tambahkan ke dalam tb_cashflow_temp id_projectnya
                                        $this->db->select('id_kontrak');
                                        $this->db->from('tb_kontrak');
                                        $this->db->where(['no_job_kontrak' => $no_job]);
            $id_kontrakCashflow     =   $this->db->get()->row_array();
            $data_cashflow_kontrak  = array('id_kontrak' => $id_kontrakCashflow['id_kontrak']);
            $this->db->insert('tb_cashflow_kontrak', $data_cashflow_kontrak);

            //Data log untuk data yg nantinya akan di simpan di tb_log
            $data_log = array(
                'no_job'            => $this->input->post('no_jobTambah', true),
                'kode_customer'     => $this->input->post('kode_customerTambah', true),
                'perusahaan'        => $this->input->post('perusahaan',true),
                'tgl_project'       => $this->input->post('tgl_project', true),
                'nama_project'      => $this->input->post('nama_project', true),
                'snilai_project'    => $snilai_projectTambahKontrak,
                'nilai_project'     => $nilai_projectTambahKontrak,
                'peluang'           => $this->input->post('peluang', true),
                'sales1'            => $this->input->post('sales1', true),
                'sales2'            => $this->input->post('sales2', true),
                'sales3'            => $this->input->post('sales3', true),
                'sales4'            => $this->input->post('sales4', true),
                'keterangan'        => $this->input->post('keterangan', true),
                'tgl_update'        => date('Y-m-d'),
                'username'          => $username,
                'status'            => 1,
                'id_kontrak'        => $id_kontrakCashflow['id_kontrak'],
            );
            $this->db->insert('log_kontrak', $data_log);

            //Query ini berfungsi untuk mengambil nilai id_cashflow di tb_cashflow_temp supaya bisa digunakan buat proses edit kolom tb_cashflow_temp
            //ketika user menambahkan sebuah project baru
            $id_kontrakResult           =   $id_kontrakCashflow['id_kontrak'];

                                            $this->db->select('id_cashflow_kontrak');
                                            $this->db->from('tb_cashflow_kontrak');
                                            $this->db->where(['id_kontrak' => $id_kontrakResult]);
            $id_cashflow                =   $this->db->get()->row_array();
            $id_cashflowResult          =   $id_cashflow['id_cashflow_kontrak'];
            
        //Setelah menambahkan data project baru maka halaman cashflow akan terbentuk dan menyediakan angka 0 di semua fieldnya
        $sr01 = $this->input->post('R01');
        if(trim($sr01) == ""){
            $sr01 = "0";
        }

        $sr02 = $this->input->post('R02');
        if(trim($sr02) == ""){
            $sr02 = "0";
        }
                                                                                                               
        $sr03 = $this->input->post('R03');
        if(trim($sr03) == ""){
            $sr03 = "0";
        }

        $sr04 = $this->input->post('R04');
        if(trim($sr04) == ""){
            $sr04 = "0";
        }

        $sr05 = $this->input->post('R05');
        if(trim($sr05) == ""){
            $sr05 = "0";
        }

        $sr06 = $this->input->post('R06');
        if(trim($sr06) == ""){
            $sr06 = "0";
        }

        $sr07 = $this->input->post('R07');
        if(trim($sr07) == ""){
            $sr07 = "0";
        }

        $sr08 = $this->input->post('R08');
        if(trim($sr08) == ""){
            $sr08 = "0";
        }

        $sr09 = $this->input->post('R09');
        if(trim($sr09) == ""){
            $sr09 = "0";
        }

        $sr10 = $this->input->post('R10');
        if(trim($sr10) == ""){
            $sr10 = "0";
        }

        $sr11 = $this->input->post('R11');
        if(trim($sr11) == ""){
            $sr11 = "0";
        }

        $sr12 = $this->input->post('R12');
        if(trim($sr12) == ""){
            $sr12 = "0";
        }      

        //tidak ada titik                                           
        //yg ga ada titiknya simpan di kolom r yg bertipe integer
        $r01 = preg_replace('/\D/','',$sr01);
        $r02 = preg_replace('/\D/','',$sr02);
        $r03 = preg_replace('/\D/','',$sr03);
        $r04 = preg_replace('/\D/','',$sr04);
        $r05 = preg_replace('/\D/','',$sr05);
        $r06 = preg_replace('/\D/','',$sr06);
        $r07 = preg_replace('/\D/','',$sr07);
        $r08 = preg_replace('/\D/','',$sr08);
        $r09 = preg_replace('/\D/','',$sr09);
        $r10 = preg_replace('/\D/','',$sr10);
        $r11 = preg_replace('/\D/','',$sr11);
        $r12 = preg_replace('/\D/','',$sr12);

        //Mengupdate ke kolom integer Revenue               //Mengupdate ke kolom string Revenue
        $this->db->set('r01',$r01);                         $this->db->set('sr01',$sr01);
        $this->db->set('r02',$r02);                         $this->db->set('sr02',$sr02);
        $this->db->set('r03',$r03);                         $this->db->set('sr03',$sr03);
        $this->db->set('r04',$r04);                         $this->db->set('sr04',$sr04);
        $this->db->set('r05',$r05);                         $this->db->set('sr05',$sr05);
        $this->db->set('r06',$r06);                         $this->db->set('sr06',$sr06);
        $this->db->set('r07',$r07);                         $this->db->set('sr07',$sr07);
        $this->db->set('r08',$r08);                         $this->db->set('sr08',$sr08);
        $this->db->set('r09',$r09);                         $this->db->set('sr09',$sr09);
        $this->db->set('r10',$r10);                         $this->db->set('sr10',$sr10);
        $this->db->set('r11',$r11);                         $this->db->set('sr11',$sr11);
        $this->db->set('r12',$r12);                         $this->db->set('sr12',$sr12);

        //Expense
        $se01 = $this->input->post('E01');
        if(trim($se01) == ""){
            $se01 = "0";
        }              
        $se02 = $this->input->post('E02');
        if(trim($se02) == ""){
            $se02 = "0";
        }                 
        $se03 = $this->input->post('E03');
        if(trim($se03) == ""){
            $se03 = "0";
        }                
        $se04 = $this->input->post('E04');
        if(trim($se04) == ""){
            $se04 = "0";
        }                 
        $se05 = $this->input->post('E05');
        if(trim($se05) == ""){
            $se05 = "0";
        }                 
        $se06 = $this->input->post('E06');
        if(trim($se06) == ""){
            $se06 = "0";
        }                
        $se07 = $this->input->post('E07');
        if(trim($se07) == ""){
            $se07 = "0";
        }                 
        $se08 = $this->input->post('E08');
        if(trim($se08) == ""){
            $se08 = "0";
        }                 
        $se09 = $this->input->post('E09');
        if(trim($se09) == ""){
            $se09 = "0";
        }                
        $se10 = $this->input->post('E10');
        if(trim($se10) == ""){
            $se10 = "0";
        }                 
        $se11 = $this->input->post('E11');
        if(trim($se11) == ""){
            $se11 = "0";
        }                
        $se12 = $this->input->post('E12');
        if(trim($se12) == ""){
            $se12 = "0";
        }                 

        //Merubah ke integer untuk expense
        $e01 = preg_replace('/\D/','',$se01);       $e07 = preg_replace('/\D/','',$se07);
        $e02 = preg_replace('/\D/','',$se02);       $e08 = preg_replace('/\D/','',$se08);
        $e03 = preg_replace('/\D/','',$se03);       $e09 = preg_replace('/\D/','',$se09);
        $e04 = preg_replace('/\D/','',$se04);       $e10 = preg_replace('/\D/','',$se10);
        $e05 = preg_replace('/\D/','',$se05);       $e11 = preg_replace('/\D/','',$se11);
        $e06 = preg_replace('/\D/','',$se06);       $e12 = preg_replace('/\D/','',$se12);

        //Mengupdate ke kolom integer Expense               //Mengupdate ke kolom string Expense
        $this->db->set('e01',$e01);                         $this->db->set('se01',$se01);
        $this->db->set('e02',$e02);                         $this->db->set('se02',$se02);
        $this->db->set('e03',$e03);                         $this->db->set('se03',$se03);
        $this->db->set('e04',$e04);                         $this->db->set('se04',$se04);
        $this->db->set('e05',$e05);                         $this->db->set('se05',$se05);
        $this->db->set('e06',$e06);                         $this->db->set('se06',$se06);
        $this->db->set('e07',$e07);                         $this->db->set('se07',$se07);
        $this->db->set('e08',$e08);                         $this->db->set('se08',$se08);
        $this->db->set('e09',$e09);                         $this->db->set('se09',$se09);
        $this->db->set('e10',$e10);                         $this->db->set('se10',$se10);
        $this->db->set('e11',$e11);                         $this->db->set('se11',$se11);
        $this->db->set('e12',$e12);                         $this->db->set('se12',$se12);

        //Instalasi
        $si01 = $this->input->post('I01');
        if(trim($si01) == ""){
            $si01 = "0";
        }                 
        $si02 = $this->input->post('I02');
        if(trim($si02) == ""){
            $si02 = "0";
        }                 
        $si03 = $this->input->post('I03');
        if(trim($si03) == ""){
            $si03 = "0";
        }                 
        $si04 = $this->input->post('I04');
        if(trim($si04) == ""){
            $si04 = "0";
        }                 
        $si05 = $this->input->post('I05');
        if(trim($si05) == ""){
            $si05 = "0";
        }                
        $si06 = $this->input->post('I06');
        if(trim($si06) == ""){
            $si06 = "0";
        }               
        $si07 = $this->input->post('I07');
        if(trim($si07) == ""){
            $si07 = "0";
        }               
        $si08 = $this->input->post('I08');
        if(trim($si08) == ""){
            $si08 = "0";
        }               
        $si09 = $this->input->post('I09');
        if(trim($si09) == ""){
            $si09 = "0";
        }               
        $si10 = $this->input->post('I10');
        if(trim($si10) == ""){
            $si10 = "0";
        }               
        $si11 = $this->input->post('I11');
        if(trim($si11) == ""){
            $si11 = "0";
        }               
        $si12 = $this->input->post('I12');
        if(trim($si12) == ""){
            $si12 = "0";
        }                

        $i01 = preg_replace('/\D/','',$si01);       $i07 = preg_replace('/\D/','',$si07);
        $i02 = preg_replace('/\D/','',$si02);       $i08 = preg_replace('/\D/','',$si08);
        $i03 = preg_replace('/\D/','',$si03);       $i09 = preg_replace('/\D/','',$si09);
        $i04 = preg_replace('/\D/','',$si04);       $i10 = preg_replace('/\D/','',$si10);
        $i05 = preg_replace('/\D/','',$si05);       $i11 = preg_replace('/\D/','',$si11);
        $i06 = preg_replace('/\D/','',$si06);       $i12 = preg_replace('/\D/','',$si12);

        //Mengupdate ke kolom integer Instalasi             //Mengupdate ke kolom string Instalasi
        $this->db->set('i01',$i01);                         $this->db->set('si01',$si01);
        $this->db->set('i02',$i02);                         $this->db->set('si02',$si02);
        $this->db->set('i03',$i03);                         $this->db->set('si03',$si03);
        $this->db->set('i04',$i04);                         $this->db->set('si04',$si04);
        $this->db->set('i05',$i05);                         $this->db->set('si05',$si05);
        $this->db->set('i06',$i06);                         $this->db->set('si06',$si06);
        $this->db->set('i07',$i07);                         $this->db->set('si07',$si07);
        $this->db->set('i08',$i08);                         $this->db->set('si08',$si08);                   
        $this->db->set('i09',$i09);                         $this->db->set('si09',$si09);
        $this->db->set('i10',$i10);                         $this->db->set('si10',$si10);
        $this->db->set('i11',$i11);                         $this->db->set('si11',$si11);
        $this->db->set('i12',$i12);                         $this->db->set('si12',$si12);

        //----------------------------------------- DIFFERENSIAL -----------------------------------//
        $sd01 = $this->input->post('D01');
        if(trim($sd01) == ""){
            $sd01 = "0";
        }                
        $sd02 = $this->input->post('D02');
        if(trim($sd02) == ""){
            $sd02 = "0";
        }                    
        $sd03 = $this->input->post('D03');
        if(trim($sd03) == ""){
            $sd03 = "0";
        }              
        $sd04 = $this->input->post('D04');
        if(trim($sd04) == ""){
            $sd04 = "0";
        }              
        $sd05 = $this->input->post('D05');
        if(trim($sd05) == ""){
            $sd05 = "0";
        }             
        $sd06 = $this->input->post('D06');
        if(trim($sd06) == ""){
            $sd06 = "0";
        }             
        $sd07 = $this->input->post('D07');
        if(trim($sd07) == ""){
            $sd07 = "0";
        }            
        $sd08 = $this->input->post('D08');
        if(trim($sd08) == ""){
            $sd08 = "0";
        }          
        $sd09 = $this->input->post('D09');
        if(trim($sd09) == ""){
            $sd09 = "0";
        }        
        $sd10 = $this->input->post('D10');
        if(trim($sd10) == ""){
            $sd10 = "0";
        }           
        $sd11 = $this->input->post('D11');
        if(trim($sd11) == ""){
            $sd11 = "0";
        }            
        $sd12 = $this->input->post('D12');
        if(trim($sd12) == ""){
            $sd12 = "0";
        }          

        //Integer untuk Differensial
        $d01 = preg_replace('/\D/','',$sd01);       $d07 = preg_replace('/\D/','',$sd07);
        $d02 = preg_replace('/\D/','',$sd02);       $d08 = preg_replace('/\D/','',$sd08);
        $d03 = preg_replace('/\D/','',$sd03);       $d09 = preg_replace('/\D/','',$sd09);
        $d04 = preg_replace('/\D/','',$sd04);       $d10 = preg_replace('/\D/','',$sd10);
        $d05 = preg_replace('/\D/','',$sd05);       $d11 = preg_replace('/\D/','',$sd11);
        $d06 = preg_replace('/\D/','',$sd06);       $d12 = preg_replace('/\D/','',$sd12);

        //Mengupdate ke kolom integer Differensial          //Mengupdate ke kolom string Differensial
        $this->db->set('d01',$d01);                         $this->db->set('sd01',$sd01);
        $this->db->set('d02',$d02);                         $this->db->set('sd02',$sd02);
        $this->db->set('d03',$d03);                         $this->db->set('sd03',$sd03);
        $this->db->set('d04',$d04);                         $this->db->set('sd04',$sd04);
        $this->db->set('d05',$d05);                         $this->db->set('sd05',$sd05);
        $this->db->set('d06',$d06);                         $this->db->set('sd06',$sd06);
        $this->db->set('d07',$d07);                         $this->db->set('sd07',$sd07);
        $this->db->set('d08',$d08);                         $this->db->set('sd08',$sd08);
        $this->db->set('d09',$d09);                         $this->db->set('sd09',$sd09);
        $this->db->set('d10',$d10);                         $this->db->set('sd10',$sd10);
        $this->db->set('d11',$d11);                         $this->db->set('sd11',$sd11);
        $this->db->set('d12',$d12);                         $this->db->set('sd12',$sd12);

        //Mengambil nilai total dari field total di html
        $stotal_revenue = $this->input->post('TR');
        if((trim($stotal_revenue) == "NaN") || (trim($stotal_revenue) == "")){
            $stotal_revenue = "0";
        }                      
        $stotal_expense = $this->input->post('TE');
        if((trim($stotal_expense) == "NaN") || (trim($stotal_expense) == "")){
            $stotal_expense = "0";
        }                      
        $stotal_instalasi = $this->input->post('TI');
        if((trim($stotal_instalasi) == "NaN") || (trim($stotal_instalasi) == "")){
            $stotal_instalasi = "0";
        }                    
        $stotal_differensial = $this->input->post('TD');
        if((trim($stotal_differensial) == "NaN") || (trim($stotal_differensial) == "")){
            $stotal_differensial = "0";
        }

        //Merubah ke integer untuk nilai total
        $total_revenue = preg_replace('/\D/','',$stotal_revenue);
        $total_expense = preg_replace('/\D/','',$stotal_expense);
        $total_instalasi = preg_replace('/\D/','',$stotal_instalasi);
        $total_differensial = preg_replace('/\D/','',$stotal_differensial);

        //Mengupdate nilai total ke db
        $this->db->set('total_revenue',$total_revenue);                 $this->db->set('stotal_revenue',$stotal_revenue);
        $this->db->set('total_expense', $total_expense);                $this->db->set('stotal_expense', $stotal_expense);
        $this->db->set('total_instalasi', $total_instalasi);            $this->db->set('stotal_instalasi', $stotal_instalasi);
        $this->db->set('total_differensial',$total_differensial);       $this->db->set('stotal_differensial',$stotal_differensial);

        //Mengambil nilai margin dari field html
        $smargin01 = $this->input->post('M01');
        if((trim($smargin01) == "NaN") || (trim($smargin01) == "")){
            $smargin01 = "0";
        }             
        $smargin02 = $this->input->post('M02');
        if((trim($smargin02) == "NaN") || (trim($smargin02) == "")){
            $smargin02 = "0";
        }             
        $smargin03 = $this->input->post('M03');
        if((trim($smargin03) == "NaN") || (trim($smargin03) == "")){
            $smargin03 = "0";
        }           
        $smargin04 = $this->input->post('M04');
        if((trim($smargin04) == "NaN") || (trim($smargin04) == "")){
            $smargin04 = "0";
        }            
        $smargin05 = $this->input->post('M05');
        if((trim($smargin05) == "NaN") || (trim($smargin05) == "")){
            $smargin05 = "0";
        }           
        $smargin06 = $this->input->post('M06');
        if((trim($smargin06) == "NaN") || (trim($smargin06) == "")){
            $smargin06 = "0";
        }          
        $smargin07 = $this->input->post('M07');
        if((trim($smargin07) == "NaN") || (trim($smargin07) == "")){
            $smargin07 = "0";
        }          
        $smargin08 = $this->input->post('M08');
        if((trim($smargin08) == "NaN") || (trim($smargin08) == "")){
            $smargin08 = "0";
        }   
        $smargin09 = $this->input->post('M09');
        if((trim($smargin09) == "NaN") || (trim($smargin09) == "")){
            $smargin09 = "0";
        } 
        $smargin10 = $this->input->post('M10');
        if((trim($smargin10) == "NaN") || (trim($smargin10) == "")){
            $smargin10 = "0";
        }
        $smargin11 = $this->input->post('M11');
        if((trim($smargin11) == "NaN") || (trim($smargin11) == "")){
            $smargin11 = "0";
        }  
        $smargin12 = $this->input->post('M12');
        if((trim($smargin12) == "NaN") || (trim($smargin12) == "")){
            $smargin12 = "0";
        } 

        $margin01 = preg_replace('/\D/','',$smargin01);     $margin07 = preg_replace('/\D/','',$smargin07);
        $margin02 = preg_replace('/\D/','',$smargin02);     $margin08 = preg_replace('/\D/','',$smargin08);
        $margin03 = preg_replace('/\D/','',$smargin03);     $margin09 = preg_replace('/\D/','',$smargin09);
        $margin04 = preg_replace('/\D/','',$smargin04);     $margin10 = preg_replace('/\D/','',$smargin10);
        $margin05 = preg_replace('/\D/','',$smargin05);     $margin11 = preg_replace('/\D/','',$smargin11);
        $margin06 = preg_replace('/\D/','',$smargin06);     $margin12 = preg_replace('/\D/','',$smargin12);

        //mengupdate nilai margin ke db
        //Ini buat Integer                                  //Ini buat String
        $this->db->set('margin01',$margin01);               $this->db->set('sm01',$smargin01);
        $this->db->set('margin02',$margin02);               $this->db->set('sm02',$smargin02);
        $this->db->set('margin03',$margin03);               $this->db->set('sm03',$smargin03);
        $this->db->set('margin04',$margin04);               $this->db->set('sm04',$smargin04);
        $this->db->set('margin05',$margin05);               $this->db->set('sm05',$smargin05);
        $this->db->set('margin06',$margin06);               $this->db->set('sm06',$smargin06);
        $this->db->set('margin07',$margin07);               $this->db->set('sm07',$smargin07);
        $this->db->set('margin08',$margin08);               $this->db->set('sm08',$smargin08);
        $this->db->set('margin09',$margin09);               $this->db->set('sm09',$smargin09);
        $this->db->set('margin10',$margin10);               $this->db->set('sm10',$smargin10);
        $this->db->set('margin11',$margin11);               $this->db->set('sm11',$smargin11);
        $this->db->set('margin12',$margin12);               $this->db->set('sm12',$smargin12);

        $this->db->where('id_cashflow_kontrak', $id_cashflowResult);
        $this->db->update('tb_cashflow_kontrak');
        $this->session->set_flashdata('message', 'Tambah Data Project Kontrak');

        redirect('admin/cust_kontrak_project');
        }      
    }

    //Untuk melihat detail kontrak
    public function tampil_kontrak($kode_cust){

        $data['title'] = 'Detail Kontrak Project';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['project'] = $this->admin->getProjectAll();
        $data['kontrak'] = $this->admin->getKontrakAll($kode_cust);
        $data['kustomer'] = $this->db->get('mst_customer')->result_array();
        $data['kompany']=$this->db->get('mst_company')->result_array();
        $data['sales']=$this->db->get('mst_sales')->result_array();
        $data['no_job'] = $this->admin->getKodeKontrakProject();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_admin', $data);
        $this->load->view('admin/transaksi/tabel_detail_kontrak', $data);
        $this->load->view('templates/footer');
    }

    //Untuk mengedit kontrak project
    public function edit_kontrak()
    {

        $id_kontrak         = $this->input->post('id_kontrak');
        $tgl_project        = $this->input->post('tgl_project');
        $nama_project       = $this->input->post('nama_project');
        $kode_customer      = $this->input->post('kode_customer');
        $peluang            = $this->input->post('peluang'); 
        $perusahaan         = $this->input->post('perusahaan');

        $sales1             = $this->input->post('sales1');
        $sales2             = $this->input->post('sales2');
        $sales3             = $this->input->post('sales3');
        $sales4             = $this->input->post('sales4');
        $keterangan         = $this->input->post('keterangan');
        $alasan             = $this->input->post('alasan');

        $snilai_projectEdit = $this->input->post('nilai_projectEdit');
        $nilai_projectEdit  = preg_replace('/\D/','',$snilai_projectEdit);

        $this->db->set('tgl_project_kontrak',$tgl_project);
        $this->db->set('nama_project_kontrak', $nama_project);
        $this->db->set('snilai_project_kontrak', $snilai_projectEdit);
        $this->db->set('nilai_project_kontrak', $nilai_projectEdit);
        $this->db->set('kode_customer_kontrak',$kode_customer);
        $this->db->set('perusahaan_kontrak',$perusahaan);
        $this->db->set('peluang_kontrak',$peluang);
        
        $this->db->set('sales1_kontrak',$sales1);
        $this->db->set('sales2_kontrak',$sales2);
        $this->db->set('sales3_kontrak',$sales3);
        $this->db->set('sales4_kontrak',$sales4);
        $this->db->set('keterangan_kontrak',$keterangan);
        $this->db->set('alasan',$alasan);

        $this->db->where('id_kontrak', $id_kontrak);
        $this->db->update('tb_kontrak');

        //Array ini gunanya buat di isi ke dalam tabel log
        //Proses edit hanya butuh data dari POST ga perlu sebuah array
        $username           = $this->session->userdata('username');
        $dataLog = array(
                            'id_kontrak'        => $this->input->post('id_kontrak', true),
                            'no_job'            => $this->input->post('no_job', true),
                            'kode_customer'     => $this->input->post('kode_customer', true),
                            'perusahaan'        => $this->input->post('perusahaan',true),
                            'tgl_project'       => $this->input->post('tgl_project', true),
                            'nama_project'      => $this->input->post('nama_project', true),
                            'snilai_project'    => $snilai_projectEdit,
                            'nilai_project'     => $nilai_projectEdit,
                            'peluang'           => $this->input->post('peluang', true),
                            'sales1'            => $this->input->post('sales1', true),
                            'sales2'            => $this->input->post('sales2', true),
                            'sales3'            => $this->input->post('sales3', true),
                            'sales4'            => $this->input->post('sales4', true),
                            'keterangan'        => $this->input->post('keterangan', true),
                            'alasan'            => $this->input->post('alasan', true),
                            'tgl_update'        => date('Y-m-d'),
                            'username'          => $username,
                            'status'            => 2,
                    );

        $this->db->insert('log_kontrak', $dataLog);

        // if($peluang == 100){
        //     // $dataCustomerKontrak = array( 'status' => 1);
        //     // $this->db->insert('mst_customer', $dataCustomerKontrak);

        //     $this->db->set('status', $status);
        //     $this->db->where('kode_cust', $kode_customer);
        //     $this->db->update('mst_customer');
        // }

        $this->session->set_flashdata('message', 'Update data');
        redirect('admin/cust_kontrak_project');
    }

    //Untuk menampilkan data kontrak
    public function get_kontrak()
    {
        $id_kontrak = $_POST['id_kontrakResult'];
        // $cashflow =  
        echo json_encode($this->db->get_where('tb_kontrak', ['id_kontrak' => $id_kontrak])->row_array());
    }

    public function del_kontrak($id_kontrak)
    {
        
        $this->db->where('id_kontrak', $id_kontrak);
        $this->db->delete('tb_kontrak');

        $this->db->where('id_kontrak', $id_kontrak);
        $this->db->delete('tb_cashflow_kontrak');

        $this->db->where('id_kontrak', $id_kontrak);
        $this->db->delete('log_kontrak');

        $this->session->set_flashdata('message', 'Hapus Project Kontrak');
        redirect('admin/cust_kontrak_project');
    }

    //Untuk menampilkan data cashflow kontrak
    public function get_cashflow_kontrak()
    {
        $id_kontrak = $_POST['id_kontrakResult'];

        $this->db->select('tb_kontrak.*, mst_customer.nama_cust, tb_cashflow_kontrak.*');
        $this->db->from('tb_kontrak');
        $this->db->join('mst_customer', 'tb_kontrak.kode_customer_kontrak = mst_customer.kode_cust');
        $this->db->join('tb_cashflow_kontrak', 'tb_kontrak.id_kontrak = tb_cashflow_kontrak.id_kontrak');
        $this->db->where(['tb_cashflow_kontrak.id_kontrak' => $id_kontrak]);
        $cashflow_kontrak = $this->db->get()->row_array();

        echo json_encode($cashflow_kontrak);
    }

    //Untuk edit cashflow kontrak
    public function edit_cashflow_kontrak()
    {

        $id_cashflow = $this->input->post('id_cashflow_cp', true);
        $id_kontrak = $this->input->post('id_kontrak_cp', true); 

        $kontrak = $this->db->get_where('tb_kontrak', ['id_kontrak' => $id_kontrak])->row_array();

        $no_job = $kontrak['no_job_kontrak'];
        $kode_customer = $kontrak['kode_customer_kontrak'];
        $perusahaan = $kontrak['perusahaan_kontrak'];
        $tgl_project = $kontrak['tgl_project_kontrak'];
        $nama_project = $kontrak['nama_project_kontrak'];
        $snilai_project = $kontrak['snilai_project_kontrak'];
        $nilai_project = $kontrak['nilai_project_kontrak'];
        $peluang = $kontrak['peluang_kontrak'];
        $sales1 = $kontrak['sales1_kontrak'];
        $sales2 = $kontrak['sales2_kontrak'];
        $sales3 = $kontrak['sales3_kontrak'];
        $sales4 = $kontrak['sales4_kontrak'];
        $keterangan = $kontrak['keterangan_kontrak'];
        $alasan = $kontrak['alasan'];
        $id_kontrak = $kontrak['id_kontrak'];
        $username = $this->session->userdata('username');
        
        $snilai_projectLogCashflow = $snilai_project;
        $nilai_projectLogCashflow = preg_replace('/\D/','',$snilai_projectLogCashflow);                   

        //Data log untuk data yg nantinya akan di simpan di tb_log
            $data_log = array(
                'no_job'            => $no_job,
                'kode_customer'     => $kode_customer,
                'perusahaan'        => $perusahaan,
                'tgl_project'       => $tgl_project,
                'nama_project'      => $nama_project,
                'snilai_project'    => $snilai_projectLogCashflow,
                'nilai_project'     => $nilai_projectLogCashflow,
                'peluang'           => $peluang,
                'sales1'            => $sales1,
                'sales2'            => $sales2,
                'sales3'            => $sales3,
                'sales4'            => $sales4,
                'keterangan'        => $keterangan,
                'alasan'            => $alasan,
                'tgl_update'        => date('Y-m-d'),
                'username'          => $username,
                'status'            => 4,
                'id_kontrak'        => $id_kontrak,
            );
        $this->db->insert('log_kontrak', $data_log);
            
        //ini ada titiknya
        //yg ada titiknya simpan di kolom sr yg bertipe varchar dan dilakukan pengkondisian supaya ketika load pertama kali bentuknya nol bukan blank                                           
        $sr01 = $this->input->post('R01');
        if(trim($sr01) == ""){
            $sr01 = "0";
        }

        $sr02 = $this->input->post('R02');
        if(trim($sr02) == ""){
            $sr02 = "0";
        }
                                                                                                               
        $sr03 = $this->input->post('R03');
        if(trim($sr03) == ""){
            $sr03 = "0";
        }

        $sr04 = $this->input->post('R04');
        if(trim($sr04) == ""){
            $sr04 = "0";
        }

        $sr05 = $this->input->post('R05');
        if(trim($sr05) == ""){
            $sr05 = "0";
        }

        $sr06 = $this->input->post('R06');
        if(trim($sr06) == ""){
            $sr06 = "0";
        }

        $sr07 = $this->input->post('R07');
        if(trim($sr07) == ""){
            $sr07 = "0";
        }

        $sr08 = $this->input->post('R08');
        if(trim($sr08) == ""){
            $sr08 = "0";
        }

        $sr09 = $this->input->post('R09');
        if(trim($sr09) == ""){
            $sr09 = "0";
        }

        $sr10 = $this->input->post('R10');
        if(trim($sr10) == ""){
            $sr10 = "0";
        }

        $sr11 = $this->input->post('R11');
        if(trim($sr11) == ""){
            $sr11 = "0";
        }

        $sr12 = $this->input->post('R12');
        if(trim($sr12) == ""){
            $sr12 = "0";
        }      

        //tidak ada titik                                           
        //yg ga ada titiknya simpan di kolom r yg bertipe integer
        $r01 = preg_replace('/\D/','',$sr01);
        $r02 = preg_replace('/\D/','',$sr02);
        $r03 = preg_replace('/\D/','',$sr03);
        $r04 = preg_replace('/\D/','',$sr04);
        $r05 = preg_replace('/\D/','',$sr05);
        $r06 = preg_replace('/\D/','',$sr06);
        $r07 = preg_replace('/\D/','',$sr07);
        $r08 = preg_replace('/\D/','',$sr08);
        $r09 = preg_replace('/\D/','',$sr09);
        $r10 = preg_replace('/\D/','',$sr10);
        $r11 = preg_replace('/\D/','',$sr11);
        $r12 = preg_replace('/\D/','',$sr12);

        //Expense
        $se01 = $this->input->post('E01');
        if(trim($se01) == ""){
            $se01 = "0";
        }              
        $se02 = $this->input->post('E02');
        if(trim($se02) == ""){
            $se02 = "0";
        }                 
        $se03 = $this->input->post('E03');
        if(trim($se03) == ""){
            $se03 = "0";
        }                
        $se04 = $this->input->post('E04');
        if(trim($se04) == ""){
            $se04 = "0";
        }                 
        $se05 = $this->input->post('E05');
        if(trim($se05) == ""){
            $se05 = "0";
        }                 
        $se06 = $this->input->post('E06');
        if(trim($se06) == ""){
            $se06 = "0";
        }                
        $se07 = $this->input->post('E07');
        if(trim($se07) == ""){
            $se07 = "0";
        }                 
        $se08 = $this->input->post('E08');
        if(trim($se08) == ""){
            $se08 = "0";
        }                 
        $se09 = $this->input->post('E09');
        if(trim($se09) == ""){
            $se09 = "0";
        }                
        $se10 = $this->input->post('E10');
        if(trim($se10) == ""){
            $se10 = "0";
        }                 
        $se11 = $this->input->post('E11');
        if(trim($se11) == ""){
            $se11 = "0";
        }                
        $se12 = $this->input->post('E12');
        if(trim($se12) == ""){
            $se12 = "0";
        }                 

        $e01 = preg_replace('/\D/','',$se01);       $e07 = preg_replace('/\D/','',$se07);
        $e02 = preg_replace('/\D/','',$se02);       $e08 = preg_replace('/\D/','',$se08);
        $e03 = preg_replace('/\D/','',$se03);       $e09 = preg_replace('/\D/','',$se09);
        $e04 = preg_replace('/\D/','',$se04);       $e10 = preg_replace('/\D/','',$se10);
        $e05 = preg_replace('/\D/','',$se05);       $e11 = preg_replace('/\D/','',$se11);
        $e06 = preg_replace('/\D/','',$se06);       $e12 = preg_replace('/\D/','',$se12);

        //Instalasi
        $si01 = $this->input->post('I01');
        if(trim($si01) == ""){
            $si01 = "0";
        }                 
        $si02 = $this->input->post('I02');
        if(trim($si02) == ""){
            $si02 = "0";
        }                 
        $si03 = $this->input->post('I03');
        if(trim($si03) == ""){
            $si03 = "0";
        }                 
        $si04 = $this->input->post('I04');
        if(trim($si04) == ""){
            $si04 = "0";
        }                 
        $si05 = $this->input->post('I05');
        if(trim($si05) == ""){
            $si05 = "0";
        }                
        $si06 = $this->input->post('I06');
        if(trim($si06) == ""){
            $si06 = "0";
        }               
        $si07 = $this->input->post('I07');
        if(trim($si07) == ""){
            $si07 = "0";
        }               
        $si08 = $this->input->post('I08');
        if(trim($si08) == ""){
            $si08 = "0";
        }               
        $si09 = $this->input->post('I09');
        if(trim($si09) == ""){
            $si09 = "0";
        }               
        $si10 = $this->input->post('I10');
        if(trim($si10) == ""){
            $si10 = "0";
        }               
        $si11 = $this->input->post('I11');
        if(trim($si11) == ""){
            $si11 = "0";
        }               
        $si12 = $this->input->post('I12');
        if(trim($si12) == ""){
            $si12 = "0";
        }                

        $i01 = preg_replace('/\D/','',$si01);       $i07 = preg_replace('/\D/','',$si07);
        $i02 = preg_replace('/\D/','',$si02);       $i08 = preg_replace('/\D/','',$si08);
        $i03 = preg_replace('/\D/','',$si03);       $i09 = preg_replace('/\D/','',$si09);
        $i04 = preg_replace('/\D/','',$si04);       $i10 = preg_replace('/\D/','',$si10);
        $i05 = preg_replace('/\D/','',$si05);       $i11 = preg_replace('/\D/','',$si11);
        $i06 = preg_replace('/\D/','',$si06);       $i12 = preg_replace('/\D/','',$si12);

        $sd01 = $this->input->post('D01');
        if(trim($sd01) == ""){
            $sd01 = "0";
        }                
        $sd02 = $this->input->post('D02');
        if(trim($sd02) == ""){
            $sd02 = "0";
        }                    
        $sd03 = $this->input->post('D03');
        if(trim($sd03) == ""){
            $sd03 = "0";
        }              
        $sd04 = $this->input->post('D04');
        if(trim($sd04) == ""){
            $sd04 = "0";
        }              
        $sd05 = $this->input->post('D05');
        if(trim($sd05) == ""){
            $sd05 = "0";
        }             
        $sd06 = $this->input->post('D06');
        if(trim($sd06) == ""){
            $sd06 = "0";
        }             
        $sd07 = $this->input->post('D07');
        if(trim($sd07) == ""){
            $sd07 = "0";
        }            
        $sd08 = $this->input->post('D08');
        if(trim($sd08) == ""){
            $sd08 = "0";
        }          
        $sd09 = $this->input->post('D09');
        if(trim($sd09) == ""){
            $sd09 = "0";
        }        
        $sd10 = $this->input->post('D10');
        if(trim($sd10) == ""){
            $sd10 = "0";
        }           
        $sd11 = $this->input->post('D11');
        if(trim($sd11) == ""){
            $sd11 = "0";
        }            
        $sd12 = $this->input->post('D12');
        if(trim($sd12) == ""){
            $sd12 = "0";
        }          

        $d01 = preg_replace('/\D/','',$sd01);       $d07 = preg_replace('/\D/','',$sd07);
        $d02 = preg_replace('/\D/','',$sd02);       $d08 = preg_replace('/\D/','',$sd08);
        $d03 = preg_replace('/\D/','',$sd03);       $d09 = preg_replace('/\D/','',$sd09);
        $d04 = preg_replace('/\D/','',$sd04);       $d10 = preg_replace('/\D/','',$sd10);
        $d05 = preg_replace('/\D/','',$sd05);       $d11 = preg_replace('/\D/','',$sd11);
        $d06 = preg_replace('/\D/','',$sd06);       $d12 = preg_replace('/\D/','',$sd12);
        
        //Mengambil nilai total dari field total di html
        $stotal_revenue = $this->input->post('TR');
        if((trim($stotal_revenue) == "NaN") || (trim($stotal_revenue) == "")){
            $stotal_revenue = "0";
        }                      
        $stotal_expense = $this->input->post('TE');
        if((trim($stotal_expense) == "NaN") || (trim($stotal_expense) == "")){
            $stotal_expense = "0";
        }                      
        $stotal_instalasi = $this->input->post('TI');
        if((trim($stotal_instalasi) == "NaN") || (trim($stotal_instalasi) == "")){
            $stotal_instalasi = "0";
        }                    
        $stotal_differensial = $this->input->post('TD');
        if((trim($stotal_differensial) == "NaN") || (trim($stotal_differensial) == "")){
            $stotal_differensial = "0";
        }

        //Merubah ke integer untuk nilai total
        $total_revenue = preg_replace('/\D/','',$stotal_revenue);
        $total_expense = preg_replace('/\D/','',$stotal_expense);
        $total_instalasi = preg_replace('/\D/','',$stotal_instalasi);
        $total_differensial = preg_replace('/\D/','',$stotal_differensial);
        
        //Mengambil nilai margin dari field html
        $smargin01 = $this->input->post('M01');
        if((trim($smargin01) == "NaN") || (trim($smargin01) == "")){
            $smargin01 = "0";
        }             
        $smargin02 = $this->input->post('M02');
        if((trim($smargin02) == "NaN") || (trim($smargin02) == "")){
            $smargin02 = "0";
        }             
        $smargin03 = $this->input->post('M03');
        if((trim($smargin03) == "NaN") || (trim($smargin03) == "")){
            $smargin03 = "0";
        }           
        $smargin04 = $this->input->post('M04');
        if((trim($smargin04) == "NaN") || (trim($smargin04) == "")){
            $smargin04 = "0";
        }            
        $smargin05 = $this->input->post('M05');
        if((trim($smargin05) == "NaN") || (trim($smargin05) == "")){
            $smargin05 = "0";
        }           
        $smargin06 = $this->input->post('M06');
        if((trim($smargin06) == "NaN") || (trim($smargin06) == "")){
            $smargin06 = "0";
        }          
        $smargin07 = $this->input->post('M07');
        if((trim($smargin07) == "NaN") || (trim($smargin07) == "")){
            $smargin07 = "0";
        }          
        $smargin08 = $this->input->post('M08');
        if((trim($smargin08) == "NaN") || (trim($smargin08) == "")){
            $smargin08 = "0";
        }   
        $smargin09 = $this->input->post('M09');
        if((trim($smargin09) == "NaN") || (trim($smargin09) == "")){
            $smargin09 = "0";
        } 
        $smargin10 = $this->input->post('M10');
        if((trim($smargin10) == "NaN") || (trim($smargin10) == "")){
            $smargin10 = "0";
        }
        $smargin11 = $this->input->post('M11');
        if((trim($smargin11) == "NaN") || (trim($smargin11) == "")){
            $smargin11 = "0";
        }  
        $smargin12 = $this->input->post('M12');
        if((trim($smargin12) == "NaN") || (trim($smargin12) == "")){
            $smargin12 = "0";
        } 

        $margin01 = preg_replace('/\D/','',$smargin01);     $margin07 = preg_replace('/\D/','',$smargin07);
        $margin02 = preg_replace('/\D/','',$smargin02);     $margin08 = preg_replace('/\D/','',$smargin08);
        $margin03 = preg_replace('/\D/','',$smargin03);     $margin09 = preg_replace('/\D/','',$smargin09);
        $margin04 = preg_replace('/\D/','',$smargin04);     $margin10 = preg_replace('/\D/','',$smargin10);
        $margin05 = preg_replace('/\D/','',$smargin05);     $margin11 = preg_replace('/\D/','',$smargin11);
        $margin06 = preg_replace('/\D/','',$smargin06);     $margin12 = preg_replace('/\D/','',$smargin12);

        //Mengupdate header cashflow
        $this->db->set('id_kontrak',$id_kontrak);

        //Mengupdate nilai total ke db
        $this->db->set('total_revenue',$total_revenue);                 $this->db->set('stotal_revenue',$stotal_revenue);
        $this->db->set('total_expense', $total_expense);                $this->db->set('stotal_expense', $stotal_expense);
        $this->db->set('total_instalasi', $total_instalasi);            $this->db->set('stotal_instalasi', $stotal_instalasi);
        $this->db->set('total_differensial',$total_differensial);       $this->db->set('stotal_differensial',$stotal_differensial);

        //mengupdate nilai margin ke db
        //Ini buat Integer                                  //Ini buat String
        $this->db->set('margin01',$margin01);               $this->db->set('sm01',$smargin01);
        $this->db->set('margin02',$margin02);               $this->db->set('sm02',$smargin02);
        $this->db->set('margin03',$margin03);               $this->db->set('sm03',$smargin03);
        $this->db->set('margin04',$margin04);               $this->db->set('sm04',$smargin04);
        $this->db->set('margin05',$margin05);               $this->db->set('sm05',$smargin05);
        $this->db->set('margin06',$margin06);               $this->db->set('sm06',$smargin06);
        $this->db->set('margin07',$margin07);               $this->db->set('sm07',$smargin07);
        $this->db->set('margin08',$margin08);               $this->db->set('sm08',$smargin08);
        $this->db->set('margin09',$margin09);               $this->db->set('sm09',$smargin09);
        $this->db->set('margin10',$margin10);               $this->db->set('sm10',$smargin10);
        $this->db->set('margin11',$margin11);               $this->db->set('sm11',$smargin11);
        $this->db->set('margin12',$margin12);               $this->db->set('sm12',$smargin12);

  
        //Mengupdate ke kolom integer Revenue               //Mengupdate ke kolom string Revenue
        $this->db->set('r01',$r01);                         $this->db->set('sr01',$sr01);
        $this->db->set('r02',$r02);                         $this->db->set('sr02',$sr02);
        $this->db->set('r03',$r03);                         $this->db->set('sr03',$sr03);
        $this->db->set('r04',$r04);                         $this->db->set('sr04',$sr04);
        $this->db->set('r05',$r05);                         $this->db->set('sr05',$sr05);
        $this->db->set('r06',$r06);                         $this->db->set('sr06',$sr06);
        $this->db->set('r07',$r07);                         $this->db->set('sr07',$sr07);
        $this->db->set('r08',$r08);                         $this->db->set('sr08',$sr08);
        $this->db->set('r09',$r09);                         $this->db->set('sr09',$sr09);
        $this->db->set('r10',$r10);                         $this->db->set('sr10',$sr10);
        $this->db->set('r11',$r11);                         $this->db->set('sr11',$sr11);
        $this->db->set('r12',$r12);                         $this->db->set('sr12',$sr12);

        //Mengupdate ke kolom integer Expense               //Mengupdate ke kolom string Expense
        $this->db->set('e01',$e01);                         $this->db->set('se01',$se01);
        $this->db->set('e02',$e02);                         $this->db->set('se02',$se02);
        $this->db->set('e03',$e03);                         $this->db->set('se03',$se03);
        $this->db->set('e04',$e04);                         $this->db->set('se04',$se04);
        $this->db->set('e05',$e05);                         $this->db->set('se05',$se05);
        $this->db->set('e06',$e06);                         $this->db->set('se06',$se06);
        $this->db->set('e07',$e07);                         $this->db->set('se07',$se07);
        $this->db->set('e08',$e08);                         $this->db->set('se08',$se08);
        $this->db->set('e09',$e09);                         $this->db->set('se09',$se09);
        $this->db->set('e10',$e10);                         $this->db->set('se10',$se10);
        $this->db->set('e11',$e11);                         $this->db->set('se11',$se11);
        $this->db->set('e12',$e12);                         $this->db->set('se12',$se12);
        
        //Mengupdate ke kolom integer Instalasi             //Mengupdate ke kolom string Instalasi
        $this->db->set('i01',$i01);                         $this->db->set('si01',$si01);
        $this->db->set('i02',$i02);                         $this->db->set('si02',$si02);
        $this->db->set('i03',$i03);                         $this->db->set('si03',$si03);
        $this->db->set('i04',$i04);                         $this->db->set('si04',$si04);
        $this->db->set('i05',$i05);                         $this->db->set('si05',$si05);
        $this->db->set('i06',$i06);                         $this->db->set('si06',$si06);
        $this->db->set('i07',$i07);                         $this->db->set('si07',$si07);
        $this->db->set('i08',$i08);                         $this->db->set('si08',$si08);                   
        $this->db->set('i09',$i09);                         $this->db->set('si09',$si09);
        $this->db->set('i10',$i10);                         $this->db->set('si10',$si10);
        $this->db->set('i11',$i11);                         $this->db->set('si11',$si11);
        $this->db->set('i12',$i12);                         $this->db->set('si12',$si12);

        //Mengupdate ke kolom integer Differensial          //Mengupdate ke kolom string Differensial
        $this->db->set('d01',$d01);                         $this->db->set('sd01',$sd01);
        $this->db->set('d02',$d02);                         $this->db->set('sd02',$sd02);
        $this->db->set('d03',$d03);                         $this->db->set('sd03',$sd03);
        $this->db->set('d04',$d04);                         $this->db->set('sd04',$sd04);
        $this->db->set('d05',$d05);                         $this->db->set('sd05',$sd05);
        $this->db->set('d06',$d06);                         $this->db->set('sd06',$sd06);
        $this->db->set('d07',$d07);                         $this->db->set('sd07',$sd07);
        $this->db->set('d08',$d08);                         $this->db->set('sd08',$sd08);
        $this->db->set('d09',$d09);                         $this->db->set('sd09',$sd09);
        $this->db->set('d10',$d10);                         $this->db->set('sd10',$sd10);
        $this->db->set('d11',$d11);                         $this->db->set('sd11',$sd11);
        $this->db->set('d12',$d12);                         $this->db->set('sd12',$sd12); 
       
        $this->db->where('id_cashflow_kontrak', $id_cashflow);
        $this->db->update('tb_cashflow_kontrak');

        $this->session->set_flashdata('message', 'Simpan Data Cashflow');
        redirect('admin/cust_kontrak_project');
    }

    //untuk menampilkan tabel log
    public function get_log_kontrak()
    {
        $id_log = $_POST['id_log_kontrak'];

        echo json_encode($this->db->get_where('log_kontrak', ['id_log_kontrak' => $id_log])->row_array());
    }

    //untuk menampilkan tabel log
    // public function get_log_cashflow_kontrak()
    // {
    //     $id_log = $_POST['id_log_cashflow'];

    //     $this->db->select('log_kontrak.*,tb_cashflow_kontrak.*');
    //     $this->db->from('log_kontrak');
    //     $this->db->join('tb_cashflow_kontrak', 'log_kontrak.id_kontrak = tb_cashflow_kontrak.id_kontrak');
    //     $this->db->where('id_log_kontrak', $id_log);
    //     $query = $this->db->get()->row_array();

    //     echo json_encode($query);
    // }

    //---------------------------------------------- Fungsi untuk manajemen filter pada dashboard  ----------------------------- //
    public function get_dashboardSales()
        {
           $sales = $_POST['sales'];

        if($sales == 'all'){

        $queryAll10     = $this->db->query("SELECT COUNT(id_project) as peluang_10 FROM tb_project WHERE peluang = 10")->row_array();
        $queryAll25     = $this->db->query("SELECT COUNT(id_project) as peluang_25 FROM tb_project WHERE peluang = 25")->row_array();
        $queryAll50     = $this->db->query("SELECT COUNT(id_project) as peluang_50 FROM tb_project WHERE peluang = 50")->row_array();
        $queryAll100    = $this->db->query("SELECT COUNT(id_project) as peluang_100 FROM tb_project WHERE peluang = 100")->row_array();

        $this->db->select(
        //Revenue, Expense, Instalasi, Differensial, Margin 
        'SUM(r01) as t_r01, SUM(r02) as t_r02 , SUM(r03) as t_r03, SUM(r04) as t_r04, SUM(r05) as t_r05 , SUM(r06) as t_r06, SUM(r07) as t_r07, SUM(r08) as t_r08 , SUM(r09) as t_r09, SUM(r10) as t_r10, SUM(r11) as t_r11 , SUM(r12) as t_r12,
                            
        SUM(e01) as t_e01, SUM(e02) as t_e02 , SUM(e03) as t_e03, SUM(e04) as t_e04, SUM(e05) as t_e05 , SUM(e06) as t_e06, SUM(e07) as t_e07, SUM(e08) as t_e08 , SUM(e09) as t_e09, SUM(e10) as t_e10, SUM(e11) as t_e11 , SUM(e12) as t_e12,

        SUM(i01) as t_i01, SUM(i02) as t_i02 , SUM(i03) as t_i03, SUM(i04) as t_i04, SUM(i05) as t_i05 , SUM(i06) as t_i06, SUM(i07) as t_i07, SUM(i08) as t_i08 , SUM(i09) as t_i09, SUM(i10) as t_i10, SUM(i11) as t_i11 , SUM(i12) as t_i12,

        SUM(d01) as t_d01, SUM(d02) as t_d02 , SUM(d03) as t_d03, SUM(d04) as t_d04, SUM(d05) as t_d05 , SUM(d06) as t_d06, SUM(d07) as t_d07, SUM(d08) as t_d08 , SUM(d09) as t_d09, SUM(d10) as t_d10, SUM(d11) as t_d11 , SUM(d12) as t_d12,

        SUM(r01 - e01 - i01 - d01) as t_m01, SUM(r02 - e02 - i02 - d02) as t_m02 , SUM(r03 - e03 - i03 - d03) as t_m03, SUM(r04 - e04 - i04 - d04) as t_m04, SUM(r05 - e05 - i05 - d05) as t_m05 , SUM(r06 - e06 - i06 - d06) as t_m06, SUM(r07 - e07 - i07 - d07) as t_m07, SUM(r08 - e08 - i08 - d08) as t_m08 , SUM(r09 - e09 - i09 - d09) as t_m09, SUM(r10 - e10 - i10 - d10) as t_m10, SUM(r11 - e11 - i11 - d11) as t_m11 , SUM(r12 - e12 - i12 - d12) as t_m12,'
        );

        $this->db->from('tb_project');
        $this->db->join('tb_cashflow', 'tb_project.id_project = tb_cashflow.id_project');
        $data_result = $this->db->get()->row();
        $total_data = array('dataBar' => $data_result, 
        'dataPeluang10' => $queryAll10, 'dataPeluang25' => $queryAll25, 'dataPeluang50' => $queryAll50, 'dataPeluang100' => $queryAll100);

        echo json_encode($total_data);

        } else {

        $query10 = $this->db->query("SELECT COUNT(id_project) as peluang_10 FROM tb_project WHERE peluang = 10 AND (sales1 = '".$sales."' OR sales2 = '".$sales."' OR sales3 = '".$sales."' OR sales4 = '".$sales."')")->row_array();

        $query25 = $this->db->query("SELECT COUNT(id_project) as peluang_25 FROM tb_project WHERE peluang = 25 AND (sales1 = '".$sales."' OR sales2 = '".$sales."' OR sales3 = '".$sales."' OR sales4 = '".$sales."')")->row_array();

        $query50 = $this->db->query("SELECT COUNT(id_project) as peluang_50 FROM tb_project WHERE peluang = 50 AND (sales1 = '".$sales."' OR sales2 = '".$sales."' OR sales3 = '".$sales."' OR sales4 = '".$sales."')")->row_array();

        $query100 = $this->db->query("SELECT COUNT(id_project) as peluang_100 FROM tb_project WHERE peluang = 100 AND (sales1 = '".$sales."' OR sales2 = '".$sales."' OR sales3 = '".$sales."' OR sales4 = '".$sales."')")->row_array();
        
        $this->db->select(
        //Revenue, Expense, Instalasi, Differensial, Margin 
        'SUM(r01) as t_r01, SUM(r02) as t_r02 , SUM(r03) as t_r03, SUM(r04) as t_r04, SUM(r05) as t_r05 , SUM(r06) as t_r06, SUM(r07) as t_r07, SUM(r08) as t_r08 , SUM(r09) as t_r09, SUM(r10) as t_r10, SUM(r11) as t_r11 , SUM(r12) as t_r12,
                            
        SUM(e01) as t_e01, SUM(e02) as t_e02 , SUM(e03) as t_e03, SUM(e04) as t_e04, SUM(e05) as t_e05 , SUM(e06) as t_e06, SUM(e07) as t_e07, SUM(e08) as t_e08 , SUM(e09) as t_e09, SUM(e10) as t_e10, SUM(e11) as t_e11 , SUM(e12) as t_e12,

        SUM(i01) as t_i01, SUM(i02) as t_i02 , SUM(i03) as t_i03, SUM(i04) as t_i04, SUM(i05) as t_i05 , SUM(i06) as t_i06, SUM(i07) as t_i07, SUM(i08) as t_i08 , SUM(i09) as t_i09, SUM(i10) as t_i10, SUM(i11) as t_i11 , SUM(i12) as t_i12,

        SUM(d01) as t_d01, SUM(d02) as t_d02 , SUM(d03) as t_d03, SUM(d04) as t_d04, SUM(d05) as t_d05 , SUM(d06) as t_d06, SUM(d07) as t_d07, SUM(d08) as t_d08 , SUM(d09) as t_d09, SUM(d10) as t_d10, SUM(d11) as t_d11 , SUM(d12) as t_d12,

        SUM(r01 - e01 - i01 - d01) as t_m01, SUM(r02 - e02 - i02 - d02) as t_m02 , SUM(r03 - e03 - i03 - d03) as t_m03, SUM(r04 - e04 - i04 - d04) as t_m04, SUM(r05 - e05 - i05 - d05) as t_m05 , SUM(r06 - e06 - i06 - d06) as t_m06, SUM(r07 - e07 - i07 - d07) as t_m07, SUM(r08 - e08 - i08 - d08) as t_m08 , SUM(r09 - e09 - i09 - d09) as t_m09, SUM(r10 - e10 - i10 - d10) as t_m10, SUM(r11 - e11 - i11 - d11) as t_m11 , SUM(r12 - e12 - i12 - d12) as t_m12,'
        );

        $this->db->from('tb_project');
        $this->db->join('tb_cashflow', 'tb_project.id_project = tb_cashflow.id_project');
        $this->db->where(['sales1' => $sales]);
        $this->db->or_where(['sales2' => $sales]);
        $this->db->or_where(['sales3' => $sales]);
        $this->db->or_where(['sales4' => $sales]);
        $data_result = $this->db->get()->row();
        $total_data = array('dataBar' => $data_result, 
        'dataPeluang10' => $query10, 'dataPeluang25' => $query25, 'dataPeluang50' => $query50, 'dataPeluang100' => $query100);

        echo json_encode($total_data);

        }
    }

    // public function getProject()
    // {
    //     $id_project = $_POST['id_project'];
        
    //     $this->db->select('*');
    //     $this->db->from('tb_project');
    //     $this->db->join('mst_customer', 'tb_project.kode_customer = mst_customer.kode_cust');
    //     $this->db->where(['$id_project' => $id_project]);
    //     $query = $this->db->get();
    //     echo json_encode($query->row_array());
    // }

}
