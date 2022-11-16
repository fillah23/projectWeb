<?php 
$conn = mysqli_connect("localhost","root","","fans");

if(isset($_POST['checking_add']))
{
    $pertanyaan = $_POST['pertanyaan'];
    $jawaban = $_POST['jawaban'];

    $query = "INSERT INTO faq (pertanyaan,jawaban) VALUES ('$pertanyaan','$jawaban')";
    $query_run = mysqli_query($conn, $query);
    
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

    $query = "SELECT * FROM faq WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

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

    $query = "UPDATE faq SET pertanyaan='$pertanyaan',jawaban='$jawaban' WHERE id='$kode'";
    $query_run = mysqli_query($conn, $query);

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

    $query = "DELETE FROM faq WHERE id='$kode' ";
    $query_run = mysqli_query($conn, $query);

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