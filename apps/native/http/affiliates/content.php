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

if (empty($cl["is_logged"])) {
	cl_redirect("guest");
}

else {
	$cl["page_title"] = cl_translate('Affiliates');
	$cl["page_desc"]  = $cl["config"]["description"];
	$cl["page_kw"]    = $cl["config"]["keywords"];
	$cl["pn"]         = "affiliates";
	$cl["sbr"]        = true;
	$cl["sbl"]        = true;

	$cl["app_statics"] = array(
		"styles" => array(
			cl_static_file_path("statics/css/apps/affiliates/style.master.css"),
			cl_static_file_path("statics/css/apps/affiliates/style.custom.css")
		)
	);

	$cl["http_res"] = cl_template("affiliates/content");
}