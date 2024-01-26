<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$judul = $pengarang = $penerbit = $tahun = $jumlah = $harga = $detail = "";
$judul_err = $pengarang_err = $penerbit_err =  $tahun_err = $jumlah_err =  $harga_err = $detail_err ="";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate judul
    $input_judul = trim($_POST["judul"]);
    if(empty($input_judul)){
        $judul_err = "Isi Judul Buku";
    } else{
        $judul = $input_judul;
    }

    // Validate nama pengarang
    $input_pengarang = trim($_POST["pengarang"]);
    if(empty($input_pengarang)){
        $pengarang_err = "Isi Nama pengarang";
    } else{
        $pengarang = $input_pengarang;
    }

     // Validate nama penerbit
     $input_penerbit = trim($_POST["penerbit"]);
     if(empty($input_penerbit)){
         $penerbit_err = "Isi Nama Penerbit";
     } else{
         $penerbit = $input_penerbit;
     }

     // Validate nama tahun
     $input_tahun = trim($_POST["tahun"]);
     if(empty($input_tahun)){
         $tahun_err = "Isi Tahun Penerbit";
     } else{
         $tahun = $input_tahun;
     }
     
     // Validate nama jumlah halaman
     $input_jumlah = trim($_POST["jumlah"]);
     if(empty($input_jumlah)){
         $jumlah_err = "Isi Jumlah Halaman";
     } else{
         $jumlah = $input_jumlah;
     }

     // Validate harga buku
     $input_harga = trim($_POST["harga"]);
     if(empty($input_harga)){
         $harga_err = "Isi Harga Buku";
     } else{
         $harga = $input_harga;
     }

     
     // Validate detail buku
     $input_detail = trim($_POST["detail"]);
     if(empty($input_detail)){
         $detail_err = "Isi Detail Buku";
     } else{
         $detail = $input_detail;
     }

    

    // Check input errors before inserting in database
    if(empty($judul_err) && empty($pengarang_err) && empty($penerbit_err) && empty($tahun_err) && empty($jumlah_err) && empty($harga_err) && empty($detail_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO tabel_buku (judul, pengarang, penerbit, tahun, jumlah, harga, detail) VALUES (?, ?, ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_judul, $param_pengarang, $param_penerbit, $param_tahun, $param_jumlah, $param_harga, $param_detail );

            // Set parameters
            $param_judul = $judul;
            $param_pengarang = $pengarang;
            $param_penerbit = $penerbit;
            $param_tahun = $tahun;
            $param_jumlah = $jumlah;
            $param_harga = $harga;
            $param_detail = $detail;
            

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Tambah Record</h2>
                    </div>
                    <p>Silahkan isi form di bawah ini kemudian submit untuk menambahkan data Buku ke dalam database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        
                        <div class="form-group <?php echo (!empty($judul_err)) ? 'has-error' : ''; ?>">
                                <label>Judul Buku</label>
                            <input type="text" name="judul" class="form-control" value="<?php echo $judul; ?>">
                            <span class="help-block"><?php echo $judul_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($pengarang_err)) ? 'has-error' : ''; ?>">
                            <label>Nama Pengarang</label>
                            <input type="text" name="pengarang" class="form-control" value="<?php echo $pengarang; ?>">
                            <span class="help-block"><?php echo $pengarang_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($penerbit_err)) ? 'has-error' : ''; ?>">
                            <label>Nama Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" value="<?php echo $penerbit; ?>">
                            <span class="help-block"><?php echo $penerbit_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($tahun_err)) ? 'has-error' : ''; ?>">
                            <label>Tahun Penerbit</label>
                            <input type="text" name="tahun" class="form-control" value="<?php echo $tahun; ?>">
                            <span class="help-block"><?php echo $tahun_err;?></span>
                        </div>

                        
                        <div class="form-group <?php echo (!empty($jumlah_err)) ? 'has-error' : ''; ?>">
                            <label>Jumlah Halaman</label>
                            <input type="text" name="jumlah" class="form-control" value="<?php echo $jumlah; ?>">
                            <span class="help-block"><?php echo $jumlah_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($harga_err)) ? 'has-error' : ''; ?>">
                            <label>Harga Buku</label>
                            <input type="text" name="harga" class="form-control" value="<?php echo $harga; ?>">
                            <span class="help-block"><?php echo $harga_err;?></span>
                        </div>
                        
                        <div class="form-group <?php echo (!empty($detail_err)) ? 'has-error' : ''; ?>">
                            <label>Deskripsi Buku</label>
                            <textarea name="detail" class="form-control"><?php echo $detail; ?></textarea>
                            <span class="help-block"><?php echo $detail_err;?></span>
                        </div>
                        
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="home.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

