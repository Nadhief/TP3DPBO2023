<?php

class Hotwheels extends DB
{
    // function buat nyatuin sekaligus ngambil data dari 3 tabel
    function getHotwheelsJoin()
    {
        $query = "SELECT * FROM hotwheels JOIN tipe ON hotwheels.tipe_id=tipe.tipe_id JOIN seri ON hotwheels.seri_id=seri.seri_id ORDER BY hotwheels.hotwheels_id";

        return $this->execute($query);
    }

    // function buat ngambil tabel Hotwheels aja
    function getHotwheels()
    {
        $query = "SELECT * FROM hotwheels";
        return $this->execute($query);
    }

    // function buat ngambil id Hotwheelsnya
    function getHotwheelsById($id)
    {
        $query = "SELECT * FROM hotwheels JOIN tipe ON hotwheels.tipe_id=tipe.tipe_id JOIN seri ON hotwheels.seri_id=seri.seri_id WHERE hotwheels_id=$id";
        return $this->execute($query);
    }

    function searchHotwheels($keyword)
    {
        $query = "SELECT * FROM hotwheels JOIN tipe ON hotwheels.tipe_id=tipe.tipe_id JOIN seri ON hotwheels.seri_id=seri.seri_id WHERE hotwheels_nama LIKE '%".$keyword."%'";
        return $this->execute($query);
    }


    function addHotwheels($data, $file)
    {
        // var_dump($file);
        // exit;

        $hotwheels_foto = $file['hotwheels_foto']['name'];
        $hotwheels_kode = $data['hotwheels_kode'];
        $hotwheels_nama = $data['hotwheels_nama'];
        $tipe_id = $data['Tipe'];
        $seri_id = $data['Seri'];
        $namaFile = $file['hotwheels_foto']['name'];
        $ukuranFile = $file['hotwheels_foto']['size'];
        $error = $file['hotwheels_foto']['error'];
        $tmpName = $file['hotwheels_foto']['tmp_name'];

        if (empty($hotwheels_kode) || empty($hotwheels_nama) || empty($namaFile)) {
            echo "Mohon lengkapi semua data";
        } else {
            // Memeriksa tipe file yang diunggah (hanya jpg, jpeg, dan png yang diperbolehkan)
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "Format file tidak valid. Hanya diperbolehkan file JPG, JPEG, atau PNG.";
            } else if ($ukuranFile > 2000000) { // Memeriksa ukuran file (maksimal 2MB)
                echo "Ukuran file terlalu besar. Maksimal 2MB.";
            } else if ($error !== 0) { // Memeriksa apakah ada error saat mengunggah file
                echo "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
            } else { 
                // Jika semua syarat terpenuhi, tampilkan pesan selamat bergabung
                move_uploaded_file($tmpName, 'assets/gambar/' . $namaFile);// Pindahkan file ke folder uploads
                echo "Selamat bergabung, $hotwheels_nama! Foto profil Anda sudah berhasil diunggah.";
            }
        }

        $query = "INSERT INTO hotwheels VALUES('','$hotwheels_foto', '$hotwheels_kode', '$hotwheels_nama', '$tipe_id', '$seri_id')";
        return $this->executeAffected($query);
    }

    function updateData($id, $data, $file)
    {
        $hotwheels_foto = $file['hotwheels_foto']['name'];
        $hotwheels_kode = $data['hotwheels_kode'];
        $hotwheels_nama = $data['hotwheels_nama'];
        $tipe_id = $data['Tipe'];
        $seri_id = $data['Seri'];

        $namaFile = $_FILES['hotwheels_foto']['name'];
        $ukuranFile = $_FILES['hotwheels_foto']['size'];
        $error = $_FILES['hotwheels_foto']['error'];
        $tmpName = $_FILES['hotwheels_foto']['tmp_name'];

        if (empty($hotwheels_kode) || empty($hotwheels_nama) || empty($namaFile) || empty($jenis_kelamin)) {
            echo "Mohon lengkapi semua data";
        } else {
            // Memeriksa tipe file yang diunggah (hanya jpg, jpeg, dan png yang diperbolehkan)
            $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
            $ekstensiGambar = explode('.', $namaFile);
            $ekstensiGambar = strtolower(end($ekstensiGambar));
            if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
                echo "Format file tidak valid. Hanya diperbolehkan file JPG, JPEG, atau PNG.";
            } else if ($ukuranFile > 2000000) { // Memeriksa ukuran file (maksimal 2MB)
                echo "Ukuran file terlalu besar. Maksimal 2MB.";
            } else if ($error !== 0) { // Memeriksa apakah ada error saat mengunggah file
                echo "Terjadi kesalahan saat mengunggah file. Silakan coba lagi.";
            } else { // Jika semua syarat terpenuhi, tampilkan pesan selamat bergabung
                if (move_uploaded_file($tmpName, 'assets/gambar/' . $namaFile)) {
                    echo "File berhasil dipindahkan ke direktori tujuan.";
                } else {
                    echo "Terjadi kesalahan saat memindahkan file.";
                };
            }
        }

        // Periksa apakah ada file foto yang diunggah
        if (isset($file['hotwheels_foto'])) {
            $hotwheels_foto = $file['hotwheels_foto']['name'];
            $query = "UPDATE hotwheels SET hotwheels_foto='$hotwheels_foto', hotwheels_kode='$hotwheels_kode', hotwheels_nama='$hotwheels_nama', tipe_id='$tipe_id', seri_id='$seri_id' WHERE hotwheels_id=$id";
        } else {
            $query = "UPDATE hotwheels SET hotwheels_kode='$hotwheels_kode', hotwheels_nama='$hotwheels_nama', tipe_id='$tipe_id', seri_id='$seri_id' WHERE hotwheels_id=$id";
        }
        return $this->executeAffected($query);
    }

    function deleteHotwheels($id)
    {
        $query = "DELETE FROM hotwheels WHERE hotwheels_id = $id";
        return $this->executeAffected($query);
    }
}
