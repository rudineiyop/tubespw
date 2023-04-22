<?php
var_dump($_SESSION["pusername"]);

$perpage = 4;
$page = isset($_GET['page']) ? $_GET['page'] : "";

if (empty($page)) {
    $num = 0;
    $page = 1;
} else {
    $num = ($page - 1) * $perpage;
} ?>

<div class="container mt-5">
    <div class="row">

    </div>
    <div class="row">
        <div class="col text-center">
            <span class="text h1">ini halaman publisher setelah login</span><br>
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
        require_once "./function.php";

        $sql = mysqli_query($koneksi, "SELECT * FROM berita");
        $total_record = mysqli_num_rows($sql);
        $total_page = ceil($total_record / $perpage); ?>

        <ul class="pagination justify-content-center mb-4">
            <?php
            if ($page > 1) {
                $prev = "<a href='./index.php?p=publisher&page=1' class='page-link'><span aria-hidden='true'>First</span></a>";
            } else {
                $prev = "<a href='./index.php?p=publisher&page=1' class='page-link'><span aria-hidden='true'>First</span></a>";
            }
            $number = '';
            for ($i = 1; $i <= $total_page; $i++) {
                if ($i == $page) {
                    $number .= "<li><a href='./index.php?p=publisher&page=$i' class='page-link'>$i</a></li>";
                } else {
                    $number .= "<li><a href='./index.php?p=publisher&page=$i' class='page-link'>$i</a></li>";
                }
            }
            if ($page < $total_page) {
                $link = $page + 1;
                $next = "<a href='./index.php?p=publisher&page=$total_page' class='page-link'><span aria-hidden='true'>Last</span></a>";
            } else {
                $next = "<a href='./index.php?p=publisher&page=$total_page' class='page-link'><span aria-hidden='true'>Last</span></a>";
            }
            ?>
            <li class="page-item">
                <?php echo $prev; ?>
            </li>
            <li class="page-item flex-col">
                <?php echo $number; ?>
            </li>
            <li class="page-item">
                <?php echo $next; ?>
            </li>
        </ul>

        <?php
        $hasil = mysqli_query($koneksi, "select berita.username,berita.id as idb,berita.judul as judul,kategori.kategori,kategori.id as idk,berita.konten,berita.tanggal from berita left join kategori on kategori.id=berita.idkategori order by berita.id desc LIMIT  $num, $perpage");
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
                    </div>
                </div>
            </div>
            <br>
            <?php
        }
        ?>

    </div>
</div>