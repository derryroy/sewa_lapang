<?php

use GuzzleHttp\Psr7\Message;

defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('Price');
        $this->load->library('Send_mail');
    }

    public function checkout()
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->db->order_by('id_pesanan', 'DESC');
        $this->db->limit(1);
        $res = $this->db->get('pesanan');

        if ($res->num_rows() > 0) {
            $last_id = $res->row()->no_pesanan;

            if (substr($last_id, 0, -4) == 'GCA' . date('Ymd')) {
                $no_pesanan = 'GCA' . date('Ymd') . str_pad(intval(substr($last_id, -4)) + 1, 4, '0', STR_PAD_LEFT);
            } else {
                $no_pesanan = 'GCA' . date('Ymd') . str_pad(1, 4, '0', STR_PAD_LEFT);
            }
        } else {
            $no_pesanan = 'GCA' . date('Ymd') . str_pad(1, 4, '0', STR_PAD_LEFT);
        }

        $order['no_pesanan'] = $no_pesanan;
        $order['id_user'] = $this->session->userdata('user_id');
        $order['tanggal_pesanan'] = date('Y-m-d H:i:s');

        $date = new DateTime($order['tanggal_pesanan']);
        $date->modify('+1 hour');

        $order['tanggal_kadaluarsa'] = $date->format('Y-m-d H:i:s');

        $this->db->insert('pesanan', $order);
        $id_pesanan = $this->db->insert_id();

        $total = $this->detail_pesanan($id_pesanan);

        $this->db->where('id_user', $this->session->userdata('user_id'));
        $this->db->delete('keranjang');

        $output = array(
            'status' => 1,
            'expired' => $date->format('M d, Y H:i:s'),
            'id_pesanan' => $id_pesanan,
            'no_pesanan' => $no_pesanan,
            'total' => $total
        );

        echo json_encode($output);
    }

    private function detail_pesanan($id_pesanan)
    {
        $res = $this->db->get_where('keranjang', array('id_user' => $this->session->userdata('user_id')))->result();
        $data_res = $this->price->list_disc_member('keranjang', 'id_user', $this->session->userdata('user_id'));
        $total = 0;

        foreach ($data_res['disc_member_2'] as $val) {
            $count_disc = 0;

            for ($i = 1; $i <= $val['count']; $i++) {
                if ($i % 4 == 0) {
                    $count_disc++;
                }
            }

            $no = 0;

            foreach ($res as $data) {
                $day = date('w', strtotime($data->tanggal));

                if ($val['day'] == $day) {
                    if ($val['sesi'] == $data->sesi) {
                        $no++;
                        $disc = 0;

                        if ($count_disc > 0) {
                            if ($day == 1 || $day == 2 || $day == 3 || $day == 4 || $day == 5) {
                                if ($data->sesi == 1 || $data->sesi == 2 || $data->sesi == 3 || $data->sesi == 4) {
                                    $disc = 70000;
                                } elseif ($data->sesi == 5 || $data->sesi == 6) {
                                    $disc = 85000;
                                } elseif ($data->sesi == 7 || $data->sesi == 8) {
                                    $disc = 100000;
                                }
                            } else {
                                $disc = 100000;
                            }
                        }

                        $count = 4 * $count_disc;

                        if ($no > $count) {
                            $disc = 0;
                        }

                        $price = $this->price->price_court($data->tanggal, $data->sesi);

                        $detail_order['id_pesanan'] = $id_pesanan;
                        $detail_order['tanggal'] = $data->tanggal;
                        $detail_order['sesi'] = $data->sesi;
                        $detail_order['harga'] = $this->price->price_court($data->tanggal, $data->sesi);
                        $detail_order['diskon'] = $disc;
                        $detail_order['total'] = $price - $disc;

                        $this->db->insert('detail_pesanan', $detail_order);

                        $total += $detail_order['total'];
                    }
                }
            }
        }

        return $total;
    }

    public function kirim_bukti()
    {
        $path = 'upload/bukti_tf/';
        $status = 0;

        $filename = $this->input->post('no_pesanan');

        if ($_FILES['file']['name'] != '') {
            $check_files = $this->check_file($path);

            if ($check_files == 0) {
                $file_name = explode(".", $_FILES['file']['name']);
                $allowed_ext = array("jpg", "jpeg", "png", "gif", "PNG", "JPEG", "JPG");

                if (in_array($file_name[1], $allowed_ext)) {
                    $sourcePath = $_FILES['file']['tmp_name'];
                    $targetPath = $path . $filename . '.' . $file_name[1];

                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $bukti_bayar['tanggal_pembayaran'] = date('Y-m-d H:i:s');
                        $bukti_bayar['status_pembayaran'] = 1;
                        $bukti_bayar['lokasi_gambar'] = $path;
                        $bukti_bayar['nama_gambar'] = $filename . '.' . $file_name[1];
                        $this->db->where('id_pesanan', $this->input->post('id_pesanan'));
                        $this->db->update('pesanan', $bukti_bayar);

                        $status = 1;
                    }
                }
            }
        }

        $output = array(
            'status' => $status
        );

        echo json_encode($output);
    }

    private function check_file($path)
    {
        $count = 0;
        $file_name = explode(".", $_FILES['file']['name']);
        $allowed_ext = array("jpg", "jpeg", "png", "gif", "PNG", "JPEG", "JPG");

        if (in_array($file_name[1], $allowed_ext)) {
            $name = $_FILES['file']['name'];
            $targetPath = $path . $name;

            if (file_exists($targetPath)) {
                $count++;
            }
        }

        return $count;
    }

    public function batalkan_pesanan()
    {
        $data['status_pembayaran'] = 4;
        $this->db->where('id_pesanan', $this->input->post('id_pesanan'));
        $this->db->update('pesanan', $data);
        
        $output = array(
            'status' => 1,
            'message' => 'Pesanan Anda Berhasil Dibatalkan'
        );

        echo json_encode($output);
    }

    public function kirim_bukti_2()
    {
        $path = 'upload/bukti_tf/';
        $status = 0;

        $filename = $this->input->post('no_pesanan_2');

        if ($_FILES['file2']['name'] != '') {
            $check_files = $this->check_file_2($path);

            if ($check_files == 0) {
                $file_name = explode(".", $_FILES['file2']['name']);
                $allowed_ext = array("jpg", "jpeg", "png", "gif", "PNG", "JPEG", "JPG");

                if (in_array($file_name[1], $allowed_ext)) {
                    $sourcePath = $_FILES['file2']['tmp_name'];
                    $targetPath = $path . $filename . '_2.' . $file_name[1];

                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        $bukti_bayar['tanggal_pembayaran'] = date('Y-m-d H:i:s');
                        $bukti_bayar['status_pembayaran'] = 1;
                        $bukti_bayar['lokasi_gambar'] = $path;
                        $bukti_bayar['nama_gambar_2'] = $filename . '_2.' . $file_name[1];
                        $this->db->where('id_pesanan', $this->input->post('id_pesanan_2'));
                        $this->db->update('pesanan', $bukti_bayar);

                        $status = 1;
                    }
                }
            }
        }

        $output = array(
            'status' => $status
        );

        echo json_encode($output);
    }

    private function check_file_2($path)
    {
        $count = 0;
        $file_name = explode(".", $_FILES['file2']['name']);
        $allowed_ext = array("jpg", "jpeg", "png", "gif", "PNG", "JPEG", "JPG");

        if (in_array($file_name[1], $allowed_ext)) {
            $name = $_FILES['file2']['name'];
            $targetPath = $path . $name;

            if (file_exists($targetPath)) {
                $count++;
            }
        }

        return $count;
    }
}
