<?php 

$conn = mysqli_connect("localhost","root","","fans");

$query = "SELECT * FROM pelanggan join produk on pelanggan.kode_produk = produk.kode_produk;";
$query_run = mysqli_query($conn, $query);
$result_array = [];

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
    echo $return = "<h4>No Record Found</h4>";
}
?>