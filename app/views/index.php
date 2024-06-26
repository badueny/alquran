<!DOCTYPE html>
<html lang="id">
<head>
	<title>Al-Qur'an Karim</title>
	<meta charset="utf-8"> 
	<meta content="width=device-width, initial-scale=1.0" name="viewport"> 
	<meta property="og:locale" content="id_ID"/>	
	<meta property="og:title" content="Al-Qur'an Karim"/> 
	<meta property="og:type" content="website"/>
	<meta property="og:description" content="Al-Qur'an Karim Terjemah Indonesia" /> 
	<meta property="og:url" content="<?=base_url()?>" />
	<meta property="og:image" content="<?=base_url()?>assets/images/icons/al-quran-512.png" />
	<meta property="description" content="Al-Qur'an Karim Terjemah Indonesia" /> 
	<meta content="quran,Al-Qur'an terjemah Indonesia,audio alquran,juzz,ayat,banten,lptqbanten" name="keywords" />
	<meta content="Al-Qur'an Karim Terjemah Indonesia" name="description" />
	<meta name="author" content="badueny@BITDEV.ID" />
	<link rel="manifest" href="<?=base_url()?>manifest.json?<?=strtotime('now')?>"> 	
	<link rel="icon" href="<?=base_url()?>assets/images/icons/al-quran-512.png" sizes="512x512"/>
	<link rel="stylesheet" href="assets/css/app.min.css">	
	<link rel="stylesheet" href="assets/css/quran.min.css?<?=strtotime('now')?>">
	<script src="assets/js/app.bundle.js"></script>
	<script>var defaulturis = "", baseUrl = "<?=base_url()?>";</script>
</head>
<body id="home">
<nav class="sticky-top bg-light">
  <div class="container">
	<div class="row g-2">
		<div class="col-md-2 navbar-brand"><a href="<?=base_url()?>?j=all&s=1&d=1&k=7" style="text-decoration:none;font-size: 16px;" class="text-success"><img src="assets/images/icons/al-quran-512.png" width="45px"> Al-Qur'an</a></div>
		<div class="col-md-1 navi" style="flex-direction: column;">
				<label for="juzz" class="form-label text-dark">Juz</label>
				<input type="hidden" value="<?=cleanInputGet('j')=='' ? 'all' : cleanInputGet('j')?>" id="ajuzz">
				<select class="form-select text-dark" name="juzz" id="juzz">				
					<?php  				
					$selectedja = (cleanInputGet('j')=='all' OR cleanInputGet('j')=='') ? 'selected' : '';
					echo '<option value="all" '.$selectedja.'>Semua</option>';
					for($noj=1;$noj<=30;$noj++){ 					
						$selectedj = cleanInputGet('j')==$noj ? 'selected' : '';
						$selectedj = cleanInputGet('j')=='all' ? '' : '';
						echo '<option value="'.$noj.'" '.$selectedj.'>'.$noj.'</option>';
					}  ?>
				</select>
		</div>
		<div class="col-md-4 navi" style="flex-direction: column;">
			<label for="surah" class="form-label text-dark">Surah</label>
			<select class="form-select text-dark" name="surah" id="surah"></select>
		</div>
		<div class="col-md-2 navi" style="flex-direction: column;">
			<label for="surah" class="form-label text-dark">Dari ayah ke ayah</label>
			<div class="input-group mb-2">
				<select class="form-control text-dark" id="dari"></select>
				<span class="input-group-text text-dark" style="height: 27px;padding: 2px;">s.d</span>
				<select class="form-control text-dark" id="ke"></select>
				<input type="hidden" value="<?=cleanInputGet('k')?>" id="ake">
				<input type="hidden" value="<?=cleanInputGet('d')?>" id="adari">
				<input type="hidden" value="<?=cleanInputGet('s')?>" id="asurah">
			</div>
		</div>
		<div class="col-md-2 mb-3 navi" >
			<label class="form-label text-light d-none d-sm-block">option</label>
			<div class="dropdown"  style="margin-top: 6px;">
				<a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" style="height: 28px;line-height: 13px;width: 80%;text-align: left;" data-bs-toggle="dropdown" aria-expanded="false">Pilihan Lainnya</a>
				<ul class="dropdown-menu">
					<li><div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="trans">
						<label class="form-check-label" for="trans">Transliterasi</label>
					</div></li>
					<li ><div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" id="terj">
					<label class="form-check-label" for="terj">Terjemahan</label>
					</div></li>
					<li><div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" id="isrt">
					<label class="form-check-label" for="isrt">Al-Qur'an Isyarat</label>
					</div></li>					
					<li ><div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" id="autoscrl">
					<label class="form-check-label" for="autoscrl">Gulir Otomatis</label>
					</div></li>
					<li class="mb-2"><a href="<?=base_url()?>emushaf" style="text-decoration:none" class="text-dark"><i class="fas fa-quran"></i> e-Mushaf Al-Qur'an</a></li>
					<li class="mb-2"><a href="<?=base_url()?>quran-reader" style="text-decoration:none" class="text-dark"><i class="fas fa-quran"></i> Al-Qur'an per-Halaman</a></li>
					<li class="mb-2"><a href="<?=base_url()?>asbabun-nuzul" target="_blank" style="text-decoration:none" class="text-dark"><i class="fas fa-book"></i> Asbabun Nuzul</a></li>
					<li class="mb-2"><a href="<?=base_url()?>tajwid" target="_blank" style="text-decoration:none" class="text-dark"><i class="fas fa-book-reader"></i> Panduan Ilmu Tajwid</a></li>
					<li><a href="<?=base_url()?>unduh-isyarat" target="_blank" style="text-decoration:none" class="text-dark"><i class="fas fa-download"></i> Unduh Panduan Isyarat</a></li>
				</ul>
			</div>			
		</div>	
	</div>	
	<div class="form-check form-switch ftrb">
		<input class="form-check-input" type="checkbox" id="ftrb">
		<label class="form-check-label text-dark" for="ftrb">Tombol Fitur</label>
	</div>
	<div class="form-check form-switch mode">
		<input class="form-check-input" type="checkbox" id="mode">
		<label class="form-check-label text-dark" for="mode">Mode Gelap</label>
	</div>
	<button class="btn btn-outline-secondary btn-menu"><i class="fas fa-bars"></i></button>	
	<script>var defaulturis = '?j='+$("#ajuzz").val();</script>
  </div>
