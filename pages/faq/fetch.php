<?php 
include '../koneksi.php';
$db = new Database();
$conn =  $db->db_connect();

$query_run = $conn->query("SELECT * FROM faq");
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