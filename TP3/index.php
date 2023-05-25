<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Tipe.php');
include('classes/Seri.php');
include('classes/Hotwheels.php');
include('classes/Template.php');

// buat instance Hotwheels
$listHotwheels = new Hotwheels($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listHotwheels->open(); //-> function open berasal dari class DB.php (Karena kelas Hotwheels extends DB.php jadi bisa akses function nya juga)

// tampilkan data Hotwheels
$listHotwheels->getHotwheelsJoin(); //-> ini baru akses function dari kelas Hotwheels

// cari Hotwheels
if (isset($_POST['btn-cari'])) {
    // methode mencari data Hotwheels
    $listHotwheels->searchHotwheels($_POST['cari']);
} else {
    // method menampilkan data Hotwheels
    $listHotwheels->getHotwheelsJoin();
}

$data = null;

// ambil data Hotwheels
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listHotwheels->getResult()) {
    // pake concat biar datanya terus di copy sampe habis konsepnya mirip += 
    $data .= 
            '<div class="col gx-2 gy-3 justify-content-center">' .
                '<div class="card pt-4 px-2 hotwheels-thumbnail">
                    <a href="detail.php?id=' . $row['hotwheels_id'] . '">
                        <div class="row justify-content-center">
                            <img src="assets/gambar/' . $row['hotwheels_foto'] . '" class="card-img-top" alt="' . $row['hotwheels_foto'] . '">
                        </div>
                        <div class="card-body">
                            <p class="card-text hotwheels-nama my-0">' . $row['hotwheels_nama'] . '</p>
                            <p class="card-text tipe-nama">' . $row['tipe_nama'] . '</p>
                            <p class="card-text seri-nama my-0">' . $row['seri_nama'] . '</p>
                        </div>
                    </a>
                </div>    
            </div>';
}

// tutup koneksi
$listHotwheels->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_HOTWHEELS', $data);
$home->write();
