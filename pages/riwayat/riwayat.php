<!-- table -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Riwayat
            </h2>
        </div>
        <div id="table-faq" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>Id</td>
                        <td>Pelanggan</td>
                        <td>Produk</td>
                        <td>Tanggal</td>
                        <td>Kecepatan</td>
                        <td>Admin</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody class="tabel">
                </tbody>
            </table>
        </div>

    </div>
</div>






<script>
    $(document).ready(function () {
        getdata();
    });
    function getdata() {
        $.ajax({
            type: "GET",
            url: "riwayat/fetch.php",
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    // console.log(value['fname']);
                    $('.tabel').append('<tr>' +
                        '<td class="riwayat_id" >' + value['kode_transaksi'] + '</td>\
                                <td >' + value['nama_pelanggan'] + '</td>\
                                <td >' + value['nama_produk'] + '</td>\
                                <td >' + value['tanggal_transaksi'] + '</td>\
                                <td >' + value['kecepatan'] + '</td>\
                                <td >' + value['nama_akun'] + '</td>\
                                <td >\
                                <a href="#" id="btn-detail">\
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"\
                                    style="fill: rgba(138, 153, 181, 1);">\
                                    <path\
                                    d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">\
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
    $('#search_faq').on('keyup',function(){
    $('#table-faq').load('faq/search.php?keyword=' +$('#search_faq').val());
    });
    });
</script>