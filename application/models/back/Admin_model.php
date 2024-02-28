<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    var $table = 'admin';
    var $column_order = array(null, 'nama', 'email', 'tanggal', null);
    var $column_search = array('nama', 'email');
    var $order = array('id_admin' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }

    private function _get_datatables_query($requestData)
    {
        $this->db->from($this->table);
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
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}
