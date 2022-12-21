<?php

include '../koneksi.php';
$db = new Database();
$conn =  $db->db_connect();
$query_run = $conn->query("select * from faq");


if(isset($_POST['checking_add']))
{
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];

    $query_run = $conn->query("INSERT INTO faq (pertanyaan,jawaban) VALUES ('$pertanyaan','$jawaban')");
    
    if($query_run)
    {
        echo $return  = "Data berhasil ditambah!";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}

if(isset($_POST['checking_edit']))
{
    $id = $_POST['id'];
    $result_array = [];

    $query_run = $conn->query("SELECT * FROM faq WHERE id='$id' ");

    if(mysqli_num_rows($query_run) > 0)
    {
        foreach($query_run as $row)
        {
            array_push($result_array, $row);
        }
        header('Content-type: application/json');
        echo json_encode($result_array);
    }
    else
    {
        echo $return = "No Record Found.!";
    }
}
if(isset($_POST['checking_update']))
{
    $kode = $_POST['id_faq'];
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];

    $query_run = $conn->query("UPDATE faq SET pertanyaan='$pertanyaan',jawaban='$jawaban' WHERE id='$kode'");

    if($query_run)
    {
        echo $return  = "Berhasil di edit";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}
if(isset($_POST['checking_delete']))
{
    $kode = $_POST['id'];

    $query_run = $conn->query("DELETE FROM faq WHERE id='$kode'");

    if($query_run)
    {
        echo $return  = "Berhasil di hapus";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}
?>