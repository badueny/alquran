$("#trans").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".latin").show() : $(".latin").hide();
});
$("#terj").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".terjemah").show() : $(".terjemah").hide();
});

$(".btn-idn").on("click",function(){
    var chk = $(this).data("ayah");
    $("#ltn"+chk).toggle();
    $("#idn"+chk).toggle();
    $(".note"+chk).toggle();
});

$(".btn-isrt").on("click",function(){
    var chk = $(this).data("ayah");
    $("#texti"+chk).toggle();
});


$("#isrt").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".isyarat").show() : $(".isyarat").hide();
});

$("#ftrb").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".btn-fitur").show() : $(".btn-fitur").hide();
});

$(".btn-audio").on("click",function(){  
    $(".btn-audio").attr('disabled', true);
    $(".plyr--audio").show();
    playAudio($(this).data('name'),$(this).data('audio'));
    $(".arab").attr('style','color:inherit');
    $(".textarb"+$(this).data('ayah')).attr('style','color:#008900');
});

$(".btn-copy").on("click",function(){
    var chk = $(this).data("ayah");
    copyText('texta'+chk,chk);
    
});

$(".btn-tafsir").on("click", function(){
		getTafsir($(this).data("surah"),$(this).data("ayah"),$(this).data("ayat"));		
	});

$(".btn-eng").on("click", function(){
    getTerjemahEnglish($(this).data("surah"),$(this).data("ayah"),$(this).data("ayat"));		
});