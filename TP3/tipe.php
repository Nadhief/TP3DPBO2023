<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Tipe.php');
include('classes/Template.php');

$tipe = new Tipe($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$tipe->open();
$tipe->gettipe();

if (isset($_POST['btn-cari'])) {
    // methode mencari data tipe
    $tipe->searchTipe($_POST['cari']);
} else {
    // method menampilkan data tipe
    $tipe->getTipe();
}
$view = new Template('templates/skintabel.html');

// cari tipe


$mainTitle = 'tipe';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama tipe</th>
<th scope="row">Aksi</th>
</tr>';

$data = null;
$no = 1;
$formLabel = 'tipe';
$kocak ='';

while ($type = $tipe->getResult()) {
    $data .= 
    '<tr>
        <th scope="row">' . $no . '</th>
        <td>' . $type['tipe_nama'] . '</td>
        <td style="font-size: 22px;">
            <a href="tipe.php?id=' . $type['tipe_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
            <a href="tipe.php?hapus=' . $type['tipe_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>    
        </td>
    </tr>';
    $no++;
}

if(!isset($_GET['id'])){

    if (isset($_POST['submit'])) {
        if ($tipe->addTipe($_POST)>0) {
            echo "<script>
            alert('Data berhasil ditambah!');
            document.location.href = 'tipe.php';
        </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambah!');
            document.location.href = 'tipe.php';
        </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Add';
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($tipe->updateTipe($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'tipe.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'tipe.php';
            </script>";
            }
        }

        $tipe->getTipeById($id);
        $row = $tipe->getResult();

        $dataUpdate = $row['tipe_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';
        $kocak = '<a href="tipe.php"><button type="button" class="btn btn-danger text-white" name="sambit">Cancel</button></a>';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($tipe->deleteTipe($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'tipe.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'tipe.php';
            </script>";
        }
    }
}



$tipe->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('BUTTON_CANCEL', $kocak);
$view->replace('DATA_TABEL', $data);
$view->write();
