
<!doctype html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="google" content="notranslate">

<link rel="preconnect" href="<?=base_url()?>asbabun-nuzul">

    <link rel="canonical" href="<?=base_url()?>asbabun-nuzul" />    

<title>ASBABUN NUZUL</title>
<link rel="icon" href="<?=base_url()?>assets/images/icons/al-quran-512.png" sizes="512x512"/>
<meta itemprop="name" content="ASBABUN NUZUL">
<meta itemprop="description" content="Imam As-Suyuthi">
<meta property="og:type" content="website" />
<meta property="og:title" content="ASBABUN NUZUL" />
<meta property="og:description" content="Imam As-Suyuthi" />
<meta property="og:url" content="<?=base_url()?>asbabun-nuzul" />
<meta property="og:image" content="<?=base_url()?>assets/asbabunuzul/files/uploaded/v2/8c13143aa81e533f03ea733d45f9b929cd3b95da.pdf-thumb.jpg" />
<meta itemprop="image" content="<?=base_url()?>assets/asbabunuzul/files/uploaded/v2/8c13143aa81e533f03ea733d45f9b929cd3b95da.pdf-thumb.jpg">
<meta name="robots" content="index, nofollow">



    <script type="text/javascript" src="<?=base_url()?>assets/asbabunuzul/flipbook/js/site/jquery-3.5.1.min.js?v2"></script>
    <script src="<?=base_url()?>assets/asbabunuzul/flipbook/js/site/pdf.3.11.174.l.min.js"></script>
    <script type="text/javascript">
        var URL_ = <?=json_encode(base_url('asbabun-nuzul/'))?>,
        URL_BASE = '<?=base_url()?>assets/asbabunuzul/',
        URL_BASE_J =  <?=json_encode(base_url().'assets/asbabunuzul/')?>;        
    </script>
    <script src="assets/js/asbab.cfg.min.js?<?=strtotime('now')?>"></script>
    <style>
        .bg-icons{
            background-image: url('assets/asbabunuzul/flipbook/img/iconset2_6.png');
        }
    </style>
</head>
<body style="width: 100vw; height: 100vh">
    
    
    

<div id="loaderLine" class="loader-line" style="display: none;"></div>

<div class="logo-backs"></div>

    <img src="" class="logo-backs2 logo-backs2-loading" style="display: none;" alt="PDF to Flipbook" width="5px" />

<div class="flipbook-title" style="display: none;">
    <h1></h1>
    <h2></h2>
    <p></p>
</div>


<div id="modalFull" style="display: none;">
    <div class="hz-icon hz-icn-fullscreen-on bg-icons"></div>
</div>

<div id="modalOver" style="display: none;">

</div>

<div id="zoomArea"></div>

