<?php
include 'db.php';
$queryResult=$db->query("SELECT * FROM pelanggan");
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
echo json_encode($result);
?>