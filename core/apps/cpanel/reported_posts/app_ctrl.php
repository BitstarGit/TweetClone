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

function cl_admin_get_reported_posts($args = array()) {
    global $cl,$me,$db;

    $args           = (is_array($args)) ? $args : array();
    $options        = array(
        "offset"    => false,
        "limit"     => 10,
        "offset_to" => false,
        "order"     => 'DESC',
    );

    $args           = array_merge($options, $args);
    $offset         = $args['offset'];
    $limit          = $args['limit'];
    $order          = $args['order'];
    $offset_to      = $args['offset_to'];
    $t_reports      = T_REPORTS;
    $t_users        = T_USERS;
    $sql            = cl_sqltepmlate('apps/cpanel/reported_posts/sql/fetch_reported_posts',array(
        'offset'    => $offset,
        't_reports' => $t_reports,
        't_users'   => $t_users,
        'limit'     => $limit,
        'offset_to' => $offset_to,
        'order'     => $order,
    ));

    $data  = array();
    $reported_posts = $db->rawQuery($sql);

    if (cl_queryset($reported_posts)) {
        foreach ($reported_posts as $row) {
            $row['time']        = date('d M, Y h:m',$row['time']);
            $row['url']         = cl_link(cl_strf('@%s', $row['username']));
            $row['username']    = $row['name'];
            $row['avatar']      = cl_get_media($row['avatar']);
            $row['post_id']     = $row['post_id'];
            $row['post_url']    =cl_link(cl_strf('thread/%d', $row['post_id']));
            $data[]             = $row;
        }
    }

    return $data;
}

function cl_admin_total_reported_posts(){
    global $db, $cl;
    $qr = $db->getValue(T_REPORTS,'COUNT(*)');
    $num = 0;

    if (is_posnum($qr)) {
        $num = $qr;
    }
    return $num;
}
