<main>
    <!-- table -->
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>
                    Produk
                </h2>
                <a href="#" id="show-login" class="btn">Tambah</a>
        <!-- <button id="show-login" class="btn">Login</button> -->
    
            </div>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Kode Produk</td>
                            <td>Nama</td>
                            <td>Harga</td>
                            <td>Stok</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width: 5%;">1</td>
                            <td style="width: 20%;">124343</td>
                            <td style="width: 30%;">
                            INTERNET LITE
                            </td>
                            <td style="width: 20%;">
                                150.000
                            </td>
                            <td style="width: 15%;">
                                50
                            </td>
                            <td style="width: 10%;">
                            <a href="#" id="btn-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 212, 0, 1);">
                                    <path
                                        d="M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z">
                                    
                                    </path>
                                </svg>
                            </a>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    style="fill: rgba(227, 71, 36, 1);">
                                    <path
                                        d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z">
                                    </path>
                                </svg>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 5%;">2</td>
                            <td style="width: 20%;">124342</td>
                            <td style="width: 30%;">
                            INTERNET DEDICATED
                            </td>
                            <td style="width: 20%;">
                                150.000
                            </td>
                            <td style="width: 15%;">
                                50
                            </td>
                            <td style="width: 10%;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    style="fill: rgba(255, 212, 0, 1);">
                                    <path
                                        d="M8.707 19.707 18 10.414 13.586 6l-9.293 9.293a1.003 1.003 0 0 0-.263.464L3 21l5.242-1.03c.176-.044.337-.135.465-.263zM21 7.414a2 2 0 0 0 0-2.828L19.414 3a2 2 0 0 0-2.828 0L15 4.586 19.414 9 21 7.414z">
                                    </path>
                                </svg>
                                
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                                    style="fill: rgba(227, 71, 36, 1);">
                                    <path
                                        d="M6 7H5v13a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7H6zm10.618-3L15 2H9L7.382 4H3v2h18V4z">
                                    </path>
                                </svg>
                            </td>
                        </tr>



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
                <label for="nama">Nama</label>
                <input type="text" id="nama" placeholder="Masukkan Nama">
            </div>
            
            <div class="form-element">
                <label for="harga">Harga</label>
                <input type="text" id="harga" placeholder="Masukkan Harga">
            </div>
            <div class="form-element">
                <label for="stok">Stok</label>
                <input type="text" id="stok" placeholder="Masukkan Stok">
            </div>
            <div class="form-element">
                <button>Tambah</button>
            </div>
        </div>
    </div>
    <div class="edit">
        <div class="close-btn">&times;</div>
        <div class="form">
            <h2>Edit Data</h2>
            <div class="form-element">
                <label for="nama">Nama</label>
                <input type="text" id="nama" placeholder="Masukkan Nama">
            </div>
            
            <div class="form-element">
                <label for="harga">Harga</label>
                <input type="text" id="harga" placeholder="Masukkan Harga">
            </div>
            <div class="form-element">
                <label for="stok">Stok</label>
                <input type="text" id="stok" placeholder="Masukkan Stok">
            </div>
            <div class="form-element">
                <button>Tambah</button>
            </div>
        </div>
    </div>
</main>
<script>
    document.querySelector("#show-login").addEventListener("click",function(){
        document.querySelector(".popup").classList.add("active");
    });
    document.querySelector(".popup .close-btn").addEventListener("click",function(){
        document.querySelector(".popup").classList.remove("active");
    });
    document.querySelector("#btn-edit").addEventListener("click",function(){
        document.querySelector(".edit").classList.add("active");
    });
    document.querySelector(".edit .close-btn").addEventListener("click",function(){
        document.querySelector(".edit").classList.remove("active");
    });
</script>