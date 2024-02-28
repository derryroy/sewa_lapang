<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Harga extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $res = $this->db->get('harga_sewa');
            $harga = [];

            if ($res->num_rows() > 0) {
                foreach ($res->result() as $value) {
                    array_push($harga, $value->harga_sewa);
                }
            }

            $page_data['page_name'] = 'harga';
            $page_data['harga'] = $harga;
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function simpan_harga()
    {
        $requestData = $this->input->post();

        $res = $this->db->get('harga_sewa')->num_rows();

        if ($res > 0) {
            foreach ($requestData as $key => $value) {
                $data['nama_harga'] = $key;
                $data['harga_sewa'] = $value;

                $this->db->where('nama_harga', $key);
                $this->db->update('harga_sewa', $data);
            }
        } else {
            foreach ($requestData as $key => $value) {
                $data['nama_harga'] = $key;
                $data['harga_sewa'] = $value;

                $this->db->insert('harga_sewa', $data);
            }
        }

        $output = array(
            'status' => 1,
            'message' => 'Data harga berhasil disimpan'
        );

        echo json_encode($output);
    }

    // harga event
    public function event()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $res = $this->db->get('harga_event');
            $harga = [];

            if ($res->num_rows() > 0) {
                foreach ($res->result() as $value) {
                    array_push($harga, $value->harga_event);
                }
            }

            $page_data['page_name'] = 'harga_event';
            $page_data['harga'] = $harga;
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function simpan_harga_event()
    {
        $requestData = $this->input->post();

        $res = $this->db->get('harga_event')->num_rows();

        if ($res > 0) {
            foreach ($requestData as $key => $value) {
                $data['nama_event'] = $key;
                $data['harga_event'] = $value;

                $this->db->where('nama_event', $key);
                $this->db->update('harga_event', $data);
            }
        } else {
            foreach ($requestData as $key => $value) {
                $data['nama_event'] = $key;
                $data['harga_event'] = $value;

                $this->db->insert('harga_event', $data);
            }
        }

        $output = array(
            'status' => 1,
            'message' => 'Data harga event berhasil disimpan'
        );

        echo json_encode($output);
    }
}
