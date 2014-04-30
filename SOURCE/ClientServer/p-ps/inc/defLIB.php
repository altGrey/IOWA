<?php
/*	This file is a part of IOWA, the Iowa Online Web Application for 3D Web.
	IOWA is released under MIT License, which can be found in a document marked:
	LICENSE in the root directory of the source archive you downloaded this file
	with. In the event you cannot find the LICENSE document, you can visit:
	http://opensource.org/licenses/MIT for the full text of the MIT License.
	This file, however, is released into the PUBLIC DOMAIN by
	the Homeland3D Developers.
	
	To get more information about IOWA, please visit: http://homeland3d.org/
*/
icheck() or die();

///// Plugins
function runPlugins($itx) {
	$x = 0;
	while(isset($itx['plugins']['type']['registry'][$x])) {
		$result = myquery("SELECT COUNT() FROM `".dbprfx."plugins-list` where `plugin-type` = '".$itx['plugins']['type']['registry'][$x]."' AND ((`plugin-allow` LIKE ';".$itx['get']['id'].";') OR (`plugin-allow` LIKE ';ALL;')) AND (`plugin-allow` NOT LIKE ';DENY|".$itx['get']['id'].";')");
		if(mysql_result($result,0) != 0) {
			$numberofplugins = myrows($result);
			$xx = 0;
			$resultactual =  myquery("SELECT * FROM `".dbprfx."plugins-list` where `plugin-type` = '".$itx['plugins']['type']['registry'][$x]."' AND ((`plugin-allow` LIKE ';".$itx['get']['id'].";') OR (`plugin-allow` LIKE ';ALL;')) AND (`plugin-allow` NOT LIKE ';DENY|".$itx['get']['id'].";') ORDER BY `plugins-order` ASC");
			while($xx < $numberofplugins) {
				$array = myarray($resultactual);
				if(file_exists(pathPRV."plugins/plg-".$array['plugin-name']."/".$itx['plugins']['type']['registry'][$x].".php")) {
					include(pathPRV."plugins/plg-".$array['plugin-name']."/".$itx['plugins']['type']['registry'][$x].".php");
				}
				$xx++;
			}
		}
		$x++;
	}
}
//Initilize Session
function initSession($session) {
	if (!isset($session['initiated'])) {
		session_regenerate_id();
		$session['initiated'] = true;
	}
	return $session;
}
//Agent Session
function agentSession($session,$agent) {
	$fingerprint = md5($agent . secretPUB);
	if (isset($session['HTTP_USER_AGENT'])) {
		if ($session['HTTP_USER_AGENT'] != $fingerprint) {
			die();
			exit;
		}
	} else {
		$session['HTTP_USER_AGENT'] = $fingerprint;
	}
	return $session;
}
///// MIME Identification
if(!function_exists('mime_content_type')) {

    function mime_content_type($filename) {

        $mime_types = array(

            'txt' => 'text/plain',
            'htm' => 'text/html',
            'html' => 'text/html',
            'php' => 'text/html',
            'css' => 'text/css',
            'js' => 'application/javascript',
            'json' => 'application/json',
            'xml' => 'application/xml',
            'swf' => 'application/x-shockwave-flash',
            'flv' => 'video/x-flv',

            // images
            'png' => 'image/png',
            'jpe' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'jpg' => 'image/jpeg',
            'gif' => 'image/gif',
            'bmp' => 'image/bmp',
            'ico' => 'image/vnd.microsoft.icon',
            'tiff' => 'image/tiff',
            'tif' => 'image/tiff',
            'svg' => 'image/svg+xml',
            'svgz' => 'image/svg+xml',

            // archives
            'zip' => 'application/zip',
            'rar' => 'application/x-rar-compressed',
            'exe' => 'application/x-msdownload',
            'msi' => 'application/x-msdownload',
            'cab' => 'application/vnd.ms-cab-compressed',

            // audio/video
            'mp3' => 'audio/mpeg',
            'qt' => 'video/quicktime',
            'mov' => 'video/quicktime',

            // adobe
            'pdf' => 'application/pdf',
            'psd' => 'image/vnd.adobe.photoshop',
            'ai' => 'application/postscript',
            'eps' => 'application/postscript',
            'ps' => 'application/postscript',

            // ms office
            'doc' => 'application/msword',
            'rtf' => 'application/rtf',
            'xls' => 'application/vnd.ms-excel',
            'ppt' => 'application/vnd.ms-powerpoint',

            // open office
            'odt' => 'application/vnd.oasis.opendocument.text',
            'ods' => 'application/vnd.oasis.opendocument.spreadsheet',
        );

        $ext = strtolower(array_pop(explode('.',$filename)));
        if (array_key_exists($ext, $mime_types)) {
            return $mime_types[$ext];
        }
        elseif (function_exists('finfo_open')) {
            $finfo = finfo_open(FILEINFO_MIME);
            $mimetype = finfo_file($finfo, $filename);
            finfo_close($finfo);
            return $mimetype;
        }
        else {
            return 'application/octet-stream';
        }
    }
}
///// formatted time
function getPrettyTime($foo) {
 return date('l, F jS, Y g:i A',$foo);
}