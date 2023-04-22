<?php var_dump($_SESSION["username"]) ?>
<div class="container mt-5">
    <div class="row">
        <div class="col text-center">
            <span class="text h1">ini halaman user setelah login</span><br>
            <?php $sql = mysqli_query($koneksi, "select id,kategori from kategori");
            while ($row = mysqli_fetch_array($sql)) { ?>
                <a href="index.php?p=kategori&id=<?= $row['id'] ?>">
                    <?php echo htmlentities($row['kategori']); ?> &nbsp;
                </a>
                <?php } ?>
        </div>
    </div>
</div>

<?php
date_default_timezone_set("Asia/jakarta");
?>
<p>Jam Digital: <b><span id="jam" style="font-size:24"></span></b></p>

<script type="text/javascript">
    window.onload = function () { jam(); }

    function jam() {
        var e = document.getElementById('jam'),
            d = new Date(), h, m, s;
        h = d.getHours();
        m = set(d.getMinutes());
        s = set(d.getSeconds());

        e.innerHTML = h + ':' + m + ':' + s;

        setTimeout('jam()', 1000);
    }

    function set(e) {
        e = e < 10 ? '0' + e : e;
        return e;
    }
</script>


    <div class="container">
        <div class="row">
            <?php
            include_once "./function.php";
            $query = "SELECT * FROM berita";
            $hasil = mysqli_query($koneksi, "select berita.username,berita.id as idb,berita.judul,kategori.kategori,kategori.id as idk,berita.konten,berita.tanggal from berita left join kategori on kategori.id=berita.idkategori order by berita.id desc");

            foreach ($hasil as $data) {
                ?>
                <div class="col kartu">
                    <div class="card produk" style="width: 18rem;">
                        <img src="aset\quran-3.jpeg" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo "$data[judul]"; ?></h5>
                            <p class="card-text">
                                <?php echo "Diposting oleh : $data[username], tanggal : $data[tanggal]" ?><br><br>
                                <?php echo "$data[konten]" ?>
                                <?php echo "$data[kategori]" ?>
                            </p>
                            <a href="index.php?p=detail&idb=<?= $data["idb"] ?>" class="btn btn-primary">Selengkapnya!</a>
                        </div>
                    </div>
                </div>
                <br>
                <?php
            }
            ?>

        </div>
    </div>