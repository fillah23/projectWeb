<?php 
function auto(){
    $conn = mysqli_connect("localhost","root","","fans");

    $num = '';
    $perfix = 'TR';
    $query = "SELECT MAX(kode_transaksi) AS kode from detail_transaksi";
    $run = mysqli_query($conn,$query);
    $data = mysqli_fetch_array($run);
    $row = mysqli_fetch_row($run);
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
?>
<div class="details">
  <div class="recentOrders">
    <div class="cardHeader">
      <h2>
        Transaksi
      </h2>
    </div>
    <div id="table-transaksi" class="table-wrapper">
      <table>
        <thead>
          <tr>
            <td>ID</td>
            <td>Nama</td>
            <td>Nomer hp</td>
            <td>Produk</td>
            <td>Status</td>
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
    <div class="form-element">
      <h2>Apakah Yakin ingin bayar?</h2>
      <button type="button" id="submit" onclick="struk3(); struk4(); location.href='transaksi/struk.html'; ">Bayar</button>
    </div>
  </div>
</div>
<input type="text" value="<?= auto(); ?>" id="idbarang">
<input type="text" value="<?php echo date("Y-m-d") ?>" id="tanggal">
<input type="text" id="harga_barang">
<input type="text" id="id_pelanggan">
<input type="text" id="barang">
<input type="text" id="barang1" value="">
<input type="text" id="id_akun">
<input type="text" id="name_akun">
<input type="text" id="nama_plg">
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.querySelector(".popup .close-btn").addEventListener("click", function () {
    document.querySelector(".popup").classList.remove("active");
    $(".popup").css({
      "box-shadow": "none"
    });
  });
</script>
<script>
  $(document).ready(function () {
    getdata();
    cekbayar();
    addData();
    update();
    detail();
  });
  function detail(){
    $('#submit').click(function (e) {
      e.preventDefault();


      var id = $('#idbarang').val();
      var tanggal = $('#tanggal').val();
      var harga_barang = $('#harga_barang').val();
      var id_pelanggan = $('#nama_plg').val();
      var barang = $('#barang').val();
      var idakun = $('#name_akun').val();


      if (tanggal != '' & id != '') {
        $.ajax({
          type: "POST",
          url: "transaksi/code.php",
          data: {
            'checking_add_detail': true,
            'id': id,
            'tanggal': tanggal,
            'harga_barang': harga_barang,
            'id_pelanggan': id_pelanggan,
            'barang': barang,
            'idakun': idakun,

          },
          success: function (response) {
            // console.log(response);
            $('#idbarang').val(response);
          }
        });

      } else {
        // console.log("Please enter all fileds.");
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Lengkapi data',
          showConfirmButton: false,
          timer: 2000
        })
      }

    });
  }
  function update(){
    $('#submit').click(function (e) {
            e.preventDefault();

            var kode = $('#id_pelanggan').val();
            var tanggal = $('#tanggal').val();
           

            if (kode != '' ) {
                $.ajax({
                    type: "POST",
                    url: "transaksi/code.php",
                    data: {
                        'checking_update': true,
                        'id': kode,
                        'tanggal': tanggal,
                        
                    },
                    success: function (response) {
   
                    }
                });

            } else {
                // console.log("Please enter all fileds.");
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Lengkapi data',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

        });
  }
  function addData() {
    $('#submit').click(function (e) {
      e.preventDefault();


      var id = $('#idbarang').val();
      var tanggal = $('#tanggal').val();
      var harga_barang = $('#harga_barang').val();
      var id_pelanggan = $('#id_pelanggan').val();
      var barang = $('#barang').val();
      var idakun = $('#id_akun').val();


      if (tanggal != '' & id != '') {
        $.ajax({
          type: "POST",
          url: "transaksi/code.php",
          data: {
            'checking_add': true,
            'id': id,
            'tanggal': tanggal,
            'harga_barang': harga_barang,
            'id_pelanggan': id_pelanggan,
            'barang': barang,
            'idakun': idakun,

          },
          success: function (response) {
            // console.log(response);
            document.querySelector(".popup").classList.remove("active");
            $(".popup").css({
              "box-shadow": "none"
            });
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: "pembayaran berhasil",
              showConfirmButton: false,
              timer: 2000
            })
            $('.tabel').html("");
            getdata();
            
          }
        });

      } else {
        // console.log("Please enter all fileds.");
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Lengkapi data',
          showConfirmButton: false,
          timer: 2000
        })
      }

    });
  }

  function cekbayar() {
    $(document).on("click", "#btn-bayar", function () {

      var id = $(this).closest('tr').find('.transaksi_id').text();
      // alert(stud_id);

      $.ajax({
        type: "POST",
        url: "transaksi/code.php",
        data: {
          'checking_bayar': true,
          'id': id,
        },
        success: function (response) {
          // console.log(response);
          $.each(response, function (key, value) {
            // console.log(studview['fname']);
            $('#harga_barang').val(value['harga_produk']);
            $('#id_pelanggan').val(value['kode_pelanggan']);
            $('#barang').val(value['nama_produk']);
            $('#barang1').val(value['nama_produk']);
            $('#nama_plg').val(value['nama_pelanggan']);
          });
          document.querySelector(".popup").classList.add("active");
          $(".popup").css({
            "box-shadow": "0 0 0 500vmax rgb(0 0 0 / 0.5)"
          });
        }
      });

    });
  }

  function getdata() {
    $.ajax({
      type: "GET",
      url: "transaksi/fetch.php",
      success: function (response) {
        // console.log(response);
        $.each(response, function (key, value) {
          // console.log(value['fname']);
          $('.tabel').append('<tr>' +
            '<td class="transaksi_id" style="width: 10%;">' + value['kode_pelanggan'] + '</td>\
                                <td style="width: 20%;">' + value['nama_pelanggan'] + '</td>\
                                <td style="width: 20%;">' + value['nomer_hp'] + '</td>\
                                <td style="width: 22%;">' + value['nama_produk'] + '</td>\
                                <td style="width: 18%;">' + value['status'] + '</td>\
                                <td style="width: 12%;">\
                                <a href="#" id="btn-bayar">\
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24"\
                                    style="fill: rgba(13, 255, 19, 1);">\
                                    <path\
                                    d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z">\
                                    </path>\
                                </svg>\
                                </a>\
                                <a href="#" id="btn-edit">\
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                    style="fill: rgba(255, 212, 0, 1);">\
                                    <path\
                                        d="M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z">\
                                    </path>\
                                </svg>\
                                </a>\
                                <a href="#" id="btn-hapus">\
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                    style="fill: rgba(227, 71, 36, 1);">\
                                    <path\
                                        d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z">\
                                    </path>\
                                </svg>\
                                </a>\
                                </td>\
                            </tr>');
        });
      }
    });
  }
  $(document).ready(function () {
    $('#search_transaksi').on('keyup', function () {
      $('#table-transaksi').load('transaksi/search.php?keyword=' + $('#search_transaksi').val());
    });
  });
</script>
<script>
  document.getElementById("id_akun").value=sessionStorage.getItem("textvalue");
  document.getElementById("name_akun").value=sessionStorage.getItem("textvalue2");
</script>
<script>
  struk();
  struk2();
  
  
  function struk(){
    var x = document.getElementById("tanggal").value;
      sessionStorage.setItem("textvalue4",x);
      return false;
  }
  function struk2(){
    var x = document.getElementById("idbarang").value;
      sessionStorage.setItem("textvalue5",x);
      return false;
  }
  function struk3(){
    var x = document.getElementById("barang").value;
      sessionStorage.setItem("textvalue6",x);
      return false;
  }
  function struk4(){
    var x = document.getElementById("harga_barang").value;
      sessionStorage.setItem("textvalue7",x);
      return false;
  }
</script>
