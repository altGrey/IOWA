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
//MySQL Query Database
function myquery($query) {
	mysql_connect(dbhost, dbuser, dbpass);
	mysql_select_db(dbname);
	$result = mysql_query($query);
	if (!mysql_errno() && @mysql_num_rows($result) > 0) {
}
else {
$result="not";
}
	mysql_close();
	return $result;
}
// MySQL Num Rows
function myrows($result) {
	$rows = @mysql_num_rows($result);
	return $rows;
}
// MySQL fetch array
function myarray($result) {
	$array = mysql_fetch_array($result);
	return $array;
}
// MySQL escape string
function myescape($query) {
	$escape = mysql_escape_string($query);
	return $escape;
}