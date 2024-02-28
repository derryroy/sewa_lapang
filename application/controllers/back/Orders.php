<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('back/Orders_model', 'orders');
        $this->load->library('Send_mail');
        $this->load->library('Price');
        $this->load->library('Mpdf');

        $this->admin_role = $this->session->userdata('admin_role');
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = 'orders';
            $page_data['year'] = $this->get_year();
            $page_data['status'] = ['Belum diproses', 'Dalam Proses', 'Berhasil', 'Kadalurasa', 'Dibatalkan'];
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    private function get_year()
    {
        $this->db->select("DATE_FORMAT(tanggal_pesanan,'%Y') AS year");
        $this->db->from('pesanan');
        $this->db->group_by('YEAR(tanggal_pesanan)');
        $this->db->order_by('YEAR(tanggal_pesanan)', 'DESC');
        return $this->db->get()->result();
    }

    public function data($para1 = '', $para2 = '')
    {
        date_default_timezone_set("Asia/Jakarta");

        if ($para1 == 'list') {
            $requestData = $this->input->post();
            $list = $this->orders->get_datatables($requestData);
            $data = array();
            $no = $requestData['start'];
            $status = ['Belum diproses', 'Dalam Proses', 'Berhasil', 'Kadaluarsa', 'Dibatalkan'];
            $bg_status = ['bg-secondary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];

            foreach ($list as $val) {
                $nama_klub = '';

                if ($val->rnama_klub != null) {
                    $nama_klub = $val->rnama_klub;
                } elseif ($val->nama_klub != null) {
                    $nama_klub = $val->nama_klub;
                } else {
                    $nama_klub = $val->nama;
                }

                $no++;
                $row = array();
                $row[] = $no;
                $row[] = '<b><a href="' . base_url() . 'back/orders/data/detail/' . $val->no_pesanan . '">' . $val->no_pesanan . '</a></b>';
                $row[] = $nama_klub;
                $row[] = $val->email;
                $row[] = '<span class="' . $bg_status[$val->status_pembayaran] . ' text-white" style="padding:2px 5px 2px 5px;">' . $status[$val->status_pembayaran] . '</span>';
                $date = new DateTime($val->tanggal_pesanan);
                $row[] = $date->format('d M Y H:i:s');

                $disc_member = 0;
                $disc_member = $this->price->price_member('detail_pesanan', 'id_pesanan', $val->id_pesanan);

                $total = $val->total != null ? 'Rp ' . number_format($val->total - $disc_member, 0, ',', '.') : 0;

                $btn_edit_status = '';

                if ($this->session->userdata('admin_role') != 2) {
                $btn_edit_status = '<a class="dropdown-item" onclick="option(0,' . $val->id_pesanan . ',' . $val->status_pembayaran . ')">Edit Status</a>'; }


                $row[] = $total;
                $row[] = '<div class="dropdown float-left">
                        <button class="btn btn-info btn-sm dropdown-toggle text-xs" type="button" data-toggle="dropdown"><i class="fas fa-cogs"></i> Option</button>
                        <div class="dropdown-menu animated--fade-in">
                            ' . $btn_edit_status . '
                            <a class="dropdown-item" href="' . base_url() . 'back/orders/data/detail/' . $val->no_pesanan . '">Detail Order</a>
                        </div>
                    </div>';

                $data[] = $row;
            }

            $output = array(
                'draw' => $requestData['draw'],
                'recordsTotal' => $this->orders->count_all(),
                'recordsFiltered' => $this->orders->count_filtered($requestData),
                'data' => $data
            );

            echo json_encode($output);
        } elseif ($para1 == 'edit_status') {
            $id = $this->input->post('id');
            $status = $this->input->post('status');

            $order['status_pembayaran'] = $status;
            $order['tanggal_pembayaran'] = date('Y-m-d H:i:s');
            $this->db->where('id_pesanan', $id);
            $this->db->update('pesanan', $order);
        } elseif ($para1 == 'detail') {
            if ($this->session->userdata('admin_login') == 'yes') {
                $page_data['page_name'] = 'order_edit';
                $page_data['order_data'] = $this->editOrder($para2);
                $this->load->view('back/index', $page_data);
            } else {
                redirect(base_url() . 'admin');
            }
        } elseif ($para1 == 'edit_order') {
            $tanggal = $this->input->post('tanggal');
            $tanggal_lama = $this->input->post('tanggal_lama');

            $status = 0;
            $message = 'Jadwal sudah digunakan.';

            $sesi = $this->input->post('sesi');
            $sesi_lama = $this->input->post('sesi_lama');
            $id_detail_pesanan = $this->input->post('id_detail_pesanan');

            $res = $this->db->from('pesanan a')->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan')->where(array('b.tanggal' => $tanggal, 'b.sesi' => $sesi))->where_in('a.status_pembayaran', array(0, 1, 2))->get();
            $res1 = $this->db->from('pesanan a')->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan')->where('b.id_detail_pesanan', $id_detail_pesanan)->get()->row();

            if ($res->num_rows() == 0) {
                $status = 1;
                $message = $this->edit_order($id_detail_pesanan, $tanggal, $sesi, $tanggal_lama, $sesi_lama);
            } elseif ($res->num_rows() > 0) {
                if ($res1->id_admin > 0) {
                    $this->db->select('a.no_pesanan,b.id_detail_pesanan,b.tanggal,b.sesi');
                    $this->db->from('pesanan a');
                    $this->db->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan');
                    $this->db->where(array('a.id_pesanan' => $res1->id_pesanan, 'b.tanggal >=' => $tanggal_lama));
                    $this->db->order_by('b.tanggal,b.sesi', 'ASC');
                    $data = $this->db->get();

                    $diff = date_diff(date_create($tanggal_lama), date_create($tanggal));

                    $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];
                    $status = 1;
                    $message = 'Update date from ' . $tanggal_lama . ' session ' . $sesi_lama . ' : ' . $jam[$sesi_lama - 1] . ' to ' . $tanggal . ' session ' . $sesi . ' : ' . $jam[$sesi - 1];

                    if ($data->num_rows() > 0) {
                        foreach ($data->result() as $row) {
                            $date = new DateTime($row->tanggal);
                            $date->modify('+' . $diff->d . ' day');

                            $this->edit_order($row->id_detail_pesanan, $date->format('Y-m-d'), $row->sesi, $row->tanggal, $row->sesi);
                        }
                    }
                }
            }

            $output = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($output);
        } elseif ($para1 == 'delete_date') {
            $id = $this->input->post('id');
            $res = $this->db->get_where('detail_pesanan', array('id_detail_pesanan' => $id))->row();

            $this->db->where('id_detail_pesanan', $id);
            $this->db->delete('detail_pesanan');

            $status = 1;
            $message = 'Hapus Data Berhasil.';

            $output = array(
                'status' => $status,
                'message' => $message
            );

            echo json_encode($output);
        }
    }

    private function edit_order($id_detail_pesanan, $tanggal, $sesi, $tanggal_lama, $sesi_lama)
    {
        $detail_order['tanggal'] = $tanggal;
        $detail_order['sesi'] = $sesi;
        $this->db->where('id_detail_pesanan', $id_detail_pesanan);
        $this->db->update('detail_pesanan', $detail_order);

        $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];
        $message = 'Update date from ' . $tanggal_lama . ' session ' . $sesi_lama . ' : ' . $jam[$sesi_lama - 1] . ' to ' . $tanggal . ' session ' . $sesi . ' : ' . $jam[$sesi - 1];

        return $message;
    }

    public function order($para1 = '', $para2 = '')
    {
        date_default_timezone_set("Asia/Jakarta");

        if ($para1 == 'add') {
            if ($this->session->userdata('admin_login') == 'yes') {
                $page_data['page_name'] = 'order_add';
                $this->load->view('back/index', $page_data);
            } else {
                redirect(base_url() . 'admin');
            }
        } elseif ($para1 == 'event') {
            if ($this->session->userdata('admin_login') == 'yes') {
                $page_data['page_name'] = 'order_event';
                $this->load->view('back/index', $page_data);
            } else {
                redirect(base_url() . 'admin');
            }
        } elseif ($para1 == 'get_data') {
            $date = $this->input->post('date');

            $this->db->select('a.id_pesanan,a.no_pesanan,b.id_detail_pesanan,a.nama_klub AS rnama_klub,c.nama,c.nama_klub,c.email,b.sesi,b.tanggal,a.status_pembayaran,a.tanggal_kadaluarsa');
            $this->db->from('pesanan a');
            $this->db->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan');
            $this->db->join('user c', 'a.id_user=c.id_user', 'LEFT');
            $this->db->where("date_format(b.tanggal,'%Y-%m-%d') = '$date' AND (a.status_pembayaran IN(0,1,2))");
            $this->db->order_by('b.sesi', 'ASC');
            $res = $this->db->get()->result();

            $data_db = [];

            foreach ($res as $val) {
                $nama_klub = '';

                if ($val->rnama_klub != null) {
                    $nama_klub = $val->rnama_klub;
                } elseif ($val->nama_klub != null) {
                    $nama_klub = $val->nama_klub;
                } else {
                    $nama_klub = $val->nama;
                }

                $row['id_pesanan'] = $val->id_pesanan;
                $row['id_detail_pesanan'] = $val->id_detail_pesanan;
                $row['no_pesanan'] = $val->no_pesanan;
                $row['sesi'] = $val->sesi;
                $row['nama_klub'] = $nama_klub;
                $row['date'] = $val->tanggal;
                $row['payment_status'] = $val->status_pembayaran;
                $row['date_exp'] = $val->tanggal_kadaluarsa;
                $row['email'] = $val->email;

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

                $date_now = date("Y-m-d");
                $row['disabled'] = '';

                if ($date_now > $date) {
                    $row['disabled'] = 'disabled';
                    $row['nama'] = 'TIDAK TERSEDIA';
                } elseif ($date_now == $date) {
                    $datetime_now = date('H.i');
                    $dtn = new DateTime($datetime_now);
                    // $dtn->modify('+1 hour');

                    if ($jam[$i] < $dtn->format('H.i')) {
                        // $row['disabled'] = 'disabled';
                        // $row['nama'] = 'TIDAK TERSEDIA';
                    } else {
                        $row['disabled'] = '';
                        $row['nama'] = 'TERSEDIA';
                    }
                }

                foreach ($data_db as $val) {
                    if ($row['sesi'] == $val['sesi']) {
                        if ($val['payment_status'] == 0) {
                            $row['payment_status'] = $val['payment_status'];
                            $row['nama'] = 'BOOKED by ' . $val['nama_klub'];
                            $row['disabled'] = 'disabled';

                            if (date('Y-m-d H:i:s') > $val['date_exp']) {
                                $row['disabled'] = '';
                            }
                        } else {
                            $row['nama'] = $val['nama_klub'];
                            $row['booked'] = 1;
                            $row['email'] = $val['email'] != null ? $val['email'] : '';
                            $row['id'] = $val['id_pesanan'];
                            $row['opt'] = '';

                            $btn = '<a class="btn btn-sm btn-primary text-xs" onclick="option(0,' . $val['id_detail_pesanan'] . ',\'' . $val['date'] . '\',' . $val['sesi'] . ',\'' . $val['no_pesanan'] . '\',)"><i class="fas fa-edit"></i> <span class="price">Edit</span></a>';

                            $row['opt'] = $btn;
                        }
                    }
                }

                $row['booking'] = 0;

                foreach ($this->db->get('keranjang')->result_array() as $val) {
                    if ($row['sesi'] == $val['sesi'] && $date == $val['tanggal']) {
                        $row['booking'] = 1;

                        if ($val['id_admin'] != $this->session->userdata('admin_id')) {
                            $row['booking'] = 0;
                            $row['disabled'] = 'disabled';
                        }

                        $row['user'] = $val['id_admin'] != null ? 'BOOKED BY ADMIN' : 'BOOKED BY USER';
                    }
                }

                $harga = $this->price->price_court($date, ($i + 1));

                $row['harga'] = 'Rp ' . number_format($harga, 0, ',', '.');
                $row['tanggal'] = $date;

                $data[] = $row;
            }

            $price_event = 0;

            if ($this->input->post('event') == 'event') {
                $price_event = $this->price->price_event($date);
            }

            $output = array(
                'data' => $data,
                'count_cart' => $this->db->get_where('keranjang', array('id_admin' => $this->session->userdata('id_admin')))->num_rows(),
                'price_event' => 'Rp ' . number_format($price_event, 0, ',', '.')
            );

            echo json_encode($output);
        } elseif ($para1 == 'booking') {
            if ($para2 == 'add') {
                $id = $this->input->post('id');
                $tanggal = $this->input->post('tanggal');
                $sesi = $this->input->post('sesi');

                $date_now = date('Y-m-d H:i:s');

                $cart['id_keranjang'] = $id;
                $cart['tanggal'] = $tanggal;
                $cart['sesi'] = $sesi;
                $cart['harga'] = $this->price->price_court($tanggal, $sesi);
                $cart['id_admin'] = $this->session->userdata('admin_id');
                $this->db->insert('keranjang', $cart);
            } elseif ($para2 == 'remove') {
                $this->db->where('id_keranjang', $this->input->post('id'));
                $this->db->delete('keranjang');
            }
        } elseif ($para1 == 'booking_event') {
            if ($para2 == 'add') {
                $date = $this->input->post('date');

                $date_now = date('Y-m-d H:i:s');

                for ($i = 1; $i <= 8; $i++) {
                    $cart['id_keranjang'] = 'GCA' . str_replace('-', '', $date) . '000' . $i;
                    $cart['tanggal'] = $date;
                    $cart['sesi'] = $i;
                    $cart['harga'] = $this->price->price_event($date) / 8;
                    $cart['id_admin'] = $this->session->userdata('admin_id');
                    $cart['event'] = 1;
                    $this->db->insert('keranjang', $cart);
                }
            } elseif ($para2 == 'remove') {
                $this->db->where('tanggal', $this->input->post('date'));
                $this->db->delete('keranjang');
            }
        } elseif ($para1 == 'cart_list') {
            $res = $this->db->get_where('keranjang', array('id_admin' => $this->session->userdata('admin_id'), 'event' => 0))->result();
            $data_res = $this->price->list_disc_member('keranjang', 'id_admin', $this->session->userdata('admin_id'));

            $data1 = [];
            $ttl_hrg = 0;

            foreach ($data_res['disc_member_2'] as $val) {
                foreach ($res as $data) {
                    $day = date('w', strtotime($data->tanggal));

                    if ($val['day'] == $day) {
                        if ($val['sesi'] == $data->sesi) {
                            $m = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
                            $d = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
                            $h = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];

                            $ttl_hrg += intval($this->price->price_court($data->tanggal, $data->sesi));
                            $date = new DateTime($data->tanggal);

                            $row = [];
                            $row['tanggal'] = $d[$date->format('w')] . ', ' . $date->format('d') . ' ' . $m[$date->format('n') - 1] . ' ' . $date->format('Y');
                            $row['sesi'] = 'Sesi ' . $data->sesi . '<br>' . $h[$data->sesi - 1];
                            $row['harga'] = 'Rp ' . number_format($this->price->price_court($data->tanggal, $data->sesi), 0, ',', '.');
                            $row['opt'] = '<button class="btn btn-sm btn-danger text-xs" onclick="unbooking(\'' . $data->id_keranjang . '\',\'' . $data->tanggal . '\')"><i class="fas fa-trash"></i> Remove</button>';

                            $data1[] = $row;
                        }
                    }
                }
            }

            $disc_member = $this->price->price_member('keranjang', 'id_admin', $this->session->userdata('admin_id'));

            $data2['diskon_member'] = 'Rp ' . number_format($disc_member, 0, ',', '.');
            $data2['total_harga'] = 'Rp ' . number_format($ttl_hrg, 0, ',', '.');
            $data2['harga_keseluruhan'] = 'Rp ' . number_format($ttl_hrg - $disc_member, 0, ',', '.');

            $output = array(
                'data1' => $data1,
                'data2' => $data2
            );

            echo json_encode($output);
        } elseif ($para1 == 'cart_list_event') {
            $data1 = [];
            $month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
            $day = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
            $cart = $this->db->group_by('tanggal')->get_where('keranjang', array('id_admin' => $this->session->userdata('admin_id'), 'event' => 1))->result_array();
            $ttl_hrg = 0;

            foreach ($cart as $data) {
                $ttl_hrg += intval($this->price->price_event($data['tanggal']));
                $date = new DateTime($data['tanggal']);

                $row['date'] = $day[$date->format('w')] . ', ' . $date->format('d') . ' ' . $month[$date->format('n') - 1] . ' ' . $date->format('Y');
                $row['tanggal'] = $data['tanggal'];
                $row['sesi'] = '<div class="row text-center">
                                    <div>Sesi 1 <br> 06.00 - 08.00</div>
                                    <div style="padding:0px 10px 0px 10px;">-</div>
                                    <div>Sesi 8 <br> 20.00 - 22.00</div>
                                </div>';
                $row['price'] = 'Rp ' . number_format($this->price->price_event($data['tanggal']), 0, ',', '.');
                $row['opt'] = '<button class="btn btn-sm btn-danger text-xs" onclick="unbooking_event(\'' . $data['tanggal'] . '\')"><i class="fas fa-trash"></i> Remove</button>';

                $data1[] = $row;
            }

            $data2['total_price'] = $ttl_hrg;

            $output = array(
                'data1' => $data1,
                'data2' => $data2
            );

            echo json_encode($output);
        } elseif ($para1 == 'checkout') {
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
            $order['id_admin'] = $this->session->userdata('admin_id');
            $order['nama_klub'] = $this->input->post('nama_klub');
            $order['telepon'] = $this->input->post('telepon');
            $order['status_pembayaran'] = 0;
            $order['tanggal_pesanan'] = date('Y-m-d H:i:s');

            $disc_member = $this->price->price_member('keranjang', 'id_admin', $this->session->userdata('admin_id'));

            if ($this->input->post('event') == 'event') {
                $order['event'] = 1;
            }

            $this->db->insert('pesanan', $order);
            $id_pesanan = $this->db->insert_id();

            $this->detail_pesanan($id_pesanan, $this->input->post('event'));

            $output = array(
                'status' => 1,
            );

            echo json_encode($output);
        } elseif ($para1 == 'get_data_calendar') {
            if ($para2 == 'event') {
                $res = $this->db->group_by('tanggal')->get_where('keranjang', array('id_admin' => $this->session->userdata('admin_id'), 'event' => 1))->result();
            } else {
                $res = $this->db->group_by('tanggal')->get_where('keranjang', array('id_admin' => $this->session->userdata('admin_id'), 'event' => 0))->result();
            }

            echo json_encode($res);
        }
    }

    private function detail_pesanan($id_pesanan, $event = '')
    {
        $e = $event != '' ? 1 : 0;

        $res = $this->db->get_where('keranjang', array('id_admin' => $this->session->userdata('admin_id'), 'event' => $e));

        if ($event == 'event') {
            foreach ($res->result() as $data) {
                $disc = 0;

                $detail_order['id_pesanan'] = $id_pesanan;
                $detail_order['tanggal'] = $data->tanggal;
                $detail_order['sesi'] = $data->sesi;
                $detail_order['harga'] = $data->harga;
                $detail_order['total'] = $data->harga;
                $this->db->insert('detail_pesanan', $detail_order);
            }
        } else {
            $data_res = $this->price->list_disc_member('keranjang', 'id_admin', $this->session->userdata('admin_id'));

            foreach ($data_res['disc_member_2'] as $val) {
                $count_disc = 0;

                for ($i = 1; $i <= $val['count']; $i++) {
                    if ($i % 4 == 0) {
                        $count_disc++;
                    }
                }

                $no = 0;

                foreach ($res->result() as $data) {
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
                        }
                    }
                }
            }
        }
        $this->db->where('id_admin', $this->session->userdata('admin_id'));
        $this->db->where('event', $e);
        $this->db->delete('keranjang');
    }

    private function editOrder($no_pesanan)
    {
        $status = ['Belum diproses', 'Dalam Proses', 'Berhasil', 'Kadaluarsa', 'Dibatalkan'];
        $bg_status = ['bg-secondary', 'bg-info', 'bg-success', 'bg-warning', 'bg-danger'];

        $this->db->select('a.id_pesanan,a.no_pesanan,a.nama_klub AS rnama_klub,a.telepon AS telepon2,a.status_pembayaran,a.tanggal_pesanan,a.tanggal_kadaluarsa,a.tanggal_pembayaran,b.nama,b.email,b.telepon AS telepon1,b.nama_klub,b.telepon2 AS telepon3,c.nama AS nama_admin,a.nama_gambar,a.nama_gambar_2,a.lokasi_gambar,a.catatan');
        $this->db->from('pesanan a');
        $this->db->join('user b', 'a.id_user=b.id_user', 'LEFT');
        $this->db->join('admin c', 'a.id_admin=c.id_admin', 'LEFT');
        $this->db->where('a.no_pesanan', $no_pesanan);
        $res1 = $this->db->get()->row();

        $data1['id_pesanan'] = $res1->id_pesanan;
        $data1['no_pesanan'] = $res1->no_pesanan;
        $data1['nama_klub'] = $res1->rnama_klub != null ? $res1->rnama_klub : $res1->nama_klub;
        $data1['telepon2'] = $res1->telepon2 != null ? $res1->telepon2 : $res1->telepon3;
        $data1['status_pembayaran'] = '<span class="' . $bg_status[$res1->status_pembayaran] . ' text-white rounded" style="padding:2px 7px 2px 7px;">' . $status[$res1->status_pembayaran] . '</span>';
        $tanggal_pesanan = new DateTime($res1->tanggal_pesanan);
        $tanggal_kadaluarsa = new DateTime($res1->tanggal_kadaluarsa);
        $tanggal_pembayaran = new DateTime($res1->tanggal_pembayaran);
        $data1['tanggal_pesanan'] = $tanggal_pesanan->format('d M Y H:i:s');
        $data1['tanggal_kadaluarsa'] = $res1->tanggal_kadaluarsa != null ? $tanggal_kadaluarsa->format('d M Y H:i:s') : '-';
        $data1['tanggal_pembayaran'] = $tanggal_pembayaran->format('d M Y H:i:s');
        $data1['nama'] = $res1->nama;
        $data1['email'] = $res1->email;
        $data1['telepon1'] = $res1->telepon1;
        $data1['nama_admin'] = $res1->nama_admin;
        $data1['bukti_bayar'] = $res1->lokasi_gambar . $res1->nama_gambar;
        $data1['bukti_bayar_2'] = $res1->lokasi_gambar . $res1->nama_gambar_2;
        $data1['catatan'] = $res1->catatan;

        $disc_member = 0;

        $disc_member = $this->price->price_member('detail_pesanan', 'id_pesanan', $res1->id_pesanan);

        $data1['disc_member'] = 'Rp ' . number_format($disc_member, 0, ',', '.');

        $month = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $day = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];
        $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];

        $res2 = $this->db->order_by('tanggal,sesi ASC')->get_where('detail_pesanan', array('id_pesanan' => $res1->id_pesanan));

        $data2 = [];
        $no = 1;
        $ttl_hrg = 0;

        foreach ($res2->result() as $val) {
            $ttl_hrg += intval($val->harga);

            $btn_detele = '';

            if ($res2->num_rows() > 1) {
                $btn_detele = '<a class="dropdown-item" onclick="option(1,' . $val->id_detail_pesanan . ')">Delete</a>';
            }

            $sesi = 'Sesi ' . $val->sesi . ' : ' . $jam[$val->sesi - 1];
            $option = '';

            if ($this->session->userdata('admin_role') == 1) {
                $option = '
                    <div class="dropdown float-left">
                        <button class="btn btn-info btn-sm dropdown-toggle text-xs" type="button" data-toggle="dropdown"><i class="fas fa-cogs"></i> Option</button>
                        <div class="dropdown-menu animated--fade-in">
                            <a class="dropdown-item" onclick="option(0,' . $val->id_detail_pesanan . ',\'' . $val->tanggal . '\',' . $val->sesi . ')">Edit</a>
                            ' . $btn_detele . '
                        </div>
                    </div>';
            }

            $date = new DateTime($val->tanggal);

            $row['no'] = $no++;
            $row['tanggal'] = $day[$date->format('w')] . ', ' . $date->format('d') . ' ' . $month[$date->format('n') - 1] . ' ' . $date->format('Y');
            $row['sesi'] = $sesi;
            $row['harga'] = 'Rp ' . number_format($val->harga, 0, ',', '.');
            $row['option'] = $option;

            $data2[] = $row;
        }

        $data1['total_price'] = 'Rp ' . number_format($ttl_hrg, 0, ',', '.');
        $data1['grand_total'] = 'Rp ' . number_format($ttl_hrg - $disc_member, 0, ',', '.');

        $output = array(
            'data1' => $data1,
            'data2' => $data2,
            'dataJam' => $jam
        );

        return $output;
    }

    public function export_pdf()
    {
        // header("Content-type: application/x-pdf");
        // header("Content-Disposition: attachment; filename=Laporan C-tra Arena.pdf");

        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');

        $this->db->select('a.id_pesanan,a.no_pesanan,a.event,a.nama_klub AS rnama_klub,a.tanggal_pesanan,a.tanggal_pembayaran,a.status_pembayaran,b.nama,b.nama_klub,SUM(c.total) AS total');
        $this->db->from('pesanan a');
        $this->db->join('user b', 'a.id_user=b.id_user', 'LEFT');
        $this->db->join('detail_pesanan c', 'a.id_pesanan=c.id_pesanan');
        $this->db->where("date_format(a.tanggal_pembayaran,'%Y-%m-%d') BETWEEN '" . $sdate . "' AND '" . $edate . "'");
        $this->db->where("a.status_pembayaran", 2);

        $this->db->group_by('a.id_pesanan');
        $res1 = $this->db->get()->result();

        $no = 1;
        $akumulasi = 0;
        $table = '';

        foreach ($res1 as $row1) {
            $res2 = $this->db->order_by('tanggal ASC')->get_where('detail_pesanan', array('id_pesanan' => $row1->id_pesanan))->result();

            $status = ['Belum diproses', 'Dalam Proses', 'Berhasil', 'Kadaluarsa', 'Dibatalkan'];
            $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];

            $akumulasi += $row1->total;
            $tanggal_pesanan = new DateTime($row1->tanggal_pesanan);
            $tanggal_pembayaran = new DateTime($row1->tanggal_pembayaran);
            $web_manual = $row1->rnama_klub != null ? 'MANUAL' : 'WEB';
            $nama_klub = '';
            $event = $row1->event == 1 ? '(Event) ' : '';

            if ($row1->rnama_klub != null) {
                $nama_klub = $row1->rnama_klub;
            } elseif ($row1->nama_klub != null) {
                $nama_klub = $row1->nama_klub;
            } else {
                $nama_klub = $row1->nama;
            }


            $table .= '
                <tr>
                    <td style="padding:5px;">' . $no++ . '</td>
                    <td style="padding:5px;">' . $tanggal_pesanan->format('d M Y') . '</td>
                    <td style="padding:5px;">' . $tanggal_pembayaran->format('d M Y') . '</td>
                    <td style="padding:5px;">' . $status[$row1->status_pembayaran] . '</td>
                    <td style="padding:5px;">' . $event . $nama_klub . '</td>
                    <td style="padding:5px;">' . $web_manual . '</td>
                    <td>
                        <table>';

            foreach ($res2 as $row2) {
                $date = new DateTime($row2->tanggal);
                $table .= '
                            <tr>
                                <td style="padding:5px;border:0;">' . $date->format('d M Y') . '</td>
                            </tr>';
            }

            $table .= '
                        </table>
                    </td>
                    <td>
                        <table>';

            foreach ($res2 as $row2) {
                $table .= '
                            <tr>
                                <td style="padding:5px;border:0;">' . $row2->sesi . ' : ' . $jam[$row2->sesi - 1] . '</td>
                            </tr>';
            }

            $table .= '
                        </table>
                    </td>
                    <td>
                        <table>';

            foreach ($res2 as $row2) {
                $table .= '
                            <tr>
                                <td style="padding:5px;border:0;">' . $row2->total . '</td>
                            </tr>';
            }

            $table .= '
                        </table>
                    </td>
                    <td style="padding:5px;">' . $row1->total . '</td>
                    <td style="padding:5px;">' . $akumulasi . '</td>
                </tr>';
        }

        $data['table'] = $table;
        $html = $this->load->view('back/page/order_export', $data, TRUE);
        $this->mpdf->generate($html);
    }

    public function catatan()
    {
        $requestData = $this->input->post();

        $data['catatan'] = $requestData['catatan'];
        $this->db->where('no_pesanan', $requestData['no_pesanan']);
        $this->db->update('pesanan', $data);

        $output = array(
            'status' => 1,
            'message' => 'Catatan berhasil ditambahkan atau diubah'
        );

        echo json_encode($output);
    }
}
