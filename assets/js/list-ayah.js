$("#trans").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".latin").show() : $(".latin").hide();
});
$("#terj").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".terjemah").show() : $(".terjemah").hide();
});

$("#isrt").on("click",function(){
    var chk = $(this).prop("checked");
    chk==true ? $(".isyarat").show() : $(".isyarat").hide();
});

$(".btn-audio").on("click",function(){  
    $(".btn-audio").attr('disabled', true);
    $(".plyr--audio").show();
    playAudio($(this).data('name'),$(this).data('audio'));
    $(".arab").attr('style','color:black');
    $(".textarb"+$(this).data('ayah')).attr('style','color:#008900');
});

$(".btn-copy").on("click",function(){
    var chk = $(this).data("ayah");
    copyText('texta'+chk,chk);
    
});

$(".btn-tafsir").on("click", function(){
		getTafsir($(this).data("surah"),$(this).data("ayah"));		
	});

$(".btn-eng").on("click", function(){
    getTerjemahEnglish($(this).data("surah"),$(this).data("ayah"));		
});