<?php 
# @*************************************************************************@
# @ @author Mansur Altamirov (Mansur_TL)									@
# @ @author_url 1: https://www.instagram.com/mansur_tl                      @
# @ @author_url 2: http://codecanyon.net/user/mansur_tl                     @
# @ @author_email: highexpresstore@gmail.com                                @
# @*************************************************************************@
# @ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
# @ Copyright (c) 21.03.2020 ColibriSM. All rights reserved.                @
# @*************************************************************************@

require_once("core/init.php");

$app_name = (isset($_GET["app"])) ? $_GET["app"] : "home";
$app_stat = fetch_or_get($applications[$app_name], false);

if ($app_stat == true) {
	include_once(cl_strf("apps/native/http/%s/content.php",$app_name));

	if (empty($cl["http_res"])) {
		include_once("apps/native/http/err404/content.php");
	}
} 

else {
	include_once("apps/native/http/err404/content.php");
}

$http_res = cl_template("container");

echo $http_res;
mysqli_close($mysqli);
unset($cl);