<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('back/Admin_model', 'admin');
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            redirect(base_url() . 'back/dashboard');
        } else {
            $this->load->view('back/login');
        }
    }

    public function login()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
        } else {
            $login_data = $this->db->get_where('admin', array(
                'email' => $this->input->post('email'),
                'password' => sha1($this->input->post('password'))
            ));

            if ($login_data->num_rows() > 0) {
                foreach ($login_data->result_array() as $row) {
                    $this->session->set_userdata('admin_login', 'yes');
                    $this->session->set_userdata('admin_id', $row['id_admin']);
                    $this->session->set_userdata('admin_name', $row['nama']);
                    $this->session->set_userdata('admin_role', $row['role']);

                    echo 'lets_login';
                }
            } else {
                echo 'login_failed';
            }
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'admin', 'refresh');
    }

    public function profile($para = '')
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            if ($para == 'update_profile') {
                $data['nama'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $this->db->where('id_admin', $this->session->userdata('admin_id'));
                $this->db->update('admin', $data);
            }
            if ($para == 'update_password') {
                $current_pass = $this->input->post('current_pass');
                $new_pass = $this->input->post('new_pass');
                $confirm_pass = $this->input->post('confirm_pass');

                $data_pass = $this->db->get_where('admin', array('id_admin' => $this->session->userdata('admin_id')))->row();

                if ($data_pass->password == sha1($current_pass)) {
                    if ($new_pass == $confirm_pass) {
                        $data['password'] = sha1($confirm_pass);
                        $this->db->where('id_admin', $this->session->userdata('admin_id'));
                        $this->db->update('admin', $data);

                        $json_data = array(
                            'success' => 1,
                            'message' => 'Update password done.'
                        );

                        echo json_encode($json_data);
                    }
                } else {
                    $json_data = array(
                        'success' => 2,
                        'message' => 'Current Password not match'
                    );

                    echo json_encode($json_data);
                }
            } else {
                $page_data['page_name'] = 'profile';
                $page_data['admin_data'] = $this->db->get_where('admin', array('id_admin' => $this->session->userdata('admin_id')))->row();
                $this->load->view('back/index', $page_data);
            }
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function list()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = 'admin';
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function data($para = '')
    {
        if ($para == 'list') {
            $requestData = $this->input->post();
            $list = $this->admin->get_datatables($requestData);
            $data = array();
            $no = $requestData['start'];
            $role = ['-', 'Admin', 'Keuangan'];

            foreach ($list as $val) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $val->nama;
                $row[] = $val->email;
                $row[] = $role[$val->role];
                $row[] = date_format(date_create($val->tanggal), 'd M Y H:i');
                $row[] = '<div class="dropdown float-left">
                        <button class="btn btn-info btn-sm dropdown-toggle text-xs" type="button" data-toggle="dropdown"><i class="fas fa-cogs"></i> Option</button>
                        <div class="dropdown-menu animated--fade-in">
                            <a class="dropdown-item" onclick="option(0,' . $val->id_admin . ')"><i class="fas fa-edit"></i> Edit</a>
                            <a class="dropdown-item" onclick="option(1,' . $val->id_admin . ')"><i class="fas fa-trash-alt"></i> Delete</a>
                        </div>
                        </div>';

                $data[] = $row;
            }

            $output = array(
                'draw' => $requestData['draw'],
                'recordsTotal' => $this->admin->count_all(),
                'recordsFiltered' => $this->admin->count_filtered($requestData),
                'data' => $data
            );

            echo json_encode($output);
        } elseif ($para == 'add') {
            $row = $this->db->get_where('admin', array('email' => $this->input->post('email')))->num_rows();

            if ($row == 0) {
                $data['nama'] = $this->input->post('nama');
                $data['email'] = $this->input->post('email');
                $data['password'] = sha1($this->input->post('confirm_pass'));
                $this->db->insert('admin', $data);
                $email = $this->input->post('email');
                $nama = $this->input->post('nama');

                $status = 1;
                $message = 'Add admin berhasil.';
            } else {
                $status = 2;
                $message = 'Email ini sudah digunakan.';
            }

            if ($email == '') {
                $status = 2;
                $message = 'Email diperlukan!';
            } else {
                $data['email'] = $email;
            }

            if ($nama == '') {
                $status = 2;
                $message = 'Nama diperlukan!';
            } else {
                $data['nama'] = $nama;
            }

            $json_data = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($json_data);
        } elseif ($para == 'edit') {
            $id = $this->input->post('id_admin');
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $confirm_pass = $this->input->post('confirm_pass');

            $status = 1;
            $message = 'Edit admin Berhasil.';

            $data = array();
            $data['nama'] = $this->input->post('nama');

            if ($password != '' || $confirm_pass != '') {
                $data['password'] = sha1($this->input->post('confirm_pass'));
            }

            $row = $this->db->get_where('admin', array('id_admin' => $id))->row();

            if ($row->email != $email) {
                $check_email = $this->db->get_where('admin', array('email' => $email, 'id_admin !=' => $id))->num_rows();
                // $check_email2 = $this->db->get_where('user', array('email' => $email, 'id_user !=' => $id))->num_rows();

                if ($check_email == 0) {
                    $data['email'] = $email;
                } else {
                    $status = 2;
                    $message = 'Email ini sudah digunakan.';
                }
            }

            if ($email == '') {
                $status = 2;
                $message = 'Email diperlukan!';
            } else {
                $data['email'] = $email;
            }

            $data['role'] = $this->input->post('role');

            if ($status == 1) {
                $this->db->where('id_admin', $id);
                $this->db->update('admin', $data);
            }

            $json_data = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($json_data);
        } elseif ($para == 'delete') {
            $this->db->where('id_admin', $this->input->post('id_admin'));
            $this->db->delete('admin');

            $json_data = array(
                'status' => 1,
                'message' => 'Delete admin berhasil.'
            );

            echo json_encode($json_data);
        } elseif ($para == 'get_data') {
            $data_admin = $this->db->select('nama,email,role')->get_where('admin', array('id_admin' => $this->input->post('id_admin')))->row();

            $json_data = array(
                'status' => 1,
                'data' => $data_admin
            );

            echo json_encode($json_data);
        }
    }
}
