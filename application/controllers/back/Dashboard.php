<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $jam = ['06.00 - 08.00', '08.00 - 10.00', '10.00 - 12.00', '12.00 - 14.00', '14.00 - 16.00', '16.00 - 18.00', '18.00 - 20.00', '20.00 - 22.00'];

            $page_data['page_name'] = 'dashboard';
            $page_data['dataJam'] = $jam;
            $this->load->view('back/index', $page_data);
        } else {
            redirect(base_url() . 'admin');
        }
    }

    public function getDataBooking()
    {
        $sdate = $this->input->post('sdate');
        $edate = $this->input->post('edate');

        $this->db->select('a.nama_klub AS rnama_klub,c.nama,c.nama_klub,b.tanggal,b.sesi,a.status_pembayaran');
        $this->db->from('pesanan a');
        $this->db->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan');
        $this->db->join('user c', 'a.id_user=c.id_user', 'LEFT');
        $this->db->where("b.tanggal BETWEEN '" . $sdate . "' AND '" . $edate . "' AND (a.status_pembayaran IN (0,1,2))");
        $this->db->order_by('b.tanggal', 'ASC');
        $res = $this->db->get()->result();

        $day = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        $jam = ['06.00&minus;08.00', '08.00&minus;10.00', '10.00&minus;12.00', '12.00&minus;14.00', '14.00&minus;16.00', '16.00&minus;18.00', '18.00&minus;20.00', '20.00&minus;22.00'];

        $table = '
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="col-sm-1 text-center align-middle">Hari <br> Jam</th>';

        for ($i = new DateTime($sdate); $i <= new DateTime($edate); $i->modify('+1 day')) {
            $table .= '<th class="text-center" style="width:12.5%;">' . $day[$i->format('w')] . '<br>' . $i->format('d-m-Y') . '</th>';
        }

        $table .= '</tr>
            </thead>';

        $table .= '
            <tbody>';

        for ($i = 0; $i < 8; $i++) {
            $table .= '<tr>';
            $table .= '<td class="text-center align-middle">' . $jam[$i] . '</td>';

            for ($j = new DateTime($sdate); $j <= new DateTime($edate); $j->modify('+1 day')) {
                $clubname = '';

                foreach ($res as $val) {
                    if ($val->tanggal == $j->format('Y-m-d') && ($val->sesi - 1) == $i) {
                        if ($val->rnama_klub != null) {
                            $clubname = $val->rnama_klub;
                        } elseif ($val->nama_klub != null) {
                            $clubname = $val->nama_klub;
                        } else {
                            $clubname = $val->nama;
                        }

                        if ($val->status_pembayaran == 0) {
                            $clubname = '<span class="table-warning">BOOKED by ' . $clubname . '</span>';
                        }
                    }
                }

                $table .= '<td class="text-center align-middle">' . $clubname . '</td>';
            }

            $table .= '</tr>';
        }

        $table .= '
            </tbody>';

        $table .= '
        </table>';

        echo $table;
    }

    public function get_data_calendar()
    {
        $date_now = $this->input->post('date_now');

        $this->db->select('b.tanggal as date');
        $this->db->from('pesanan a');
        $this->db->join('detail_pesanan b', 'a.id_pesanan=b.id_pesanan', 'LEFT');
        $this->db->join('user c', 'a.id_user=c.id_user', 'LEFT');
        $this->db->join('admin d', 'a.id_admin=d.id_admin', 'LEFT');
        $this->db->where('a.status_pembayaran IN(2)');
        $this->db->where("b.tanggal >= '" . $date_now . "'");
        $this->db->group_by('b.tanggal');
        $res = $this->db->get()->result();
        echo json_encode($res);
    }
}
