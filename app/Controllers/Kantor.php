<?php

namespace App\Controllers;

use App\Models\KecamatanModel;
use App\Models\KantorModel;

class Kantor extends BaseController {
    
    // Method index yang memanggil method tampil
    public function index() {
        $this->tampil();
    }

    // Method untuk menampilkan data kantor
    public function tampil() {
        $kantor = new KantorModel();
        // Mengambil semua data di tabel kantor dan kecamatan menggunakan JOIN
        $data['query'] = $kantor->join('kecamatan', 'kecamatan.kode_kecamatan = kantor.kode_kecamatan')->findAll();
        // Mengambil nilai variabel msg pada session flashdata
        $data['msg'] = session()->getFlashdata('msg');
        // Memanggil file view tampil
        echo view('kantor/tampil', $data);
    }

    // Method untuk menampilkan form tambah kantor
    public function tambah() {
        $kecamatan = new KecamatanModel();
        $kecamatan = $kecamatan->findAll();
        $kecamatanOptions = array();
        // Mempersiapkan variabel array
        $kecamatanOptions[''] = 'belum dipilih';
        // Perulangan untuk menghasilkan option value di dropdown kecamatan
        foreach ($kecamatan as $row) {
            $kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
        }
        // Variabel untuk list dropdown kecamatan
        $data['kecamatanOptions'] = $kecamatanOptions;
        // Memanggil view form tambah
        return view('kantor/tambah', $data);
    }

    // Method untuk menampilkan form edit kantor
    public function edit($kode_pos) {
        $kecamatan = new KecamatanModel();
        $kecamatan = $kecamatan->findAll();
        $kecamatanOptions = array();
        $kecamatanOptions[''] = 'belum dipilih';
        foreach ($kecamatan as $row) {
            $kecamatanOptions[$row->kode_kecamatan] = strtoupper($row->nama_kecamatan);
        }
        $data['kecamatanOptions'] = $kecamatanOptions;

        $kantor = new kantorModel();
        // Mengambil data kantor sesuai nilai pada $kode_pos
        $data['query'] = $kantor->find($kode_pos);
        // Mengirimkan id yang berisi nilai $kode_pos sebagai acuan untuk update data di method update()
        $data['id'] = $kode_pos;
        return view('kantor/edit', $data);
    }

    // Method untuk menyimpan data kantor baru
    public function simpan() {
        $kantor = new KantorModel();
        // Mengambil data dari masing-masing input pada form tambah
        // dan disimpan pada array untuk disimpan ke tabel kantor
        $data_kantor = [
            'kode_pos' => $this->request->getVar('kode_pos'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'alamat_kantor' => $this->request->getVar('alamat_kantor'),
            'koordinat' => $this->request->getVar('koordinat')
        ];
        // Menggunakan query builder insert untuk menyimpan ke tabel kantor
        $kantor->insert($data_kantor);
        // Method affectedRows() mengembalikan nilai 1 jika insert berhasil, nilai 0 jika gagal
        if ($kantor->affectedRows() > 0) {
            // Persiapkan pesan jika insert berhasil
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            // Persiapkan pesan jika insert gagal
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        // Mengirimkan nilai msg melalui flashdata (session sekali pakai)
        session()->setFlashdata('msg', $msg);
        // Memanggil index pada controller kantor agar setelah simpan, tampilan kembali ke tabel CRUD
        return redirect()->to('kantor');
    }

    // Method untuk mengupdate data kantor
    public function update() {
        $kantor = new KantorModel();
        // Mengambil input hidden id dari form edit
        $id = $this->request->getVar('id');
        $data_kantor = [
            'kode_pos' => $this->request->getVar('kode_pos'),
            'kode_kecamatan' => $this->request->getVar('kode_kecamatan'),
            'alamat_kantor' => $this->request->getVar('alamat_kantor'),
            'koordinat' => $this->request->getVar('koordinat')
        ];
        // Menggunakan query builder update untuk mengubah data di tabel kantor berdasarkan id (kode_pos)
        $kantor->update($id, $data_kantor);
        if ($kantor->affectedRows() > 0) {
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil disimpan!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('kantor');
    }

    // Method untuk menghapus data kantor
    public function hapus($kode_pos) {
        $kantor = new KantorModel();
        // Menggunakan query builder delete untuk menghapus data di tabel kantor sesuai kode_pos
        $kantor->delete(['kode_pos' => $kode_pos]);
        if ($kantor->affectedRows() > 0) {
            $msg = '<div class="alert alert-primary" role="alert">Data berhasil dihapus!</div>';
        } else {
            $msg = '<div class="alert alert-danger" role="alert">Data gagal dihapus!</div>';
        }
        session()->setFlashdata('msg', $msg);
        return redirect()->to('kantor');
    }
}
?>
