<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homepage extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Price');
    }

    public function index()
    {
        $page_data['page_name'] = 'home';
        $this->load->view('front/index', $page_data);
    }

    public function get_data()
    {
        date_default_timezone_set("Asia/Jakarta");

        $date = $this->input->post('date');

        $this->db->select('a.nama_klub AS anama_klub,c.nama,c.nama_klub,b.sesi,b.tanggal,a.status_pembayaran,a.tanggal_kadaluarsa');
        $this->db->from('pesanan a');
        $this->db->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan');
        $this->db->join('user c', 'a.id_user=c.id_user', 'LEFT');
        $this->db->where("date_format(b.tanggal,'%Y-%m-%d') = '$date' AND (a.status_pembayaran IN(0,1,2))");
        $this->db->order_by('b.sesi', 'ASC');
        $res = $this->db->get()->result();

        $data_db = [];

        foreach ($res as $val) {
            $clubname = '';

            if ($val->anama_klub != null) {
                $clubname = $val->anama_klub;
            } elseif ($val->nama_klub != null) {
                $clubname = $val->nama_klub;
            } else {
                $clubname = $val->nama;
            }

            $row['sesi'] = $val->sesi;
            $row['clubname'] = $clubname;
            $row['date'] = $val->tanggal;
            $row['payment_status'] = $val->status_pembayaran;
            $row['date_exp'] = $val->tanggal_kadaluarsa;

            $data_db[] = $row;
        }

        $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];
        $data = [];

        for ($i = 0; $i < 8; $i++) {
            $row = [];
            $row['sesi'] = $i + 1;
            $row['jam'] = $jam[$i];
            $row['nama'] = 'TERSEDIA';
            $row['booked'] = 0;

            $date_now = date('Y-m-d');
            $row['disabled'] = '';

            if ($date_now > $date) {
                $row['disabled'] = 'disabled';
                $row['nama'] = 'TIDAK TERSEDIA';
            } elseif ($date_now == $date) {
                $datetime_now = date('H.i');
                $dtn = new DateTime($datetime_now);
                $dtn->modify('+1 hour');

                if ($jam[$i] < $dtn->format('H.i')) {
                    $row['disabled'] = 'disabled';
                    $row['nama'] = 'TIDAK TERSEDIA';
                } else {
                    $row['disabled'] = '';
                    $row['nama'] = 'TERSEDIA';
                }
            } else {
                $row['disabled'] = 'disabled';
                $row['nama'] = '<span class="text-danger">BELUM TERSEDIA</span>';

                $d = new DateTime($date_now);
                $d->modify('+60 day');

                if ($date <= $d->format('Y-m-d')) {
                    $row['disabled'] = '';
                    $row['nama'] = 'TERSEDIA';
                }
            }

            foreach ($data_db as $val) {
                if ($row['sesi'] == $val['sesi']) {
                    $row['disabled'] = 'disabled';
                    $row['nama'] = '<span class="text-danger">BELUM TERSEDIA</span>';

                    $d = new DateTime($date_now);
                    $d->modify('+60 day');

                    if ($date <= $d->format('Y-m-d')) {
                        if ($val['payment_status'] == 0) {
                            $row['payment_status'] = $val['payment_status'];
                            $row['nama'] = 'BOOKED by ' . $val['clubname'];
                            $row['disabled'] = 'disabled';

                            if (date('Y-m-d H:i:s') > $val['date_exp'] && $val['date_exp'] != '') {
                                $row['disabled'] = '';
                            }
                        } else {
                            $row['nama'] = $val['clubname'];
                            $row['booked'] = 1;
                        }
                    }
                }
            }

            $row['booking'] = 0;

            foreach ($this->db->get('keranjang')->result_array() as $val) {
                if ($row['sesi'] == $val['sesi'] && $date == $val['tanggal']) {
                    $row['booking'] = 1;

                    if ($val['id_user'] != $this->session->userdata('user_id')) {
                        $row['disabled'] = '';
                    }

                    if ($val['id_user'] == null || $val['id_user'] != $this->session->userdata('user_id')) {
                        $row['booking'] = 0;
                        $row['disabled'] = 'disabled';
                    }
                }
            }

            $price = $this->price->price_court($date, ($i + 1));

            $row['harga'] = $price;
            $row['tanggal'] = $date;

            $data[] = $row;
        }

        $output = array(
            'data' => $data,
            'count_cart' => $this->db->get_where('keranjang', array('id_user' => $this->session->userdata('user_id')))->num_rows()
        );

        echo json_encode($output);
    }

    public function get_data_calendar()
    {
        $res = $this->db->group_by('tanggal')->get_where('keranjang', array('id_user' => $this->session->userdata('user_id')))->result();
        echo json_encode($res);
    }

    public function information()
    {
        $page_data['page_name'] = 'information';
        $this->load->view('front/index', $page_data);
    }

    public function csrf_hash()
    {
        echo $this->security->get_csrf_hash();
    }

    public function expired()
    {
        date_default_timezone_set("Asia/Jakarta");

        $res = $this->db->get_where('pesanan', array('status_pembayaran' => 0))->result();

        foreach ($res as $val) {
            if (date('Y-m-d H:i:s') > $val->tanggal_kadaluarsa && $val->tanggal_kadaluarsa != '') {
                $data['status_pembayaran'] = 3;
                $this->db->where('id_pesanan', $val->id_pesanan);
                $this->db->update('pesanan', $data);
            }
        }

        $res2 = $this->db->get('keranjang')->result();

        foreach ($res2 as $val2) {
            if (date('Y-m-d H:i:s') > $val2->kadaluarsa_keranjang && $val2->kadaluarsa_keranjang != '') {
                $this->db->where('id_user', $val2->id_user);
                $this->db->delete('keranjang');
            }
        }
    }
}
