<?php 
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2019, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package CodeIgniter
 * @author  EllisLab Dev Team
 * @copyright   Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright   Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://codeigniter.com
 * @since   Version 1.0.0
 * @filesource
 */

if(!defined('BASEPATH')) exit('No direct script access allowed');
   

    if(!function_exists('getInstance'))
    {
        function getInstance()
        {
            $iki = &get_instance();
            return $iki;
        }
    }
    
    if(!function_exists('uriSegment'))
    {
		function uriSegment($no)
		{
			return getInstance()->uri->segment($no);
		}		
	}
    

    if(!function_exists('base64url_encode'))
    {
        function base64url_encode($data)
        { 
            return rtrim(strtr(base64_encode($data), '+/', '-_'), '='); 
        } 
    }
   
        
    if(!function_exists('encriptResult'))
    {
        function encriptResult($text)
        {
            // Store the cipher method
            $ciphering = "AES-128-CTR";        
            // Use OpenSSl Encryption method
            $iv_length = openssl_cipher_iv_length($ciphering);
            $options = 0;        
            // Non-NULL Initialization Vector for encryption
            $encryption_iv = '1234567891011121';        
            // Store the encryption key
            $encryption_key = "$53876AzHY#93";        
            // Use openssl_encrypt() function to encrypt the data
            $encryption = openssl_encrypt($text, $ciphering,
                        $encryption_key, $options, $encryption_iv);        
            // Display the encrypted string
            return base64url_encode($encryption);        
        }
    }

    if(!function_exists('decriptResult'))
    {
        function decriptResult($criptedResult)
        {        
            // Non-NULL Initialization Vector for decryption
            $decryption_iv = '1234567891011121';       
            // Store the decryption key
            $decryption_key = "$53876AzHY#93";        
            // Use openssl_decrypt() function to decrypt the data
            $decryption=openssl_decrypt ($criptedResult, $ciphering, 
                    $decryption_key, $options, $decryption_iv);        
            // Display the decrypted string
            return base64url_encode($decryption);
        }
    }

      
    if(!function_exists('verifyCodeGen'))
    {
        function verifyCodeGen($code)
        { 
            return $code=='8kr34tive' ? true : false; 
        } 
    }
	
	if(!function_exists('generatePass'))
    {
        function generatePass($pass)
        { 
            return password_hash($pass, PASSWORD_DEFAULT); 
        } 
    }
	
	if(!function_exists('verifyPass'))
    {
        function verifyPass($passInput,$passDB)
        { 
            return password_verify($passInput,$passDB); 
        } 
    }
    
    if(!function_exists('profilerCi'))
    {
        function profilerCi()
        {
            $iki = &get_instance();
            return $iki->output->enable_profiler(TRUE);
        }
    }

    if(!function_exists('getConfigItem'))
    {
        function getConfigItem($item)
        {
            $iki = &get_instance();
            return $iki->config->item($item);
        }
    }

    if(!function_exists('hideCharater'))
    {   
        function hideCharater($text)
        {       
            $kata = explode(" ",$text);
            $max = COUNT($kata);
            $hasil = '';
            for($i=0;$i<$max;$i++){	
                $jumKata = strlen($kata[$i])>2 ? strlen($kata[$i])-2 : strlen($kata[$i])-1;	
                $kataAkhir = (strlen($kata[$i])>2) ? substr($kata[$i],-1) : '';	
                $bintang ='';
                for($x=0;$x<$jumKata;$x++){
                    $bintang.='*';
                }
                $hasil.=substr($kata[$i],0,1).str_replace(substr($kata[$i],1,$jumKata),$bintang,substr($kata[$i],1,$jumKata)).$kataAkhir.' '.' ';
            }
            return rtrim($hasil);
        }
    }

    if(!function_exists('XMLtoArray'))
    {
        function XMLtoArray($xml) {
            $previous_value = libxml_use_internal_errors(true);
            $dom = new DOMDocument('1.0', 'UTF-8');
            $dom->preserveWhiteSpace = false; 
            $dom->loadXml($xml);
            libxml_use_internal_errors($previous_value);
            if (libxml_get_errors()) {
                return [];
            }
            return DOMtoArray($dom);
        }
    }

    if(!function_exists('DOMtoArray'))
    {
        function DOMtoArray($root) {
            $result = array();

            if ($root->hasAttributes()) {
                $attrs = $root->attributes;
                foreach ($attrs as $attr) {
                    $result['@attributes'][$attr->name] = $attr->value;
                }
            }

            if ($root->hasChildNodes()) {
                $children = $root->childNodes;
                if ($children->length == 1) {
                    $child = $children->item(0);
                    if (in_array($child->nodeType,[XML_TEXT_NODE,XML_CDATA_SECTION_NODE])) {
                        $result['_value'] = $child->nodeValue;
                        return count($result) == 1
                            ? $result['_value']
                            : $result;
                    }

                }
                $groups = array();
                foreach ($children as $child) {
                    if (!isset($result[$child->nodeName])) {
                        $result[$child->nodeName] = DOMtoArray($child);
                    } else {
                        if (!isset($groups[$child->nodeName])) {
                            $result[$child->nodeName] = array($result[$child->nodeName]);
                            $groups[$child->nodeName] = 1;
                        }
                        $result[$child->nodeName][] = DOMtoArray($child);
                    }
                }
            }
            return $result;
        }
    }

    if(!function_exists('searchJsonFileSingle'))
    {
        function searchJsonFileSingle($fieldSearch,$fieldReturn,$keyword,$file)
        {				    
            $decodedarrays 	= json_decode(file_get_contents($file), true);
            $result			=	'NOT FOUND';		
            foreach ($decodedarrays as $value) {
                if($value[$fieldSearch]==$keyword){
                    $result	= $value[$fieldReturn];
                    break;
                }			
            }
            return $result;
        }
    }

    if(!function_exists('array_sort'))
    {
        function array_sort($array, $on, $order=SORT_ASC)
        {
            $new_array = array();
            $sortable_array = array();

            if (count($array) > 0) {
                foreach ($array as $k => $v) {
                    if (is_array($v)) {
                        foreach ($v as $k2 => $v2) {
                            if ($k2 == $on) {
                                $sortable_array[$k] = $v2;
                            }
                        }
                    } else {
                        $sortable_array[$k] = $v;
                    }
                }

                switch ($order) {
                    case SORT_ASC:
                        asort($sortable_array);
                    break;
                    case SORT_DESC:
                        arsort($sortable_array);
                    break;
                }

                foreach ($sortable_array as $k => $v) {
                    $new_array[$k] = $array[$k];
                }
            }

            return $new_array;
        }
    }
    
    if(!function_exists('hitungUsiaTahun'))
    {
        function hitungUsiaTahun($tglahir,$batas)
        {
            $tanggal = new DateTime($tglahir);
            // tanggal hari ini
            $today = new DateTime($batas);
            // tahun
            $y = $today->diff($tanggal)->y;
            return $y;
        }
    }
    
    if(!function_exists('hitungUsiaBulan'))
    {
        function hitungUsiaBulan($tglahir,$batas)
        {
            $tanggal = new DateTime($tglahir);
            // tanggal hari ini
            $today = new DateTime($batas);
            // tahun
            $m = $today->diff($tanggal)->m;
            return $m;
        }
    }

    if(!function_exists('hitungUsiaTahunBulan'))
    {
        function hitungUsiaTahunBulan($tglahir,$batas)
        {
            $tanggal = new DateTime($tglahir);
            // tanggal hari ini
            $today = new DateTime($batas);
            // tahun
            $y = $today->diff($tanggal)->y;
            // bulan
            $m = $today->diff($tanggal)->m; 
            // hari
            $d = $today->diff($tanggal)->d;          
            return '<b>'.$y . "</b>t <b>" . $m . "</b>b <b>" . $d . "</b>h";
        }
    }

    
    if(!function_exists('hitungUsia'))
    {
        function hitungUsia($tglahir,$batas)
        {
            $tanggal = new DateTime($tglahir);
            // tanggal hari ini
            $today = new DateTime($batas);
            // tahun
            $y = $today->diff($tanggal)->y;
            // bulan
            $m = $today->diff($tanggal)->m;
            // hari
            $d = $today->diff($tanggal)->d;
            return $y . " Tahun " . $m . " Bulan " . $d . " Hari";
        }
    }

    if(!function_exists('hitungJamKerja'))
    {
        function hitungJamKerja($masuk,$pulang,$tglTok)
        {                     
            if($masuk!=$tglTok AND $pulang!=$tglTok){
                $dtCurrent = DateTime::createFromFormat('Y-m-d H:i:s', $masuk);
                $dtCreate = DateTime::createFromFormat('Y-m-d H:i:s', $pulang);
                $diff = $dtCurrent->diff($dtCreate);
                $intervalJam = $diff->format("%h");
                $intervalMenit = $diff->format("%i");            
                if($intervalJam!=''){
                    $d['jam'] = $intervalJam;
                    $d['menit'] = $intervalMenit;
                    return $d;
                }else{
                    $d['jam'] = '0';
                    $d['menit'] = '0';
                    return $d;
                }
            }else{
                    $d['jam'] = '0';
                    $d['menit'] = '0';
                    return $d;
            }
        }
    }

     if(!function_exists('generateCaptcha'))
    {
        function generateCaptcha() {
            $CI = getInstance();
            $vals = array(
                'word'          => '',
                'img_path'      => './assets/captcha/images/',
                'img_url'       => base_url('assets').'/captcha/images/',
                'font_path'     => base_url('assets').'/captcha/fonts/font29.ttf',
                'img_width'     => '150',
                'img_height'    => '41',
                'expiration'    => 1800,
                'word_length'   => 4,
                'font_size' => 36,
                'img_id'        => 'Imageid',
                'pool'      => '23456789ABCDEFGHJKLMNPQRSTUVWXYZ',
                'colors'    => array(
                    'background'    => array(255,255,255),
                    'border'    => array(28,0,0),
                    'text'      => array(28,0,0),
                    'grid'      => array(255,255,255)
                    )
                );
                $CI->load->helper('captcha');
                $captc = create_captcha($vals); 
                $isi = array(
                    'captcha_time'  => $captc['time'],
                    'ip_address'    => $CI->input->ip_address(),
                     'word'         => $captc['word'],
                     'images'       => $captc['filename']
                    );  
                $CI->mod_captcha->save_captcha($isi);
            return $captc; 
        }
    }

    if(!function_exists('setAksesToken'))
    {
        function setAksesToken($tokenName)
        {
            $CI = &get_instance();
            $token = guidv4();
            $CI->session->set_userdata($tokenName,$token);
            $inputToken = '<input type="hidden" name="'.$tokenName.'"  id="'.$tokenName.'" value="'.base64url_encode($token).'" required="">';
            return $inputToken;
        }
    }

    if(!function_exists('verifyAksesToken'))
    {
        function verifyAksesToken($tokenName,$token)
        {
            $CI = &get_instance();
            if($CI->session->userdata($tokenName)==base64url_decode($token)){
                return true;
            }
        }
    }

    if(!function_exists('setSession'))
    {
        function setSession($sessionName,$value) 
        { 
            $CI = getInstance(); 
            return $CI->session->set_userdata(base64url_encode($sessionName),base64url_encode($value));
        } 
    } 
    
    if(!function_exists('getSession'))
    {
        function getSession($sessionName) 
        { 
            $CI = getInstance(); 
            return base64url_decode($CI->session->userdata(base64url_encode($sessionName)));
        } 
    }
    
    if(!function_exists('destroySession'))
    {
        function destroySession() 
        { 
            $CI = getInstance(); 
            return $CI->session->sess_destroy();
        } 
    }

    //RuleUser
    if(!function_exists('wilayahLevel'))
    {
        function wilayahLevel() 
        { 
            //1 ADMIN | 2 PROV | 3 KAB | 4 KEC | 5 KEL
            $CI = getInstance(); 
            $level = getSession('level');            
            return ($level=='8' OR $level=='9' OR $level=='10') ? '5' : (($level=='7') ? '4' : (($level=='6') ? '3' : (($level=='5') ? '2' : '1')));
        } 
    }
	
	
	if(!function_exists('visitorLog'))
    {
        function visitorLog($page)
        {
            $CI = &get_instance();
            $isilog = array(
                'page_logv'=> $page,
                'ip_logv' => getClientIP(),
                'os_logv' => getOS(),
                'browser_logv' => getBrowser(),
            );
            return DB::saveData('log_visitor',$isilog);
        }
    }

    if(!function_exists('countVisitor'))
    {
        function countVisitor($url){
            $CI = &get_instance();
            $user_ip = getClientIP();
            if ($CI->agent->is_browser()){
                $agent = $CI->agent->browser();
            }elseif ($CI->agent->is_robot()){
                $agent = $CI->agent->robot();
            }elseif ($CI->agent->is_mobile()){
                $agent = $CI->agent->mobile();
            }else{
                $agent='Other';
            }
            $dataSave = [
                'url_pengunjung' => getSession('urls'),
                'pengunjung_ip' => getClientIP(),
                'pengunjung_perangkat' =>  $agent,
                'pengunjung_ref' => $CI->agent->is_referral(),
                'pengujung_platform' => $CI->agent->platform()
            ];
            return DB::saveDataIfNotExist('pengunjung',$dataSave,['url_pengunjung' => $url,'pengunjung_ip' => getClientIP(), 'LEFT(pengunjung_tanggal,10)' => date('Y-m-d')]);
           
        }
    }
    
    if(!function_exists('historyLog'))
    {
        function historyLog($aksi,$data)
        {
            $CI = &get_instance();
            $isilog = array(
                'userId_act'=> getSession('idUser'),
                'namaUser_act' => getSession('nama'),
                'nama_act' => $aksi,
                'detil_act' => $data,
                'userInfo_act' => userInfo()
            );
            return DB::saveData('activity',$isilog);
        }
    }

    if(!function_exists('unduhFile'))
    {
        function unduhFile($nama_berkas,$lokasi)
        {
            $CI = &get_instance();
            $CI->load->helper('download');
            $pathBerkas = $lokasi . $nama_berkas;         
            if (!file_exists($pathBerkas)) {
                redirect('404');
            }else{
                $ext = explode(".",$nama_berkas);
                $data = file_get_contents($pathBerkas);  
                force_download(substr($nama_berkas,0,10).'-'.time().'.'.$ext[1], $data);
            }        
        }
    }
	
	if(!function_exists('historyLogBefore'))
    {
        function historyLogBefore($aksi,$data,$nama,$idUser)
        {
            $CI = &get_instance();
            $isilog = array(
                'userId_act'=> $idUser,
                'namaUser_act' => $nama,
                'nama_act' => $aksi,
                'detil_act' => $data,
                'userInfo_act' => userInfo()
            );
            return DB::saveData('activity',$isilog);
        }
    }

    if(!function_exists('userInfo'))
    {
        function userInfo()
        {
            $ip = getClientIP();
            $os = getOS();
            $bws = getBrowser();
            $t=time();
            $waktu = date("Y-m-d H:i:s",$t);
            $tanggal= tgllokalhari($waktu);
            $jam = ' '.substr($waktu,11,5);
            return 'Info Pengguna: IP: '.$ip.', OS: '.$os.', Browser: '.$bws.', Pada: '.$tanggal.$jam;
        }
    }

    
    if(!function_exists('base64url_decode'))
    {
        function base64url_decode($data) 
        { 
            return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT)); 
        } 
    } 

    if(!function_exists('cleanInputPost'))
    {
        function cleanInputPost($namaInput)
        {
            $CI = getInstance();           
            $text2 = $CI->security->xss_clean($CI->input->post($namaInput));
            $text2 = htmlentities($text2);
            return str_replace(array('&lt;?', '<?', '?>', '?&gt;', '$', '='), array('', '', '', '', '', ''), $text2);
             
        }
    }

    if(!function_exists('cleanInputGet'))
    {
        function cleanInputGet($namaInput)
        {
            $CI = getInstance();           
            $text2 = $CI->security->xss_clean($CI->input->get($namaInput));
            $text2 = htmlentities($text2);
            return str_replace(array('&lt;?', '<?', '?>', '?&gt;', '$', '='), array('', '', '', '', '', ''), $text2);
             
        }
    }

    if(!function_exists('cleanInputText'))
    {
        function cleanInputText($text)
        {
            $CI = getInstance();
            $CI->load->helper('security');
            $text2 = $CI->security->xss_clean($text);
            $text2 = htmlentities($text2);
            return str_replace(array('&lt;?', '<?', '?>', '?&gt;', '$', '='), array('', '', '', '', '', ''), $text2);
        }
    }
    

    if(!function_exists('hitungJarakLurusPeta'))
    {
        function hitungJarakLurusPeta($lat1, $lon1, $lat2, $lon2, $unit) {
          if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
          }
          else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);
            if ($unit == "K") {
              return ($miles * 1.609344);
            } else if ($unit == "N") {
              return ($miles * 0.8684);
            } else {
              return $miles;
            }
          }
        }
    }

    if(!function_exists('hitungJarakLurus'))
    {
        function hitungJarakLurus($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo) 
        {
            //Calculate distance from latitude and longitude
            $theta = $longitudeFrom - $longitudeTo;
            $dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;

            $distance = ($miles * 1.60934);
            return number_format($distance,3);
        }
    }

    if(!function_exists('textDiantaraKarakter'))
    {
        function textDiantaraKarakter($str, $starting_word, $ending_word){ 
            $arr = explode($starting_word, $str); 
            if (isset($arr[1])){ 
                $arr = explode($ending_word, $arr[1]); 
                return $arr[0]; 
            } 
            return ''; 
        } 
    }

    //uploadFile
    if(!function_exists('uploadFile'))
    {
        function uploadFile($pathUpload,$mimeLegal,$fileInputName,$namaFile)
        {
            $CI = &get_instance();
            $config['upload_path'] = $pathUpload;
            $config['allowed_types'] = $mimeLegal;
            $config['max_filename'] = '255';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = '0';
            if (isset($_FILES[$fileInputName]['name'])) {
                if (0 < $_FILES[$fileInputName]['error']) {
                    return 'Error during file upload' . $_FILES[$fileInputName]['error'];
                } else {
                    $CI->load->library('upload', $config);
                    if (!$CI->upload->do_upload($fileInputName)) {
                        return $CI->upload->display_errors();
                    } else {
                        $filenama = $namaFile;
                        $fupload = $CI->upload->data();
                        move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $pathUpload.$filenama);
                        $file= $pathUpload.$fupload['file_name'];
                        $CI->load->helper("file");
                        @unlink($file);
                        return $filenama;
                    }
                }
            }else{
                return 'Nothing To Upload';
            }
        }
    }

    if(!function_exists('convertFilesBase64ToFile'))
    {
        function convertFilesBase64ToFile($path,$file64,$fileName,$ext)
        {            
            $CI = &get_instance();
            $CI->load->helper("file");
            $bas64File = base64_decode($file64);        
            @file_put_contents($path.$fileName.'.'.$ext, $bas64File);  
            return $fileName.'.'.$ext;          
        }
    }

    if(!function_exists('convertImageBase64'))
    {
        function convertImageBase64($img)
        {
            $image_parts = explode(";base64,", $img);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            return $image_base64;
        }
    }

    if(!function_exists('convertImageToBase64'))
    {
        function convertImageToBase64($pathImg)
        {
            $img    = file_get_contents($pathImg);	
		    $data   = base64_encode($img);
			return $data;
        }
    }

    if(!function_exists('convertFileToBase64FromCDN'))
    {
        function convertFileToBase64FromCDN($pathImg)
        {
            $img    = url_get_contents($pathImg);	
		    $data   = base64_encode($img);
			return $data;
        }
    }


    if(!function_exists('uploadBase64'))
    {
        function uploadBase64($file64,$nama,$folder)
        {
                $datafile = base64_decode($file64);
                $filename = $nama.'-'.strtotime('now').'.jpg';
                $file = $folder.$filename;
                @file_put_contents($file, $datafile);
                return $filename;
        }
    }

    if(!function_exists('uploadBase64General'))
    {
        function uploadBase64General($file64,$filename,$folder)
        {
                $datafile = base64_decode($file64);                
                $file = $folder.$filename;
                @file_put_contents($file, $datafile);
                return $filename;
        }
    }
    //==========
   
	
    if(!function_exists('sendSmtpMail'))
    {
         function sendSmtpMail($host,$port,$smtpEmail,$passMail,$appUrl,$appName,$emailTo,$title,$message)
        {
            $CI = getInstance();

            $config = Array(
                    'protocol' => 'smtp',
                    'smtp_host' => $host,
                    'smtp_port' => $port,
                    'smtp_user' => $smtpEmail,
                    'smtp_pass' => $passMail,
                    'mailtype'  => 'html', 
                    'charset'   => 'iso-8859-1'
                    );                
            $CI->load->library('email', $config);
            $CI->email->set_newline("\r\n");
            $CI->email->from('no-reply@'.$appUrl, $appName);
            $CI->email->to($emailTo);  
            $CI->email->subject($title);
            $CI->email->message($message);
            return $CI->email->send();
        }
    }

    
    if(!function_exists('curlData'))
    {
        function curlData($url)
        {
            //  Initiate curl
            $ch = curl_init();

            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);

            // Execute
            $result=curl_exec($ch);

            // Closing
            curl_close($ch);  
            return json_decode($result,true);  
        }
    }

    if(!function_exists('curlApiGet'))
    {
        function curlApiGet($url)
        {
            //  Initiate curl
            $ch = curl_init();

            // Disable SSL verification
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Will return the response, if false it print the response
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Set the url
            curl_setopt($ch, CURLOPT_URL,$url);

            // Execute
            $result=curl_exec($ch);

            // Closing
            curl_close($ch);  
            return json_decode($result,true);  
        }
    }

    if(!function_exists('curlApiData'))
    {
        function curlApiData($urlApi,$apiKey,$page,$type,$dataBody,$dataHeader)
        {   
            $CI = getInstance();
            $headerData = $dataHeader!='' ? '&'.$dataHeader : '';            
            $curl = curl_init();            
            curl_setopt_array($curl, array(
            CURLOPT_URL => $urlApi.$page.'?key='.$apiKey.$headerData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST =>$type, // "POST/GET",
            CURLOPT_POSTFIELDS => $dataBody,
            CURLOPT_HTTPHEADER => array(),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        } 
    }

        
    if(!function_exists('url_get_contents'))
    {
        function url_get_contents($Url) {            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_URL, $Url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            return $output;
        }
    }      

    
    //UnikID
    if(!function_exists('randomNumber'))
    {
        function randomNumber(){
          $digits = 6;
          return str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);
        }
    }

    if(!function_exists('randomId'))
    {    
        function randomId(){
          $length = 10;
            $key = "";
            $numbers = "23456789abcdefghijkmnpqrstuABCDEFGHIJKLMNPQRSTU!@#$&^*";
            for ($i = 0; $i < $length; $i++) {
                $key .= $numbers[rand(0, strlen($numbers) - 1)];
            }  
            return $key;
        }
    }
        
    if(!function_exists('guidv4'))
    {
        function guidv4() 
        {
            if (function_exists('com_create_guid') === true)
                return trim(com_create_guid(), '{}');

            $data = openssl_random_pseudo_bytes(16);
            $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
            $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
            return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
        }
    }

    if(!function_exists('guid'))
    {
        function guid(){
            if (function_exists('com_create_guid')){
                return com_create_guid();
            }else{
                mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
                $charid = strtoupper(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "-"
                $uuid = //chr(123)// "{"
                    substr($charid, 0, 8).$hyphen
                    .substr($charid, 8, 4).$hyphen
                    .substr($charid,12, 4).$hyphen
                    .substr($charid,16, 4).$hyphen
                    .substr($charid,20,12);
                    //.chr(125);// "}"
                return $uuid;
            }
        }
    }
	
	if(!function_exists('genUid'))
    {
		function genUid($tblName,$field)
		{
			return guidv4().'-'.time();
			/*$cek = DB::getDataSelectWhere($tblName,$field,[$field => $uid])->num_rows();
			return $cek>0 ? guidv4() : $uid;*/
		}		
	}

    

    if(!function_exists('paginasi'))
    {
        function paginasi($url, $count, $segment, $limit, $numLink)
        {
                $CI = getInstance();
                $offset = ($CI->uri->segment($segment)) ? $CI->uri->segment($segment) : "";
                $config['base_url'] = $url;
                $config['total_rows'] = $count;
                $config['per_page'] = $limit;
                $config['uri_segment'] = $segment;
                $config['num_links'] = $numLink;
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] ='<li style="display:none;">';
                $config['cur_tag_close'] ='</li>';
                $config['last_link'] = '';
                $config['first_link'] = '';
                $config['next_link'] = '<span aria-hidden="true">»</span>';
                $config['next_tag_open'] = '<li>';
                $config['next_tag_close'] = '</li>';
                $config['prev_link'] = '<span aria-hidden="true">«</span>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';        
                $CI->pagination->initialize($config); 
                $data= array(
                    'jumlah' => $config['total_rows'], 
                    'pagelinks' => $CI->pagination->create_links()
                );
                return $data;
        }
    }

    if(!function_exists('paginasiNonNumber'))
    {
        function paginasiNonNumber($url, $count, $segment, $limit, $numLink)
        {
                $CI = getInstance();
                $offset = ($CI->uri->segment($segment)) ? $CI->uri->segment($segment) : "";
                $config['base_url'] = $url; //site_url('store/').$slugToko.'/';
                $config['total_rows'] = $count;
                $config['per_page'] = $limit;
                $config['uri_segment'] = $segment;
                $config['num_links'] = $numLink;
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] ='<li style="display:none;">';
                $config['cur_tag_close'] ='</li>';
                $config['last_link'] = '';
                $config['first_link'] = '';
                $config['next_link'] = '<i class="fas fa-angle-double-right"></i>';
                $config['next_tag_open'] = '<li class="active">';
                $config['next_tag_close'] = '</li>';
                $config['prev_link'] = '<i class="fas fa-angle-double-left"></i>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';        
                $CI->pagination->initialize($config); 
                $data= array(
                    'jumlah' => $config['total_rows'], 
                    'pagelinks' => $CI->pagination->create_links()
                );
                return $data;
        }
    }

    if(!function_exists('paginasiApi'))
    {
        function paginasiApi($url, $count, $segment, $limit, $numLink,$offset)
        {
                $CI = getInstance();
                $offset = (($offset)) ? ($offset) : "";
                $config['base_url'] = $url;
                $config['total_rows'] = $count;
                $config['per_page'] = $limit;
                $config['uri_segment'] = $segment;
                $config['num_links'] = $numLink;
                $config['num_tag_open'] = '<li>';
                $config['num_tag_close'] = '</li>';
                $config['cur_tag_open'] ='<li style="display:none;">';
                $config['cur_tag_close'] ='</li>';
                $config['last_link'] = '';
                $config['first_link'] = '';
                $config['next_link'] = '<i class="fas fa-angle-double-right"></i>';
                $config['next_tag_open'] = '<li class="active">';
                $config['next_tag_close'] = '</li>';
                $config['prev_link'] = '<i class="fas fa-angle-double-left"></i>';
                $config['prev_tag_open'] = '<li>';
                $config['prev_tag_close'] = '</li>';        
                $CI->pagination->initialize($config); 
                $data= array(
                    'jumlah' => $config['total_rows'], 
                    'pagelinks' => $CI->pagination->create_links()
                );
                return $data;
        }
    }

    if(!function_exists('slug'))
    {
        function slug($text)
        {                                         
            $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
            // trim
            $text = trim($text, '-');
            // transliterate
            $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
            // lowercase
            $text = strtolower($text);
            // remove unwanted characters
            $text = preg_replace('~[^-\w]+~', '', $text);
            if (empty($text))
            {
                return 'n-a';
            }
            return $text;                   
        }
    }


        //userInfo===============
        //GetIPKlien
    if(!function_exists('getClientIP'))
    {
        function getClientIP() 
        {
              $ipaddress = '';
              if (isset($_SERVER['HTTP_CLIENT_IP']))
                  $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
              else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                  $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
              else if(isset($_SERVER['HTTP_X_FORWARDED']))
                  $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
              else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                  $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
              else if(isset($_SERVER['HTTP_FORWARDED']))
                  $ipaddress = $_SERVER['HTTP_FORWARDED'];
              else if(isset($_SERVER['REMOTE_ADDR']))
                  $ipaddress = $_SERVER['REMOTE_ADDR'];
              else
                  $ipaddress = 'UNKNOWN';
              return $ipaddress;
        }
    }
    
        //GetOSKlien
    if(!function_exists('getOS'))
    {
        function getOS() { 
          $user_agent = $_SERVER['HTTP_USER_AGENT'];
          $os_platform =   '';
          $os_array =   array(
            '/windows nt 10/i'      =>  'Windows 10',
            '/windows nt 6.3/i'     =>  'Windows 8.1',
            '/windows nt 6.2/i'     =>  'Windows 8',
            '/windows nt 6.1/i'     =>  'Windows 7',
            '/windows nt 6.0/i'     =>  'Windows Vista',
            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     =>  'Windows XP',
            '/windows xp/i'         =>  'Windows XP',
            '/windows nt 5.0/i'     =>  'Windows 2000',
            '/windows me/i'         =>  'Windows ME',
            '/win98/i'              =>  'Windows 98',
            '/win95/i'              =>  'Windows 95',
            '/win16/i'              =>  'Windows 3.11',
            '/macintosh|mac os x/i' =>  'Mac OS X',
            '/mac_powerpc/i'        =>  'Mac OS 9',
            '/linux/i'              =>  'Linux',
            '/ubuntu/i'             =>  'Ubuntu',
            '/iphone/i'             =>  'iPhone',
            '/ipod/i'               =>  'iPod',
            '/ipad/i'               =>  'iPad',
            '/android/i'            =>  'Android',
            '/blackberry/i'         =>  'BlackBerry',
            '/webos/i'              =>  'Mobile'
          );
          foreach ( $os_array as $regex => $value ) { 
            if ( preg_match($regex, $user_agent ) ) {
              $os_platform = $value;
            }
          }   
          return $os_platform;
        }
    }

        //GetBrowserKlien
    if(!function_exists('getBrowser'))
    {
        function getBrowser() {
          $user_agent = $_SERVER['HTTP_USER_AGENT'];
          $browser        = '';
          $browser_array  = array(
            '/msie/i'       =>  'Internet Explorer',
            '/firefox/i'    =>  'Firefox',
            '/safari/i'     =>  'Safari',
            '/chrome/i'     =>  'Chrome',
            '/edge/i'       =>  'Edge',
            '/opera/i'      =>  'Opera',
            '/netscape/i'   =>  'Netscape',
            '/maxthon/i'    =>  'Maxthon',
            '/konqueror/i'  =>  'Konqueror',
            '/mobile/i'     =>  'Mobile Browser'
          );
          foreach ( $browser_array as $regex => $value ) { 
            if ( preg_match( $regex, $user_agent ) ) {
              $browser = $value;
            }
          }
          return $browser;
        }
    }

    if(!function_exists('getLokasiIP'))
    {
        function getLokasiIP($ip)
        {
            if($ip!='::1' AND $ip!='127.0.0.1'){
                $getloc = json_decode(file_get_contents("http://ipinfo.io/".$ip."/json"));
                return $getloc->city.', IP ';
            }else{
                return 'Localhost, IP ';
            }
        }
    }

    if (!function_exists('randomHexColor')) {
        function randomHexColor()
        {
            return sprintf("#%06x", rand(0, 16777215));
        }
    }

    if(!function_exists('random_color'))
    {
        function random_color() {
            return random_color_part() . random_color_part() . random_color_part();
        }
    }

    if(!function_exists('random_color_part'))
    {
        function random_color_part() {
            return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
        }
    }

    if(!function_exists('iconPerangkat'))
    {
        function iconPerangkat($os)
        {
            if($os>='Windows' AND $os>='Mac' AND $os>='Linux'){
                return '<i class="icon-laptop" style="font-size:24px; color:green; vertical-align:middle;"></i>';
            }else{
                return '<i class="fa fa-mobile" style="font-size:24px; color:green; vertical-align:middle;"></i>';
            }
        } 
    }
	
	if(!function_exists('userInfo'))
    {
        function userInfo()
        {
            $ip = getClientIP();
            $os = getOS();
            $bws = getBrowser();
            $t=time();
            $waktu = date("Y-m-d H:i:s",$t);
            $tanggal= tgllokalhari($waktu);
            $jam = ' '.substr($waktu,11,5);
            return 'IP: '.$ip.', OS: '.$os.', Browser: '.$bws.', Pada: '.$tanggal.$jam;
        } 
    }
        //====userInfo
	
	//StandarisasiNoHP
	if ( ! function_exists('standarNoHp'))
    {
		function standarNoHp($number)
		{
			$input = str_replace(array(" ","-","+62"),array("","",""),$number);				
			$jumkar = strlen((int)$input);
			return str_pad($input,$jumkar+1,"0", STR_PAD_LEFT);
		}
	}
        //WAktu
	if ( ! function_exists('date_indo'))
    {
        function date_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.' '.$bulan.' '.$tahun;
        }
    }

    if ( ! function_exists('format_tgl_indo'))
    {
        function format_tgl_indo($tgl)
        {            
            $tanggal = substr($tgl,-2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
    }

    if ( ! function_exists('format_tgl_lahir'))
    {
        function format_tgl_lahir($tgl)
        {            
            $tanggal = substr($tgl,-2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.$bulan.substr($tahun,-2);
        }
    }

    if ( ! function_exists('dateRange'))
    {
        function dateRange($awal, $akhir)
        {
            $CI = getInstance();
            $begin = new DateTime($awal);
            $end = new DateTime($akhir);
            $daterange = $CI->getPeriode($begin,$end);
            $tgl=[];
            foreach($daterange as $date){
                $tgl[]= $date->format("Y-m-d");
            }
            return $tgl;
        }
    }

    if ( ! function_exists('getPeriode'))
    {
        function getPeriode($begin,$end)
        {
            $end = $end->modify( '+1 day' );
            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);
            
            return $daterange;
            
        }
    }
      
    if ( ! function_exists('bulan'))
    {
        function bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Januari";
                    break;
                case 2:
                    return "Februari";
                    break;
                case 3:
                    return "Maret";
                    break;
                case 4:
                    return "April";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Juni";
                    break;
                case 7:
                    return "Juli";
                    break;
                case 8:
                    return "Agustus";
                    break;
                case 9:
                    return "September";
                    break;
                case 10:
                    return "Oktober";
                    break;
                case 11:
                    return "November";
                    break;
                case 12:
                    return "Desember";
                    break;
            }
        }
    }
 
    //Format Shortdate
    if ( ! function_exists('shortdate_indo'))
    {
        function shortdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = short_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'/'.$bulan.'/'.$tahun;
        }
    }
      
    if ( ! function_exists('short_bulan'))
    {
        function short_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "01";
                    break;
                case 2:
                    return "02";
                    break;
                case 3:
                    return "03";
                    break;
                case 4:
                    return "04";
                    break;
                case 5:
                    return "05";
                    break;
                case 6:
                    return "06";
                    break;
                case 7:
                    return "07";
                    break;
                case 8:
                    return "08";
                    break;
                case 9:
                    return "09";
                    break;
                case 10:
                    return "10";
                    break;
                case 11:
                    return "11";
                    break;
                case 12:
                    return "12";
                    break;
            }
        }
    }
 
    //Format Medium date
    if ( ! function_exists('mediumdate_indo'))
    {
        function mediumdate_indo($tgl)
        {
            $ubah = gmdate($tgl, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tanggal = $pecah[2];
            $bulan = medium_bulan($pecah[1]);
            $tahun = $pecah[0];
            return $tanggal.'-'.$bulan.'-'.$tahun;
        }
    }
      
    if ( ! function_exists('medium_bulan'))
    {
        function medium_bulan($bln)
        {
            switch ($bln)
            {
                case 1:
                    return "Jan";
                    break;
                case 2:
                    return "Feb";
                    break;
                case 3:
                    return "Mar";
                    break;
                case 4:
                    return "Apr";
                    break;
                case 5:
                    return "Mei";
                    break;
                case 6:
                    return "Jun";
                    break;
                case 7:
                    return "Jul";
                    break;
                case 8:
                    return "Aug";
                    break;
                case 9:
                    return "Sep";
                    break;
                case 10:
                    return "Okt";
                    break;
                case 11:
                    return "Nov";
                    break;
                case 12:
                    return "Des";
                    break;
            }
        }
    }
     
    //Long date indo Format
    if ( ! function_exists('longdate_indo'))
    {
        function longdate_indo($tanggal)
        {
            $ubah = gmdate($tanggal, time()+60*60*8);
            $pecah = explode("-",$ubah);
            $tgl = $pecah[2];
            $bln = $pecah[1];
            $thn = $pecah[0];
            $bulan = bulan($pecah[1]);
      
            $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
            $nama_hari = "";
            if($nama=="Sunday") {$nama_hari="Minggu";}
            else if($nama=="Monday") {$nama_hari="Senin";}
            else if($nama=="Tuesday") {$nama_hari="Selasa";}
            else if($nama=="Wednesday") {$nama_hari="Rabu";}
            else if($nama=="Thursday") {$nama_hari="Kamis";}
            else if($nama=="Friday") {$nama_hari="Jumat";}
            else if($nama=="Saturday") {$nama_hari="Sabtu";}
            return $nama_hari.', '.$tgl.' '.$bulan.' '.$thn;
        }
    }	
		
    if(!function_exists('tgllokalhari'))
    {
        function tgllokalhari($waktu)
        {
            $hari_array = array(
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
            );
            $hr = date('w', strtotime($waktu));
            $hari = $hari_array[$hr];
            $tanggal = date('j', strtotime($waktu));
            $bulan_array = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            );
            $bl = date('n', strtotime($waktu));
            $bulan = $bulan_array[$bl];
            $tahun = date('Y', strtotime($waktu));
            $jam = date( 'H:i:s', strtotime($waktu)); 
            return "$hari, $tanggal $bulan $tahun";
        }
    }

    if(!function_exists('tgllokal'))
    {
        function tgllokal($waktu)
        {
            $hari_array = array(
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
            );
            $hr = date('w', strtotime($waktu));
            $hari = $hari_array[$hr];
            $tanggal = date('j', strtotime($waktu));
            $bulan_array = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            );
            $bl = date('n', strtotime($waktu));
            $bulan = $bulan_array[$bl];
            $tahun = date('Y', strtotime($waktu));
            $jam = date( 'H:i:s', strtotime($waktu));    
            
            return "$tanggal $bulan $tahun";
        }
    }

    if(!function_exists('tglindoTF'))
    {
        function tglindoTF($tanggal, $cetak_hari = false)
        {
            $hari = array ( 1 =>    'Senin',
                        'Selasa',
                        'Rabu',
                        'Kamis',
                        'Jumat',
                        'Sabtu',
                        'Minggu'
                    );
                    
            $bulan = array (1 =>   'Januari',
                        'Februari',
                        'Maret',
                        'April',
                        'Mei',
                        'Juni',
                        'Juli',
                        'Agustus',
                        'September',
                        'Oktober',
                        'November',
                        'Desember'
                    );
            $split    = explode('-', $tanggal);
            $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
            
            if ($cetak_hari) {
                $num = date('N', strtotime($tanggal));
                return $hari[$num] . ', ' . $tgl_indo;
            }
            return $tgl_indo;
        }
    }

    if(!function_exists('hitungWaktu'))
    {
        function hitungWaktu($waktu)
        {
            $create_time = $waktu;
            $current_time= date('Y-m-d H:i:s');
            $dtCurrent = new DateTime();
            $dtCreate = DateTime::createFromFormat('Y-m-d H:i:s', $create_time);
            $diff = $dtCurrent->diff($dtCreate);
            $interval = $diff->format("%y tahun %m bulan %d hari %h jam %i menit");
            $intervals = preg_replace('/(^0| 0) (tahun|bulan|hari|jam|menit)/', '', $interval);
            if($intervals!=''){
                return $intervals.' lalu';
            }else{
                return '';
            }
        }
    }

    function getNamaHari($tgl){
     $tanggal = substr($tgl, 0,10);//'2015-06-03';
      $day = date('D', strtotime($tanggal));
      $dayList = array(
          'Sun' => 'Minggu',
          'Mon' => 'Senin',
          'Tue' => 'Selasa',
          'Wed' => 'Rabu',
          'Thu' => 'Kamis',
          'Fri' => 'Jumat',
          'Sat' => 'Sabtu'
      );
     return $dayList[$day];
    }

    
    //Digitt============
    if(!function_exists('penyebut'))
    {
        function penyebut($nilai) {
                $nilai = abs($nilai);
                $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
                $temp = "";
                if ($nilai < 12) {
                    $temp = " ". $huruf[$nilai];
                } else if ($nilai <20) {
                    $temp = penyebut($nilai - 10). " belas";
                } else if ($nilai < 100) {
                    $temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
                } else if ($nilai < 200) {
                    $temp = " seratus" . penyebut($nilai - 100);
                } else if ($nilai < 1000) {
                    $temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
                } else if ($nilai < 2000) {
                    $temp = " seribu" . penyebut($nilai - 1000);
                } else if ($nilai < 1000000) {
                    $temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
                } else if ($nilai < 1000000000) {
                    $temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
                } else if ($nilai < 1000000000000) {
                    $temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
                } else if ($nilai < 1000000000000000) {
                    $temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
                }     
                return $temp;
            }
    }

    if(!function_exists('terbilang'))
    {     
        function terbilang($nilai) {
            if($nilai<0) {
                $hasil = "minus ". trim(penyebut($nilai));
            } else {
                $hasil = trim(penyebut($nilai));
            }           
            return $hasil;
        }
    }

    if(!function_exists('desimalTitik'))
    {
        function desimalTitik($number,$digit)
        {
            return number_format($number,$digit,",",".");
            ///9,000 -> 9.0000;
        }
    }

    if(!function_exists('number_format_short'))
    {
        function number_format_short( $n ) {
            if ($n >= 0 && $n < 1000) {
                // 1 - 999
                $n_format = floor($n);
                $suffix = '';
            } else if ($n >= 1000 && $n < 1000000) {
                // 1k-999k
                $n_format = floor($n / 1000);
                $suffix = 'K+';
            } else if ($n >= 1000000 && $n < 1000000000) {
                // 1m-999m
                $n_format = floor($n / 1000000);
                $suffix = 'M+';
            } else if ($n >= 1000000000 && $n < 1000000000000) {
                // 1b-999b
                $n_format = floor($n / 1000000000);
                $suffix = 'B+';
            } else if ($n >= 1000000000000) {
                // 1t+
                $n_format = floor($n / 1000000000000);
                $suffix = 'T+';
            }

            return !empty($n_format . $suffix) ? $n_format . $suffix : 0;

            //9000 -> 9K
        }
    }
?>