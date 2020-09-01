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

function cl_template($file_path = "") {
    global $config, $cl, $me;

    $path  = cl_strf("themes/%s/apps/%s.phtml",$config['theme'],$file_path);
    $path  = cl_full_path($path);
    $cont  = "";

    if (file_exists($path) != true) {
        die("File does not exists: $temp");
    } 
    
    ob_start();
	    require($path);
	    $cont = ob_get_contents();
    ob_end_clean();

    $cont = preg_replace_callback("/\{\%config\s{1}([a-z0-9_]{1,32})\%\}/", function($m) use ($config) {
        return ((isset($config[$m[1]])) ? $config[$m[1]] : "");
    }, $cont);

    return $cont;
}

function cl_sitemap($file_path = "") {
    global $cl;
    
    $path  = cl_strf("sitemap/%s.xml", $file_path);
    $path  = cl_full_path($path);
    $cont  = "";

    if (file_exists($path) != true) {
        die("File does not exists: $path");
    } 
    
    ob_start();
        require($path);
        $cont = ob_get_contents();
    ob_end_clean();

    return $cont;
}

function cl_sqltepmlate($path = '', $data = array()){
    $temp_path = cl_strf("core/%s.sql",$path);
    $template  = "";
    $temp_path = cl_full_path($temp_path);
    
    if (file_exists($temp_path)) {
        ob_start();
            require($temp_path);
            $template = ob_get_contents();
        ob_end_clean();
    }
    else {
        exit("$temp_path: Does not exists on the server!");
    }
    return $template;
}