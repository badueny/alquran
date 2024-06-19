<?php
    if($ayat){
		foreach($ayat as $row){            
            $surahIdAudio = str_pad($row->surah_id,3,"0",STR_PAD_LEFT);
            $ayahIdAudio = str_pad($row->no_ayat,3,"0",STR_PAD_LEFT);
            preg_match_all('!\d+!', $row->terjemah_ayat, $matches);
            $footnots = implode("",$matches[0]);
            $catatanKaki = $row->footnotes_ayat!='' ? '<small class="terjemah" style="font-size: 0.9em;margin-bottom: 10px;"><i>Catatan Kaki:<br>'.str_replace($footnots.')', '<sup class="footnote">'.$footnots.')</sup>',$row->footnotes_ayat).'</i></small>' : '';
            $terjemah = $footnots!='' ? str_replace($footnots.')', '<sup class="footnote">'.$footnots.')</sup>',$row->terjemah_ayat) : $row->terjemah_ayat;
            $fAudio = $surahIdAudio.$ayahIdAudio;
			echo '<div class="row baris animate__animated animate__fadeIn"><div class="baris-ayat">
			<div class="surah-number">'.$row->no_ayat.'</div>
			<div class="surah-arabic">
            <p class="arab textarb'.$row->no_ayat.'" id="texta'.$row->no_ayat.'">'.$row->arabic_ayat.'</p>
            <p class="isyarat textisrt'.$row->no_ayat.'" id="texti'.$row->no_ayat.'">'.$row->arabic_ayat.'</p>
            </div>			
			</div>
			<p class="latin" id="ltn'.$row->no_ayat.'">'.$row->latin_ayat.'</p>
			<p class="terjemah" id="idn'.$row->no_ayat.'">'.$terjemah.'</p>
            '.$catatanKaki.'
            <div class="row text-left btn-fitur">
                <button class="btn btn-sm btn-outline-success btn-audio" data-toggle="tooltip" title="Play Audio Ayah" data-ayah="'.$row->no_ayat.'" data-audio="'.$fAudio.'" data-name="'.$row->no_ayat.'"><i class="fas fa-play"></i></i></button>
                <button class="btn btn-sm btn-outline-success btn-copy" data-toggle="tooltip" title="Salin Ayah" data-ayah="'.$row->no_ayat.'"><i class="fas fa-copy"></i></button>                
                <button class="btn btn-sm btn-outline-success btn-idn" data-toggle="tooltip" title="Terjemah Indonesia" data-ayah="'.$row->no_ayat.'" data-surah="'.$row->surah_id.'">ID</button>
                <button class="btn btn-sm btn-outline-success btn-eng" data-toggle="tooltip" title="Terjemah English" data-ayah="'.$row->no_ayat.'" data-surah="'.$row->surah_id.'">EN</button>
                <button class="btn btn-sm btn-outline-success btn-tafsir" data-toggle="tooltip" title="Tafsir al-Jalalain" data-ayah="'.$row->no_ayat.'" data-surah="'.$row->surah_id.'"><i class="far fa-file-alt"></i> TAFSIR</button>
			</div>
            </div>';
		}
    }else{
        echo '<p>Silahkan Pilih Juz/Surah/Ayat</p>';
    }
?>
<script src="assets/js/list-ayah.min.js?<?=strtotime('now')?>"></script>