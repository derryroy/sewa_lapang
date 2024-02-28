<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders_model extends CI_Model
{
    var $table1 = 'pesanan a';
    var $table2 = 'detail_pesanan b';
    var $table3 = 'user c';
    var $column_order = array('a.no_pesanan', 'a.nama_klub', 'c.nama', 'c.nama_klub', 'c.email', 'a.tanggal_pesanan');
    var $column_search = array('a.no_pesanan', 'a.nama_klub', 'c.nama', 'c.nama_klub', 'c.email');
    var $order = array('a.id_pesanan' => 'DESC');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query($requestData)
    {
        $this->db->select('a.id_pesanan,a.no_pesanan,a.nama_klub AS rnama_klub,c.nama,c.nama_klub,c.email,a.tanggal_pesanan,SUM(b.harga) AS total,a.status_pembayaran');
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'a.id_pesanan = b.id_pesanan', 'LEFT');
        $this->db->join($this->table3, 'a.id_user = c.id_user', 'LEFT');

        if ($requestData['type'] == 'date') {
            $this->db->where("date_format(a.tanggal_pesanan,'%Y-%m-%d') BETWEEN '" . $requestData['sdate'] . "' AND '" . $requestData['edate'] . "'");
        } elseif ($requestData['type'] == 'month') {
            $this->db->where("MONTH(a.tanggal_pesanan)", $requestData['month']);
            $this->db->where("YEAR(a.tanggal_pesanan)", $requestData['year']);
        } elseif ($requestData['type'] == 'year') {
            $this->db->where("YEAR(a.tanggal_pesanan)", $requestData['year']);
        }

        if ($requestData['status'] != 'all') {
            if ($requestData['status'] != '') {
                $this->db->where("a.status_pembayaran", $requestData['status']);
            } else {
                if ($requestData['search']['value'] == '') {
                    $this->db->where_in("a.status_pembayaran", array(0, 1, 2));
                }
            }
        }

        $this->db->group_by('a.id_pesanan');

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($requestData['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $requestData['search']['value']);
                } else {
                    $this->db->or_like($item, $requestData['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) {
                    $this->db->group_end();
                }
            }

            $i++;
        }

        if (isset($requestData['order'])) {
            $this->db->order_by($this->column_order[$requestData['order']['0']['column']], $requestData['order']['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($requestData)
    {
        $this->_get_datatables_query($requestData);
        if ($requestData['length'] != 1) {
            $this->db->limit($requestData['length'], $requestData['start']);
            $query = $this->db->get();
            return $query->result();
        }
    }

    function count_filtered($requestData)
    {
        $this->_get_datatables_query($requestData);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select('a.id_pesanan,a.no_pesanan,a.nama_klub AS rnama_klub,c.nama,c.nama_klub,c.email,a.tanggal_pesanan,SUM(b.harga) AS total,a.status_pembayaran');
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'a.id_pesanan = b.id_pesanan', 'LEFT');
        $this->db->join($this->table3, 'a.id_user = c.id_user', 'LEFT');
        $this->db->group_by('a.id_pesanan');
        return $this->db->count_all_results();
    }
}
