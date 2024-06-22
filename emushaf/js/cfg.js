

function loadApp() {

    $('#canvas').fadeIn(1000);

    var flipbook = $('.magazine');

    // Check if the CSS was already loaded
   
   if (flipbook.width()==0 || flipbook.height()==0) {
       setTimeout(loadApp, 10);
       return;
   }
   
   // Create the flipbook

   flipbook.turn({
           
           // Magazine width
           direction: "rtl",

           width: 922,

           // Magazine height

           height: 745,

           // Duration in millisecond

           duration: 1000,

           // Enables gradients

           gradients: true,
           
           // Auto center this flipbook

           autoCenter: true,

           // Elevation from the edge of the flipbook when turning a page

           elevation: 50,

           // The number of pages

           pages: 605,

           // Events

           when: {
               turning: function(event, page, view) {
                   
                   var book = $(this),
                   currentPage = book.turn('page'),
                   pages = book.turn('pages');
               
           
                   // Update the current URI

                   Hash.go('page/' + page).update();

                   if(page % 2 == 0) {
                       $(".hal").val(page);
                   }else{
                       $(".hal").val(parseInt(page)-1);
                   }
                   //$(".surah").val(page);
                   getSelectSurah(page);
                   getSelectJuz(page);
                   //$(".juz").val(page);
                   play();
                   
                   // Show and hide navigation buttons

                   disableControls(page);

               },

               turned: function(event, page, view) {

                   disableControls(page);

                   $(this).turn('center');

                   $('#slider').slider('value', getViewNumber($(this), page));
                   

                   if (page==1) { 
                       $(this).turn('peel', 'br');
                   }

               },

               missing: function (event, pages) {

                   // Add pages that aren't in the magazine

                   for (var i = 0; i < pages.length; i++)
                       addPage(pages[i], $(this));

               }
           }

   });

   // Zoom.js

   $('.magazine-viewport').zoom({
       flipbook: $('.magazine'),

       max: function() { 
           
           return largeMagazineWidth()/$('.magazine').width();

       }, 

       when: {
           swipeLeft: function() {

               $(this).zoom('flipbook').turn('next');

           },

           swipeRight: function() {
               
               $(this).zoom('flipbook').turn('previous');

           },

           resize: function(event, scale, page, pageElement) {

               if (scale==1)
                   loadSmallPage(page, pageElement);
               else
                   loadLargePage(page, pageElement);

           },

           zoomIn: function () {

               $('#slider-bar').hide();
               $('.made').hide();
               $('.magazine').removeClass('animated').addClass('zoom-in');
               $('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');
               
               if (!window.escTip && !$.isTouch) {
                   escTip = true;

                   $('<div />', {'class': 'exit-message'}).
                       html('<div>Press ESC to exit</div>').
                           appendTo($('body')).
                           delay(2000).
                           animate({opacity:0}, 500, function() {
                               $(this).remove();
                           });
               }
           },

           zoomOut: function () {

               $('#slider-bar').fadeIn();
               $('.exit-message').hide();
               $('.made').fadeIn();
               $('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

               setTimeout(function(){
                   $('.magazine').addClass('animated').removeClass('zoom-in');
                   resizeViewport();
               }, 0);

           }
       }
   });

   // Zoom event

   if ($.isTouch)
       $('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
   else
       $('.magazine-viewport').bind('zoom.doubleTap', zoomTo);

   $(".next").on("click", function(e){
       e.preventDefault();
       $('.magazine').turn('next');
   });

   $(".prev").on("click", function(e){
       e.preventDefault();
       $('.magazine').turn('previous');
   });

   $(".surah").on("change", function(e){
       e.preventDefault();
       var val = $(this).val();
       $(".hal").val(val).trigger("change");
   });

   $(".juz").on("change", function(e){
       e.preventDefault();
       var val = $(this).val();
       $(".hal").val(val).trigger("change");
   });

   $(".hal").on("change", function(e){
       e.preventDefault();
       var number = $(this).val();		
       if(number>604){
           $(this).val('604');
           $('.magazine').turn('page', 604);			
       }else{
           if(number % 2 == 0) {
               $('.magazine').turn('page', number);
           }else{				
               $('.magazine').turn('page', parseInt(number)+1);
           }
       }
       
   });

   $(".last").on("click", function(e){
       e.preventDefault();
       $('.magazine').turn('page', 604);
   });

   $(".first").on("click", function(e){
       e.preventDefault();
       $('.magazine').turn('page', 1);
       $(".surah").val('0');
   });

   function getSelectJuz(page)
   {
       var vals = '0';
       if(page>0 && page < 22){ vals = "1"; }		
       else if(page>21 && page < 42){ vals = "22"; }
       else if(page>41 && page < 62){ vals = "42"; }
       else if(page>61 && page < 82){ vals = "62"; }
       else if(page>81 && page < 102){ vals = "82"; }
       else if(page>101 && page < 122){ vals = "102"; }
       else if(page>121 && page < 142){ vals = "122"; }
       else if(page>141 && page < 162){ vals = "142"; }
       else if(page>161 && page < 182){ vals = "162"; }
       else if(page>181 && page < 202){ vals = "182"; }
       else if(page>201 && page < 222){ vals = "202"; }
       else if(page>221 && page < 242){ vals = "222"; }
       else if(page>241 && page < 262){ vals = "242"; }
       else if(page>261 && page < 282){ vals = "262"; }
       else if(page>281 && page < 302){ vals = "282"; }
       else if(page>301 && page < 322){ vals = "302"; }
       else if(page>321 && page < 342){ vals = "322"; }
       else if(page>341 && page < 362){ vals = "342"; }
       else if(page>361 && page < 382){ vals = "362"; }
       else if(page>381 && page < 401){ vals = "382"; }
       else if(page>400 && page < 422){ vals = "401"; }
       else if(page>421 && page < 441){ vals = "422"; }
       else if(page>440 && page < 462){ vals = "441"; }
       else if(page>461 && page < 482){ vals = "462"; }
       else if(page>481 && page < 502){ vals = "482"; }
       else if(page>501 && page < 522){ vals = "502"; }
       else if(page>521 && page < 542){ vals = "522"; }
       else if(page>541 && page < 562){ vals = "542"; }
       else if(page>561 && page < 582){ vals = "562"; }
       else if(page>581){ vals = "582"; }
       $(".juz").val(vals);
   }

   function getSelectSurah(page)
   {
       var vals = '0';
       if(page==1){ vals = "1"; }else if(page>1 && page < 49){ vals = "2"; }else if(page>49 && page < 76){ vals = "50"; }else if(page>76 && page < 106){ vals = "77"; }else if(page>105 && page < 127){ vals = "106"; }else if(page>127 && page < 151){ vals = "128"; }else if(page>150 && page < 176){ vals = "151"; }else if(page>176 && page < 186){ vals = "177"; }else if(page>186 && page < 207){ vals = "187"; }else if(page>207 && page < 221){ vals = "208"; }else if(page>220 && page < 235){ vals = "221"; }else if(page>234 && page < 248){ vals = "235"; }else if(page>248 && page < 255){ vals = "249"; }else if(page>254 && page < 261){ vals = "255"; }else if(page>261 && page < 267){ vals = "262"; }else if(page>266 && page < 281){ vals = "267"; }else if(page>281 && page < 293){ vals = "282"; }else if(page>292 && page < 304){ vals = "293"; }else if(page>304 && page < 312){ vals = "305"; }else if(page>311 && page < 321){ vals = "312"; }else if(page>321 && page < 331){ vals = "322"; }else if(page>331 && page < 341){ vals = "332"; }else if(page>341 && page < 349){ vals = "342"; }else if(page>349 && page < 359){ vals = "350"; }else if(page>358 && page < 366){ vals = "359"; }else if(page>366 && page < 376){ vals = "367"; }else if(page>376 && page < 385){ vals = "377"; }else if(page>384 && page < 396){ vals = "385"; }else if(page>395 && page < 404){ vals = "396"; }else if(page>403 && page < 410){ vals = "404"; }else if(page>410 && page < 414){ vals = "411"; }else if(page>414 && page < 417){ vals = "415"; }else if(page>417 && page < 427){ vals = "418"; }else if(page>427 && page < 434){ vals = "428"; }else if(page>433 && page < 440){ vals = "434"; }else if(page>439 && page < 445){ vals = "440"; }else if(page>445 && page < 452){ vals = "446"; }else if(page>452 && page < 458){ vals = "453"; }else if(page>457 && page < 467){ vals = "458"; }else if(page>466 && page < 476){ vals = "467"; }else if(page>476 && page < 482){ vals = "477"; }else if(page>482 && page < 489){ vals = "483"; }else if(page>488 && page < 495){ vals = "489"; }else if(page>495 && page < 498){ vals = "496"; }else if(page>498 && page < 502){ vals = "499"; }else if(page>501 && page < 506){ vals = "502"; }else if(page>506 && page < 510){ vals = "507"; }else if(page>510 && page < 515){ vals = "511"; }else if(page>514 && page < 517){ vals = "515"; }else if(page>517 && page < 520){ vals = "518"; }else if(page>519 && page < 523){ vals = "520"; }else if(page>522 && page < 525){ vals = "523"; }else if(page>525 && page < 528){ vals = "526"; }else if(page>527 && page < 531){ vals = "528"; }else if(page>530 && page < 534){ vals = "531"; }else if(page>533 && page < 537){ vals = "534"; }else if(page>536 && page < 541){ vals = "537"; }else if(page>541 && page < 545){ vals = "542"; }else if(page>544 && page < 548){ vals = "545"; }else if(page>548 && page < 551){ vals = "549"; }else if(page>550 && page < 552){ vals = "551"; }else if(page>552 && page < 554){ vals = "553"; }else if(page>553 && page < 555){ vals = "554"; }else if(page>555 && page < 557){ vals = "556"; }else if(page>557 && page < 559){ vals = "558"; }else if(page>559 && page < 561){ vals = "560"; }else if(page>561 && page < 564){ vals = "562"; }else if(page>563 && page < 566){ vals = "564"; }else if(page>565 && page < 568){ vals = "566"; }else if(page>567 && page < 570){ vals = "568"; }else if(page>569 && page < 571){ vals = "570"; }else if(page>571 && page < 573){ vals = "572"; }else if(page>573 && page < 575){ vals = "574"; }else if(page>574 && page < 577){ vals = "575"; }else if(page>576 && page < 578){ vals = "577"; }else if(page>577 && page < 580){ vals = "578"; }else if(page>579 && page < 581){ vals = "580"; }else if(page>581 && page < 583){ vals = "582"; }else if(page>582 && page < 584){ vals = "583"; }else if(page==585){ vals = "585"; }else if(page==586){ vals = "586"; }else if(page==587){ vals = "587"; }else if(page>586 && page < 589){ vals = "587"; }else if(page==589){ vals = "589"; }else if(page==590){ vals = "590"; }else if(page==591){ vals = "591"; }else if(page>590 && page < 592){ vals = "591"; }else if(page==592){ vals = "592"; }else if(page>592 && page < 594){ vals = "593"; }else if(page==594){ vals = "594"; }else if(page==595){ vals = "595"; }else if(page>594 && page < 596){ vals = "595"; }else if(page==596){ vals = "596"; }else if(page==596){ vals = "596"; }else if(page==597){ vals = "597"; }else if(page==597){ vals = "597"; }else if(page==598){ vals = "598"; }else if(page>597 && page < 599){ vals = "598"; }else if(page==599){ vals = "599"; }else if(page==600){ vals = "600"; }else if(page==601){ vals = "601"; }else if(page==602){ vals = "602"; }else if(page==603){ vals = "603"; }else if(page==604){ vals = "604"; }
       $(".surah").val(vals);
   }
       
   // Using arrow keys to turn the page

   $(document).keydown(function(e){
       //a=65 s=83 w=87 d=68
       var previous = 39, next = 37, esc = 27, up = 38, down = 40, upw = 87, downs = 83, pervd=68, nexta = 65; //previous = 37, next = 39

       switch (e.keyCode) {
           case previous:
               // left arrow
               $('.magazine').turn('previous');
               e.preventDefault();
           break;

           case pervd:
               // left arrow
               $('.magazine').turn('previous');
               e.preventDefault();
           break;

           case next:

               //right arrow
               $('.magazine').turn('next');
               e.preventDefault();
           break;

           case nexta:
               // left arrow
               $('.magazine').turn('next');
               e.preventDefault();
           break;

           case esc:				
               $('.magazine-viewport').zoom('zoomOut');	
               e.preventDefault();

           break;
           case up:				
               $('.magazine').turn('page', 604);
               e.preventDefault();
           break;

           case upw:				
               $('.magazine').turn('page', 604);
               e.preventDefault();
           break;

           case down:				
               $('.magazine').turn('page', 1);	
               e.preventDefault();
           break;

           case downs:				
               $('.magazine').turn('page', 1);	
               e.preventDefault();
           break;
       }
   });

   // URIs - Format #/page/1 

   Hash.on('^page\/([0-9]*)$', {
       yep: function(path, parts) {
           var page = parts[1];
           if (page!==undefined) {
               if ($('.magazine').turn('is'))
                   $('.magazine').turn('page', page);
           }

       },
       nop: function(path) {

           if ($('.magazine').turn('is'))
               $('.magazine').turn('page', 1);
       }
   });


   $(window).resize(function() {
       resizeViewport();
   }).bind('orientationchange', function() {
       resizeViewport();
   });

   // Regions

   if ($.isTouch) {
       $('.magazine').bind('touchstart', regionClick);
   } else {
       $('.magazine').click(regionClick);
   }

   // Events for the next button

   $('.next-button').bind($.mouseEvents.over, function() {
       
       $(this).addClass('next-button-hover');

   }).bind($.mouseEvents.out, function() {
       
       $(this).removeClass('next-button-hover');

   }).bind($.mouseEvents.down, function() {
       
       $(this).addClass('next-button-down');

   }).bind($.mouseEvents.up, function() {
       
       $(this).removeClass('next-button-down');

   }).click(function() {
       
       $('.magazine').turn('next');

   });

   // Events for the next button
   
   $('.previous-button').bind($.mouseEvents.over, function() {
       
       $(this).addClass('previous-button-hover');

   }).bind($.mouseEvents.out, function() {
       
       $(this).removeClass('previous-button-hover');

   }).bind($.mouseEvents.down, function() {
       
       $(this).addClass('previous-button-down');

   }).bind($.mouseEvents.up, function() {
       
       $(this).removeClass('previous-button-down');

   }).click(function() {
       
       $('.magazine').turn('previous');

   });


   // Slider

   $( "#slider" ).slider({
       min: 1,
       max: numberOfViews(flipbook),

       start: function(event, ui) {

           if (!window._thumbPreview) {
               _thumbPreview = $('<div />', {'class': 'thumbnail'}).html('<div></div>');
               setPreview(ui.value);
               _thumbPreview.appendTo($(ui.handle));
           } else
               setPreview(ui.value);

           moveBar(false);

       },

       slide: function(event, ui) {

           setPreview(ui.value);

       },

       stop: function() {

           if (window._thumbPreview)
               _thumbPreview.removeClass('show');
           
           $('.magazine').turn('page', Math.max(1, $(this).slider('value')*2 - 2));

       }
   });

   resizeViewport();

   $('.magazine').addClass('animated');

}


function play() {
    var audio = new Audio('pics/flip.mp3');
    audio.play();
  }
// Load the HTML4 version if there's not CSS transform
yepnope({
    test : Modernizr.csstransforms,
    yep: ['lib/turn.min.js'],
    nope: ['lib/turn.html4.min.js', 'css/jquery.ui.html4.css'],
    both: ['lib/zoom.min.js', 'css/jquery.ui.css', 'js/magazine.js?v2', 'css/magazine.min.css'],
    complete: loadApp
 });

 $('.quran-logo').show();
 $('.info-key').show();
 $('.pagination').show();
// Zoom icon
$('.zoom-icon').bind('mouseover', function() { 
    
    if ($(this).hasClass('zoom-icon-in'))
        $(this).addClass('zoom-icon-in-hover');

    if ($(this).hasClass('zoom-icon-out'))
        $(this).addClass('zoom-icon-out-hover');

}).bind('mouseout', function() { 
    
     if ($(this).hasClass('zoom-icon-in'))
        $(this).removeClass('zoom-icon-in-hover');
    
    if ($(this).hasClass('zoom-icon-out'))
        $(this).removeClass('zoom-icon-out-hover');

}).bind('click', function() {

    if ($(this).hasClass('zoom-icon-in')){
        //$('.magazine-viewport').zoom('zoomIn');
        $(this).removeClass('zoom-icon-in').addClass('zoom-icon-out');
        openFullscreen();
   }else if ($(this).hasClass('zoom-icon-out')){
       //$('.magazine-viewport').zoom('zoomOut');
       $(this).removeClass('zoom-icon-out').addClass('zoom-icon-in');
       closeFullscreen();
   }

});

$('#canvas').hide();




var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
 if (elem.requestFullscreen) {
   elem.requestFullscreen();
 } else if (elem.webkitRequestFullscreen) { /* Safari */
   elem.webkitRequestFullscreen();
 } else if (elem.msRequestFullscreen) { /* IE11 */
   elem.msRequestFullscreen();
 }
}

/* Close fullscreen */
function closeFullscreen() {
 if (document.exitFullscreen) {
   document.exitFullscreen();
 } else if (document.webkitExitFullscreen) { /* Safari */
   document.webkitExitFullscreen();
 } else if (document.msExitFullscreen) { /* IE11 */
   document.msExitFullscreen();
 }
}