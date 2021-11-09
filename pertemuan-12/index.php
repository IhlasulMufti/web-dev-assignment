<!--koneksi database-->
<?php
$server = "localhost";
$user = "root";
$pass = "";
$database = "dbpertemuan12";

$koneksi = mysqli_connect($server, $user,  $pass, $database) or die(mysqli_error($koneksi));

//aktifkan tombol simpan
if (isset($_POST['bsimpan'])) {
    if ($_GET['hal'] == "edit") {
        $edit = mysqli_query($koneksi, "UPDATE tmhs set 
        nim='$_POST[tnim]',
        nama='$_POST[tnama]',
        alamat='$_POST[talamat]',
        prodi='$_POST[tprodi]'
        WHERE id_mhs = '$_GET[id]'
        ");
        if ($edit) {
            echo "<script>
            alert('Edit Data Sukses!');
            document.location='index.php';
            </script>";
        } else {
            echo "<script>
            alert('Edit Data Gagal!');
            document.location='index.php';
            </script>";
        }
    } else {
        $simpan = mysqli_query($koneksi, "INSERT INTO tmhs (nim, nama, alamat, prodi)
        VALUES('$_POST[tnim]', '$_POST[tnama]', '$_POST[talamat]', '$_POST[tprodi]')");
        if ($simpan) {
            echo "<script>
                alert('Simpan Data Sukses!');
                document.location='index.php';
                </script>";
        } else {
            echo "<script>
                alert('Simpan Data Gagal!');
                document.location='index.php';
                </script>";
        }
    }
}

if (isset($_GET['hal'])) {
    if ($_GET['hal'] == "edit") {
        $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs WHERE id_mhs = '$_GET[id]'");
        $data = mysqli_fetch_array($tampil);
        if ($data) {
            $vnim = $data['nim'];
            $vnama = $data['nama'];
            $valamat = $data['alamat'];
            $vprodi = $data['prodi'];
        }
    } else if ($_GET['hal'] == "hapus") {
        $hapus = mysqli_query($koneksi, "DELETE FROM tmhs WHERE id_mhs='$_GET[id]'");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>PERTEMUAN 12</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>

<body>

    <div class="bg-success text-white p-4 mb-2">
        <img class="float-start img-fluid" src="NicePng_indonesia-flag-png_5535871.png" width="100" height="100">
        <h1 class="text-center">PERTEMUAN 12</h1>
        <h2 class="text-center">Pembuatan CRUD</h2>
    </div>

    <div class="container p-5">
        <h3>Pendaftaran Mahasiswa</h3>
        <!--Awal Card Form-->
        <div class="card border-info mb-3">
            <div class="card-header">Form Input Siswa</div>
            <div class="card-body">
                <form method="POST" action="">
                    <div>
                        <label>NIM</label>
                        <input type="text" name="tnim" value="<?= @$vnim ?>" class="form-control" placeholder="Input NIM Anda" required>
                    </div>
                    <div>
                        <label>NAMA</label>
                        <input type="text" name="tnama" value="<?= @$vnama ?>" class="form-control" placeholder="Input Nama Anda" required>
                    </div>
                    <div>
                        <label>ALAMAT</label>
                        <textarea name="talamat" class="form-control" placeholder="Input Alamat Anda" required><?= @$valamat ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>PRODI</label>
                        <select class="form-control" name="tprodi">
                            <option value=""><?= @$vprodi ?></option>
                            <option value="S1-MT">S1-MT</option>
                            <option value="S1-SI">S1-SI</option>
                            <option value="S1-AK">S1-AK</option>
                        </select>
                    </div>

                    <div class="py-3">
                        <button type="submit" class="btn btn-success" name="bsimpan">Simpan</button>
                        <button type="reset" class="btn btn-danger" name="breset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Akhir Card Form-->

    <div class="bg-secondary p-5">
        <!--Awal Card Form-->
        <div class="card border-info mb-3">
            <div class="card-header">Daftar Mahasiswa</div>
            <div class="card-body">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>
                            <th>ALAMAT</th>
                            <th>PROGRAM STUDI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody class="table-success">
                        <?php
                        $no = 1;
                        $tampil = mysqli_query($koneksi, "SELECT * FROM tmhs order by id_mhs desc");
                        while ($data = mysqli_fetch_array($tampil)) :
                        ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $data['nim']; ?></td>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['alamat']; ?></td>
                                <td><?= $data['prodi']; ?></td>
                                <td>
                                    <a href="index.php?hal=edit&id=<?= $data['id_mhs'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="index.php?hal=hapus&id=<?= $data['id_mhs'] ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--Akhir Card Form-->
    </div>


    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>

</html>