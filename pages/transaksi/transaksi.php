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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
    getdata();
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
            '<td class="pelanggan_id" style="width: 10%;">' + value['kode_pelanggan'] + '</td>\
                                <td style="width: 20%;">' + value['nama_pelanggan'] + '</td>\
                                <td style="width: 20%;">' + value['nomer_hp'] + '</td>\
                                <td style="width: 22%;">' + value['nama_produk'] + '</td>\
                                <td style="width: 18%;">' + value['status'] + '</td>\
                                <td style="width: 12%;">\
                                <a href="#" id="btn-view">\
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
  $(document).ready(function(){
  $('#search_transaksi').on('keyup',function(){
    $('#table-transaksi').load('transaksi/search.php?keyword=' +$('#search_transaksi').val());
  });
  });
</script>