var playerQs = new Plyr('#player');
	function playAudio(title,audio){		
		playerQs.source = {
			type: 'audio',
			title: title,
			autoplay: true,
			resetOnEnd:true,
			sources: [
				{
				src: 'static/quran/audio/'+audio+'.m4a',
				type: 'audio/mp3',
				},
			],
		};

		
	}

	playerQs.on('ended', (event) => {
		$(".plyr").hide();
		$("#app .arab").attr("style","color:inherit");
		$("#app .btn-audio").attr("disabled",false);
	});
	
$("#unduhisrt").on("click", function(e){
	e.preventDefault();
	var fname = $(this).data('file');
	downloadFile(baseUrl+'static/panduan/'+fname, fname)
});

$("#mode").on("click", function(e){
	var element = document.body;
  	element.classList.toggle("dark-mode");
});


function downloadFile(url, name) {
	fetch(url)
		.then(res => res.blob()) 
		.then(blob => {
			let objectURL = URL.createObjectURL(blob);
			var link = document.createElement('a');
			link.download = name;
			link.href = objectURL;
			document.body.appendChild(link);
			link.click();
			document.body.removeChild(link);
		});
  }

$(".btn-menu").on("click", function(e){	
	$(".navi").toggle("slow");
});

$("#juzz").on("change", function(e){
	var val = $(this).val();
	$("#ajuzz").val(val);	
	getSuratByJuzz(val);
    //loadList();
});

function getSuratByJuzz(val)
{
    $.ajax({  
		url:baseUrl+"getSuratByJuzz",  
		type:"GET",  
		dataType:"JSON", 
		data:{j:val},
		success:function(data)  
		{    
			$("#surah").html(data.list).trigger("change.select2");
			$("#asurah").val(data.no); 
			selectListNoAyat(val,data.no);
			val=='all' ? resetSearch() : '';            
		}
	});	
}

