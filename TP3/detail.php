<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Tipe.php');
include('classes/Seri.php');
include('classes/Hotwheels.php');
include('classes/Template.php');

$hotwheels = new Hotwheels($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$hotwheels->open();

$data = nulL;

if (isset($_GET['id_del'])) {
    $id = $_GET['id_del'];
    if ($id > 0) {
        if ($hotwheels->deleteHotwheels($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'index.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'index.php';
            </script>";
        }
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $hotwheels->getHotwheelsById($id);
        $row = $hotwheels->getResult();

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Detail ' . $row['hotwheels_nama'] . '</h3>
        </div>
        <div class="card-body text-end">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/gambar/' . $row['hotwheels_foto'] . '" class="img-thumbnail" alt="' . $row['hotwheels_foto'] . '" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3">
                            <table border="0" class="text-start">
                                <tr>
                                    <td>Nama</td>
                                    <td>:</td>
                                    <td>' . $row['hotwheels_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Kode</td>
                                    <td>:</td>
                                    <td>' . $row['hotwheels_kode'] . '</td>
                                </tr>
                                <tr>
                                    <td>Tipe</td>
                                    <td>:</td>
                                    <td>' . $row['tipe_nama'] . '</td>
                                </tr>
                                <tr>
                                    <td>Seri</td>
                                    <td>:</td>
                                    <td>' . $row['seri_nama'] . '</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <a href="tambahHotwheels.php?id='.$row['hotwheels_id'].'"><button type="button" class="btn btn-success text-white">Ubah Data</button></a>
                <a href="detail.php?id_del='. $row['hotwheels_id'].'"><button type="button" class="btn btn-danger">Hapus Data</button></a>
            </div>';
    }
}

$hotwheels->close();
$detail = new Template('templates/skindetail.html');
$detail->replace('DATA_DETAIL_HOTWHEELS', $data);
$detail->write();
