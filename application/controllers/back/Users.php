<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('back/Users_model', 'users');
        $this->load->library('Send_mail');
        $this->load->library('Price');
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = 'users';
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function data($para = '')
    {
        if ($para == 'list') {
            $requestData = $this->input->post();
            $list = $this->users->get_datatables($requestData);
            $data = array();
            $no = $requestData['start'];

            foreach ($list as $val) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $val->nama;
                $row[] = $val->email;
                $row[] = $val->telepon;
                $row[] = $val->nama_klub;
                $row[] = $val->telepon2;
                $row[] = date_format(date_create($val->tanggal), 'd M Y H:i');
                $row[] = '<div class="dropdown float-left">
                        <button class="btn btn-info btn-sm dropdown-toggle text-xs" type="button" data-toggle="dropdown"><i class="fas fa-cogs"></i> Option</button>
                        <div class="dropdown-menu animated--fade-in">
                            <a class="dropdown-item" onclick="option(0,' . $val->id_user . ')"><i class="fas fa-edit"></i> Edit</a>
                            <a class="dropdown-item" onclick="option(1,' . $val->id_user . ')"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                    </div>';

                $data[] = $row;
            }

            $output = array(
                'draw' => $requestData['draw'],
                'recordsTotal' => $this->users->count_all(),
                'recordsFiltered' => $this->users->count_filtered($requestData),
                'data' => $data
            );

            echo json_encode($output);
        } elseif ($para == 'add') {
            $row = $this->db->get_where('user', array('email' => $this->input->post('email')))->num_rows();

            if ($row == 0) {
                $data['nama'] = $this->input->post('nama');
                $data['email'] = $this->input->post('email');
                $data['telepon'] = $this->input->post('telepon');
                $data['password'] = sha1($this->input->post('password'));
                $data['nama_klub'] = $this->input->post('nama_klub') != '' ? $this->input->post('nama_klub') : null;
                $data['telepon2'] = $this->input->post('telepon2') != '' ? $this->input->post('telepon2') : null;
                $this->db->insert('user', $data);

                $status = 1;
                $message = 'Add user berhasil.';
            } else {
                $status = 2;
                $message = 'Email ini sudah digunakan.';
            }

            $json_data = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($json_data);
        } elseif ($para == 'edit') {
            $id = $this->input->post('id_user');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $phone = $this->input->post('telepon');
            $email = $this->input->post('email');

            $status = 1;
            $message = 'Edit user berhasil.';

            $data = array();
            $data['nama'] = $this->input->post('nama');

            if ($password != '') {
                $data['password'] = sha1($this->input->post('password'));
            }

            if ($phone == '') {
                $status = 2;
                $message = 'Nomor telepon diperlukan!';
            } else {
                $data['telepon'] = $phone;
            }

            if ($email == '') {
                $status = 2;
                $message = 'Email diperlukan!';
            } else {
                $data['email'] = $email;
            }

            $data['nama_klub'] = $this->input->post('nama_klub') != '' ? $this->input->post('nama_klub') : null;
            $data['telepon2'] = $this->input->post('telepon2') != '' ? $this->input->post('telepon2') : null;

            $row = $this->db->get_where('user', array('id_user' => $id))->row();

            if ($row->email != $email) {
                $check_email = $this->db->get_where('user', array('email' => $email, 'id_user !=' => $id))->num_rows();

                if ($check_email == 0) {
                    $data['email'] = $email;
                } else {
                    $status = 2;
                    $message = 'This email is already in use.';
                }
            }

            if ($status == 1) {
                $this->db->where('id_user', $id);
                $this->db->update('user', $data);
            }

            $json_data = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($json_data);
        } elseif ($para == 'delete') {
            $this->db->where('id_user', $this->input->post('id_user'));
            $this->db->delete('user');

            $json_data = array(
                'status' => 1,
                'message' => 'Delete user berhasil.'
            );

            echo json_encode($json_data);
        } elseif ($para == 'get_data') {
            $data_user = $this->db->get_where('user', array('id_user' => $this->input->post('id_user')))->row();

            $json_data = array(
                'status' => 1,
                'data' => $data_user
            );

            echo json_encode($json_data);
        }
    }
}