$("#surah").on("change", function(e){
    e.preventDefault();
    var valk = encodeHTML($("#asurah").val());
	var s = $('#surah').val(),srh = s.split("|");              
    $("#asurah").val(srh[0]); 
	selectListNoAyat($("#juzz").val(),srh[0]);   
 });

 function selectListNoAyat(juzz,surah)
 {	
	$.ajax({  
		url:baseUrl+"getNomorAyatByJuzzSurat",  
		type:"GET",  
		dataType:"JSON", 
		data:{j:juzz,s:surah},
		success:function(data)  
		{    
					
			$("#dari").html(data.list).trigger("change.select2");
			$("#dari").val(data.first);
			$("#ke").html(data.list).trigger("change.select2");	
			$("#ke").val(data.last);
			$("#adari").val(data.first),$("#ake").val(data.last);
            loadList();					
		}
	});
 }

    getSuratByJuzz($("#ajuzz").val());
	$("#juzz").select2();
	$("#surah").select2();
	$("#dari").select2();
	$("#ke").select2();
    $("#juzz").val($("#ajuzz").val()).trigger('change.select2');
 
 function encodeHTML(s) {
     return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/"/g, '&quot;');
 }
 
 $("#dari").on("change", function(e){
    e.preventDefault();
	if(parseInt($(this).val())>parseInt($("#ke").val())){
		$(this).val($("#ke").val()).trigger('change.select2');
		$("#adari").val($("#ke").val())
	}
    var valk = encodeHTML($("#adari").val());                      
    defaulturis = defaulturis.replace('&d='+$("#adari").val(),'');                    
    $("#adari").val($(this).val());                      
    loadList();
 });

 $("#ke").on("change", function(e){
    e.preventDefault();
	if(parseInt($(this).val())<parseInt($("#dari").val())){
		$(this).val($("#dari").val()).trigger('change.select2');
		$("#ake").val($("#dari").val())
	}
    var valk = encodeHTML($("#ake").val());                    
    defaulturis = defaulturis.replace('&k='+$("#ake").val(),'');                    
    $("#ake").val($(this).val());                      
    loadList();
 });

	function resetSearch()
	{     
		var j = $('#juzz').val(), s = $('#surah').val(),srh = s.split("|");		
		defaulturis = j=='all' ? '?j=all&s=1&d=1&k=7' : '?j='+j+'&s='+srh[0]+'&d=1&k='+srh[1];
		$("#ajuzz").val(j);   	
		$('#asurah').val(srh[0]);
		$("#adari").val(1); 
		$("#ake").val(srh[1]);
	}
                  
 	function upToDiv(o){$("html,body").animate({scrollTop:$("#"+o).offset().top},50)}
       
	function loadList()
	{     	
		$(".plyr--audio").hide();	     
		var j = $('#ajuzz').val()=='' ? 'all' : $('#ajuzz').val(), s = $('#asurah').val(),
			d = $('#adari').val()=='' ? '1' : $('#adari').val(),
			k = $('#ake').val()=='' ? '1' : $('#ake').val();
			defaulturis = '?j='+j+'&s='+s+'&d='+d+'&k='+k;                        
			window.history.pushState('quran', 'Quran', defaulturis);
            $("#dari").val(d).trigger('change.select2');
			$("#ke").val(k).trigger('change.select2');
			$("#infoNav").html("<p class='text-center'><i class='fas fa-spinner fa-spin'></i> Load Data...</p>");
			loadingAyat();
			$("#trans").prop("checked", false);
			$("#terj").prop("checked", false);
			$("#isrt").prop("checked", false);
			$("#ftrb").prop("checked", true);
			$("#autoscrl").prop("checked", false);
		$.ajax({  
				url:baseUrl+"getAyat",  
				type:"GET",  
				dataType:"TEXT", 
				data:{j:j,s:s, d:d, k:k},
				success:function(data)  
				{                  					
					if($("#surah").val()!=''){
						var bismillah = (s!='1' && s!='9') ? "<p class='arab text-center'>بِسْمِ اللّٰهِ الرَّحْمٰنِ الرَّحِيْمِ</p>" : '<p class="text-center text-white" style="margin-bottom: 2rem;"></p>';
						var infosurat = $("#surah option:selected").text();
						infosurat = infosurat.split("(");
						infosurat = infosurat[1].split("|");
						var InfoAyah = "Surah: <b>"+infosurat[0]+"</b> ayah <b>"+$("#dari option:selected").text()+"</b> s.d <b>"+$("#ke option:selected").text()+"</b>";
						$("#infoNav").html(InfoAyah+bismillah);
					}else{ $("#infoNav").html(''); }
					$('#app').html(data);
					upToDiv("home");
				}  
		});	
	}

	function loadingAyat()
	{	
		var contLoad='<p class="text-center text-white" style="margin-bottom: 2rem;">.....</p>';
		for(var x=1;x<=7;x++){
			contLoad +='<div class="row baris animate__animated animate__fadeIn" style="background: inherit;height: 150px;"></div>';
		}
		$('#app').html(contLoad);
	}

	
	
function copyText(id,numAyah) {
    var text = document.getElementById(id).innerText;
    var elem = document.createElement("textarea");
    document.body.appendChild(elem);
    elem.value = text;
    elem.select();
    document.execCommand("copy");
    document.body.removeChild(elem);
	var suratc = $("#surah option:selected").text();
	suratc = suratc.split("(");
	suratc = suratc[1].split("|");
	$("#infoCopy").html("Salin <b>Ayah "+numAyah+" Surah "+suratc[0]+"</b> Sukses.<br>Silahkan Paste.");
	$("#infoCopy").show();
	setTimeout(hideInfoCopy, 1500);
}
function hideInfoCopy()
{
	$("#infoCopy").hide();
}

function copyTextTafsir(elmtID) {
	var out = document.querySelector('#tfsr'+elmtID);
    var textArea = document.createElement('textarea');
    textArea.value = out.innerHTML;
    textArea.style.opacity = 0;
    $(".modal-body").append(textArea);
    textArea.focus();
    textArea.select();
    try {
      var success = document.execCommand('copy');
      console.log(`Text copy was ${success ? 'successful' : 'unsuccessful'}.`);
    } catch (err) {
      console.error(err.name, err.message);
    }
	$("#"+elmtID).hide();
	$(".modal-body").append('<small class="text-success"><i>Copy Text Tafsir Sukses</i></small>');
	$(".modal-body").remove(textArea);
}

