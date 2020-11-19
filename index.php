<?php
include "database.php";
$que = mysqli_query($db_conn, "SELECT * FROM un_konfigurasi");
$hsl = mysqli_fetch_array($que);
$timestamp = strtotime($hsl['tgl_pengumuman']);
//echo $timestamp;

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/png" href="favicon.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="aplikasi sederhana untuk menampilkan pengumuman hasil ujian nasional secara online">
    <meta name="author" content="slamet.bsan@gmail.com">
    <title>Pengumuman KJP dan PIP</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/jasny-bootstrap.min.css" rel="stylesheet">
	<link href="css/kelulusan.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="./">Penerima KJP/PIP <?=$hsl['sekolah'] ?></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
              <ul class="nav navbar-nav navbar-right">
                <li><a href="./">Home</a></li>
                <!-- <li><a href="#about">About</a></li> -->
                <!-- <li><a href="#contact">Contact</a></li> -->
              </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
    
    <div class="container">
        <!-- <h2 align="center">Pengumuman Kelulusan 
<?=$hsl['tahun'] ?></h2> -->
        <h3 align="center" style="font-weight: bold;">Pengumuman Penerima KJP dan KIP</h3>
        <h3 align="center" style="font-weight: bold;">SMP IT - SMA - SMK YP IPPI Petojo</h3>
		<!-- countdown -->
		
		<div id="clock" class="lead"></div>
		
		<div id="xpengumuman">
