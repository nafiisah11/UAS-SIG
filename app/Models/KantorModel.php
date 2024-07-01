<?php
namespace App\Models;
use CodeIgniter\Model;
class KantorModel extends Model
{
    protected $table = 'kantor'; // nama tabel
    protected $primaryKey = 'kode_pos'; // primary key tabel
    protected $returnType = 'object';
    protected $useSoftDeletes = false;
    protected $useAutoIncrement = false;
    // nama semua field pada tabel
    protected $allowedFields =['kode_pos','kode_kecamatan','alamat_kantor','koordinat'];
    protected $skipValidation = true;
}

