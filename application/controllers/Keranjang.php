<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Price');
    }

    public function index()
    {
        if ($this->session->userdata('user_login') == 'yes') {
            $page_data['page_name'] = 'keranjang';
            $page_data['user_data'] = $this->db->get_where('user', array('id_user' => $this->session->userdata('user_id')))->row();
            $this->load->view('front/index', $page_data);
        } else {
            redirect(base_url() . 'login');
        }
    }

    public function booking($para = '')
    {
        date_default_timezone_set("Asia/Jakarta");

        if ($para == 'add') {
            $id = $this->input->post('id');
            $tanggal = $this->input->post('tanggal');
            $sesi = $this->input->post('sesi');

            $cart['id_keranjang'] = $id;
            $cart['tanggal'] = $tanggal;
            $cart['sesi'] = $sesi;
            $cart['harga'] = $this->price->price_court($tanggal, $sesi);
            $cart['id_user'] = $this->session->userdata('user_id');

            $date = new DateTime(date('Y-m-d H:i:s'));
            $date->modify('+15 minute');

            $cart['kadaluarsa_keranjang'] = $date->format('Y-m-d H:i:s');

            $this->db->insert('keranjang', $cart);
        } elseif ($para == 'remove') {
            $this->db->where('id_keranjang', $this->input->post('id'));
            $this->db->delete('keranjang');
        }
    }

    public function daftar_keranjang()
    {
        $res = $this->db->get_where('keranjang', array('id_user' => $this->session->userdata('user_id')))->result();
        $data_res = $this->price->list_disc_member('keranjang', 'id_user', $this->session->userdata('user_id'));

        $list_cart = [];

        foreach ($data_res['disc_member_2'] as $val) {
            foreach ($res as $data) {
                $day = date('w', strtotime($data->tanggal));

                if ($val['day'] == $day) {
                    if ($val['sesi'] == $data->sesi) {
                        $m = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                        $d = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                        $h = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];

                        $date = new DateTime($data->tanggal);

                        $row = [];
                        $row['date'] = $d[$date->format('w')] . ', ' . $date->format('d') . ' ' . $m[$date->format('n') - 1] . ' ' . $date->format('Y');
                        $row['tgl'] = date_format(date_create($data->tanggal), 'M d, Y H:i:s');
                        $row['sesi'] = 'Sesi ' . $data->sesi . '<br>' . $h[$data->sesi - 1];
                        $row['price'] = $this->price->price_court($data->tanggal, $data->sesi);
                        $row['opt'] = '<button class="btn btn-sm btn-danger text-xs" onclick="hapus_keranjang(\'' . $data->id_keranjang . '\')"><i class="fas fa-trash"></i> Remove</button>';

                        $list_cart[] = $row;
                    }
                }
            }
        }

        $output = array(
            'data' => $list_cart,
            'disc_member' => $this->price->price_member('keranjang', 'id_user', $this->session->userdata('user_id'))
        );

        echo json_encode($output);
    }

    public function hapus_keranjang()
    {
        $this->db->where('id_keranjang', $this->input->post('id'));
        $this->db->delete('keranjang');
    }
}
