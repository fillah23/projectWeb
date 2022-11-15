<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
	exit;
}
$conn = mysqli_connect("localhost","root","","fans");

$query = "UPDATE `pelanggan` SET status = 'non aktif', tanggal_berlangganan = date(now()) WHERE MONTH(tanggal_berlangganan) != MONTH(date(NOW()))";
$query_run = mysqli_query($conn, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/home.css?v=2.4">
  <link rel="stylesheet" href="../css/popup.css?v=1.8">
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
        <li class="tooltip-element" data-tooltip="3">
          <a href="" data-active="3" id="portfolio" class="menu">
            <div class="icon">
              <i class='bx bx-image-add'></i>
              <i class='bx bxs-image-add'></i>
            </div>
            <span class="link hide">Portfolio</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Transaksi</span>
          <span>Produk</span>
          <span>Pelanggan</span>
          <span>Portfolio</span>

        </div>
      </ul>
      <div id="main-page"></div>

      <h4 class="hide" hidden>Shortcuts</h4>

      <ul>
        <li class="tooltip-element" data-tooltip="0">
          <a href="" data-active="4" id="faq" class="menu">
            <div class="icon">
              <i class='bx bx-message-dots'></i>
              <i class='bx bxs-message-dots'></i>
            </div>
            <span class="link hide">FAQ</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1" id="menu_akun">
          <a href="" data-active="5" id="akun" class="menu">
            <div class="icon">
              <i class='bx bx-user-plus'></i>
              <i class='bx bxs-user-plus'></i>
            </div>
            <span class="link hide">Pengaturan Akun</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="2" id="menu_riwayat">
          <a href="" data-active="6" id="riwayat" class="menu">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Riwayat</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">FAQ</span>
          <span>Pengaturan Akun</span>
          <span>Riwayat</span>
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
          </div>
        </div>
        <a href="logout.php" class="log-out">
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
          $('#content').load('produk/produk.php');
          $(".search_field").attr("id", "search_produk");
        } else if (menu == "pelanggan") {
          $('#content').load('pelanggan/pelanggan.php');
          $(".search_field").attr("id", "search_pelanggan");
        } else if (menu == "portfolio") {
          $('#content').load('portfolio.php');
          $(".search_field").attr("id", "search_portfolio");
        } else if (menu == "akun") {
          $('#content').load('akun/akun.php');
          $(".search_field").attr("id", "search_akun");
        } else if (menu == "riwayat") {
          $('#content').load('riwayat.php');
          $(".search_field").attr("id", "search_riwayat");
        } else if (menu == "faq") {
          $('#content').load('faq.php');
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
  </script>


</body>

</html>
<?php 

if($_SESSION['level']=="Admin"){
  echo "<script>
  document.getElementById('menu_akun').hidden = true;
  document.getElementById('menu_riwayat').hidden = true;
  </script>";
}elseif($_SESSION['level']=="Super"){
  echo "<script>
  document.getElementById('menu_akun').hidden = false;
  document.getElementById('menu_riwayat').hidden = false;
  </script>";
}else{
  header("Location: login.php");
	exit;
}
?>