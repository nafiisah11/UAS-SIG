<?php
// Memanggil tampilan header
echo view('header');

// Memanggil tampilan sidebar
echo view('sidebar');
?>

<main class="col-10 ms-sm-auto px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-itemscenter pt-3 pb-2">
        <h1 class="h4">Data Kantor</h1>
    </div>

    <?php
    // Menampilkan pesan setelah operasi tambah, edit, atau hapus
    if (!empty($msg)) {
        echo $msg;
    }
    ?>

    <div class="mb-3">
        <?php
        // Tombol untuk menuju ke halaman tambah kantor
        echo anchor('tambahkantor', '<i class="fa-solid fa-plus"></i>', ['class' => 'btn btn-primary']);
        ?>
    </div>

    <table class="table table-hover table-striped table-bordered">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Kecamatan</th>
                <th>Kode Pos</th>
                <th>Alamat Kantor</th>
                <th>Koordinat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            if (!empty($query)) {
                foreach ($query as $baris) {
            ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $baris->nama_kecamatan; ?></td>
                        <td><?php echo $baris->kode_pos; ?></td>
                        <td><?php echo $baris->alamat_kantor; ?></td>
                        <td><?php echo $baris->koordinat; ?></td>
                        <td>
                            <?php
                            // Tombol untuk mengedit dan menghapus kantor
                            echo anchor('editkantor/' . $baris->kode_pos, '<i class="fa-solid fa-pencil"></i>', ['class' => 'btn btn-success']) . ' ';
                            echo anchor('hapuskantor/' . $baris->kode_pos, '<i class="fa-solid fa-trash-can"></i>', ['class' => 'btn btn-danger']);
                            ?>
                        </td>
                    </tr>
                <?php
                }
            } else {
                ?>
                <tr>
                    <td class="text-center text-danger" colspan="9">
                        DATA TIDAK ADA
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>

<?php
// Memanggil tampilan footer
echo view('footer');
?>
