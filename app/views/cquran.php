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
			<div class="surah-arabic"><p class="arab textarb'.$row->no_ayat.'" id="texta'.$row->no_ayat.'">'.$row->arabic_ayat.'</p></div>			
			</div>
			<p class="latin">'.$row->latin_ayat.'</p>
			<p class="terjemah">'.$terjemah.'</p>
            '.$catatanKaki.'
            <div class="row text-left">
                <button class="btn btn-sm btn-outline-success btn-audio" data-ayah="'.$row->no_ayat.'" data-audio="'.$fAudio.'" data-name="'.$row->no_ayat.'"><i class="fas fa-play"></i></i></button>
                <button class="btn btn-sm btn-outline-success btn-copy" data-ayah="'.$row->no_ayat.'"><i class="fas fa-copy"></i></button>
			</div>
            </div>';
		}
    }else{
        echo '<p>Silahkan Pilih Juz/Surah/Ayat</p>';
    }
?>

<script>
$("#trans").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".latin").show() : $(".latin").hide();
});
$("#terj").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".terjemah").show() : $(".terjemah").hide();
});

$(".btn-audio").on("click",function(){
    $(".plyr--audio").show();
    playAudio($(this).data('name'),$(this).data('audio'));
    $(".arab").attr('style','color:black');
    $(".textarb"+$(this).data('ayah')).attr('style','color:#008900');
});

$(".btn-copy").on("click",function(){
    var chk = $(this).data("ayah");
    copyText('texta'+chk,chk);
    
});


</script>