function copyTextEnglish(elmtID) {
	var out = document.querySelector('#e'+elmtID);
    var textArea = document.createElement('textarea');
    textArea.value = out.innerHTML;
    textArea.style.opacity = 0;
    $(".modal-body").append(textArea);
    textArea.focus();
    textArea.select();
    try {
      var success = document.execCommand('copy');
      console.log(`Text copy was ${success ? 'successful' : 'unsuccessful'}.`);
    } catch (err) {
      console.error(err.name, err.message);
    }
	$("#"+elmtID).hide();
	$(".modal-body").append('<small class="text-success"><i>Copy Success</i></small>');
	$(".modal-body").remove(textArea);
}

function getTafsir(s,a,q)
	{
		$.ajax({  
			url:baseUrl+"getTafsir",  
			type:"GET",  
			dataType:"TEXT", 
			data:{s:s,a:a},
			success:function(data)  
			{    
				$(".modal-title").html('Tafsir al-Jalalain');
				$(".modal-body").html('<p class="arab" style="font-size: 16px;font-weight: 550;">'+q+'</p>'+data);
				$("#tafsirModal").modal({ backdrop: "static", keyboard: !1 }), 				
				$("#tafsirModal").modal("show");
			}
		});
	}

	function getTerjemahEnglish(s,a,q)
	{
		$.ajax({  
			url:baseUrl+"getTerjemahEnglish",  
			type:"GET",  
			dataType:"TEXT", 
			data:{s:s,a:a},
			success:function(data)  
			{    
				$(".modal-title").html('Terjemah English <font size="-1"><i>*Sahih International</i></font>');
				$(".modal-body").html('<p class="arab" style="font-size: 16px;font-weight: 550;">'+q+'</p>'+data);
				$("#tafsirModal").modal({ backdrop: "static", keyboard: !1 }), 				
				$("#tafsirModal").modal("show");
			}
		});
	}

	

//autoscroll
var speed = 1;
var disp = 0;
var handle;
var currentspeed = 0;
var status = 1;
var currentpos = 0,
    alt = 1,
    curpos1 = 0,
    curpos2 = -1;
var color = new Array();
color[1] = "#ddd";
color[2] = "#ccc";
color[3] = "#bbb";
color[4] = "#aaa";
color[5] = "#999";
var interval = new Array(400, 300, 200, 100, 30);

function scrollwindow() {
    if (status == 1) {
        if (document.all && !document.getElementById) temp = document.body.scrollTop;
        else temp = window.pageYOffset;
        if (alt == 0) alt = 2;
        else alt = 1;
        if (curpos1 != curpos2) {
            if (document.all) currentpos = document.body.scrollTop + speed;
            else currentpos = window.pageYOffset + speed;
            window.scroll(0, currentpos);
        } else {
            currentpos = 0;
            window.scroll(0, currentpos);
        }
    }
}

function startit(s) {
    status = 1;
    currentspeed = s;
    clearInterval(handle);
    handle = setInterval("scrollwindow()", interval[s]);
}

function stopit() {
    currentspeed = 0;
    for (i = 1; i <= 5; i++) {
        document.getElementById('speed' + i).style.backgroundColor = color[i];
    }
    status = 0;
}

function resetBg(n) {
    for (i = 1; i <= 5; i++) {
        document.getElementById('speed' + i).style.backgroundColor = color[i];
    }
    for (i = 1; i <= currentspeed; i++) {
        document.getElementById('speed' + i).style.backgroundColor = "#00cc00";
    }
}

function changeBg(n) {
    for (i = 1; i <= 5; i++) {
        document.getElementById('speed' + i).style.backgroundColor = color[i];
    }
    for (i = 1; i <= n; i++) {
        document.getElementById('speed' + i).style.backgroundColor = "#00cc00";
    }
}

$("#autoscrl").on("click",function(){
	tooglespeed();
});
disp = 0;
document.getElementById('speednav').style.display = 'none';
function tooglespeed() {
    if (disp == 0) {
        disp = 1;
        document.getElementById('speednav').style.display = '';
		$(".scroll-title").attr("style","left: 38px;");
    } else {
        disp = 0;
        document.getElementById('speednav').style.display = 'none';
		$(".scroll-title").attr("style","left: -1px;");
    }
}

function calcHeight() {
    var the_height = document.getElementById('app').contentWindow.document.body.scrollHeight;
    document.getElementById('app').height = the_height;
}
	///=======

// Get the button
let mybutton = document.getElementById("toTop");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
  document.body.scrollTop = 0;
  document.documentElement.scrollTop = 0;
}



void 0!==navigator.serviceWorker&&navigator.serviceWorker.register(baseUrl+"sw.js");