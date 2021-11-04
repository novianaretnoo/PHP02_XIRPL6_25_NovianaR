    <?php 
    //koneksi database
    $server = "localhost";
    $user = "root";
    $pass = "";
    $database = "perpustakaan";

    $koneksi = mysqli_connect($server, $user, $pass, $database) or die(mysqli_error($koneksi));

    //jika tombol simpan pada tabel data siswa diklik
    if(isset($_POST['b_simpan']))
    {
        //pengujian apakah data akan diedit atau simpan baru
        if($_GET['hal'] == "edit")
        {
            //data akan diedit
            $edit = mysqli_query($koneksi, "UPDATE tbl_buku set 
            id_siswa = '$_POST[tid_siswa]', 
            nis = '$_POST[tnis]', 
            nama_siswa = '$_POST[tnama_siswa]', 
            jenis_kelamin = '$_POST[tjk]', 
            alamat = '$_POST[talamat]', 
            id_jurusan = '$_POST[tid_jurusan]'
            WHERE id_siswa '$_GET[id]'      
            ");
            if($edit) { //jika edit sukses
                echo "<script> 
                alert('Edit data SUKSES!'); 
                document.location='index.php'; 
                </script>";
            }else {
                echo "<script> 
                alert('Edit data GAGAL!'); 
                document.location='index.php'; 
                </script>";
            }
        }else
            {
            //data akan disimpan baru
            $simpan = mysqli_query($koneksi, "INSERT INTO tbl_buku (id_siswa, nis, nama_siswa, jenis_kelamin, alamat, id_jurusan)
            VALUES ('$_POST[tid_siswa]', '$_POST[tnis]', '$_POST[tnama_siswa]', '$_POST[tjk]', '$_POST[talamat]', '$_POST[tid_jurusan]')");
            if($simpan) { //jika simpan sukses
                echo "<script> 
                alert('Simpan data SUKSES!'); 
                document.location='index.php'; 
                </script>";
            }else {
                echo "<script> 
                alert('Simpan data GAGAL!'); 
                document.location='index.php'; 
                </script>";
            }
        }       
    }
    //pengujian jika tombol edit atau hapus pd tabel data siswa diklik
        if(isset($_GET['hal']))
        {
            //Pengujian saat edit data
            if($_GET['hal'] == "edit") 
            {
                //tampilkan data yang akan diedit
                $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_buku WHERE id_siswa = '$_GET[id]' ");
                $data = mysqli_fetch_array($tampil);
                if($data)
                {
                    //jika data ditemukan maka data ditampung dulu kedalam variabel
                    $vid_siswa = $data['id_siswa'];
                    $vnis = $data['nis'];
                    $vnama_siswa = $data['nama_siswa'];
                    $vjenis_kelamin = $data['jenis_kelamin'];
                    $valamat = $data['alamat'];
                    $vid_jur = $data['id_jurusan'];
                    
                }
            } else if ($_GET['hal'] == "hapus")
            {
                //persiapan hapus data
                $hapus = mysqli_query($koneksi, "DELETE FROM tbl_buku WHERE id_siswa = '$_GET[id]' ");
                if ($hapus) {
                    echo "<script> 
                    alert('Hapus data SUKSES!'); 
                    document.location='index.php'; 
                    </script>";
                }
            }
        }

    //COBAAAA tabel jurusan
    //jika tombol simpan diklik
    if(isset($_POST['b_simpan2']))
    {
        //pengujian apakah data akan diedit atau simpan baru
        if($_GET['hal2'] == "edit2")
        {
            //data akan diedit
            $edit2 = mysqli_query($koneksi, "UPDATE tbl_jurusan set  
            id_jurusan = '$_POST[tid_jurusan]',
            nama_jurusan = '$_POST[tnama_jurusan]'
            WHERE id_jurusan '$_GET[id]'      
            ");
            if($edit2) { //jika edit sukses
                echo "<script> 
                alert('Edit data SUKSES!'); 
                document.location='index.php'; 
                </script>";
            }else {
                echo "<script> 
                alert('Edit data GAGAL!'); 
                document.location='index.php'; 
                </script>";
            }
        }else
            {
            //data akan disimpan baru
            $simpan2 = mysqli_query($koneksi, "INSERT INTO tbl_jurusan (id_jurusan, nama_jurusan)
            VALUES ('$_POST[tid_jurusan]', '$_POST[tnama_jurusan]')");
            if($simpan2) { //jika simpan sukses
                echo "<script> 
                alert('Simpan data SUKSES!'); 
                document.location='index.php'; 
                </script>";
            }else {
                echo "<script> 
                alert('Simpan data GAGAL!'); 
                document.location='index.php'; 
                </script>";
            }
        }       
    }

    //edit tabel jurusan
    //pengujian jika tombol edit atau hapus diklik
    if(isset($_GET['hal2']))
    {
        //Pengujian saat edit data
        if($_GET['hal2'] == "edit2") 
        {
            //tampilkan data yang akan diedit
            $tampil2 = mysqli_query($koneksi, "SELECT * FROM tbl_jurusan WHERE id_jurusan = '$_GET[id]' ");
            $data2 = mysqli_fetch_array($tampil2);
            if($data2)
            {
                //jika data ditemukan maka data ditampung dulu kedalam variabel
                $vid_jur = $data2['id_jurusan'];
                $vn_jur = $data2['nama_jurusan'];
            }
        } else if ($_GET['hal2'] == "hapus2")
        {
            //persiapan hapus data
            $hapus2 = mysqli_query($koneksi, "DELETE FROM tbl_jurusan WHERE id_jurusan = '$_GET[id]' ");
            if ($hapus2) {
                echo "<script> 
                alert('Hapus data SUKSES!'); 
                document.location='index.php'; 
                </script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CRUD PHP & MySQL</title>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h3 class="text-center">Praktek KK4a PHP & MySQL menggunakan bootstrap</h3>
        <h4 class="text-center">Noviana Retno Pinasti</h4>

        <!--Awal Card Form-->
        <div class="card mt-3">
            <div class="card-header bg-primary text-white ">
                Form Input Data Siswa
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label>ID Siswa</label>
                        <input type="text" name="tid_siswa" value="<?=@$vid_siswa?>" class="form-control" placeholder="Input id siswa" required>
                    </div>
                    <div class="form-group">
                        <label>NIS</label>
                        <input type="text" name="tnis" value="<?=@$vnis?>" class="form-control" placeholder="Input nis" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Siswa</label>
                        <input type="text" name="tnama_siswa" value="<?=@$vnama_siswa?>" class="form-control" placeholder="Input nama siswa" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <input type="text" name="tjk" value="<?=@$vjenis_kelamin?>" class="form-control" placeholder="Input jenis kelamin" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="talamat" placeholder="Input alamat siswa"><?=@$valamat?></textarea>
                    </div>
                    <div class="form-group">
                        <label>ID Jurusan</label>
                        <input type="text" name="tid_jurusan" value="<?=@$vid_jur?>" class="form-control" placeholder="Input id jurusan" required>
                    </div>
                    <button type="submit" class="btn btn-success  mt-3" name="b_simpan">Save</button>
                    <button type="reset" class="btn btn-danger  mt-3" name="b_reset">Reset</button>
                </form>
        </div>
    </div>
<!--Akhir Card Form-->

<!--Awal Card Form-->
<div class="card mt-3">
            <div class="card-header bg-primary text-white ">
                Form Input Data Jurusan Siswa
            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label>ID Jurusan</label>
                        <input type="text" name="tid_jurusan" value="<?=@$vid_jur?>" class="form-control" placeholder="Input id jurusan" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Jurusan</label>
                        <select class="form-control" name="tnama_jurusan">
                            <option value="<?=@$vn_jur?>"><?=@$vn_jur?></option>
                            <option value="RPL">RPL</option>
                            <option value="TKJ">TKJ</option>
                            <option value="TJA">TJA</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success  mt-3" name="b_simpan2">Save</button>
                    <button type="reset" class="btn btn-danger  mt-3" name="b_reset2">Reset</button>
                </form>
        </div>
    </div>
<!--Akhir Card Form-->

<!--Awal Card Tabel-->
<div class="card mt-3">
        <div class="card-header bg-primary text-white ">
            Tabel Data Siswa
         </div>
         <div class="card-body">
             <form method="get" action="search.php">
                 <label for="cari"> Cari Data :   </label>
                 <input type="text" name="cari">
                </form> 
                <br>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>ID Siswa</th>
                        <th>NIS</th>
                        <th>Nama Siswa</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>ID Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        //tampilkan data dari tabel buku
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tbl_buku order by id_siswa asc");
                        while($data = mysqli_fetch_array($tampil)) :
                    ?>
                        <tr>
                            <td><?=$no++;?></td>
                            <td><?=$data['id_siswa']?></td>
                            <td><?=$data['nis']?></td>
                            <td><?=$data['nama_siswa']?></td>
                            <td><?=$data['jenis_kelamin']?></td>
                            <td><?=$data['alamat']?></td>
                            <td><?=$data['id_jurusan']?></td>
                            <td>
                                <a href="index.php?hal=edit&id=<?=$data['id_siswa']?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?hal=hapus&id=<?=$data['id_siswa']?>"
                                onClick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger" name="id_siswa"> Delete </a>
                            </td>
                        </tr>
                        <?php endwhile;//penutup perulangan while?>
                    </table>      
        </div>
    </div>
<!--Akhir Card Form-->

<!--Awal Card Tabel-->
<div class="card mt-3">
        <div class="card-header bg-primary text-white ">
            Tabel Data Jurusan Siswa
         </div>
         <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>ID Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                        //tampilkan data dari tabel buku
                        $no2 = 1;
                        $tampil2 = mysqli_query($koneksi, "SELECT * FROM tbl_jurusan order by id_jurusan asc");
                        while($data2 = mysqli_fetch_array($tampil2)) :
                    ?>
                        <tr>
                            <td><?=$no2++;?></td>                           
                            <td><?=$data2['id_jurusan']?></td>
                            <td><?=$data2['nama_jurusan']?></td>
                            <td>
                                <a href="index.php?hal=edit2&id=<?=$data2['id_jurusan']?>" class="btn btn-warning">Edit</a>
                                <a href="index.php?hal=hapus2&id=<?=$data2['id_jurusan']?>"
                                onClick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger" name="id_jurusan"> Delete </a>
                            </td>
                        </tr>
                        <?php endwhile;//penutup perulangan while?>
                    </table>      
        </div>
    </div>
<!--Akhir Card Form-->
</div>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
</body>
</html>