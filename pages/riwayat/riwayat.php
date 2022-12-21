<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: ../login.php");
	exit;
}
?>
<!-- table -->
<style>
    .date {
        border: 2px solid #30475E;
        background: none;
        /* display: block;
  margin: 20px auto; */
        padding: 5px 10px;
        width: 130px;
        outline: none;
        color: black;
        border-radius: 25px;
        /* text-align: center; */
        transition: 250ms width ease, 250ms border-color ease;
    }

    .date:hover {
        width: 140px;
    }

    /************** 
   On Focus
***************/
    .date:focus {
        width: 145px;
        border-color: #222831;
    }
</style>
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Riwayat
            </h2>
            <a href="#" id="show-login" class="btn" onclick="printDiv()">Export</a>
        </div>
        <div class="datepicker" style="margin-top: 10px;">
            <input placeholder="Awal" type="text" onfocus="(this.type = 'date')" class="date" id="date_picker_end"
                onchange="handledatechange()">
            <input placeholder="Akhir" type="text" onfocus="(this.type = 'date')" class="date" id="date_picker_end1"
                onchange="handledatechange1()">
            <a href="#" id="range" class="btn">Submit</a>
        </div>
        <div id="table-riwayat" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Pelanggan</td>
                        <td>Produk</td>
                        <td>Tanggal</td>
                        <td>Kecepatan</td>
                        <td>Bandwith</td>
                        <td>Admin</td>
                        <td>Harga</td>
                    </tr>
                </thead>
                <tbody class="tabel">
                </tbody>
            </table>
        </div>

    </div>
</div>


<input type="hidden" id="tanggal">
<input type="hidden" id="tanggal2">
<script src="riwayat/functions.js">
</script>



<!-- <script>
   
</script>
<script>
    
</script> -->