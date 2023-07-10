<?php 
 if($_GET['aksi']=='home'){ ?>
<section class="content">
          <h2 class="page-header">Harga <?php echo"$k_k[nama]";?></h2>
          <div class="row">
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Harga</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapstree">
                           harga <?php echo"$k_k[nama]";?> 
                          </a>
                        </h4>
                      </div>
                      <div id="collapstree" class="panel-collapse collapse in">
                        <div class="box-body">
                          Harga <?php echo"$k_k[nama]";?> adalah untuk isi ulang Rp.6.000 
                        </div>
                      </div>
                    </div>
            
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">Isikan Data Anda untuk Booking isi ulang <?php echo"$k_k[nama]";?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
				<div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                           Belum Pernah daftar silahkan Register
                          </a>
                        </h4>
                      </div>
                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="box-body">
						<form action="booking.php?aksi=inputkonsumen" method="post">
				<label>Nama</label>
                                                    <input type='text' class='form-control' name='nama_konsumen'/><br>
                                                    <label>No Hp</label>
                                                    <input type='text' class='form-control' name='no_hp'/><br>
                                                    <label>Email</label>
                                                    <input type='email' class='form-control' name='email_konsumen'/><br>
                                                    <label>Alamat Lengkap</label>
                                                    <input type='text' class='form-control' name='alamat'/><br>
                                                    <button type='submit' class='btn btn-primary'>SIMPAN </button>
        </form>
					    </div>
                      </div>
                    </div>
                    <div class="panel box box-danger">
                      <div class="box-header with-border">
                        <h4 class="box-title">
                          <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            sudah punya akun silakhan login
                          </a>
                        </h4>
                      </div>
                      <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="box-body">
						<form action="booking.php?aksi=login" method="post">
                                                    <label>No Hp</label>
                                                    <input type='text' class='form-control' name='no_hp'/><br>
                                                    <label>Email</label>
                                                    <input type='email' class='form-control' name='email_konsumen'/><br>
                                                    <button type='submit' class='btn btn-primary'>login </button>
                        </form>
					   </div>
                      </div>
                    </div>
                   
                  </div>

				

                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
          <!-- END ACCORDION & CAROUSEL-->
          </section><!-- /.content -->
<?php } 
 elseif ($_GET['aksi'] == 'inputkonsumen') {
    // Memeriksa apakah input kosong
    if (empty($_POST['nama_konsumen']) || empty($_POST['no_hp']) || empty($_POST['email_konsumen']) || empty($_POST['alamat'])) {
        echo "<script>window.alert('Data yang Anda isikan belum lengkap');
        window.location=('booking.php?aksi=home')</script>";
        exit();
    }
    
    $nama_konsumen = $_POST['nama_konsumen'];
    $no_hp = $_POST['no_hp'];
    $email_konsumen = $_POST['email_konsumen'];
    $alamat = $_POST['alamat'];
    
    mysqli_query($koneksi, "INSERT INTO konsumen (nama_konsumen, no_hp, email_konsumen, alamat) 
    VALUES ('$nama_konsumen', '$no_hp', '$email_konsumen', '$alamat')");  
    
    $login = mysqli_query($koneksi, "SELECT * FROM konsumen WHERE email_konsumen='$email_konsumen'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        session_start();
        $data = mysqli_fetch_assoc($login);
        $_SESSION['id'] = $data['id_konsumen'];
        $_SESSION['nama'] = $data['nama_konsumen'];
        $_SESSION['hp'] = $data['no_hp'];
        $_SESSION['email'] = $data['email_konsumen'];
        echo "<script>window.alert('Input data sukses dan login');
        window.location=('booking.php?aksi=booking')</script>";
    } else {
        echo "<script>window.alert('Gagal input data');
        window.location=('booking.php?aksi=home')</script>";
    }
}
elseif ($_GET['aksi'] == 'login') {
    // Memeriksa apakah data kosong
    $nama_konsumen = $_POST['nama_konsumen'];
    $no_hp = $_POST['no_hp'];
    $email_konsumen = $_POST['email_konsumen'];
    $alamat = $_POST['alamat'];
    
    $login = mysqli_query($koneksi, "SELECT * FROM konsumen WHERE email_konsumen='$email_konsumen' and no_hp = '$no_hp'");
    $cek = mysqli_num_rows($login);

    if ($cek > 0) {
        session_start();
        $data = mysqli_fetch_assoc($login);
        $_SESSION['id'] = $data['id_konsumen'];
        $_SESSION['nama'] = $data['nama_konsumen'];
        $_SESSION['hp'] = $data['no_hp'];
        $_SESSION['email'] = $data['email_konsumen'];
        echo "<script>window.alert('sukses login');
        window.location=('booking.php?aksi=booking')</script>";
    } else {
        echo "<script>window.alert('Gagal input data');
        window.location=('booking.php?aksi=home')</script>";
    }
}
		
elseif($_GET['aksi']=='booking'){ 
	function generateBookingCode($length = 7) {
		$characters = '0123456789';
		$code = '';
		for ($i = 0; $i < $length; $i++) {
			$index = rand(0, strlen($characters) - 1);
			$code .= $characters[$index];
		}
		return $code;
		}
		// Contoh penggunaan
		$bookingCode = generateBookingCode();	
echo"
<section class='content'>
<h2 class='page-header'>PILIH ISI ULANG DEPOT</h2>
           <div class='row'>
                <div class='col-lg-12'>
                       
                                    <div class='modal-dialog'>
                                        <div class='modal-content'>
                                            <div class='modal-header'>
                                                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                                                <h4 class='modal-title' id='H3'>Input Data</h4>
                                            </div>
                                            <div class='modal-body'>
                                               <form role='form' method='post' action='booking.php?aksi=inputbooking'>
                                               <label>Lokasi anda </label>
                                               <input type='text' class='form-control' id='latitude' name='latitude' readonly/>
                                               <label>Lokasi anda </label>
                                               <input type='text' class='form-control' id='longitude' name='longitude' readonly/>
                                               <label>Kode Booking</label>
                                               <input type='text' class='form-control' value='$bookingCode'  disabled/>
                                               <input type='hidden' class='form-control' value='$bookingCode' name='kode_booking'>
                                               <div class='form-group'>
                                               <label>Pilih Produk</label>
                                               <select class='form-control select2' style='width: 100%;' name=id_produk>
                                               <option value='' selected>Pilih Produk</option>"; 
                                                $sql=mysqli_query($koneksi,"SELECT * FROM produk ORDER BY id_produk");
                                                while ($c=mysqli_fetch_array($sql))
                                                {
                                                   echo "<option value=$c[id_produk]>$c[nama_produk]</option>";
                                                }
                                                   echo "
                                               </select><br>
											   <label>QTY BELI GALON DAN ISI</label>
											   <input type='number' class='form-control' name='isibaru' /><br>
											   <label>QTY ISI GALON</label>
											   <input type='number' class='form-control' name='isiulang' /><br>
                            
												<input type='hidden' class='form-control' value='$_SESSION[id]' name='id_konsumen'/><br>
                                                <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                                                <button type='submit' class='btn btn-primary'>Save </button>
                                            </div>
                       					 </form>
                                        </div>
                                    </div>
                                </div>
                       
                </div>	
			</div>				
</section><
";
}
elseif($_GET['aksi']=='inputbooking'){
  $currentDate = date('d-m-Y');
	// Memeriksa apakah input kosong
	if (empty($_POST[id_konsumen]) || empty($_POST[id_produk])) {
		echo "<script>window.alert('Data yang Anda isikan belum lengkap');
		window.location=('booking.php?aksi=booking')</script>";
		exit();
	}	
	mysqli_query($koneksi,"insert into booking (id_konsumen,kode_booking,id_produk,tgl_booking,isibaru,isiulang,latitude,longitude,status) 
	values ('$_POST[id_konsumen]','$_POST[kode_booking]','$_POST[id_produk]','$currentDate','$_POST[isibaru]','$_POST[isiulang]','$_POST[latitude]','$_POST[longitude]','unpaid')");  
	echo "<script>window.location=('booking.php?aksi=detailbooking&kode_booking=$_POST[kode_booking]')</script>";
}

elseif($_GET['aksi']=='detailbooking'){
$sql=mysqli_query($koneksi," SELECT * FROM booking,konsumen,produk WHERE booking.id_konsumen=konsumen.id_konsumen AND booking.id_produk=produk.id_produk AND booking.kode_booking=$_GET[kode_booking]");
$t=mysqli_fetch_array($sql);
$harga_format = number_format($t[harga_produk], 0, ',', '.');
$isibaru =$t[harga_produk1]*$t[isibaru];
$isiulang =$t[harga_produk]*$t[isiulang];
$jml =$t[isibaru]+$t[isiulang];
$total=$isibaru+$isiulang;
$isibaru_rp = number_format($isibaru, 0, ',', '.');
$isiulang_rp = number_format($isiulang, 0, ',', '.');
$total_rp = number_format($total, 0, ',', '.');

// abil data QR Code
require_once 'qrcode/qrlib.php';
// Data yang akan dijadikan QR Code
$data = $t[kode_booking]; // Ganti dengan data yang diinginkan

// Nama berkas QR Code yang akan dihasilkan
$kode_booking = $t['kode_booking'];

// Nama berkas QR Code yang akan dihasilkan
$filename = $kode_booking . '.png';


// Path penyimpanan berkas QR Code
$filepath = 'qrcode/gambar/' . $filename;

// Ukuran dan level koreksi kesalahan QR Code
$size = 10;
$level = 'L';

// Generate QR Code
QRcode::png($data, $filepath, $level, $size);
$date = date('Y-m-d H:i:s');
echo"
<section class='invoice'>
<!-- title row -->
<div class='row'>
  <div class='col-xs-12'>
	<h2 class='page-header'>
	  <i class='fa fa-globe'></i> $k_k[alias] $k_k[nama]
	  <small class='pull-right'>Date: $date</small>
	</h2>
  </div><!-- /.col -->
</div>
<!-- info row -->
<div class='row invoice-info'>
  <div class='col-sm-4 invoice-col'>
	Pemesan
	<address>
	  <strong>$_SESSION[nama]</strong><br>
	  $_SESSION[alamat]<br>
	  Phone: $_SESSION[hp]<br>
	  Email: $_SESSION[email]
	</address>
  </div><!-- /.col -->
 

<!-- Table row -->
<div class='row'>
  <div class='col-xs-12 table-responsive'>
	<table class='table table-striped'>
	  <thead>
		<tr>
		  <th>Produk</th>
		  <th>isiulang</th>
		  <th>Galon Baru</th>
		  <th>Subtotal</th>
		</tr>
	  </thead>
	  <tbody>
		<tr>
		  <td>$t[nama_produk]</td>
		  <td>$t[isiulang]</td>
		  <td>$t[isibaru]</td>
		  <td>$total_rp</td>
		</tr>
	  </tbody>
	</table>
  </div><!-- /.col -->
</div><!-- /.row -->

<div class='row'>
  <!-- accepted payments column -->
  <div class='col-xs-6'>
	<p class='lead'>Metode Pembayaran:</p>
	<img src='sys/bootstrap/dist/img/credit/bank.png' alt='Visa'>
	<img src='sys/bootstrap/dist/img/credit/dana.png' alt='Mastercard'>

	<p class='text-muted well well-sm no-shadow' style='margin-top: 10px;'>
	  silahakn melakukn pembayaran di rekening bank atau akun dana kami, untuk pengantaran 
";

	  $sql=mysqli_query($koneksi,"SELECT * FROM pembayaran ORDER BY id_bayar");
                                                while ($c=mysqli_fetch_array($sql))
                                                {
                                                   echo "
												   <div class='box box-success'>
													 <div class='box-header with-border'>
													   <h3 class='box-title'>$c[metode_bayar]</h3>
													   <div class='box-tools pull-right'>
														 <button class='btn btn-box-tool' data-widget='remove'><i class='fa fa-times'></i></button>
													   </div><!-- /.box-tools -->
													 </div><!-- /.box-header -->
													 <div class='box-body'>
													 $c[nomor_bayar]-$c[atas_nama]
													 </div><!-- /.box-body -->
												   </div><!-- /.box -->
												 ";
       }
	echo"</p></br>";
	if($t[status]=='unpaid'){
		echo"<a href='booking.php?aksi=konfirmasi&kode_booking=$t[kode_booking]' class='btn btn-primary'>KONFIRMASI PEMBAYARAN </a>";
	} else {
		echo"<a href='booking.php?aksi=produk' class='btn btn-primary'>SUDAH DI BAYAR </a>
    <a href='booking.php?aksi=lamaabc&id_booking=$t[id_booking]' class='btn btn-primary'>Cek Estimasi Pengiriman </a>";
	}
	echo"
	<a href='booking.php?aksi=produk' class='btn btn-primary'>Kembali </a>
  </div><!-- /.col -->
  <div class='col-xs-6'>
	<p class='lead'>STATUS BAYAR: $t[status]</p>
	<div class='table-responsive'>
	  <table class='table'>
		<tr>
		  <th style='width:50%'>total produk isibaru:</th>
		  <td>Rp. $isibaru_rp </td>
		</tr>
		<tr>
		  <th>total produk isiulang</th>
		  <td>Rp. $isiulang_rp</td>
		</tr>
		<tr>
		  <th>Jumlah Produk</th>
		  <td>$jml</td>
		</tr>
		<tr>
		  <th>sub Total Bayar:</th>
		  <td>Rp. $total_rp</td>
		</tr>
	  </table>
	</div>
  </div><!-- /.col -->";
  if($t[status]=='unpaid'){
	
} else {
	echo"<img src='$filepath' alt='QR Code'>";
}
  echo"
</div><!-- /.row -->
</section>
";
}
elseif($_GET['aksi']=='lamaabc'){
	echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            <div class='panel-body'>	
                            <a href='booking.php?aksi=produk'  class='btn btn-info' >Kembali</span></a></br></br>
                            <table id='example1' class='table table-bordered table-striped'>
                            <thead>
                                <tr> <th>No</th>
                                    <th>Lama Pengiriman</th>
                                    <th>Status Pengiriman</th>	 
                                </tr>
                            </thead><tbody>
            ";
    
$no=0;
$sql=mysqli_query($koneksi," SELECT * FROM estimasi WHERE  id_booking='$_GET[id_booking]' AND id_konsumen='$_SESSION[id]' ORDER BY id_estimasti ASC");
while ($t=mysqli_fetch_array($sql)){	
$no++;
                            echo"
                                <tr><td>$no</td>
                                    <td>$t[lama_estimasti]</td>
                                    <td>$t[status_estimasti]</td> 
            
                                </tr>";
}
                        echo"
                            </tbody></table>
                            </div>
                        </div>
        </div>";
}
elseif($_GET['aksi']=='produk'){
	echo"<div class='row'>
                    <div class='col-lg-12'>
                        <div class='panel panel-default'>
                            <div class='panel-heading'>INFORMASI 
                            </div>
                            <div class='panel-body'>	
               <a href='booking.php?aksi=booking'  class='btn btn-info' >PESAN LAGI</span></a></br></br>
                                   <div class='table-responsive'>		
         <table id='example1' class='table table-bordered table-striped'>
                                        <thead>
                                            <tr> <th>No</th>
                                                <th>Nama Pengunjung</th>
                                                <th>Nama Produk</th>	 
												<th>Status Bayar</th>	
                                                <th>AKSI</th>	
                                            </tr>
                                        </thead><tbody>
                        ";
                
    $no=0;
    $sql=mysqli_query($koneksi," SELECT * FROM booking,konsumen,produk WHERE booking.id_konsumen=konsumen.id_konsumen AND booking.id_produk=produk.id_produk AND konsumen.id_konsumen='$_SESSION[id]' ORDER BY booking.id_booking ASC");
    while ($t=mysqli_fetch_array($sql)){	
    $no++;
                                        echo"
                                            <tr><td>$no</td>
                                                <td>$t[nama_konsumen]</td>
                                                <td>$t[nama_produk]</td> 
												<td><button type='button' class='btn btn-danger'>$t[status]</button></td> 
                                <td><a class='btn btn-info' href='booking.php?aksi=detailbooking&kode_booking=$t[kode_booking]'><i class='fa fa-eye'></i>lihat</a></td>
                                            </tr>";
    }
                                    echo"
                                        </tbody></table>
                                </div>
                            </div>
                        </div>
                    </div>
                   </div>";			
}
elseif($_GET['aksi']=='konfirmasi'){
	$sql=mysqli_query($koneksi," SELECT * FROM booking,konsumen,produk WHERE booking.id_konsumen=konsumen.id_konsumen AND booking.id_produk=produk.id_produk AND booking.kode_booking=$_GET[kode_booking]");
	$t=mysqli_fetch_array($sql);
	$harga_format = number_format($t[harga_produk], 0, ',', '.');
	$isibaru =$t[harga_produk1]*$t[isibaru];
	$isiulang =$t[harga_produk]*$t[isiulang];
	$jml =$t[isibaru]+$t[isiulang];
	$total=$isibaru+$isiulang;
	$isibaru_rp = number_format($isibaru, 0, ',', '.');
	$isiulang_rp = number_format($isiulang, 0, ',', '.');
	$total_rp = number_format($total, 0, ',', '.');	
	echo"
	<section class='content'>
	<h2 class='page-header'>PILIH</h2>
			   <div class='row'>
					<div class='col-lg-12'>
						   
										<div class='modal-dialog'>
											<div class='modal-content'>
												<div class='modal-header'>
													<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
													<h4 class='modal-title' id='H3'>Input Data</h4>
												</div>
												<div class='modal-body'>
												   <form role='form' method='POST' enctype='multipart/form-data' action='booking.php?aksi=inputkonfirmasi'>
												   <label>Total Bayar</label>
												   <input type='text' class='form-control' value='Rp.$total_rp'  disabled/>
												   <input type='hidden' class='form-control' value='$t[id_booking]' name='id_booking'>
												   <div class='form-group'>
												   <label>Pilih metode Pembayaran</label>
												   <select class='form-control select2' style='width: 100%;' name=id_bayar>
												   <option value='' selected>Pilih metode Pembayaran</option>"; 
													$sql=mysqli_query($koneksi,"SELECT * FROM pembayaran ORDER BY id_bayar");
													while ($c=mysqli_fetch_array($sql))
													{
													   echo "<option value=$c[id_bayar]>$c[metode_bayar]-$c[nomor_bayar]</option>";
													}
													   echo "
												   </select><br>
												   <label>Bukti Bayar</label>
												   <input type='file' class='form-control' name='bukti' required/><br>
													<a href='booking.php?aksi=produk' class='btn btn-default'>Kembali</a>
													<button type='submit' class='btn btn-primary' name='submit'>Save </button>
												</div>
												</form>
											</div>
										</div>
									</div>
						   
					</div>	
				</div>				
	</section><
	";
}
elseif($_GET['aksi']=='inputkonfirmasi'){
	if (isset($_POST['submit'])) {
		// Mengambil informasi file yang diupload
		$namaFile = $_FILES['bukti']['name'];
		$ukuranFile = $_FILES['bukti']['size'];
		$error = $_FILES['bukti']['error'];
		$tmpName = $_FILES['bukti']['tmp_name'];
	
		// Mengambil tanggal saat ini
		$tgl = date("Y-m-d");
	
		// Mendapatkan ekstensi file
		$ekstensiFile = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));
	
		// Menentukan lokasi penyimpanan file
		$folderTujuan = "foto/data/"; // Ganti dengan folder tujuan yang diinginkan
	
		// Menghasilkan nama file baru dengan format: id_bayar_tgl.ekstensi
		$namaFileBaru = $_POST['id_bayar'] . "_" . $tgl . "." . $ekstensiFile;
	
		// Memeriksa apakah file sudah diupload dengan sukses
		if ($error === 0) {
			// Memindahkan file ke lokasi tujuan
			move_uploaded_file($tmpName, $folderTujuan . $namaFileBaru);
	
			// Menyimpan informasi file ke dalam database
			$query = "INSERT INTO konfirmasi (id_booking,id_bayar, bukti, tgl,status_bayar) VALUES ('$_POST[id_booking]','$_POST[id_bayar]', '$namaFileBaru', '$tgl', 'lunas')";
			mysqli_query($koneksi, $query);
			
	
			echo "<script>window.alert('Data bersharil di simpan');
		window.location=('booking.php?aksi=produk')</script>";
		} else {
			echo "<script>window.alert('Terjadi kesalahan saat mengupload file');
		window.location=('booking.php?aksi=konfirmasi')</script>";
		}
	}	
}
elseif($_GET['aksi']=='logout'){
	session_start();
session_destroy();
echo "<script>window.alert('anda telah keluar');
		window.location=('booking.php?aksi=home')</script>";
}
?>