<?php
	if(isset($_REQUEST['submit']))
	{
		$jenjang = $_REQUEST['jenjang'];
		$program = $_REQUEST['program'];

		// var_dump($jenjang);
		// die();

		if(empty($jenjang))
		{
?>
			<center><h1 style="color:red; font-weight: bolder;">Pilih Jenjang dan Program</h1></center>
    
		    <form method="post">
		    	<center>
		        <div class="input-group">
		            <select name="jenjang" class="form-control">
		            	<option value="" selected>-Pilih Jenjang-</option>
		            	<option value="smp">SMP IT</option>
		            	<option value="sma">SMA</option>
		            	<option value="smk">SMK</option>
		            </select>
		            <select name="program" class="form-control">
		            	<option value="" selected>-Pilih Program-</option>
		            	<option value="kjp20191">KJP 2019 Tahap 1</option>
		            	<option value="kjp20192">KJP 2019 Tahap 2</option>
		            	<option value="kjp20201">KJP 2020 Tahap 1</option>
		            	<option value="pip2020">PIP 2020</option>
		            </select>
		                <button class="btn btn-primary btn-block" type="submit" name="submit">Periksa!</button>
		        </div>
		        </center>
		    </form>
<?php			
		}
		elseif(empty($program))
		{
?>
			<center><h1 style="color:red; font-weight: bolder;">Pilih Jenjang dan Program</h1></center>
    
		    <form method="post">
		    	<center>
		        <div class="input-group">
		            <select name="jenjang" class="form-control">
		            	<option value="" selected>-Pilih Jenjang-</option>
		            	<option value="smp">SMP IT</option>
		            	<option value="sma">SMA</option>
		            	<option value="smk">SMK</option>
		            </select>
		            <select name="program" class="form-control">
		            	<option value="" selected>-Pilih Program-</option>
		            	<option value="kjp20191">KJP 2019 Tahap 1</option>
		            	<option value="kjp20192">KJP 2019 Tahap 2</option>
		            	<option value="kjp20201">KJP 2020 Tahap 1</option>
		            	<option value="pip2020">PIP 2020</option>
		            </select>
		                <button class="btn btn-primary btn-block" type="submit" name="submit">Periksa!</button>
		        </div>
		        </center>
		    </form>
<?php
		}
		elseif (isset($jenjang)&&isset($program))
		{
			if ($jenjang == "smp")
			{
				if (strpos($program, "kjp")!== false)
				{
					$prog = substr($program, 0,3);
					$thn = substr($program, 3,4);
					$thp = substr($program, 7,1);
?>
					<center><h3>Daftar Penerima <?php echo strtoupper($prog); ?> Tahun <?php echo $thn; ?> Tahap <?php echo $thp; ?></h3></center>
					<table class="table table-bordered">
						<th>No.</th>
						<th>Nama</th>
						<th>Kelas</th>

						<tbody>
<?php
							$hasil = mysqli_query($db_conn,"SELECT * FROM kp_terima WHERE jenjang='$jenjang' AND prog = '$prog' AND tahun = '$thn' AND tahap = '$thp' ORDER BY nama ASC");

							if(mysqli_num_rows($hasil) > 0)
							{
								// $data = mysqli_fetch_array($hasil);
								$x=1;
								while ($row = mysqli_fetch_row($hasil))
								{	
															
								
?>									<tr>
										<td><?php echo $x; ?></td>
										<td><?php echo $row[3];?></td>
										<td><?php echo $row[2];?></td>
									</tr>
<?php
									$x++;
								}
							}
?>
						</tbody>
						
					</table>
					<a href='./' class='btn btn-primary btn-block'>Kembali</a>
<?php
				}
				else
				{
					$prog = substr($program, 0,3);
					$thn = substr($program, 3,4);
?>

					<center><h3>Daftar Penerima <?php echo strtoupper($prog); ?> Tahun <?php echo $thn; ?></h3></center>
					<table class="table table-bordered">
						<th>No.</th>
						<th>Nama</th>
						<th>Kelas</th>

						<tbody>
<?php
							$hasil = mysqli_query($db_conn,"SELECT * FROM kp_terima WHERE jenjang='$jenjang' AND prog = '$prog' AND tahun = '$thn' ORDER BY nama ASC");

							if(mysqli_num_rows($hasil) > 0)
							{
								// $data = mysqli_fetch_array($hasil);
								$x=1;
								while ($row = mysqli_fetch_row($hasil))
								{							
								
?>									<tr>
										<td><?php echo $x; ?></td>
										<td><?php echo $row[3];?></td>
										<td><?php echo $row[2];?></td>
									</tr>
<?php
									$x++;
								}
							}
?>
						</tbody>
						
					</table>
					<a href='./' class='btn btn-primary btn-block'>Kembali</a>
<?php 
				}
			}
			else
			{
				echo "<center><h3>Belum ada data untuk ".strtoupper($jenjang)."</h3></center></br>";
				echo "<a href='./' class='btn btn-primary btn-block'>Kembali</a>";
			}
		}
	}
	else
	{
		//tampilkan form input nomor ujian
	?>
    <center><p>Pilih Jenjang dan Program.</p></center>
    
    <form method="post">
    	<center>
        <div class="input-group">
            <!-- <input type="text" name="nomor" class="form-control" data-mask="01-01-0058-9999-9" placeholder="Nomor Ujian" required> -->
            <!-- <input type="text" name="nisn" class="form-control" placeholder="NISN" required> -->
            <select name="jenjang" class="form-control">
            	<option value="" selected>-Pilih Jenjang-</option>
            	<option value="smp">SMP IT</option>
            	<option value="sma">SMA</option>
            	<option value="smk">SMK</option>
            </select>
            <select name="program" class="form-control">
            	<option value="" selected>-Pilih Program-</option>
            	<option value="kjp20191">KJP 2019 Tahap 1</option>
            	<option value="kjp20192">KJP 2019 Tahap 2</option>
            	<option value="kjp20201">KJP 2020 Tahap 1</option>
            	<option value="pip2020">PIP 2020</option>
            </select>
            <!-- <input type="text" name="tahun" class="form-control" placeholder="No. Ujian : K0101XXXXXXXXX / 01-0517-XXXX-X" required> -->
            <!-- <span class="input-group-btn"> -->
                <button class="btn btn-primary btn-block" type="submit" name="submit">Periksa!</button>
            <!-- </span> -->
        </div>
        </center>
    </form>
	<?php
	}
?>
		</div>
    </div><!-- /.container -->
	
	<footer class="footer">
		<div class="container">
			<p class="text-muted">&copy; <?=$hsl['tahun'] ?> &middot; Tim IT <?=$hsl['sekolah'] ?></p>
		</div>
	</footer>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script type="text/javascript">
	var skrg = Date.now();
	$('#clock').countdown("<?=$hsl['tgl_pengumuman'] ?>", {elapse: true})
	.on('update.countdown', function(event) {
	var $this = $(this);
	if (event.elapsed) {
		$( "#xpengumuman" ).show();
		$( "#clock" ).hide();
	} else {
		$this.html(event.strftime('Pengumuman dapat dilihat: <span>%D Hari %H Jam %M Menit %S Detik</span> lagi'));
		$( "#xpengumuman" ).hide();
	}
	});

	</script>

	<script>
function goBack() {
  window.history.back();
}
</script>
</body>
</html>
