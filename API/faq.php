<?php
include 'db.php';
$queryResult=$db->query("SELECT * FROM faq");
$result=array();
while($fetchData=$queryResult->fetch_assoc()){
    $result[]=$fetchData;
}
echo json_encode($result);
?>