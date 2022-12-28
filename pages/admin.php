<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
// $conn = mysqli_connect("localhost","root","","fans");
include ('koneksi.php');
$db = new Database();
$conn =  $db->db_connect();

// $query = "UPDATE `pelanggan` SET status = 'non aktif', tanggal_berlangganan = date(now()) WHERE MONTH(tanggal_berlangganan) != MONTH(date(NOW()))";
// $query_run = mysqli_query($conn, $query);
$query_run = $conn->query("UPDATE `pelanggan` SET status = 'non aktif', tanggal_berlangganan = date(now()) WHERE MONTH(tanggal_berlangganan) != MONTH(date(NOW()))");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/home.css">
  <link rel="stylesheet" href="../css/popup.css">
</head>

<body class="shrink">
  <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="../images/F .png" class="logo" alt="" onclick="toggleFullScreen()">
      <h3 class="hide">FANS VISION</h3>
    </div>
    <!-- <p>tes</p> -->
    <div class="search">
      <i class='bx bx-search'></i>
      <input type="text" id="search_transaksi" class="hide search_field" placeholder="Quick Search ..."
        autocomplete="off">
    </div>
    <div class="sidebar-links">
      <ul>
        <div class="active-tab"></div>
        <li class="tooltip-element" data-tooltip="0">
          <a href="" id="transaksi" class="menu active" data-active="0">
            <div class="icon">
              <i class='bx bx-cart'></i>
              <i class='bx bxs-cart'></i>
            </div>
            <span class="link hide">Transaksi</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="" id="produk" class="menu" data-active="1">
            <div class="icon">
              <i class='bx bx-box'></i>
              <i class='bx bxs-box'></i>
            </div>
            <span class="link hide">Produk</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2">
          <a href="" data-active="2" id="pelanggan" class="menu">
            <div class="icon">
              <i class='bx bx-user-check'></i>
              <i class='bx bxs-user-check'></i>
            </div>
            <span class="link hide">Pelanggan</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Transaksi</span>
          <span>Produk</span>
          <span>Pelanggan</span>
        </div>
      </ul>
      <div id="main-page"></div>

      <h4 class="hide" hidden>Shortcuts</h4>

      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="" data-active="3" id="faq" class="menu">
            <div class="icon">
              <i class='bx bx-message-dots'></i>
              <i class='bx bxs-message-dots'></i>
            </div>
            <span class="link hide">FAQ</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">FAQ</span>
        </div>
      </ul>
    </div>
    <div class="sidebar-footer">
      <a href="#" class="account tooltip-element" data-tooltip="0">
        <i class='bx bx-user'></i>
      </a>
      <div class="admin-user tooltip-element" data-tooltip="1">
        <div class="admin-profile hide">
          <img src="../images/profil.svg" alt="">
          <div class="admin-info">
            <h3><?= $_SESSION['nama_akun']; ?></h3>
            <h5><?= $_SESSION['level']; ?></h5>
            <input type="text" value="<?= $_SESSION['kode_akun']; ?>" id="idakun" hidden>
            <input type="text" value="<?= $_SESSION['nama_akun']; ?>" id="namaakun" hidden>
            <input type="text" value="<?= $_SESSION['level']; ?>" id="levelakun" hidden>
          </div>
        </div>
        <a href="#" class="log-out" onclick="logout()">
          <i class='bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show"><?= $_SESSION['nama_akun']; ?></span>
        <span>Logout</span>
      </div>
    </div>
  </nav>
  <main>
    <div id="content"></div>
    <p class="copyright">
      &copy; 2022 - <span>Fans Vision</span> All Rights Reserved.
    </p>
  </main>
  <script src="../js/home.js"></script>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(document).ready(function () {
      $('#content').load('transaksi/transaksi.php');

      $('.menu').click(function (e) {
        e.preventDefault();

        var menu = $(this).attr('id');

        if (menu == "transaksi") {
          $('#content').load('transaksi/transaksi.php');
          $(".search_field").attr("id", "search_transaksi");
        } else if (menu == "produk") {
          $('#content').load('produk/produk_admin.php');
          $(".search_field").attr("id", "search_produk");
        } else if (menu == "pelanggan") {
          $('#content').load('pelanggan/pelanggan_admin.php');
          $(".search_field").attr("id", "search_pelanggan");
        } else if (menu == "faq") {
          $('#content').load('faq/faq.php');
          $(".search_field").attr("id", "search_faq");
        }
      });
    });

    function toggleFullScreen() {
      if (!document.fullscreenElement && // alternative standard method
        !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement
        ) { // current working methods
        if (document.documentElement.requestFullscreen) {
          document.documentElement.requestFullscreen();
        } else if (document.documentElement.msRequestFullscreen) {
          document.documentElement.msRequestFullscreen();
        } else if (document.documentElement.mozRequestFullScreen) {
          document.documentElement.mozRequestFullScreen();
        } else if (document.documentElement.webkitRequestFullscreen) {
          document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        }
      }
    }
    function logout(){
      Swal.fire({
                title: 'Yakin ingin logout?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
            }).then((result) => {
              if (result.value) {
                location.href = "logout.php";
              }
            });
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.2/rollups/aes.js" integrity="sha256-/H4YS+7aYb9kJ5OKhFYPUjSJdrtV6AeyJOtTkw6X72o=" crossorigin="anonymous"></script>
  <script>
    kirim();
    kirim2();
    kirim3();
    function kirim(){
      var x = document.getElementById("idakun").value;
      sessionStorage.setItem("textvalue",x);
      return false;
    }
    function kirim2(){
      var y = document.getElementById("namaakun").value;
      sessionStorage.setItem("textvalue2",y);
      return false;
    }
  </script>
</body>

</html>
