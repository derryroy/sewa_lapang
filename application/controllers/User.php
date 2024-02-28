<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
        $this->load->library('Send_mail');
        $this->load->library('Price');
    }

    public function register()
    {
        $page_data['page_name'] = 'register';
        $this->load->view('front/index', $page_data);
    }

    public function add_user()
    {
        $email = $this->input->post('email_register');

        $row = $this->db->get_where('user', array('email' => $email))->num_rows();

        if ($row == 0) {
            $data['nama'] = $this->input->post('name_register');
            $data['email'] = $email;
            $data['password'] = sha1($this->input->post('password_register'));
            $data['telepon'] = $this->input->post('phone_register');
            $this->db->insert('user', $data);

            $status = 1;
            $message = 'Daftar Berhasil.';
        } else {
            $status = 2;
            $message = 'Email ini sudah digunakan.';
        }

        $output = array(
            'status' => $status,
            'message' => $message
        );

        echo json_encode($output);
    }

    private function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function forgot_password()
    {
        $email = $this->input->post('email');
        $reset_pass = $this->generateRandomString(8);

        $data['password'] = sha1($reset_pass);
        $this->db->where('email', $email);
        $this->db->update('user', $data);

        $subject = 'Reset Password';
        $message = '<div style="width:600px;padding:0px 0px 40px 0px;text-align:center;margin:auto;">
                    <h3 style="padding-bottom:20px;">Your password : </h3>
                    <h1>' . $reset_pass . '</h1>
                </div>';

        $this->send_mail->sendinblue($subject, $email, $message);

        $output = array(
            'status' => 1,
            'message' => 'Berhasi dikirim'
        );

        echo json_encode($output);
    }

    public function login()
    {
        if ($this->session->userdata('user_login') == 'yes') {
            redirect(base_url());
        } else {
            $page_data['page_name'] = 'login';
            $this->load->view('front/index', $page_data);
        }
    }

    public function do_login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $login_data = $this->db->get_where('user', array(
                'email' => $this->input->post('email'),
                'password' => sha1($this->input->post('password'))
            ));

            if ($login_data->num_rows() > 0) {
                foreach ($login_data->result_array() as $row) {
                    $this->session->set_userdata('user_login', 'yes');
                    $this->session->set_userdata('user_id', $row['id_user']);
                    $this->session->set_userdata('user_name', $row['nama']);
                    $this->session->set_userdata('popup', 1);

                    echo 'lets_login';
                }
            } else {
                echo 'login_failed';
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->unset_userdata('access_token');
        redirect(base_url(), 'refresh');
    }

    public function profile()
    {
        $user_data = $this->db->get_where('user', array('id_user' => $this->session->userdata('user_id')))->row();

        if ($this->session->userdata('user_login') == 'yes') {
            $page_data['page_name'] = 'profile';
            $page_data['user_data'] = $user_data;
            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function edit_user($para1 = '', $para2 = '')
    {
        date_default_timezone_set("Asia/Jakarta");

        if ($para1 == 'profile') {
            $data['nama'] = $this->input->post('profile_name');
            $data['email'] = $this->input->post('profile_email');
            $data['telepon'] = $this->input->post('profile_phone');
            $data['nama_klub'] = $this->input->post('profile_clubname') != '' ? $this->input->post('profile_clubname') : null;
            $data['telepon2'] = $this->input->post('profile_phone2') != '' ? $this->input->post('profile_phone2') : null;
            $this->db->where('id_user', $this->session->userdata('user_id'));
            $this->db->update('user', $data);
        } elseif ($para1 == 'password') {
            $old_pass = $this->input->post('old_pass');
            $new_pass = $this->input->post('new_pass');
            $confirm_new_pass = $this->input->post('confirm_new_pass');

            $status = $this->check_pass($old_pass);

            if ($para2 == 'check') {
                echo $status;
            } elseif ($new_pass == $confirm_new_pass && $status == 1) {
                $user['password'] = sha1($new_pass);
                $this->db->where('id_user', $this->session->userdata('user_id'));
                $this->db->update('user', $user);
            }
        } elseif ($para1 == 'get_data') {
            $res = $this->db->get_where('user', array('clubname' => $this->input->post('clubname')));
            echo $res->num_rows();
        }
    }

    private function check_pass($old_pass)
    {
        $res = $this->db->get_where('user', array('id_user' => $this->session->userdata('user_id')))->row();
        $status = 0;

        if ($res->password == sha1($old_pass)) {
            $status = 1;
        }

        return $status;
    }

    public function order()
    {
        if ($this->session->userdata('user_login') == 'yes') {
            $page_data['page_name'] = 'pesanan';
            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function orders()
    {
        $requestData = $this->input->post();
        $list = $this->user->get_datatables($requestData);
        $data = array();
        $no = $requestData['start'];
        $status = ['Belum diproses', 'Dalam Proses', 'Berhasil', 'Kadaluarsa', 'Dibatalkan'];
        $bg_status = ['bg-secondary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];

        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $val->no_pesanan;
            $row[] = '<span class="' . $bg_status[$val->status_pembayaran] . ' text-white" style="padding:2px 5px 2px 5px;">' . $status[$val->status_pembayaran] . '</span>';
            $row[] = 'Rp ' . number_format($val->total, 0, ',', '.');

            $diskon = $this->price->price_member('detail_pesanan', 'id_pesanan', $val->id_pesanan);

            $row[] = 'Rp ' . number_format(($diskon), 0, ',', '.');
            $row[] = 'Rp ' . number_format(($val->total - $diskon), 0, ',', '.');
            $row[] = $val->catatan;
            $row[] = '<button class="btn btn-sm btn-primary" style="font-size:12px;" onclick="detail_order(' . $val->id_pesanan . ')">Detail</button>';

            $data[] = $row;
        }

        $output = array(
            'draw' => $requestData['draw'],
            'recordsTotal' => $this->user->count_all($requestData),
            'recordsFiltered' => $this->user->count_filtered($requestData),
            'data' => $data
        );

        echo json_encode($output);
    }

    public function detail_order()
    {
        $id = $this->input->post('id');

        $this->db->select('a.id_pesanan,a.no_pesanan,a.id_user,a.nama_klub AS anama_klub,c.nama,c.email,c.nama_klub,c.telepon,c.telepon2,b.sesi,b.tanggal,a.tanggal_pesanan,a.status_pembayaran,a.tanggal_kadaluarsa,a.catatan');
        $this->db->from('pesanan a');
        $this->db->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan');
        $this->db->join('user c', 'a.id_user=c.id_user', 'LEFT');
        $this->db->where('a.id_pesanan', $id);
        $res = $this->db->get()->row();

        $status = ['Belum diproses', 'Dalam Proses', 'Berhasil', 'Kadaluarsa', 'Dibatalkan'];
        $bg_status = ['bg-secondary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];
        $btn = '';

        if ($res->status_pembayaran == 0) {
            $btn = '<button class="btn btn-sm btn-primary text-xs form-control mt-1" data-bs-toggle="modal" data-bs-target="#payment"><i class="fas fa-money-bill-wave"></i> Bayar Pesanan</button><br>
                    <button class="btn btn-sm btn-danger text-xs form-control mt-1" data-bs-toggle="modal" data-bs-target="#cancel_order"><i class="fas fa-lg fa-times"></i> Batalkan Pesanan</button>';
        }

        if ($res->status_pembayaran == 1) {
            $btn = '<button class="btn btn-sm btn-info text-xs text-light form-control mt-1" data-bs-toggle="modal" data-bs-target="#payment2"><i class="fas fa-money-bill-wave"></i> Kurang Bayar</button>';
        }

        $order['id_pesanan'] = $res->id_pesanan;
        $order['no_pesanan'] = $res->no_pesanan;
        $order['id_user'] = $res->id_user;
        $order['nama'] = $res->nama;
        $order['email'] = $res->email;
        $order['nama_klub'] = $res->nama_klub;
        $order['telepon'] = $res->telepon;
        $order['telepon2'] = $res->telepon2;
        $order['status_pembayaran'] = '<span class="' . $bg_status[$res->status_pembayaran] . ' text-white" style="padding:2px 5px 2px 5px;">' . $status[$res->status_pembayaran] . '</span><br>' . $btn;
        $tanggal_pesanan = new DateTime($res->tanggal_pesanan);
        $order['tanggal_pesanan'] = $tanggal_pesanan->format('M d, Y H:i:s');
        $tanggal_kadaluarsa = new DateTime($res->tanggal_kadaluarsa);
        $order['tanggal_kadaluarsa'] = $tanggal_kadaluarsa->format('M d, Y H:i:s');
        $order['catatan'] = $res->catatan;

        $order['disc_member'] = $this->price->price_member('detail_pesanan', 'id_pesanan', $res->id_pesanan);

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $day = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];

        $this->db->select('b.tanggal,b.sesi,b.harga,b.diskon,b.total');
        $this->db->from('pesanan a');
        $this->db->join('detail_pesanan b', 'a.id_pesanan = b.id_pesanan', 'left');
        $this->db->where('a.id_pesanan', $id);
        $res2 = $this->db->get()->result();

        $detail_order = [];
        $i = 1;

        foreach ($res2 as $val) {
            $date = new DateTime($val->tanggal);

            $row['no'] = $i++;
            $row['tanggal'] = $val->tanggal != null ? $day[$date->format('w')] . ', ' . $date->format('d') . ' ' . $month[$date->format('n') - 1] . ' ' . $date->format('Y') : '-';
            $row['sesi'] = $val->sesi != null ? 'Sesi ' . $val->sesi . ' : ' . $jam[$val->sesi - 1] : '-';
            $row['harga'] = $val->harga != null ? $val->harga : 0;

            $detail_order[] = $row;
        }

        $output = array(
            'order' => $order,
            'detail_order' => $detail_order
        );

        echo json_encode($output);
    }
}
