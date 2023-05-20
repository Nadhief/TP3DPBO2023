<?php

class Tipe extends DB
{
    function getTipe()
    {
        $query = "SELECT * FROM tipe";
        return $this->execute($query);
    }

    function getTipeById($id)
    {
        $query = "SELECT * FROM tipe WHERE tipe_id=$id";
        return $this->execute($query);
    }

    function searchTipe($keyword)
    {
        $query = "SELECT * FROM tipe WHERE nama_tipe LIKE '%$keyword%'";
        return $this->execute($query);    
    }

    function addTipe($data)
    {
        $tipe_nama = $data['tipe_nama'];
        $query = "INSERT INTO tipe VALUES('', '$tipe_nama')";
        return $this->executeAffected($query);
    }

    function updateTipe($id, $data)
    {
        $tipe_nama = $data['tipe_nama'];
        $query = "UPDATE tipe SET tipe_nama='$tipe_nama' WHERE tipe_id=$id";
        return $this->executeAffected($query);
    }

    function deleteTipe($id)
    {
        $query = "DELETE FROM tipe WHERE tipe_id = $id";
        return $this->executeAffected($query);
    }
}
