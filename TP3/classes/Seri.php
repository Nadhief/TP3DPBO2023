<?php

class Seri extends DB
{
    function getSeri()
    {
        $query = "SELECT * FROM seri";
        return $this->execute($query);
    }

    function getSeriById($id)
    {
        $query = "SELECT * FROM seri WHERE seri_id=$id";
        return $this->execute($query);
    }

    function addSeri($data)
    {
        $seri_nama = $data['seri_nama'];
        $query = "INSERT INTO seri VALUES('', '$seri_nama')";
        return $this->executeAffected($query);
    }

    function updateSeri($id, $data)
    {
        $seri_nama = $data['seri_nama'];
        $query = "UPDATE seri SET seri_nama='$seri_nama' WHERE seri_id=$id";
        return $this->executeAffected($query);
    }

    function deleteSeri($id)
    {
        $query = "DELETE FROM seri WHERE seri_id = $id";
        return $this->executeAffected($query); 
    }
}
