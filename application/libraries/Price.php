<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Price
{

    public function __construct()
    {
        $this->CI = &get_instance();
    }

    public function price_court($date, $sesi)
    {
        $res = $this->CI->db->get('harga_sewa');
        $harga = [];

        if ($res->num_rows() > 0) {
            foreach ($res->result() as $value) {
                array_push($harga, $value->harga_sewa);
            }
        }

        $day = date('w', strtotime($date));

        if ($day == 1 || $day == 2 || $day == 3 || $day == 4 || $day == 5) {
            if ($sesi == 1 || $sesi == 2 || $sesi == 3 || $sesi == 4) {
                $price = $harga[0];
            }

            if ($sesi == 5 || $sesi == 6) {
                $price = $harga[1];
            }

            if ($sesi == 7 || $sesi == 8) {
                $price = $harga[2];
            }
        } elseif ($day == 0 || $day == 6) {
            $price = $harga[3];
        }

        return intval($price);
    }

    public function list_disc_member($table, $filed, $id)
    {
        $res = $this->CI->db->get_where($table, array($filed => $id))->result();
        $disc_member = [];

        foreach ($res as $row) {
            $day = date('w', strtotime($row->tanggal));
            array_push($disc_member, $day . ':' . $row->sesi . ':' . $row->harga);
        }

        $jml_book = 0;
        $disc_member_2 = [];

        foreach (array_count_values($disc_member) as $key => $val) {
            $jml_book += $val;

            $ds = explode(':', $key);
            $no = 0;
            $d = '';
            $count_disc = 0;

            foreach ($res as $row) {
                $day = date('w', strtotime($row->tanggal));

                if ($ds[0] == $day) {
                    if ($ds[1] == $row->sesi) {
                        $no++;

                        if ($no == 1) {
                            $d = $row->tanggal;
                        } else {
                            $d = new DateTime($d);
                            $d->modify('+7 day');
                            $d = $d->format('Y-m-d');
                        }

                        if ($d == $row->tanggal) {
                            $count_disc++;
                        }
                    }
                }
            }

            $data['day'] = $ds[0];
            $data['sesi'] = $ds[1];
            $data['price'] = $ds[2];
            $data['count'] = $count_disc;

            $disc_member_2[] = $data;
        }

        $output = array(
            'disc_member_2' => $disc_member_2,
            'jml_book' => $jml_book
        );

        return $output;
    }

    public function price_member($table, $filed, $id)
    {
        $res = $this->CI->db->get('harga_diskon');
        $diskon = [];

        if ($res->num_rows() > 0) {
            foreach ($res->result() as $value) {
                array_push($diskon, $value->harga_diskon);
            }
        }

        $data_res = $this->list_disc_member($table, $filed, $id);

        $discount = 0;

        foreach ($data_res['disc_member_2'] as $val) {
            $disc = 0;

            if ($val['day'] == 1 || $val['day'] == 2 || $val['day'] == 3 || $val['day'] == 4 || $val['day'] == 5) {
                if ($val['sesi'] == 1 || $val['sesi'] == 2 || $val['sesi'] == 3 || $val['sesi'] == 4) {
                    $disc = $diskon[0];
                } elseif ($val['sesi'] == 5 || $val['sesi'] == 6) {
                    $disc = $diskon[1];
                } elseif ($val['sesi'] == 7 || $val['sesi'] == 8) {
                    $disc = $diskon[2];
                }
            } else {
                $disc = $diskon[3];
            }

            for ($i = 1; $i <= $val['count']; $i++) {
                if ($i % 4 == 0) {
                    $discount += 4 * $disc;
                }
            }
        }

        return $discount;
    }

    public function price_event($date)
    {
        $res = $this->CI->db->get('harga_event');
        $harga = [];

        if ($res->num_rows() > 0) {
            foreach ($res->result() as $value) {
                array_push($harga, $value->harga_event);
            }
        }

        $day = date('w', strtotime($date));

        if ($day == 0 || $day == 6) {
            $price = $harga[1];
        } else {
            $price = $harga[0];
        }

        return $price;
    }
}
