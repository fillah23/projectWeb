<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>
                Portfolio
            </h2>
            <a href="#" id="show-login" class="btn">Tambah</a>
        </div>
        <div id="table-faq" class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Gambar</td>
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
            <label for="nama">Gambar</label>
            <style>
                p {
                    font-size: 12px;
                }
            </style>
            <input type="file" id="input-file-now" class="dropify" />
            <p>tes</p>
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
            <label for="nama">Gambar</label>
            <input type="file" id="gambar" name="gambar" autocomplete="off">
        </div>
        <div class="form-element">
            <button type="button" id="submit">Tambah</button>
        </div>
        <div class="form-element">
            <button id="edit_button" class="button">Edit</button>
        </div>
    </div>
</div>

<link rel="stylesheet" href="../../dropify/dist/css/dropify.min.css">
<script src="../../js/jquery-3.6.0.min.js"></script>
<script src="../../dropify/dist/js/dropify.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        // Basic
        $('.dropify').dropify();
    });
</script>
<script>
    document.querySelector("#show-login").addEventListener("click", function () {
        document.querySelector(".popup").classList.add("active");
        $(".popup").css({
            "box-shadow": "0 0 0 500vmax rgb(0 0 0 / 0.5)"
        });
    });
    document.querySelector(".popup .close-btn").addEventListener("click", function () {
        document.querySelector(".popup").classList.remove("active");
        $(".popup").css({
            "box-shadow": "none"
        });
    });
    document.querySelector(".edit .close-btn").addEventListener("click", function () {
        document.querySelector(".edit").classList.remove("active");
        $(".edit").css({
            "box-shadow": "none"
        });
    });
</script>