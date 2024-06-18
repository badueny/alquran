<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
			parent::__construct();
	}

	public function index()
	{
		$data['surah'] = DB::getDataSelect('surah','*')->result();
		$this->load->view('index',$data);
	}

	public function quran()
	{
		$data['surah'] = DB::getDataSelect('surah','*')->result();
		$this->load->view('index',$data);
	}

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
			$resultSurat .= '<option value="'.$rsurah->id_surah.'|'.$rsurah->num_ayah_surah.'" '.$selected.'>'.$rsurah->id_surah.'. '.$rsurah->arabic_surah.' ('.trim($rsurah->latin_surah).'|'.trim($rsurah->location_surah).'|'.$rsurah->num_ayah_surah.' ayat)</option>';
			$no++;
		}
		$result['list'] = $resultSurat;
		$result['no'] = $nosurat;
		echo json_encode($result);
	}

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
	}	

	function getTafsir()
	{
		$surah = cleanInputGet('s');
		$ayah = cleanInputGet('a');
		
		$tafsir = DB::getDataWhereSelectJoin('tafsir_jalalayn','tbl_tafsir_jalalayn.text,tbl_surah.latin_surah',['sura' => $surah, 'aya' => $ayah],['tbl_surah' => 'tbl_surah.id_surah=tbl_tafsir_jalalayn.sura'])->row();
		echo '<h6>Surah '.$tafsir->latin_surah.' ayah '.$ayah.'</h6>
		<p style="text-align:justify" id="tfsr'.$ayah.'">'.$tafsir->text.'</p>
		<button class="btn btn-sm btn-outline-success btn-copyTafsir" data-toggle="tooltip" id="'.$ayah.'" onclick="copyTextTafsir(this.id)" title="Salin Tafsir"><i class="fas fa-copy"></i> Copy Tafsir</button>';
	}

	function getTerjemahEnglish()
	{
		$surah = cleanInputGet('s');
		$ayah = cleanInputGet('a');
		
		$tafsir = DB::getDataWhereSelectJoin('terjemah_english','tbl_terjemah_english.text,tbl_surah.latin_surah',['sura' => $surah, 'aya' => $ayah],['tbl_surah' => 'tbl_surah.id_surah=tbl_terjemah_english.sura'])->row();
		echo '<h6>Sura '.$tafsir->latin_surah.' aya '.$ayah.'</h6>
		<p style="text-align:justify" id="eng'.$ayah.'">'.$tafsir->text.'</p>
		<button class="btn btn-sm btn-outline-success" data-toggle="tooltip" id="ng'.$ayah.'" onclick="copyTextEnglish(this.id)" title="Copy English"><i class="fas fa-copy"></i> Copy</button>';
	}
}