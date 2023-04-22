<div class="container mt-5">
    <center>
        <span class="text h1">ini halaman berita publisher</span>
    </center>
</div>

<div class="container">
    <div class="row">
        <?php
        include_once "./function.php";
        $nama = $_SESSION["pusername"];
        $hasil = mysqli_query($koneksi, "select berita.username,berita.id as idb,berita.judul,kategori.kategori as kategori,kategori.id,berita.konten,berita.tanggal from berita left join kategori on kategori.id=berita.idkategori where berita.username='$nama'");
        if (isset($_POST["cari"])) {
            $hasil = cari($_POST);
        }

        foreach ($hasil as $data) {
            ?>
            <div class="col kartu">
                <div class="card produk" style="width: 18rem;">
                    <img src="aset\quran-3.jpeg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo "$data[judul]"; ?>
                        </h5>
                        <p class="card-text">
                            <?php echo "Diposting oleh : $data[username], tanggal : $data[tanggal]" ?><br><br>
                            <?php echo "$data[konten]" ?>
                            <?php echo "$data[kategori]" ?>
                        </p>
                        <a href="index.php?p=detail&idb=<?= $data["idb"] ?>" class="btn btn-primary">Selengkapnya!</a>
                        <a href="index.php?p=ubah&idb=<?= $data["idb"] ?>" class="btn btn-success">edit berita</a>
                    </div>
                </div>
            </div>
            <br>
            <?php
        }
        ?>
    </div>
</div>