<?php
// Memanggil tampilan header
echo view('header');

// Memanggil tampilan sidebar
echo view('sidebar');
?>

<main class="col-10 ms-sm-auto px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2">
        <h1 class="h4">Edit Data Kantor</h1>
    </div>
    
    <?php
    // Membuka form untuk update data kantor
    echo form_open('updatekantor');
    ?>
    
    <div class="row">
        <div class="col-4">
            <div class="mb-3">
                <label class="form-label">Kecamatan</label>
                <?php
                // Menyembunyikan input id
                echo form_hidden('id', $id);
                
                // Dropdown untuk memilih kecamatan
                echo form_dropdown('kode_kecamatan', $kecamatanOptions, $query->kode_kecamatan, 'class="form-control"');
                ?>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Kode Pos</label>
                <?php
                // Input untuk Kode Pos
                $kode_pos = [
                    'name' => 'kode_pos',
                    'type' => 'number',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Kode Pos',
                    'required' => 'required',
                    'value' => $query->kode_pos
                ];
                echo form_input($kode_pos);
                ?>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Alamat Kantor</label>
                <?php
                // Input untuk alamat kantor
                $alamat_kantor = [
                    'name' => 'alamat_kantor',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Masukkan Alamat Kantor',
                    'required' => 'required',
                    'value' => $query->alamat_kantor
                ];
                echo form_input($alamat_kantor);
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Koordinat Kantor</label>
                <?php
                // Input untuk koordinat kantor
                $koordinat = [
                    'name' => 'koordinat',
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'placeholder' => 'Contoh : -7.5134,109.0702',
                    'required' => 'required',
                    'value' => $query->koordinat
                ];
                echo form_input($koordinat);
                ?>
            </div>
            
            <div>
                <?php
                // Tombol untuk menyimpan perubahan
                $simpan = [
                    'type' => 'submit',
                    'content' => 'Simpan',
                    'class' => 'btn btn-primary'
                ];
                echo form_button($simpan);
                
                // Tombol untuk membatalkan perubahan
                echo anchor('kantor', 'Batal', ['class' => 'btn btn-danger']);
                ?>
            </div>
        </div>
    </div>
    
    <?php
    // Menutup form
    echo form_close();
    ?>
</main>

<?php
// Memanggil tampilan footer
echo view('footer');
?>
