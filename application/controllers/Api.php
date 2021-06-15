<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization');
header('Access-Control-Allow-Credentials: true');
header('Content-Type: application/json');

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Model');
        $this->load->library('session');
        $this->db->query("SET sql_mode = '' ");
    }

    public function login_post()
    {
        $username = $this->post('username');
        $password = $this->post('password');

        if ($username === null || $password === null) {
            $this->response(['message' => 'Akses ditolak'], 504);
        }

        $this->db->select('level');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $cek = $this->db->get('tbl_user');

        if ($cek->num_rows() > 0) {
            $data = $cek->result()[0];
            $session = ['hasLogin' => true, 'level' => $data->level];
            $this->session->set_userdata($session);
            $this->response(['error' => false, 'message' => "Anda berhasil login", 'level' => $data->level], 200);
        }

        $this->response(['error' => true, 'message' => 'Username atau password salah'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function penduduk_get()
    {
        $data = $this->db->get('tbl_penduduk')->result();

        $this->response($data, 200);
    }
    public function penduduk_post()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $val;
        }

        // Cek NIK
        $cek = $this->Model->getTotalData('tbl_penduduk', ['nik' => $data['nik']], 'nik');

        if ($cek > 0) {
            $this->response(['error' => true, 'message' => 'NIK telah terdaftar'], 202);
        }

        $simpan = $this->db->insert('tbl_penduduk', $data);

        if ($simpan) {
            $this->response(['error' => false, 'message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updatePenduduk_post()
    {
        foreach ($_POST as $key => $val) {
            if ($key !== 'where') {
                $data[$key] = $val;
            }
        }

        $where = $this->post('where');

        if ($data['nik'] !== $where) {
            // Cek NIK
            $cek = $this->Model->getTotalData('tbl_penduduk', ['nik' => $data['nik']], 'nik');

            if ($cek > 0) {
                $this->response(['error' => true, 'message' => 'NIK telah terdaftar'], 202);
            }
        }

        $update = $this->db->update('tbl_penduduk', $data, ['nik' => $where]);

        if ($update) {
            $this->response(['error' => false, 'message' => 'Data berhasil diubah', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diubah'], 200);
    }
    public function deletePenduduk_post()
    {
        $data = implode(', ', $this->post('listNIK'));

        $hapus = $this->db->delete('tbl_penduduk', "nik in ($data)");

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function kk_get()
    {
        $kk = $this->get('kk');
        $get = $this->get('get');
        if ($get === null && $kk !== null) {
            $this->db->select('b.nama ayah, c.nama ibu');
            $this->db->join('tbl_penduduk b', 'a.kepala_keluarga = b.nik', 'left');
            $this->db->join('tbl_penduduk c', 'a.istri = c.nik', 'left');
            $data = $this->db->get_where('tbl_kk a', ['kk' => $kk])->result()[0];

            $this->response($data, 200);
        }

        if ($get !== null && $get == 'kk_only') {
            $this->db->select('kk');
            $data = $this->db->get('tbl_kk')->result();

            $this->response($data, 200);
        }

        $this->db->select('a.kk, a.kepala_keluarga, a.istri, a.anak, b.nama nama_kepala, c.nama nama_istri');
        $this->db->join('tbl_penduduk b', 'a.kepala_keluarga = b.nik', 'left');
        $this->db->join('tbl_penduduk c', 'a.istri = c.nik', 'left');
        if ($get !== null && $get == 'all' && $kk !== null) {
            $this->db->where('kk', $kk);
        }
        $get = $this->db->get('tbl_kk a')->result();

        $data = array_map(function ($v) {
            $v->anak = $this->Model->createDataAnak($v->anak);
            return $v;
        }, $get);

        $this->response($data, 200);
    }
    public function kk_post()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $val;
        }

        // Cek KK
        $cek = $this->Model->getTotalData('tbl_kk', ['kk' => $data['kk']], 'kk');

        if ($cek > 0) {
            $this->response(['error' => true, 'message' => 'Nomor KK telah terdaftar'], 202);
        }

        $simpan = $this->db->insert('tbl_kk', $data);

        if ($simpan) {
            $data['anak'] = $this->Model->createDataAnak($data['anak']);

            $this->response(['error' => false, 'message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updateKK_post()
    {
        foreach ($_POST as $key => $val) {
            if ($key !== 'where') {
                $data[$key] = $val;
            }
        }

        $where = $this->post('where');

        $update = $this->db->update('tbl_kk', $data, ['kk' => $where]);

        if ($update) {
            $data['anak'] = $this->Model->createDataAnak($data['anak']);

            $this->response(['error' => false, 'message' => 'Data berhasil diubah', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diubah'], 200);
    }
    public function deleteKK_post()
    {
        $data = implode(', ', $this->post('listKK'));

        $hapus = $this->db->delete('tbl_kk', "kk in ($data)");

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function nik_get()
    {
        $get = $this->get('get');

        if ($get == 'list') {
            $this->db->select('nik, nama');
            $data = $this->db->get('tbl_penduduk')->result();

            $this->response($data, 200);
        }

        $this->db->select('nik, nama, jenis_kelamin, status');
        $get = $this->db->get('tbl_penduduk')->result();

        $data = ['dataSuami' => [], 'dataIstri' => [], 'dataAnak' => []];

        array_map(function ($v) use (&$data) {
            if ($v->jenis_kelamin == 'Laki-laki' && $v->status != 'Belum Kawin') {
                unset($v->jenis_kelamin);
                unset($v->status);
                $data['dataSuami'][] = $v;
                return;
            }
            if ($v->jenis_kelamin == 'Perempuan' && $v->status != 'Belum Kawin') {
                unset($v->jenis_kelamin);
                unset($v->status);
                $data['dataIstri'][] = $v;
                return;
            }
            if ($v->status == 'Belum Kawin') {
                unset($v->jenis_kelamin);
                unset($v->status);
                $data['dataAnak'][] = $v;
                return;
            }
        }, $get);

        $this->response($data, 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function kelahiran_get()
    {
        $this->db->select('a.id, a.kk, a.nama, a.jenis_kelamin, a.tempat_lahir, a.tanggal_lahir, c.nama ayah, d.nama ibu');
        $this->db->join('tbl_kk b', 'a.kk = b.kk', 'left');
        $this->db->join('tbl_penduduk c', 'b.kepala_keluarga = c.nik', 'left');
        $this->db->join('tbl_penduduk d', 'b.istri = d.nik', 'left');
        $data = $this->db->get('tbl_kelahiran a')->result();

        $this->response($data, 200);
    }
    public function kelahiran_post()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $val;
        }

        // Genereate ID
        $data['id'] = '_' . $this->Model->getRandomStr('9');

        $simpan = $this->db->insert('tbl_kelahiran', $data);

        if ($simpan) {
            $this->response(['error' => false, 'message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updateKelahiran_post()
    {
        foreach ($_POST as $key => $val) {
            if ($key !== 'where') {
                $data[$key] = $val;
            }
        }

        $id = $this->post('where');

        $update = $this->db->update('tbl_kelahiran', $data, ['id' => $id]);

        if ($update) {
            $this->response(['error' => false, 'message' => 'Data berhasil diubah', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diubah'], 200);
    }
    public function deleteKelahiran_post()
    {
        $data = implode("', '", $this->post('list'));

        $hapus = $this->db->delete('tbl_kelahiran', "id in ('$data')");

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function kematian_get()
    {
        $this->db->select('a.*, b.nama');
        $this->db->join('tbl_penduduk b', 'a.nik = b.nik', 'left');
        $data = $this->db->get('tbl_kematian a')->result();

        $this->response($data, 200);
    }
    public function kematian_post()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $val;
        }

        // Cek KK
        $cek = $this->Model->getTotalData('tbl_kematian', ['nik' => $data['nik']], 'nik');

        if ($cek > 0) {
            $this->response(['error' => true, 'message' => 'NIK telah terdaftar'], 202);
        }

        $simpan = $this->db->insert('tbl_kematian', $data);

        if ($simpan) {
            $this->response(['error' => false, 'message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updateKematian_post()
    {
        foreach ($_POST as $key => $val) {
            if ($key !== 'where') {
                $data[$key] = $val;
            }
        }

        $nik = $this->post('where');

        $update = $this->db->update('tbl_kematian', $data, ['nik' => $nik]);

        if ($update) {
            $this->response(['error' => false, 'message' => 'Data berhasil diubah', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diubah'], 200);
    }
    public function deleteKematian_post()
    {
        $data = implode("', '", $this->post('list'));

        $hapus = $this->db->delete('tbl_kematian', "nik in ('$data')");

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function pendatang_get()
    {
        $this->db->select('a.*, b.nama');
        $this->db->join('tbl_penduduk b', 'a.nik = b.nik', 'left');
        $data = $this->db->get('tbl_pendatang a')->result();

        $this->response($data, 200);
    }
    public function pendatang_post()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $val;
        }

        // Cek KK
        $cek = $this->Model->getTotalData('tbl_pendatang', ['nik' => $data['nik']], 'nik');

        if ($cek > 0) {
            $this->response(['error' => true, 'message' => 'NIK telah terdaftar'], 202);
        }

        $simpan = $this->db->insert('tbl_pendatang', $data);

        if ($simpan) {
            $this->response(['error' => false, 'message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updatePendatang_post()
    {
        foreach ($_POST as $key => $val) {
            if ($key !== 'where') {
                $data[$key] = $val;
            }
        }

        $nik = $this->post('where');

        $update = $this->db->update('tbl_pendatang', $data, ['nik' => $nik]);

        if ($update) {
            $this->response(['error' => false, 'message' => 'Data berhasil diubah', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diubah'], 200);
    }
    public function deletePendatang_post()
    {
        $data = implode("', '", $this->post('list'));

        $hapus = $this->db->delete('tbl_pendatang', "nik in ('$data')");

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function pindah_get()
    {
        $this->db->select('a.*, b.nama');
        $this->db->join('tbl_penduduk b', 'a.nik = b.nik', 'left');
        $data = $this->db->get('tbl_pindah a')->result();

        $this->response($data, 200);
    }
    public function pindah_post()
    {
        foreach ($_POST as $key => $val) {
            $data[$key] = $val;
        }

        // Cek KK
        $cek = $this->Model->getTotalData('tbl_pindah', ['nik' => $data['nik']], 'nik');

        if ($cek > 0) {
            $this->response(['error' => true, 'message' => 'NIK telah terdaftar'], 202);
        }

        $simpan = $this->db->insert('tbl_pindah', $data);

        if ($simpan) {
            $this->response(['error' => false, 'message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updatePindah_post()
    {
        foreach ($_POST as $key => $val) {
            if ($key !== 'where') {
                $data[$key] = $val;
            }
        }

        $nik = $this->post('where');

        $update = $this->db->update('tbl_pindah', $data, ['nik' => $nik]);

        if ($update) {
            $this->response(['error' => false, 'message' => 'Data berhasil diubah', 'data' => $data], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diubah'], 200);
    }
    public function deletePindah_post()
    {
        $data = implode("', '", $this->post('list'));

        $hapus = $this->db->delete('tbl_pindah', "nik in ('$data')");

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function geolokasi_get()
    {
        $data = $this->db->get('tbl_lokasi')->result();

        $this->response($data, 200);
    }
    public function geolokasi_post()
    {
        $kk = $this->post('kk');
        $latitude = $this->post('latitude');
        $longitude = $this->post('longitude');

        // Cek KK
        $cek = $this->Model->getTotalData('tbl_lokasi', ['kk' => $kk], 'kk');

        if ($cek > 0) {
            $this->response(['error' => true, 'message' => 'KK telah terdaftar sebelumnya'], 202);
        }

        $simpan = $this->db->insert('tbl_lokasi', ['kk' => $kk, 'latitude' => $latitude, 'longitude' => $longitude]);

        if ($simpan) {
            $this->response(['error' => false, 'message' => 'Data berhasil disimpan'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal disimpan'], 200);
    }
    public function updateGeolokasi_post()
    {
        $kk = $this->post('kk');
        $latitude = $this->post('latitude');
        $longitude = $this->post('longitude');


        $update = $this->db->update('tbl_lokasi', ['latitude' => $latitude, 'longitude' => $longitude], ['kk' => $kk]);

        if ($update) {
            $this->response(['error' => false, 'message' => 'Data berhasil diupdate'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal diupdate'], 200);
    }
    public function deleteGeolokasi_post()
    {
        $kk = $this->post('kk');

        $hapus = $this->db->delete('tbl_lokasi', ['kk' => $kk]);

        if ($hapus) {
            $this->response(['error' => false, 'message' => 'Data berhasil dihapus'], 200);
        }
        $this->response(['error' => true, 'message' => 'Data gagal dihapus'], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
    public function validator_get()
    {
        $validator = $this->get('validator');
        $default = $this->get('default');

        $kk = $this->get('kk');

        if ($validator == 'kk' && $kk !== null) {
            if ($default == $kk) {
                $this->response(['valid' => true], 200);
            }
            $cek = $this->Model->getTotalData('tbl_kk', ['kk' => $kk], 'kk');

            $this->response(['valid' => !$cek], 200);
        }

        $kepala_keluarga = $this->get('kepala_keluarga');

        if ($validator == 'kepala_keluarga' && $kepala_keluarga !== null) {
            if ($default == $kepala_keluarga) {
                $this->response(['valid' => true], 200);
            }
            $cek = $this->Model->getTotalData('tbl_kk', ['kepala_keluarga' => $kepala_keluarga], 'kepala_keluarga');
            $this->response(['valid' => !$cek], 200);
        }

        $istri = $this->get('istri');

        if ($validator == 'istri' && $istri !== null) {
            if ($default == $istri) {
                $this->response(['valid' => true], 200);
            }
            $cek = $this->Model->getTotalData('tbl_kk', ['istri' => $istri], 'istri');
            $this->response(['valid' => !$cek], 200);
        }

        $anak = $this->get('anak');

        if ($validator == 'anak' && $anak !== null) {
            if ($default == $anak) {
                $this->response(['valid' => true], 200);
            }

            $this->db->select('kk');
            foreach ($anak as $val) {
                $this->db->or_where("JSON_SEARCH(anak, 'one', '{$val}') IS NOT NULL");
            }
            $cek = $this->db->get('tbl_kk');

            if ($cek->num_rows() > 0 && $cek->result()[0]->kk == $kk) {
                $this->response(['valid' => true], 200);
            }
            $this->response(['valid' => !$cek->num_rows()], 200);
        }

        $nik = $this->get('nik');

        if ($validator == 'kematian' && $nik !== null) {
            if ($default == $nik) {
                $this->response(['valid' => true], 200);
            }
            $cek = $this->Model->getTotalData('tbl_kematian', ['nik' => $nik], 'nik');
            $this->response(['valid' => !$cek], 200);
        }

        if ($validator == 'pendatang' && $nik !== null) {
            if ($default == $nik) {
                $this->response(['valid' => true], 200);
            }
            $cek = $this->Model->getTotalData('tbl_pendatang', ['nik' => $nik], 'nik');
            $this->response(['valid' => !$cek], 200);
        }

        if ($validator == 'pindah' && $nik !== null) {
            if ($default == $nik) {
                $this->response(['valid' => true], 200);
            }
            $cek = $this->Model->getTotalData('tbl_pindah', ['nik' => $nik], 'nik');
            $this->response(['valid' => !$cek], 200);
        }

        if ($validator == 'geolokasi' && $kk !== null) {
            $cek = $this->Model->getTotalData('tbl_lokasi', ['kk' => $kk], 'kk');
            $this->response(['valid' => !$cek], 200);
        }

        $this->response(['valid' => true], 200);
    }
    // --------------------------------------------------------------------------------------------------------------------------
}
