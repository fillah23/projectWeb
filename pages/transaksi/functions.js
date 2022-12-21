//Popup
document.querySelector(".popup .close-btn").addEventListener("click", function () {
    document.querySelector(".popup").classList.remove("active");
    $(".popup").css({
      "box-shadow": "none"
    });
    $('#harga_barang').val("");
    $('#barang').val("");
    $('#id_pelanggan').val("");
  });

$(document).ready(function () {
    getdata();
    cekbayar();
    addData();
    update();
  });

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
                                    style="fill: rgba(105, 172, 193, 1);">\
                                    <path d="M12 15c-1.84 0-2-.86-2-1H8c0 .92.66 2.55 3 2.92V18h2v-1.08c2-.34 3-1.63 3-2.92 0-1.12-.52-3-4-3-2 0-2-.63-2-1s.7-1 2-1 1.39.64 1.4 1h2A3 3 0 0 0 13 7.12V6h-2v1.09C9 7.42 8 8.71 8 10c0 1.12.52 3 4 3 2 0 2 .68 2 1s-.62 1-2 1z"></path><path d="M5 2H2v2h2v17a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1V4h2V2H5zm13 18H6V4h12z">\
                                </svg>\
                                </a>\
                                </td>\
                            </tr>');
        });
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
          });
          document.querySelector(".popup").classList.add("active");
          $(".popup").css({
            "box-shadow": "0 0 0 500vmax rgb(0 0 0 / 0.5)"
          });
        }
      });

    });
  }

  function addData() {
    $('#submit').click(function (e) {
      e.preventDefault();


      var id = $('#idbarang').val();
      var tanggal = $('#tanggal').val();
      var harga_barang = $('#harga_barang').val();
      var id_pelanggan = $('#id_pelanggan').val();
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
            $('#idbarang').val(response);
            $('#harga_barang').val("");
            $('#barang').val("");
            $('#id_pelanggan').val("");
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

  function update() {
    $('#submit').click(function (e) {
      e.preventDefault();

      var kode = $('#id_pelanggan').val();
      var tanggal = $('#tanggal').val();


      if (kode != '') {
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
  document.getElementById("id_akun").value = sessionStorage.getItem("textvalue");
  $(document).ready(function () {
    $('#search_transaksi').on('keyup', function () {
      $('#table-transaksi').load('transaksi/search.php?keyword=' + $('#search_transaksi').val());
    });
  });

struk();
struk2();


function struk() {
  var x = document.getElementById("tanggal").value;
  sessionStorage.setItem("textvalue4", x);
  return false;
}

function struk2() {
  var x = document.getElementById("idbarang").value;
  sessionStorage.setItem("textvalue5", x);
  return false;
}

function struk3() {
  var x = document.getElementById("barang").value;
  sessionStorage.setItem("textvalue6", x);
  return false;
}

function struk4() {
  var x = document.getElementById("harga_barang").value;
  sessionStorage.setItem("textvalue7", x);
  return false;
}