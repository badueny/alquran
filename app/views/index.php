<!DOCTYPE html>
<html lang="id">
<head>
	<title>Qur'an Karim</title>
	<meta charset="utf-8"> 
	<meta content="width=device-width, initial-scale=1.0" name="viewport"> 
	<meta property="og:locale" content="id_ID"/>	
	<meta property="og:title" content="Al-Quran Karim"/> 
	<meta property="og:type" content="website"/>
	<meta property="og:description" content="Al-Quran Karim Terjemah Indonesia" /> 
	<meta property="og:url" content="<?=base_url()?>" />
	<meta property="og:image" content="<?=base_url()?>assets/images/icons/al-quran-512.png" />
	<meta property="description" content="Al-Quran Karim Terjemah Indonesia" /> 
	<meta content="quran,quran terjemah Indonesia,audio alquran,juzz,ayat,banten,lptqbanten" name="keywords" />
	<meta content="Al-Quran Karim Terjemah Indonesia" name="description" />
	<meta name="author" content="badueny@BITDEV.ID" />
	<link rel="manifest" href="<?=base_url()?>manifest.json"> 	
	<link rel="icon" href="<?=base_url()?>assets/images/icons/al-quran-512.png" sizes="512x512"/>
	<link rel="stylesheet" href="assets/css/app.min.css">	
	<link rel="stylesheet" href="assets/css/quran.min.css?<?=strtotime('now')?>">
	<script src="assets/js/script.min.js"></script>
	<script>var defaulturis = "", baseUrl = "<?=base_url()?>";</script>
</head>
<body id="home">
<nav class="navbar sticky-top navbar-light bg-light mb-4">
  <div class="container">
 	 <div class="row col-md-12">
       <div class="col-md-2 navbar-brand"><a href="<?=base_url()?>" style="text-decoration:none"><img src="assets/images/icons/al-quran-512.png" width="45px"> Qur'an Karim</a></div>
		  <div class="col-md-1 navi mb-1">
			<label for="surah" class="form-label">Juz</label>
			<input type="hidden" value="<?=cleanInputGet('j')=='' ? 'all' : cleanInputGet('j')?>" id="ajuzz">
			<select class="form-select" name="juzz" id="juzz">				
				<?php  				
				$selectedja = (cleanInputGet('j')=='all' OR cleanInputGet('j')=='') ? 'selected' : '';
				echo '<option value="all" '.$selectedja.'>Juz</option>';
				for($noj=1;$noj<=30;$noj++){ 					
					$selectedj = cleanInputGet('j')==$noj ? 'selected' : '';
					$selectedj = cleanInputGet('j')=='all' ? '' : '';
					echo '<option value="'.$noj.'" '.$selectedj.'>'.$noj.'</option>';
				}  ?>
			</select>
		</div>
		<div class="col-md-4 navi mb-1">
			<label for="surah" class="form-label">Surah</label>
			<select class="form-select arab-text" name="surah" id="surah" style="width:100%"></select>
		</div>
		<div class="col-md-2 navi mb-1">
			<label for="surah" class="form-label">Dari ayah ke ayah</label>
			<div class="input-group mb-2">
				<select class="form-control" id="dari"></select>
				<span class="input-group-text" style="height: 27px;">s.d</span>
				<select class="form-control" id="ke"></select>
				<input type="hidden" value="<?=cleanInputGet('k')?>" id="ake">
				<input type="hidden" value="<?=cleanInputGet('d')?>" id="adari">
				<input type="hidden" value="<?=cleanInputGet('s')?>" id="asurah">
			</div>
		</div>
		
		<div class="col-md-2 navi mb-1">
			<label class="form-label text-light d-none d-sm-block">option</label>
			<div class="dropdown">
				<a class="btn btn-success dropdown-toggle" href="#" role="button" style="height: 28px;line-height: 13px;width: 80%;" data-bs-toggle="dropdown" aria-expanded="false">Pilihan</a>
				<ul class="dropdown-menu">
					<li><div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="trans">
						<label class="form-check-label" for="trans">Transliterasi</label>
					</div></li>
					<li ><div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" id="terj">
					<label class="form-check-label" for="terj">Terjemahan</label>
				</div></li>
					<li ><div class="form-check form-switch">
					<input class="form-check-input" type="checkbox" id="autoscrl">
					<label class="form-check-label" for="autoscrl">Gulir Otomatis</label>
				</div></li>
				</ul>
			</div>
		</div>	
			
		<button class="btn btn-outline-secondary btn-menu"><i class="fas fa-bars"></i></button>
		
	</div>
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
        <h5 class="modal-title"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"></div>
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
