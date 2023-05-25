<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Seri.php');
include('classes/Template.php');

$seri = new Seri($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$seri->open();
$seri->getSeri();

$view = new Template('templates/skintabel.html');

$mainTitle = 'Seri';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama seri</th>
<th scope="row">Aksi</th>
</tr>';

$data = null;
$no = 1;
$formLabel = 'seri';
$kocak = '';

while ($Jab = $seri->getResult()) {
    $data .= 
    '<tr>
        <th scope="row">' . $no . '</th>
        <td>' . $Jab['seri_nama'] . '</td>
        <td style="font-size: 22px;">
            <a href="seri.php?id=' . $Jab['seri_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;
            <a href="seri.php?hapus=' . $Jab['seri_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($seri->addSeri($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'seri.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'seri.php';
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
            if ($seri->updateSeri($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'seri.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'seri.php';
            </script>";
            }
        }

        $seri->getSeriById($id);
        $row = $seri->getResult();

        $dataUpdate = $row['seri_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';
        $kocak = '<a href="seri.php"><button type="button" class="btn btn-danger text-white" name="sambit">Cancel</button></a>';
        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];   
    if ($id > 0) {
        if ($seri->deleteSeri($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'seri.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'seri.php';
            </script>";
        }
    }
}

$seri->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->replace('BUTTON_CANCEL', $kocak);
$view->write();
