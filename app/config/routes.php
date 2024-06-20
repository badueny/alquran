<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['quran'] = 'home/quran';
$route['getAyat'] = 'home/getAyat';
$route['getSuratByJuzz'] = 'home/getSuratByJuzz';
$route['getNomorAyatByJuzzSurat'] = 'home/getNomorAyatByJuzzSurat';
$route['getTafsir'] = 'home/getTafsir';
$route['getTerjemahEnglish'] = 'home/getTerjemahEnglish';
$route['tajwid'] = 'home/tajwid';
$route['asbabun-nuzul'] = 'home/asbabunuzul';

$route['quran-reader'] = 'home/quranReader';
$route['getListSurah'] = 'home/getListSurah';
$route['getListPageQuran'] = 'home/getListPageQuran';


