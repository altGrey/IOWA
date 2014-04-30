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
include(pathPRV.'config/localization/'.defLANG.'/langCONFIG.php');
include(pathPRV.'inc/defLIB.php');
include(pathPRV.'inc/dbLIB.php');
if (!isset($_SESSION['token'])) {
	define('token',md5(uniqid(rand(), true)));
	$_SESSION['token'] = token;
}
define('ip',$_SERVER['REMOTE_ADDR']);
define('unixtime',time());
define('prettytime',getPrettyTime(unixtime));
$_SESSION = initSession($_SESSION);
$_SESSION = agentSession($_SESSION,$_SERVER['HTTP_USER_AGENT']);
$itx['get'] = safeGet($_GET);
runPlugins($itx);
die();
exit();