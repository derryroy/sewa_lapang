<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    var $table1 = 'pesanan a';
    var $table2 = 'detail_pesanan b';
    var $table3 = 'user c';
    var $column_order = array('a.no_pesanan');
    var $column_search = array('a.no_pesanan');
    var $order = array('a.id_pesanan' => 'DESC');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query($requestData)
    {
        $this->db->select('a.id_pesanan,a.no_pesanan,a.status_pembayaran,SUM(b.harga) as total,a.catatan');
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'a.id_pesanan = b.id_pesanan', 'LEFT');
        $this->db->join($this->table3, 'a.id_user = c.id_user', 'LEFT');
        $this->db->where('c.id_user', $this->session->userdata('user_id'));
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
        $this->db->select('a.id_pesanan,a.no_pesanan,a.status_pembayaran,SUM(b.harga) as total,a.catatan');
        $this->db->from($this->table1);
        $this->db->join($this->table2, 'a.id_pesanan = b.id_pesanan', 'LEFT');
        $this->db->join($this->table3, 'a.id_user = c.id_user', 'LEFT');
        $this->db->where('c.id_user', $this->session->userdata('user_id'));
        $this->db->group_by('a.id_pesanan');
        $this->db->order_by('a.id_pesanan', 'DESC');
        return $this->db->count_all_results();
    }
}
