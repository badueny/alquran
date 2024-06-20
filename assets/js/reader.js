$(".btn-menu").on("click", function(e){	
    $(".navi").toggle("slow");
});

$("#filts").select2();
$("#tipe").select2();
$("#tipe").on("change", function(){ 
    var val = $(this).val();     
    if(val!='ayat'){
        $("#imgQ").html('<img src="'+baseUrl+'static/quran/mushaf/cover.jpg" class="slide-img animate__animated animate__fadeIn">');             
        val=='juz' ? listJuzz() : (val=='surah' ? listSurah() : (val=='hal' ? listHalaman() : $("#filts").html('<option value="">Pilih Filter Dahulu</option>').trigger("change.select2")));
    }else{
        window.location = baseUrl;
    }
});

$("#filts").on("change", function(){
    getListPageQuran($("#tipe").val(),$(this).val());
});

function listJuzz(){
    var list = '<option value="">Pilih Juz</option>';
    for(var x=1;x<=30;x++){
        list += '<option value="'+x+'">Juz '+x+'</option>';
    }
    $("#filts").html(list).trigger("change.select2");
}

function listSurah()
{
    $.ajax({  
        url:baseUrl+"getListSurah",  
        type:"GET",  
        dataType:"TEXT",
        success:function(data)  
        {    
            $("#filts").html(data).trigger("change.select2");
        }
    });	
}

function listHalaman(){
    var list = '<option value="">Pilih Halaman</option>';
    for(var x=1;x<=604;x++){
        list += '<option value="'+x+'">Halaman '+x+'</option>';
    }
    $("#filts").html(list).trigger("change.select2");
}

var indexValue = 1, jumIndex=1;
$("#imgQ").html('<img src="'+baseUrl+'static/quran/mushaf/cover.jpg" class="slide-img animate__animated animate__fadeIn">');

function getListPageQuran(t,f)
{
    $("#imgQ").html('<img src="'+baseUrl+'static/quran/mushaf/cover.jpg" class="slide-img animate__animated animate__fadeIn">');
    indexValue = 1;
    jumIndex = 1;
    $.ajax({  
        url:baseUrl+"getListPageQuran",  
        type:"GET",  
        dataType:"JSON",
        data:{t:t,f:f},
        success:function(data)  
        { 
            $("#imgQ").html(data.list);
            indexValue = data.first;
            jumIndex = data.last;
            showImg(indexValue);
        }
    });	
}

$('#imgQ .right').hide();      
  
  function side_slide(e){
     showImg(indexValue += e);        
  }
  
  var jumSlider = 1;
  function showImg(e){
        if(e==1){
            $('#imgQ .right').hide();        
        }else{
            $('#imgQ .right').show();
        }
        var lstImg = $("#tipe").val()=='juz' ? jumIndex : (jumIndex-1);
        if(e==lstImg){
            $('#imgQ .left').hide();
        }else{
            $('#imgQ .left').show();
        }

        var i;
        const img = document.querySelectorAll('#imgQ .slide-img');
        if(e > img.length){indexValue = 1}
        if(e < 1){indexValue = img.length}
        for(i = 0; i < img.length; i++){
            img[i].style.display = "none";
        }
        img[indexValue-1].style.display = "block";
  }

    $(document).keydown(function(ar) {
        var keyb = ar.originalEvent.key;
        if(keyb=='ArrowRight' && indexValue>1){           
            side_slide(-1);
        }    
        var lstImg = $("#tipe").val()=='juz' ? jumIndex : (jumIndex-1);  
        if(keyb=='ArrowLeft' && indexValue<lstImg){
            side_slide(1);
        }
    });

    