<div id="canvas" style="width: 100%; height: 100%; margin: 0 auto; position: relative; box-sizing: border-box; padding: 10px;">


    <div id="pnlControls" class="controls-pdf controls-md" data-disable-events="true" style="display: none;">

        
        <a id="btnNavStart" style="display: none;">
            <div class="hz-icon hz-icn-start bg-icons bg-icons"></div>
        </a>
        <a id="btnNavPrev" style="display: none;">
            <div class="hz-icon hz-icn-prev bg-icons"></div>
        </a>
        <a id="btnNavNext" style="display: none;">
            <div class="hz-icon hz-icn-next bg-icons"></div>
        </a>
        <a id="btnNavEnd" style="display: none;">
            <div class="hz-icon hz-icn-end bg-icons"></div>
        </a>

        <a id="btnNavPanel" class="hz-icon hz-icn-nav bg-icons" style="display: none;"></a>
        <a class="zoom-icon zoom-icon-in hz-icon bg-icons" data-stats="zoom" style="display: none;"></a>
        <a id="btnFullscreen" data-stats="fullscreen" class="fullscreen-button hz-icon hz-icn-fullscreen-on" onclick="if (typeof toggleFullScreen != 'undefined') { toggleFullScreen(); } return false;"></a>
        
        <a id="btnSoundOff" data-stats="soundoff" class="hz-icon hz-icn-sound-on" style="display: none;"></a>

    </div>



    <div id="pnlZoomStep" class="controls-pdf controls-zoom-step controls-md" style="display: none;">
        <a class="btnZoomMore hz-icon hz-icn-zoom-more" data-disable-events="true" data-disable-zoom="true"></a>
        <a class="btnZoomLess hz-icon hz-icn-zoom-less" data-disable-events="true" data-disable-zoom="true"></a>
    </div>

    <div class="corner-arrow" style="display: none; position: absolute;">
        <img src="" />
    </div>

    <div id="magazineViewport" class="magazine-viewport">
        <div class="magazine-viewport-loader" style="display: none;">
        </div>
    </div>

    <script id="tplMagazine" type="template/x-template">
                    <img src="" class="logo-backs2" style="display: none;" alt="PDF to Flipbook" width="5px" />
        
        <div class="container">
            <div class="magazine">
                
                <div ignore="1" class="page-depth page-depth-left" style="display: none;">
                </div>
                <div ignore="1" class="page-depth page-depth-right" style="display: none;">
                </div>
                
                <div ignore="1" class="page-findex page-findex-left" data-disable-events="true" data-disable-zoom="true" style="display: none;">
                </div>
                <div ignore="1" class="page-findex page-findex-right" data-disable-events="true" data-disable-zoom="true" style="display: none;">
                </div>                

                <div ignore="1" class="next-button btnNext" data-disable-events="true" data-disable-zoom="true"></div>
                <div ignore="1" class="previous-button btnPrevious" data-disable-events="true" data-disable-zoom="true"></div>

            </div>
        </div>
        <div class="bottom control-bottom">
            <div class="page-bar">
                <span class="page-bar-value" style="display: none;"></span>
                <span class="page-bar-num" style="display: none;"></span>
                <input class="page-bar-range" type="range" value="0" min="0" max="50" step="1">
            </div>
        </div>
        <div ignore="1" class="page-depth-label" style="display: none;">
        </div>
    </script>

    <script id="tplSwiper" type="template/x-template">

                    <img src="" class="logo-backs2" style="display: none;" alt="PDF to Flipbook" width="5px" />
        
        <div class="container swiper">

            <div class="swiper-wrapper">
            </div>

            <div ignore="1" class="page-findex page-findex-left" data-disable-events="true" data-disable-zoom="true" style="display: none;">
            </div>
            <div ignore="1" class="page-findex page-findex-right" data-disable-events="true" data-disable-zoom="true" style="display: none;">
            </div>    
                
            <div class="swiper-button-next btnNext hz-icon hz-icon-md  bg-icons" data-disable-zoom="true"></div>
            <div class="swiper-button-prev btnPrevious hz-icon hz-icon-md  bg-icons" data-disable-zoom="true"></div>
        </div>

        <div class="bottom control-bottom">
            <div class="page-bar">
                <span class="page-bar-value" style="display: none;"></span>
                <span class="page-bar-num" style="display: none;"></span>
                <input class="page-bar-range" type="range" value="0" min="0" max="50" step="1">
            </div>
        </div>

    </script>
    
    <div id="pnlNav" class="controls-pdf controls-md" data-disable-events="true" data-disable-zoom="true" style="display: none;">
        <div class="panel-nav-controls">
            <div class="panel-nav-sections">
                <div id="btnNavPanelThumbnails" class="panel-section-btn">
                    <svg width="22px" height="22px" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M14 20.4v-5.8a.6.6 0 01.6-.6h5.8a.6.6 0 01.6.6v5.8a.6.6 0 01-.6.6h-5.8a.6.6 0 01-.6-.6zM3 20.4v-5.8a.6.6 0 01.6-.6h5.8a.6.6 0 01.6.6v5.8a.6.6 0 01-.6.6H3.6a.6.6 0 01-.6-.6zM14 9.4V3.6a.6.6 0 01.6-.6h5.8a.6.6 0 01.6.6v5.8a.6.6 0 01-.6.6h-5.8a.6.6 0 01-.6-.6zM3 9.4V3.6a.6.6 0 01.6-.6h5.8a.6.6 0 01.6.6v5.8a.6.6 0 01-.6.6H3.6a.6.6 0 01-.6-.6z" stroke="#000000" stroke-width="2"></path></svg>            
                </div>
                <div id="btnNavPanelOutline" class="panel-section-btn">
                    <svg width="22px" height="22px" viewBox="0 0 24 24" stroke-width="2" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M3 5h12M20.5 7V3L19 4.5M21 14h-2l1.905-2.963a.428.428 0 00.072-.323C20.92 10.456 20.716 10 20 10c-1 0-1 .889-1 .889s0 0 0 0v.222M19.5 19h.5a1 1 0 011 1v0a1 1 0 01-1 1h-1M19 17h2l-1.5 2M3 12h12M3 19h12" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>                
                <div id="btnNavPanelBookmark" class="panel-section-btn">
                    <svg width="22px" height="22px" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M5 21V5a2 2 0 012-2h10a2 2 0 012 2v16l-5.918-3.805a2 2 0 00-2.164 0L5 21z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </div>
            </div>
            <button type="button" class="panel-nav-close">
                <svg width="22px" height="22px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </button>
        </div>
        <div class="panel-nav-thumbnails panel-nav-body">
            <button type="button" class="panel-nav-close" style="display: none;">
                <svg width="24px" height="22px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </button>             
            <div class="panel-nav-thumbnails-body">
            </div>            
        </div>
        <div class="panel-nav-outline panel-nav-body" style="display: none;">
            <button type="button" class="panel-nav-close" style="display: none;">
                <svg width="24px" height="22px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
            </button>             
            <div class="panel-nav-outline-body">
            </div>
        </div>
        <div class="panel-nav-bookmark panel-nav-body" style="display: none;">
            <div class="panel-nav-bookmark-controls">
                <button id="btnNavPanelBookmarkAdd" class="btn-nav-panel-bookmark" type="button">
                    <svg width="22px" height="22px" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6 12h6m6 0h-6m0 0V6m0 6v6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                    <span class="btn-nav-panel-text"></span>
                </button>
                <button id="btnNavPanelEditBookmarks" class="btn-nav-panel-bookmark" type="button" style="display: none;">
                    <svg width="16px" height="16px" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M3 21h18M12.222 5.828L15.05 3 20 7.95l-2.828 2.828m-4.95-4.95l-5.607 5.607a1 1 0 00-.293.707v4.536h4.536a1 1 0 00.707-.293l5.607-5.607m-4.95-4.95l4.95 4.95" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>
                <button id="btnNavPanelSaveBookmarks" class="btn-nav-panel-bookmark" type="button" style="display: none;">
                    <svg width="16px" height="16px" stroke-width="2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M3 19V5a2 2 0 012-2h11.172a2 2 0 011.414.586l2.828 2.828A2 2 0 0121 7.828V19a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="#000000" stroke-width="2"></path><path d="M8.6 9h6.8a.6.6 0 00.6-.6V3.6a.6.6 0 00-.6-.6H8.6a.6.6 0 00-.6.6v4.8a.6.6 0 00.6.6zM6 13.6V21h12v-7.4a.6.6 0 00-.6-.6H6.6a.6.6 0 00-.6.6z" stroke="#000000" stroke-width="2"></path></svg>
                </button>   
                <button type="button" class="panel-nav-close btn-nav-panel-bookmark" style="display: none;">
                    <svg width="24px" height="22px" stroke-width="1.5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" color="#000000"><path d="M6.758 17.243L12.001 12m5.243-5.243L12 12m0 0L6.758 6.757M12.001 12l5.243 5.243" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                </button>                
            </div>
            <div class="panel-nav-bookmark-body">
            </div>
        </div>        
    </div>

        <audio id="audioPageTurn" style="display: none;" preload="none">
        <source src="<?=base_url()?>assets/asbabunuzul/flipbook/snd/flip-ct-sm.mp3" type="audio/mpeg">
    </audio>
    <audio id="audioPageTurn2" style="display: none;" preload="none">
        <source src="<?=base_url()?>assets/asbabunuzul/flipbook/snd/flip-ct-md.mp3" type="audio/mpeg">
    </audio>
    <audio id="audioPageTurn3" style="display: none;" preload="none">
        <source src="<?=base_url()?>assets/asbabunuzul/flipbook/snd/flip-ct-lg.mp3" type="audio/mpeg">
    </audio>
</div>   
    <link href="<?=base_url()?>assets/asbabunuzul/flipbook/css/prod5.min.css?v2=6&v=658" rel="stylesheet">    
    <script type="text/javascript" src="<?=base_url()?>assets/asbabunuzul/flipbook/js/prod5.min.js?v=658"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/asbabunuzul/flipbook/js/prodhzp.min.js?v=658"></script>
    <script src="assets/js/asbab.min.js?<?=strtotime('now')?>"></script>
</body>
</html>
