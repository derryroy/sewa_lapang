<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Diskon extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $res = $this->db->get('harga_diskon');
            $diskon = [];

            if ($res->num_rows() > 0) {
                foreach ($res->result() as $value) {
                    array_push($diskon, $value->harga_diskon);
                }
            }

            $page_data['page_name'] = 'diskon';
            $page_data['diskon'] = $diskon;
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function simpan_diskon()
    {
        $requestData = $this->input->post();

        $res = $this->db->get('harga_diskon')->num_rows();

        if ($res > 0) {
            foreach ($requestData as $key => $value) {
                $data['nama_diskon'] = $key;
                $data['harga_diskon'] = $value;

                $this->db->where('nama_diskon', $key);
                $this->db->update('harga_diskon', $data);
            }
        } else {
            foreach ($requestData as $key => $value) {
                $data['nama_diskon'] = $key;
                $data['harga_diskon'] = $value;

                $this->db->insert('harga_diskon', $data);
            }
        }

        $output = array(
            'status' => 1,
            'message' => 'Data diskon berhasil disimpan'
        );

        echo json_encode($output);
    }
}
