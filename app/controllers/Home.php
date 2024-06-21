<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
		setSession('token',guidv4());
	}

	//Main_Page
	public function index()
	{
		$this->load->view('index');
	}

	//Main_Page
	public function quran()
	{
		$this->load->view('index');
	}

	//Tajwid_View
	public function tajwid()
	{
		$this->load->view('tajwid');
	}

	//Read_Qur'an_Per_Page_View
	public function quranReader()
	{
		$this->load->view('quranflip');
	}

	//Asbabun_Nuzul_View
	public function asbabunuzul()
	{
		$this->load->view('asbabunuzul');
	}


	
	//List_Surah_By_Juzz
	function getSuratByJuzz()
	{
		$juzz = cleanInputGet('j');
		$listSurat='';
		if($juzz!='all'){
			$listSurat = DB::getDataSelectWhereJoinGroupOrder('ayat','tbl_surah.*',['juz_ayat' => $juzz],['tbl_surah' => 'tbl_surah.id_surah=tbl_ayat.surah_id'],'surah_id',['surah_id' => 'ASC'])->result();
		}else{
			$listSurat = DB::getDataSelect('surah','*')->result();
		}
		$resultSurat ='<option value="">Surah</option>';
		$no=1;
		$nosurat='';
		foreach($listSurat as $rsurah){ 
			if($no==1){
				$nosurat = $rsurah->id_surah;
			}
			$selected = $no==1 ? 'selected' : '';
			$resultSurat .= '<option value="'.$rsurah->id_surah.'|'.$rsurah->num_ayah_surah.'" '.$selected.'>'.$rsurah->id_surah.'. '.$rsurah->arabic_surah.' ('.trim($rsurah->latin_surah).' - '.$rsurah->translation_surah.' | '.trim($rsurah->location_surah).' | '.$rsurah->num_ayah_surah.'ayah)</option>';
			$no++;
		}
		$result['list'] = $resultSurat;
		$result['no'] = $nosurat;
		echo json_encode($result);
	}

	//List_Nomor_Ayah
	function getNomorAyatByJuzzSurat()
	{
		$surahId = cleanInputGet('s');
		$juzz = cleanInputGet('j');
		$listAyat='';
		if($juzz!='all'){
			$listAyat = DB::getDataSelectWhere('ayat','no_ayat',['juz_ayat' => $juzz,'surah_id' => $surahId])->result();
		}else{
			$listAyat = DB::getDataSelectWhere('ayat','no_ayat',['surah_id' => $surahId])->result();
		}
		$resultAyat ='';
		$fisrtAyat = '';
		$lastAyat = '';
		$noa=1;
		foreach($listAyat as $rayat){ 
			if($noa==1){
				$fisrtAyat = $rayat->no_ayat;
			}
			$resultAyat .= '<option value="'.$rayat->no_ayat.'">'.$rayat->no_ayat.'</option>';
			$lastAyat = $rayat->no_ayat;
			$noa++;
		}
		$result['list'] = $resultAyat;
		$result['first'] = $fisrtAyat;
		$result['last'] = $lastAyat;
		echo json_encode($result);
	}

	//List_Ayah_View
	function getAyat()
	{
		$juzz = cleanInputGet('j');
		$surah = cleanInputGet('s');
		$dari = cleanInputGet('d');
		$ke = cleanInputGet('k');
		$where=[];	
		$juzz!='all' ? $where['juz_ayat'] = $juzz : '';	
		$surah=='' ? $where['surah_id'] = '1' : $where['surah_id'] = $surah;
		($dari!='' AND $ke=='')  ? $where['no_ayat'] = $dari : '';
		
		if($surah!='' AND $juzz!='' AND $dari!='' AND $ke!=''){		
			if($dari!='' AND $ke!=''){
				if($dari==$ke){
					$where['no_ayat'] = $dari;
				}else{
					$daria = $dari>$ke ? $ke : $dari;
					$kea = $ke<$dari ? $dari : $ke;
					$where["no_ayat BETWEEN '$daria' AND '$kea'"] = NULL;
				} 
			}
			$data['ayat'] = DB::getDataSelectWhere('ayat','*',$where)->result();
			$this->load->view('cquran',$data);
		}else{
			echo '<p class="text-center">Silahkan Pilih Juz/Surah/Ayat</p>';
		}
	}	

	//Get_Tafsir_By_Ayah
	function getTafsir()
	{
		$surah = cleanInputGet('s');
		$ayah = cleanInputGet('a');
		
		$tafsir = DB::getDataWhereSelectJoin('tafsir_jalalayn','tbl_tafsir_jalalayn.text,tbl_surah.latin_surah',['sura' => $surah, 'aya' => $ayah],['tbl_surah' => 'tbl_surah.id_surah=tbl_tafsir_jalalayn.sura'])->row();
		echo '<h6>Surah '.$tafsir->latin_surah.' ayah '.$ayah.'</h6>
		<p style="text-align:justify" id="tfsr'.$ayah.'">'.$tafsir->text.'</p>
		<button class="btn btn-sm btn-outline-success btn-copyTafsir" data-toggle="tooltip" id="'.$ayah.'" onclick="copyTextTafsir(this.id)" title="Salin Tafsir"><i class="fas fa-copy"></i> Copy Tafsir</button>';
	}

	//Get_English_Translation_By_Ayah
	function getTerjemahEnglish()
	{
		$surah = cleanInputGet('s');
		$ayah = cleanInputGet('a');
		
		$tafsir = DB::getDataWhereSelectJoin('terjemah_english','tbl_terjemah_english.text,tbl_surah.latin_surah',['sura' => $surah, 'aya' => $ayah],['tbl_surah' => 'tbl_surah.id_surah=tbl_terjemah_english.sura'])->row();
		echo '<h6>Sura '.$tafsir->latin_surah.' aya '.$ayah.'</h6>
		<p style="text-align:justify" id="eng'.$ayah.'">'.$tafsir->text.'</p>
		<button class="btn btn-sm btn-outline-success" data-toggle="tooltip" id="ng'.$ayah.'" onclick="copyTextEnglish(this.id)" title="Copy English"><i class="fas fa-copy"></i> Copy</button>';
	}

	//List_Qur'an_per-Page
	function getListPageQuran()
	{
		$tipe = cleanInputGet('t')!='' ? cleanInputGet('t') : '';
		$filt  = cleanInputGet('f')!='' ? cleanInputGet('f') : '';

		$firstPage 	= 1;
		$lastPage  	= 1;
		$result		='';
		if($tipe=='juz'){
			$getPage = DB::getDataSelectWhere('ayat','MIN(halaman_ayat) as frs, MAX(halaman_ayat) as lst',['juz_ayat' => $filt])->row();
			$firstPage = $getPage->frs;
			$lastPage = $getPage->lst;
		}elseif($tipe=='surah'){
			$pageSurah = DB::getDataSelectWhere('ayat',' MIN(halaman_ayat) as frs, MAX(halaman_ayat) as lst',['surah_id' => $filt])->row();
			$firstPage = $pageSurah->frs;
			$lastPage = $pageSurah->lst;
		}if($tipe=='hal'){
			$firstPage 	= $filt;
			$lastPage  	= $filt;
		}

		$no=1;
		if($filt!=''){
			if($tipe=='juz'){
				$result .= '<img src="'.base_url().'static/quran/mushaf/'.$filt.'.jpg" class="slide-img animate__animated animate__fadeIn">';
			}
			for($i=$firstPage;$i<=$lastPage;$i++){
				$nomber = str_pad($i, 3, "0", STR_PAD_LEFT);
				$result .= '<img src="'.base_url().'static/quran/mushaf/QK_'.$nomber.'.webp" class="slide-img animate__animated animate__fadeIn">';
				$no++;
			}
		}else{					
			$result = '<img src="'.base_url().'static/quran/mushaf/cover.jpg" class="slide-img animate__animated animate__fadeIn">';
		}
		$navIgasi = $no>1 ? '<div class="sliders left" onclick="side_slide(1)"><span class="fas fa-angle-left"></span></div>
        <div class="sliders right" onclick="side_slide(-1)"><span class="fas fa-angle-right"></span></div>' : '';
		$response['list'] = $result.$navIgasi;
		$response['first'] = 1;
		$response['last'] = $no;
		echo json_encode($response);
	}

	//List_All_Surah
	function getListSurah()
	{
		
		$listSurat = DB::getDataSelect('surah','*')->result();
		$resultSurat ='<option value="">Pilih Surah</option>';
		$no=1;
		$nosurat='';
		foreach($listSurat as $rsurah){ 
			$resultSurat .= '<option value="'.$rsurah->id_surah.'">'.$rsurah->id_surah.'. '.$rsurah->arabic_surah.' ('.trim($rsurah->latin_surah).' - '.$rsurah->translation_surah.' | '.trim($rsurah->location_surah).' | '.$rsurah->num_ayah_surah.'ayah)</option>';
			$no++;
		}
		echo $resultSurat;
	}
	//=====

	function unduhIsyarat()
	{
		unduhFile('panduan-membaca-mushaf-al-quran-isyarat_compressed.pdf','static/panduan/');
	}
}