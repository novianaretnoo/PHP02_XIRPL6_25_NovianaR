<?php
    include './index.php';

    $query = mysqli_query($koneksi, "SELECT * FROM tbl_buku");
    if (isset($_GET['cari'])) {
        $query = mysqli_query($koneksi, "SELECT * FROM tbl_buku WHERE nama_siswa LIKE '%".
            $_GET['cari']."%'");
    }
    while ($data = mysqli_fetch_array($query)) {
      }
?>