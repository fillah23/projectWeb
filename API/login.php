<?php
//  $db = mysqli_connect('localhost','root','','fans');
//  $username = $_POST['username'];
//  $password = $_POST['password'];
//  $sql = "SELECT * FROM pelanggan WHERE email_pelanggan = '".$username."' AND password = '".$password."'";
//  $result = mysqli_query($db,$sql);
//  $count = mysqli_num_rows($result);
//  if($count == 1){
//  	echo json_encode("Success");
//  } 
//  else{
//  	echo json_encode("Error");
//  }

 //MySQL database Connection
 $con=mysqli_connect('localhost','root','','fans');
  
 //Received JSON into $json variable
 $json = file_get_contents('php://input');
 
 //Decoding the received JSON and store into $obj variable.
 $obj = json_decode($json,true);
 
 if(isset($obj["email"]) && isset($obj["password"])){
   
   $uname = mysqli_real_escape_string($con,$obj['email']);
   $pwd = mysqli_real_escape_string($con,$obj['password']);
   
   //Declare array variable
   $result=[];
   
   //Select Query
   $sql="SELECT * FROM pelanggan join produk on pelanggan.kode_produk = produk.kode_produk WHERE email_pelanggan ='{$uname}' and password='{$pwd}'";
   $res=$con->query($sql);
   
   if($res->num_rows>0){
	 
	 $row=$res->fetch_assoc();
	 
	 $result['loginStatus']=true;
	 $result['message']="Login Successfully";
	 
	 $result["userInfo"]=$row;
	 
   }else{
	 
	 $result['loginStatus']=false;
	 $result['message']="Invalid Login Details";
   }
   
   // Converting the array into JSON format.
   $json_data=json_encode($result);
	 
   // Echo the $json.
   echo $json_data;
 }
?>