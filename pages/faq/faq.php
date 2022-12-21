<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: ../login.php");
	exit;
}
?>
<!-- table -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Faq
            </h2>
            <a href="#" id="show-login" class="btn" onclick="bg()">Tambah</a>
        </div>
        <div id="table-faq" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Pertanyaan</td>
                        <td>Jawaban</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="tabel">
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="popup">
    <div class="close-btn">&times;</div>

    <div class="form">
        <h2>Tambah Data</h2>
        <div class="form-element">
            <label for="nama">Pertanyaan</label>
            <input type="text" id="pertanyaan" name="pertanyaan" placeholder="Masukkan Nama" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="nama">Jawaban</label>
            <input type="text" id="jawaban" name="jawaban" placeholder="Masukkan Nama" autocomplete="off">
        </div>

        
        <div class="form-element">
            <button type="button" id="submit" class="button">Tambah</button>
        </div>
    </div>


</div>
<div class="edit">
    <div class="close-btn" id="close-edit">&times;</div>
    <div class="form">
        <h2>Edit Data</h2>
        <input type="hidden" name="" id="id_edit">
        <div class="form-element">
            <label for="pertanyaan">Pertanyaan</label>
            <input type="text" id="pertanyaan_edit" placeholder="Masukkan Pertanyaan">
        </div>
        <div class="form-element">
            <label for="jawaban">Jawaban</label>
            <input type="text" id="jawaban_edit" placeholder="Masukkan Jawaban">
        </div>

        <div class="form-element">
            <button id="edit_button" class="button">Edit</button>
        </div>
    </div>
</div>


<script>   
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="faq/functions.js"></script>  