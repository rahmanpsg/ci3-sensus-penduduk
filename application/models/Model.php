<?php

class Model extends CI_Model
{

    public function getPage($url, $i = 1)
    {
        $cek = function ($val) use ($i) {
            $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
            $numSegments = count($segments);

            if ($numSegments > 1) {
                $currentSegment = $segments[$numSegments - $i];
            } else {
                $currentSegment = $segments[$numSegments - 1];
            }

            $classActive = $val == $currentSegment ? 'active' : '';

            return $classActive;
        };

        if (is_array($url)) {
            foreach ($url as $val) {
                $arr[] = $cek($val);
            }

            return in_array('active', $arr) ? 'active' : '';
        }

        return $cek($url);
    }

    function getTotalData($tbl, $where = [], $key = '*')
    {
        $this->db->select("count($key) as total");
        if (count($where) > 0) {
            $this->db->where($where);
        }
        $res = $this->db->get($tbl);
        return $res->result_array()[0]['total'];
    }

    function deletePendudukByKematian($nik)
    {
        $this->db->select("kk, kepala_keluarga, istri, anak");
        $this->db->select("CASE 
                            WHEN kepala_keluarga = $nik THEN 'kepala_keluarga' 
                            WHEN istri = $nik THEN 'istri'
                            WHEN JSON_SEARCH(anak, 'one', '{$nik}') IS NOT NULL THEN 'anak'
                            END as status");
        $this->db->where('kepala_keluarga', $nik);
        $this->db->or_where('istri', $nik);
        $this->db->or_where("JSON_SEARCH(anak, 'one', '{$nik}') IS NOT NULL");
        $this->db->limit('1');
        $data = $this->db->get('tbl_kk')->result()[0];

        if ($data->status == null) {
            return false;
        }

        if ($data->status == 'anak') {
            $arrAnak = json_decode($data->anak);
            $newArrAnak = array_filter($arrAnak, function ($v) use ($nik) {
                return $v != $nik;
            });

            $data->anak = json_encode(array_values($newArrAnak));
        } else {
            $data->{$data->status} = null;
        }

        unset($data->status);

        // update data
        $this->db->where('kk', $data->kk);
        $update = $this->db->update('tbl_kk', $data);

        return $update;
    }

    function createDataAnak($data)
    {
        $arr = [];
        foreach (json_decode($data) as $val) {
            $this->db->select('nama');
            $nama = $this->db->get_where('tbl_penduduk', ['nik' => $val])->result()[0]->nama;
            $arr[] = ['nik' => $val, 'nama' => $nama];
        }

        return $arr;
    }

    function delete_files($target)
    {
        if (is_dir($target)) {
            $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned

            foreach ($files as $file) {
                $this->delete_files($file);
            }

            rmdir($target);
        } elseif (is_file($target)) {
            unlink($target);
        }
    }

    function cekRow($table, $val, $panjang)
    {
        $query = "SELECT * FROM $table";
        $row = $this->db->query($query)->num_rows() + 1;

        do {
            $no = str_pad($row, $panjang, '0', STR_PAD_LEFT);
            $id = $val . '-' . $no;
            $cek = "SELECT * FROM $table where id = '$id'";
            $query_cek = $this->db->query($cek)->num_rows();
            $row++;
        } while ($query_cek > 0);
        return $id;
    }

    function getWaktu()
    {
        date_default_timezone_set('Asia/Makassar');
        $waktu = date('Y-m-d H:i:s');

        return $waktu;
    }
    function getRandomStr($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    function getRandomNumber($digits)
    {
        $min = pow(10, $digits - 1);
        $max = pow(10, $digits) - 1;
        return mt_rand($min, $max);
    }
}
