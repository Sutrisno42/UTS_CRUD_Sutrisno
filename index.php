<?php include "conn.php"; ?>
<?php
$kategoribarang = "";
$namabarang     = "";
$stok           = "";
$sukses         = "";
$error          = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

if ($op == 'delete') {
    $id             = $_GET['id'];
    $sql1           = "delete  from stokbarang where id ='$id'";
    $q1             = mysqli_query($connection, $sql1);
    if ($q1) {
        $sukses = "Data berhasil dihapus";
    } else {
        $error = "Gagal melakukan hapus data";
    }
}

if ($op == 'edit') {
    $id                = $_GET['id'];
    $sql1              = "select * from stokbarang where id = '$id'";
    $q1                = mysqli_query($connection, $sql1);
    $r1                = mysqli_fetch_array($q1);
    $kategoribarang    = $r1['kategoribarang'];
    $namabarang        = $r1['namabarang'];
    $stok              = $r1['stok'];

    if ($kategoribarang == '') {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $kategoribarang = $_POST['kategoribarang'];
    $namabarang     = $_POST['namabarang'];
    $stok           = $_POST['stok'];

    if ($kategoribarang && $namabarang && $stok) {
        if ($op == 'edit') {    //untuk update data
            $sql1 = "Update stokbarang set kategoribarang = '$kategoribarang', namabarang = '$namabarang', stok = '$stok' where id = '$id'";
            $q1 = mysqli_query($connection, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error = "Data gagal diupdate";
            }
        } else {    //untuk insert data
            $sql1 = "insert into stokbarang(kategoribarang,namabarang,stok) values('$kategoribarang', '$namabarang', '$stok')";
            $q1 = mysqli_query($connection, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silahkan masukkan semua data";
    }
} else {
    $sukses = "Sukses";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <style>
        .mx-auto {
            width: 800px;
        }

        .card {
            margin-top: 10px;
        }

        body {
            background: radial-gradient(#F8ECD1, #DEB6AB);
        }

        h1 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="judul">DATA STOK BARANG MINIFROZ</h1>
    <div class="container">
        <div class="mx-auto">
            <div class="card">
                <div class="card-header text-white bg-secondary bg-gradient">
                    INPUT STOK
                </div>
                <div class="card-body">
                    <?php
                    if ($error) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $error ?>
                        </div>
                    <?php
                    }
                    ?>

                    <form action="" method="POST">
                        <div class="mb-3 row">
                            <label for="kategoribarang" class="col-sm-2 col-form-label">Kategori Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="kategoribarang" name="kategoribarang" value="<?php echo $kategoribarang ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="namabarang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="namabarang" name="namabarang" value="<?php echo $namabarang ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="stok" name="stok" value="<?php echo $stok ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" name="simpan" value="Simpan Data" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header text-white bg-secondary bg-gradient">
                    DAFTAR STOK TERSEDIA
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Kategoti Barang</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Jumlah Stok</th>
                                <th scope="col">Aksi <a href="index.php" class="btn btn-success">Tambah</a></th>
                            </tr>
                        <tbody>
                            <?php
                            $sql2 = "select * from stokbarang order by id desc";
                            $q2 = mysqli_query($connection, $sql2);
                            $urut = 1;
                            while ($r2 = mysqli_fetch_array($q2)) {
                                $id             = $r2['id'];
                                $kategoribarang = $r2['kategoribarang'];
                                $namabarang     = $r2['namabarang'];
                                $stok           = $r2['stok'];

                            ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?> </th>
                                    <td scope="row"><?php echo $kategoribarang ?></td>
                                    <td scope="row"><?php echo $namabarang ?></td>
                                    <td scope="row"><?php echo $stok ?></td>
                                    <td scope="row">
                                        <a href="index.php?op=edit&id=<?php echo $id ?>"><button type="button" class="btn btn-secondary">Update</button></a>
                                        <a href="index.php?op=delete&id=<?php echo $id ?>" onclick="return confirm('Wis yakin durung?')"><button type="button" class="btn btn-success">Delete</button></a>

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>