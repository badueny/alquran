<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <title>Al-Qur'an | per Halaman</title>
    <meta charset="utf-8"> 
	<meta content="width=device-width, initial-scale=1.0" name="viewport"> 
	<meta property="og:locale" content="id_ID"/>	
	<meta property="og:title" content="Al-Qur'an Karim"/> 
	<meta property="og:type" content="website"/>  
    <link rel="icon" href="<?=base_url()?>assets/images/icons/al-quran-512.png" sizes="512x512"/>
    <link rel="stylesheet" href="assets/css/app.min.css">	
	<link rel="stylesheet" href="assets/css/quran.min.css?<?=strtotime('now')?>">
	<script src="assets/js/app.bundle.js"></script>
    <link rel="stylesheet" href="assets/css/reader.min.css?<?=strtotime('now')?>">    
  </head>
  <body>
  <nav class="sticky-top bg-light">
  <div class="container">
	<div class="row g-2">
		<div class="col-md-2 navbar-brand"><a href="<?=base_url()?>?j=all&s=1&d=1&k=7" style="text-decoration:none;font-size: 16px;" class="text-success"><img src="assets/images/icons/al-quran-512.png" width="45px"> Al-Qur'an</a></div>
		<div class="col-md-3 navi" style="flex-direction: column;">
			<label for="surah" class="form-label text-dark">Tampilkan Berdasarkan</label>
			<select class="form-select text-dark" name="tipe" id="tipe">
                <option value="">Pilih Filter</option>
                <option value="juz">Juz</option>
                <option value="surah">Surah</option>
                <option value="hal">Halaman</option>
                <option value="ayat">Per-Ayat</option>
            </select>
		</div>
        <div class="col-md-5 navi mb-3" style="flex-direction: column;">
			<label for="surah" class="form-label">Jenis Data</label>
			<select class="form-select text-dark" name="filts" id="filts"></select>
		</div>
	</div>
	<button class="btn btn-outline-secondary btn-menu"><i class="fas fa-bars"></i></button>	
  </div>
</nav> 
    <div class="content" id="imgQ"></div>
    <script>var baseUrl = "<?=base_url()?>";</script>
    <script src="assets/js/reader.min.js?<?=strtotime('now')?>"></script>
  </body>
</html>