</nav> 
<p id="infoNav"></p>
<div class="container" id="app"></div>
<div class="auto-scroll">
	<p class="scroll-title" onclick="tooglespeed()"> <i class="fas fa-scroll"></i> gulir otomatis</p>
	<div id="speednav">		
        <ul>
            <li style="list-style-type:none;border:0px;width:40px;margin-left:-40px;font-family:arial;font-size:7pt;color:#CCC;text-align:center;"><i class="fas fa-tachometer-alt"></i> cepat</li>
            <li class="speedbar" id="speed5" onclick="startit(5);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(5);"></li>
            <li class="speedbar" id="speed4" onclick="startit(4);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(4);"></li>
            <li class="speedbar" id="speed3" onclick="startit(3);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(3);"></li>
            <li class="speedbar" id="speed2" onclick="startit(2);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(2);"></li>
            <li class="speedbar" id="speed1" onclick="startit(1);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(1);"></li>
            <li class="speedbar" onclick="stopit();" onmouseover="this.style.cursor='pointer';" style="font-family: arial; font-size: 7pt; color: rgb(204, 204, 204); text-align: center; width: 40px; height: 14px; cursor: pointer;"><i class="far fa-stop-circle"></i> Stop</li>
        </ul>
    </div>  
</div> 
<div class="modal fade" id="tafsirModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-dark"></div>
    </div>
  </div>
</div>
<button onclick="topFunction()" id="toTop" title="Ke Atas">Ke Atas</button>
<audio id="player" class="animate__animated animate__fadeInUp"></audio>
<div class="alert alert-success text-center" role="alert" id="infoCopy"></div>
<script src="assets/js/app.min.js?<?=strtotime('now')?>"></script>
<script src="assets/js/sienna.min.js"></script>
</body>
</html>
