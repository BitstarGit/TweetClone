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

function cl_get_bookmarks($user_id = false, $limit = 10, $offset = false) {
	global $db, $cl;

	if (not_num($user_id)) {
		return false;
	}

	$db        = $db->where('user_id', $user_id);
	$db        = $db->orderBy('id', 'DESC');
	$db        = ((is_posnum($offset)) ? $db->where('id', $offset, '<') : $db);
	$bookmarks = $db->get(T_BOOKMARKS,$limit);
	$data      = array();

	if (cl_queryset($bookmarks)) {
		foreach ($bookmarks as $row) {
			$post_data = cl_raw_post_data($row['publication_id']);

			if (not_empty($post_data)) {
				$post_data['offset_id'] = $row['id'];
				$data[]                 = cl_post_data($post_data);
			}
		}
	}

	return $data;
}