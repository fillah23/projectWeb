<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sidebar Menu</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="../css/home.css?v=1.1">
  <link rel="stylesheet" href="../style1.css?v=1.1">
</head>

<body>
  <nav>
    <div class="sidebar-top">
      <span class="shrink-btn">
        <i class='bx bx-chevron-left'></i>
      </span>
      <img src="../images/F .png" class="logo" alt="">
      <h3 class="hide">FANS VISION</h3>
    </div>

    <div class="search">
      <i class='bx bx-search'></i>
      <input type="text" class="hide" placeholder="Quick Search ...">
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
          <a href="" data-active="4" id="akun" class="menu">
            <div class="icon">
              <i class='bx bx-user-plus'></i>
              <i class='bx bxs-user-plus'></i>
            </div>
            <span class="link hide">Pengaturan Akun</span>
          </a>
        </li>
        <li class="tooltip-element" data-tooltip="1">
          <a href="" data-active="5" id="riwayat" class="menu">
            <div class="icon">
              <i class='bx bx-bar-chart-square'></i>
              <i class='bx bxs-bar-chart-square'></i>
            </div>
            <span class="link hide">Riwayat</span>
          </a>
        </li>
        <div class="tooltip">
          <span class="show">Pengaturan Akun</span>
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
            <h3>Rio</h3>
            <h5>Admin</h5>
          </div>
        </div>
        <a href="../index.php" class="log-out">
          <i class='bx bx-log-out'></i>
        </a>
      </div>
      <div class="tooltip">
        <span class="show">Rio Javier</span>
        <span>Logout</span>
      </div>
    </div>
  </nav>
  <div id="content"></div>
  <div class="footer">
        <p class="copyright">
            &copy; 2022 - <span>Fans Vision</span> All Rights Reserved.
        </p>
    </div>
  <script src="../js/home.js"></script>
  <script src="../js/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#content').load('transaksi.php');

      $('.menu').click(function (e) {
        e.preventDefault();

        var menu = $(this).attr('id');

        if (menu == "transaksi") {
          $('#content').load('transaksi.php');
        } else if (menu == "produk") {
          $('#content').load('produk.php');
        } else if (menu == "pelanggan") {
          $('#content').load('pelanggan.php');
        } else if (menu == "portfolio") {
          $('#content').load('portfolio.php');
        } else if (menu == "akun") {
          $('#content').load('akun.php');
        } else if (menu == "riwayat") {
          $('#content').load('riwayat.php');
        }
      });
    });
  </script>
</body>

</html>