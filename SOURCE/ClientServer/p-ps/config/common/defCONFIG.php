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
////// Database Settings
define('dbhost','localhost');
define('dbname','iowaClient');
define('dbuser','mydbuser');
define('dbpass','changeme1234');
define('dbprfx','idc-');
////// FILE PATHS
define('pathPRV','home/whiterabbit/iowa/ClientServer/p-ps/');
define('pathWEB','home/whiterabbit/iowa/ClientServer/public_html');
////// Language Settings
if((!isset($_GET['dlang'])) OR (isset($_GET['dlang']) AND (preg_match('/(\w)+/',$_GET['dlang']) and (!file_exists(pathPRV.'/config/localization/'.$_GET['dlang'].'/langCONFIG.php'))))) {
	/// change this to the language pack for your desired default language.
	define('defLANG','english_US');
}
else {
	/// do not change this.
	define('defLANG',$_GET['dlang']);
}
////// Plugins
$itx['plugins']['type']['registry'] = array('pre','run','post');
///// Salts and Secrets
define('secretPUB','tollthebell');