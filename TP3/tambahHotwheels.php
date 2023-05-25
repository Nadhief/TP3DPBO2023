<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Tipe.php');
include('classes/Seri.php');
include('classes/Hotwheels.php');
include('classes/Template.php');

// // buat instance template
$home = new Template('templates/skinform.html');

$dataTipe= null;
$tipe = new Tipe($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$tipe->open();
$tipe->getTipe();
// Looping untuk menampilkan data dalam tabel HTML
while ($row = $tipe->getResult()) {
    $dataTipe .= '<option value='. $row['tipe_id']. '>' . $row['tipe_nama'] . '</option>';
}
$tipe->close();

$dataSeri= null;
$seri= new Seri($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$seri->open();
$seri->getSeri();
// Looping untuk menampilkan data dalam tabel HTML
while ($row = $seri->getResult()) {
    $dataSeri .= '<option value='. $row['seri_id']. '>' . $row['seri_nama'] . '</option>';
}
$seri->close();


$hotwheels = new Hotwheels($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$hotwheels->open();

if(!isset($_GET['id'])){

    if (isset($_POST['submit'])) {
        if ($hotwheels->addHotwheels($_POST, $_FILES)>0) {
            echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'index.php';
        </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'index.php';
        </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Add';
}
$kocak = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($hotwheels->updateData($id, $_POST, $_FILES) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'index.php';
            </script>";
            }
        }

        $hotwheels->getHotwheelsById($id);
        $row = $hotwheels->getResult();

		$dataFoto = $row['hotwheels_foto'];
        $dataKode = $row['hotwheels_kode'];
        $dataNama = $row['hotwheels_nama'];

		$btn = 'Simpan';
        $title = 'Ubah';
        $kocak = '<a href="index.php"><button type="button" class="btn btn-danger text-white" name="sambit">Cancel</button></a>';


        $home->replace('DATA_VAL_UPDATE_FOTO', $dataFoto);
        $home->replace('DATA_VAL_UPDATE_KODE', $dataKode);
        $home->replace('DATA_VAL_UPDATE_NAMA', $dataNama);
    }
}

$hotwheels->close();



// // simpan data ke template
$home->replace('DAFTAR_TIPE', $dataTipe);
$home->replace('DAFTAR_SERI', $dataSeri);
$home->replace('DATA_BUTTON_HOTWHEELS', $btn);
$home->replace('DATA_TITLE', $title);
$home->replace('BUTTON_CANCEL', $kocak);
$home->write();
