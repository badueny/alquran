<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="id">
<head>
	<meta charset="utf-8"> 
	<meta content="width=device-width, initial-scale=1.0" name="viewport"> 
	<meta property="og:locale" content="id_ID" />
	<title>Qur'an Karim</title>
	<meta property="og:title" content="Al-Quran Karim" /> 
	<meta property="og:type" content="website" />
	<meta name="keyword" content="Quran" />
	<meta name="author" content="4113N BITDEV.ID" /> 
  	<link rel="manifest" href="<?=base_url()?>manifest.json">
	<meta property="og:description" content="Qur'an Karim" /> 
	<meta property="og:url" content="<?=base_url()?>" />
	<meta property="og:image" content="<?=base_url()?>assets/images/icons/al-quran-512.png" /> 
	<meta content="Quran" name="description" /> 
	<meta content="Quran" name="keywords" />
	<link rel="icon" href="<?=base_url()?>assets/images/icons/al-quran-512.png" sizes="512x512" />
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet"href="assets/css/animate.min.css"/>
	<link rel="stylesheet" href="assets/css/fontawesome.min.css"/>
	<link rel="stylesheet" href="assets/css/icomoon.css">
	<link href="assets/css/select2.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="assets/css/plyr.css" />
	<link rel="stylesheet" href="assets/css/quran.min.css?<?=strtotime('now')?>">
	<script>var defaulturis = "", baseUrl = "<?=base_url()?>"; </script>
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>	
	<script src="assets/js/select2.min.js"></script>
	<script src="assets/js/plyr.js"></script>
	<script src="assets/js/fontawesome.min.js"></script>
</head>
<body id="home">
<nav class="navbar sticky-top navbar-light bg-light mb-4">
  <div class="container">
 	 <div class="row col-md-12">
       <div class="col-md-2 navbar-brand"><a href="<?=base_url()?>" style="text-decoration:none"><img src="assets/images/icons/al-quran-512.png" width="45px"> Qur'an Karim</a></div>
		  <div class="col-md-1 navi">
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
		<div class="col-md-4 navi">
			<label for="surah" class="form-label">Surah</label>
			<select class="form-select arab-text" name="surah" id="surah" style="width:100%">
				<?php foreach($surah as $rsurah){ 
					$surahId = cleanInputGet('s')=='' ? '1' : cleanInputGet('s');
					$selected = cleanInputGet('s')==$rsurah->id_surah ? 'selected' : '';
					echo '<option value="'.$rsurah->id_surah.'|'.$rsurah->num_ayah_surah.'" '.$selected.'>'.$rsurah->id_surah.'. '.$rsurah->arabic_surah.' ('.trim($rsurah->latin_surah).'|'.trim($rsurah->location_surah).'|'.$rsurah->num_ayah_surah.' ayat)</option>';
				} ?>
			</select>
		</div>
		<div class="col-md-2 navi">
			<label for="surah" class="form-label">Dari ayah Ke ayah</label>
			<div class="input-group mb-3">
				<select class="form-control" id="dari"></select>
				<span class="input-group-text" style="height: 27px;">s.d</span>
				<select class="form-control" id="ke"></select>
				<input type="hidden" value="<?=cleanInputGet('k')?>" id="ake">
				<input type="hidden" value="<?=cleanInputGet('d')?>" id="adari">
				<input type="hidden" value="<?=cleanInputGet('s')?>" id="asurah">
			</div>
		</div>
		
		<div class="col-md-2 navi">
			<label class="mb-4"></label>
			<div class="dropdown" style="margin-top: 2.6px;">
				<a class="btn btn-success dropdown-toggle" href="#" role="button" style="height: 28px;line-height: 13px;" data-bs-toggle="dropdown" aria-expanded="false">
					Pilihan
				</a>
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
	<p class="scroll-title" onclick="tooglespeed()">gulir otomatis</p>
	<div id="speednav">		
        <ul>
            <li style="list-style-type:none;border:0px;width:40px;margin-left:-40px;font-family:arial;font-size:7pt;color:#CCC;text-align:center;">kecepatan</li>
            <li class="speedbar" id="speed5" onclick="startit(5);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(5);"></li>
            <li class="speedbar" id="speed4" onclick="startit(4);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(4);"></li>
            <li class="speedbar" id="speed3" onclick="startit(3);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(3);"></li>
            <li class="speedbar" id="speed2" onclick="startit(2);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(2);"></li>
            <li class="speedbar" id="speed1" onclick="startit(1);" onmouseout="resetBg();" onmouseover="this.style.cursor='pointer';changeBg(1);"></li>
            <li class="speedbar" onclick="stopit();" onmouseover="this.style.cursor='pointer';" style="font-family: arial; font-size: 7pt; color: rgb(204, 204, 204); text-align: center; width: 40px; height: 12px; cursor: pointer;">berhenti</li>
        </ul>
    </div>  
</div> 
<button onclick="topFunction()" id="toTop" title="Ke Atas">Ke Atas</button>
<audio id="player" class="animate__animated animate__fadeInUp"></audio>
<div class="alert alert-success text-center" role="alert" id="infoCopy"></div>
<script src="assets/js/app.min.js?<?=strtotime('now')?>"></script>
</body>
</html>
