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

header('Content-Type: application/json');

set_error_handler('cl_json_server500_err');

$data   = array();
$api    = ((not_empty($_GET["api"])) ? $_GET["api"] : "");
$app    = ((not_empty($_GET["app"])) ? $_GET["app"] : "");
$action = ((not_empty($_GET["action"])) ? $_GET["action"] : "");
$csrf   = false;

if ($api == "native") {
	$app_stat = fetch_or_get($applications[$app], false);

	if ($app_stat == true) {
		$req_handler = cl_strf("apps/native/ajax/%s/content.php",$app);
		$errors      = array();
		$hash        = ((not_empty($_GET["hash"])) ? $_GET["hash"] : "");

		if (empty($hash)) {
		    $hash = ((not_empty($_POST["hash"])) ? $_POST["hash"] : "");
		}

		if ($csrf) {
			if (empty($hash) || empty(cl_verify_csrf_token($hash))) {
		        $data          =  array(
		            "status"   => "400",
		            "err_code" => "invalid_csrf_token",
		            "message"  => "ERROR: Invalid or missing CSRF token"
		        );

		        echo json_encode($data, JSON_PRETTY_PRINT);
		        exit();
		    }
	    }

		require_once(cl_full_path($req_handler));

		echo json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
		exit();
	}
	else {
	    cl_json_server500_err(false, "Error: Handler for request not found");
	}
}

