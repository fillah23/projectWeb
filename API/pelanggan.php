<?php
$connect = new mysqli("localhost", "root", "", "fans");
$queryResult=$connect->query("SELECT * FROM produk");
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
echo json_encode($result);
?>