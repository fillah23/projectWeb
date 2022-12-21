<?php 
include '../koneksi.php';
session_start();
if(!isset($_SESSION["login"])){
	header("Location: ../login.php");
	exit;
}
function auto(){
    // $conn = mysqli_connect("localhost","root","","fans");
    $db = new Database();
    $conn =  $db->db_connect();

    $num = '';
    $perfix = 'AA';
    // $query = "SELECT MAX(kode_akun) AS kode from akun";
    $query_run = $conn->query("SELECT MAX(kode_akun) AS kode from akun");
    $data = mysqli_fetch_array($query_run);
    $row = mysqli_fetch_row($query_run);
    $num = $data['kode'];
    $number = (int)substr($num,2,5);
    $number++;

    if($row > 0){
        return 'kode telah digunakan';
    }else{
        $value = $perfix.sprintf("%05s",$number);
    }
    return $value;
    
}
// $conn = mysqli_connect("localhost","root","","fans");
    $db = new Database();
    $conn =  $db->db_connect();

    // $perintah="SELECT * from level_akun";
    $query=$conn->query("SELECT * from level_akun");
    
    $query_edit=$conn->query("SELECT * from level_akun");
?>
<!-- table -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Pengaturan Akun
            </h2>
            <a href="#" id="show-login" class="btn">Tambah</a>
        </div>
        <div id="table-akun" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>Kode Akun</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Level</td>
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
            <!-- <label for="kode">kode</label> -->
            <input type="hidden" id="kode" name="kode" placeholder="Masukkan kode" value="<?= auto(); ?>" readonly>
        </div>
        <div class="form-element">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan Nama" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="email">Email</label>
            <input type="text" id="email" name="email" placeholder="Masukkan Email" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="text" id="password" name="password" placeholder="Masukkan Password" autocomplete="off">
        </div>
        <div class="form-element">
            <label for="level">Level</label>
            <!-- <input type="text" id="level" placeholder="Masukkan Level" autocomplate = "off"> -->
            <select name="pilihlevel" id="pilihlevel">
                <option>==Pilih level==</option>
                <?php while($data=mysqli_fetch_array($query)){?>
                <option data-nama="<?= $data['id_level']; ?>">
                    <?php echo $data['level'];?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" name="idlevel" id="idlevel">

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
            <label for="nama">Nama</label>
            <input type="text" id="nama_edit" placeholder="Masukkan Nama">
        </div>
        <div class="form-element">
            <label for="email">Email</label>
            <input type="text" id="email_edit" placeholder="Masukkan Email">
            <input type="hidden" id="email_edit_user" placeholder="Masukkan Email">
        </div>
        <div class="form-element">
            <label for="password">Password</label>
            <input type="text" id="password_edit" placeholder="Masukkan Password">
        </div>
        <div class="form-element">
            <label for="level">Level</label>
            <!-- <input type="text" id="level_edit" placeholder="Masukkan Level"> -->
            <select name="level_edit" id="pilihlevel_edit">
                <?php while($data_edit=mysqli_fetch_array($query_edit)){?>
                <option data-nama="<?= $data_edit['id_level']; ?>">
                    <?php echo $data_edit['level'];?></option>
                <?php } ?>
            </select>
        </div>
        <input type="hidden" name="idlevel_edit" id="idlevel_edit">
        <div class="form-element">
            <button id="edit_button" class="button">Edit</button>
        </div>
    </div>
</div>

<script>

</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="akun/functions.js"></script>