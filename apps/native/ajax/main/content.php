<?php 
# @*************************************************************************@
# @ @author Mansur Altamirov (Mansur_TL)                                    @
# @ @author_url 1: https://www.instagram.com/mansur_tl                      @
# @ @author_url 2: http://codecanyon.net/user/mansur_tl                     @
# @ @author_email: highexpresstore@gmail.com                                @
# @*************************************************************************@
# @ ColibriSM - The Ultimate Modern Social Media Sharing Platform           @
# @ Copyright (c) 21.03.2020 ColibriSM. All rights reserved.                @
# @*************************************************************************@

if ($action == 'upload_post_image') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = "invalid_req_data";
        $data['status']   = 400;
        $post_data        = $me['draft_post'];

        if (not_empty($_FILES['image']) && not_empty($_FILES['image']['tmp_name'])) {
            if (empty($post_data)) {
                $post_id   = cl_create_orphan_post($me['id'], "image");
                $post_data = cl_get_orphan_post($post_id);

                cl_update_user_data($me['id'],array(
                    'last_post' => $post_id
                ));
            }
            
            if (not_empty($post_data) && $post_data["type"] == "image") {
                if (empty($post_data['media']) || count($post_data['media']) < 10) {
                    $file_info      =  array(
                        'file'      => $_FILES['image']['tmp_name'],
                        'size'      => $_FILES['image']['size'],
                        'name'      => $_FILES['image']['name'],
                        'type'      => $_FILES['image']['type'],
                        'file_type' => 'image',
                        'folder'    => 'images',
                        'slug'      => 'original',
                        'crop'      => array('width' => 300, 'height' => 300),
                        'allowed'   => 'jpg,png,jpeg,gif'
                    );

                    $file_upload = cl_upload($file_info);

                    if (not_empty($file_upload['filename'])) {
                        $post_id     =  $post_data['id'];
                        $img_id      =  $db->insert(T_PUBMEDIA, array(
                            "pub_id" => $post_id,
                            "type"   => "image",
                            "src"    => $file_upload['filename'],
                            "time"   => time(),
                            "json_data" => json(array(
                                "image_thumb" => $file_upload['cropped']
                            ),true)
                        ));

                        if (is_posnum($img_id)) {
                            $data['img']     = array("id" => $img_id, "url" => cl_get_media($file_upload['cropped']));
                            $data['status']  = 200;
                        }
                    }
                }
                else {
                    $data['err_code'] = "total_limit_exceeded";
                    $data['status']   = 400;
                }
            }
            else {
                cl_delete_orphan_posts($me['id']);
                cl_update_user_data($me['id'],array(
                    'last_post' => 0
                ));
            }
        }
    }
}

else if ($action == 'upload_post_video') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = "invalid_req_data";
        $data['status']   = 400;
        $post_data        = $me['draft_post'];

        if (not_empty($_FILES['video']) && not_empty($_FILES['video']['tmp_name'])) {
            if (empty($post_data)) {
                $post_id   = cl_create_orphan_post($me['id'], "video");
                $post_data = cl_get_orphan_post($post_id);

                cl_update_user_data($me['id'],array(
                    'last_post' => $post_id
                ));
            }

            if (not_empty($post_data) && $post_data["type"] == "video") {
                if (empty($post_data['media'])) {
                    $file_info      =  array(
                        'file'      => $_FILES['video']['tmp_name'],
                        'size'      => $_FILES['video']['size'],
                        'name'      => $_FILES['video']['name'],
                        'type'      => $_FILES['video']['type'],
                        'file_type' => 'video',
                        'folder'    => 'videos',
                        'slug'      => 'original',
                        'allowed'   => 'mp4,mov,3gp,webm',
                    );

                    $file_upload = cl_upload($file_info);
                    $upload_fail = false;
                    $post_id     = $post_data['id'];

                    if (not_empty($file_upload['filename'])) {
                        try {
                            require_once(cl_full_path("core/libs/ffmpeg-php/vendor/autoload.php"));

                            $ffmpeg         =  new FFmpeg(cl_full_path($config['ffmpeg_binary']));
                            $thumb_path     =  cl_gen_path(array(
                                "folder"    => "images",
                                "file_ext"  => "jpeg",
                                "file_type" => "image",
                                "slug"      => "poster",
                            ));

                            $ffmpeg->input($file_upload['filename']);
                            $ffmpeg->set('-ss','3');
                            $ffmpeg->set('-vframes','1');
                            $ffmpeg->set('-f','mjpeg');
                            $ffmpeg->output($thumb_path)->ready();
                        } 

                        catch (Exception $e) {
                            $upload_fail = true;
                        }

                        if (empty($upload_fail)) {
                            $img_id      =  $db->insert(T_PUBMEDIA, array(
                                "pub_id" => $post_id,
                                "type"   => "video",
                                "src"    => $file_upload['filename'],
                                "time"   => time(),
                                "json_data" => json(array(
                                    "poster_thumb" => $thumb_path
                                ),true)
                            ));

                            if (is_posnum($img_id)) {
                                $data['status'] =  200;
                                $data['video']  =  array(
                                    "source"    => cl_get_media($file_upload['filename']),
                                    "poster"    => cl_get_media($thumb_path),
                                );
                            }
                        }
                    }
                }
                else {
                    $data['err_code'] = "total_limit_exceeded";
                    $data['status']   = 400;
                }
            }
            else {
                cl_delete_orphan_posts($me['id']);
                cl_update_user_data($me['id'],array(
                    'last_post' => 0
                ));
            }
        }
    }
}

else if ($action == 'delete_post_image') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = "invalid_req_data";
        $data['status']   = 400;
        $image_id         = fetch_or_get($_POST['image_id'], 0);
        $post_data        = $me['draft_post'];

        if (not_empty($post_data) && is_posnum($image_id)) {
            $post_id    = $post_data['id'];
            $db         = $db->where('id', $image_id);
            $db         = $db->where('pub_id', $post_id);
            $image_data = $db->getOne(T_PUBMEDIA);

            if (cl_queryset($image_data)) {
                $json_data        = json($image_data['json_data']);
                $data['status']   = 200;
                $data['err_code'] = 0;
                $db               = $db->where('id', $image_id)->where('pub_id', $post_id);
                $qr               = $db->delete(T_PUBMEDIA);

                if (in_array($image_data['type'], array('image','video'))) {
                    cl_delete_media($image_data['src']);

                    if (not_empty($json_data['image_thumb'])) {
                        cl_delete_media($json_data['image_thumb']);
                    }
                }
            }

            if (count($post_data['media']) < 2) {
                cl_delete_orphan_posts($me['id']);
                cl_update_user_data($me['id'],array(
                    'last_post' => 0
                ));
            }
        }   
    }
}

else if ($action == 'delete_post_video') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = "invalid_req_data";
        $data['status']   = 400;
        $post_data        = $me['draft_post'];

        if (not_empty($post_data)) {

            $data['err_code'] = "0";
            $data['status']   = 200;
            
            cl_delete_orphan_posts($me['id']);
            cl_update_user_data($me['id'],array(
                'last_post' => 0
            ));
        }   
    }
}

else if ($action == 'publish_new_post') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = 0;
        $data['status']   = 400;
        $post_data        = $me['draft_post'];
        $curr_pn          = fetch_or_get($_POST['curr_pn'],"none");
        $post_text        = fetch_or_get($_POST['post_text'],"");
        $gif_src          = fetch_or_get($_POST['gif_src'],"");
        $thread_id        = fetch_or_get($_POST['thread_id'], 0);
        $post_text        = cl_croptxt($post_text,600);

        if (not_empty($post_data) && not_empty($post_data["media"])) {
            $data['status'] =  200;
            $thread_id      =  ((is_posnum($thread_id)) ? $thread_id : 0);
            $post_id        =  $post_data['id'];
            $post_text      =  cl_upsert_htags($post_text);
            $mentions       =  cl_get_user_mentions($post_text);
            $up             =  cl_update_post_data($post_id, array(
                "text"      => cl_text_secure($post_text),
                "status"    => "active",
                "thread_id" => $thread_id,
                "time"      => time()
            ));

            if (empty($thread_id)) {
                $db->insert(T_POSTS, array(
                    "user_id"        => $me['id'],
                    "publication_id" => $post_id,
                    "time"           => time()
                ));

                $data['posts_total'] = ($me['posts'] += 1);
                
                cl_update_user_data($me['id'], array(
                    'posts' => $data['posts_total']
                ));
            }

            else {
                $data['replys_total'] = cl_update_thread_replys($thread_id, 'plus');
                $thread_data          = cl_raw_post_data($thread_id);

                cl_update_post_data($post_id, array(
                    "target" => "pub_reply"
                ));

                if ($thread_data['user_id'] != $me['id']) {
                    cl_notify_user(array(
                        'subject'  => 'reply',
                        'user_id'  => $thread_data['user_id'],
                        'entry_id' => $post_id
                    ));
                }
            }

            #Delete post previews after successful posting
            
            if (in_array($curr_pn, array('home','thread'))) {
                $post_data    = cl_raw_post_data($post_id);
                $cl['li']     = cl_post_data($post_data);
                $data['html'] = cl_template('timeline/post');
            }

            if (not_empty($mentions)) {
                cl_notify_mentioned_users($mentions, $post_id);
            }
        }

        else {
            if (not_empty($post_text) || not_empty($gif_src)) {
                $thread_id      =  ((is_posnum($thread_id)) ? $thread_id : 0);
                $post_text      =  cl_upsert_htags($post_text);
                $mentions       =  cl_get_user_mentions($post_text);
                $insert_data    =  array(
                    "user_id"   => $me['id'],
                    "text"      => cl_text_secure($post_text),
                    "status"    => "active",
                    "type"      => "text",
                    "thread_id" => $thread_id,
                    "time"      => time()
                );

                $post_id = $db->insert(T_PUBS, $insert_data);

                if (is_posnum($post_id)) {

                    $data['status'] = 200;

                    if (empty($thread_id)) {
                        $db->insert(T_POSTS, array(
                            "user_id" => $me['id'],
                            "publication_id" => $post_id,
                            "time" => time()
                        ));


                        $data['posts_total'] = ($me['posts'] += 1);

                        cl_update_user_data($me['id'], array(
                            'posts' => $data['posts_total']
                        ));
                    }

                    else {
                        $data['replys_total'] = cl_update_thread_replys($thread_id,'plus');
                        $thread_data          = cl_raw_post_data($thread_id);

                        cl_update_post_data($post_id, array(
                            "target" => "pub_reply"
                        ));

                        if ($thread_data['user_id'] != $me['id']) {
                            cl_notify_user(array(
                                'subject'  => 'reply',
                                'user_id'  => $thread_data['user_id'],
                                'entry_id' => $post_id
                            ));
                        }
                    }

                    if (not_empty($gif_src) && is_url($gif_src)) {
                        $db->insert(T_PUBMEDIA, array(
                            "pub_id" => $post_id,
                            "type"   => "gif",
                            "src"    => $gif_src,
                            "time"   => time(),
                        ));

                        cl_update_post_data($post_id, array(
                            "type" => "gif"
                        ));
                    }

                    if (in_array($curr_pn, array('home','thread'))) {
                        $post_data    = cl_raw_post_data($post_id);
                        $cl['li']     = cl_post_data($post_data);
                        $data['html'] = cl_template('timeline/post');
                    }

                    if (not_empty($mentions)) {
                        cl_notify_mentioned_users($mentions, $post_id);
                    }
                }
            }
        }

        cl_delete_orphan_posts($me['id']);
        cl_update_user_data($me['id'], array(
            'last_post' => 0
        ));
    }
}

else if($action == 'get_draft_post') {
    $data['status']   = 404;
    $data['err_code'] = 0;
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        if (not_empty($me['draft_post'])) {
            if ($me['draft_post']['type'] == "image") {
                if (not_empty($me['draft_post']['media'])) {
                    $data['images'] = array();
                    $data['status'] = 200;
                    $data['type']   = "image";

                    foreach ($me['draft_post']['media'] as $row) {
                        $data['images'][] = array(
                            "id" => $row["id"],
                            "url" => cl_get_media($row["src"]),
                        );
                    }
                }
            }
            else if($me['draft_post']['type'] == "video") {

                $video_src = fetch_or_get($me['draft_post']['media'][0],false);
               
                if (not_empty($video_src)) {
                    $data['video']  = array();
                    $data['status'] = 200;
                    $data['type']   = "video";

                    $data['video']  = array(
                        "poster"    => cl_get_media($video_src['x']['poster_thumb']),
                        "source"    => cl_get_media($video_src['src'])
                    );
                }
            }
        }
    }
}

else if($action == 'follow') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['status']   = 404;
        $data['err_code'] = 0;
        $user_id          = fetch_or_get($_POST['id'],0);


        if (is_posnum($user_id) && $me['id'] != $user_id) {
            
            $udata = cl_raw_user_data($user_id);

            if (not_empty($udata)) {
            
                if (cl_is_following($me['id'], $user_id)) {
                    if (cl_unfollow($me['id'], $user_id)) {
                        
                        $me_followings           = ($me['following'] -= 1);
                        $udata_followers         = ($udata['followers'] -= 1);
                        $data['status']          = 200;
                        $data['total_following'] = $me_followings;

                        cl_update_user_data($me['id'], array(
                            'following' => (($me_followings < 0) ? 0 : $me_followings)
                        ));

                        cl_update_user_data($user_id, array(
                            'followers' => (($udata_followers < 0) ? 0 : $udata_followers)
                        ));

                        $db = $db->where('notifier_id', $me['id']);
                        $db = $db->where('recipient_id', $user_id);
                        $db = $db->where('subject', 'subscribe');
                        $db = $db->where('entry_id', $user_id);
                        $qr = $db->delete(T_NOTIFS);

                        if ($udata['profile_privacy'] == 'followers') {
                            $data['refresh'] = 1;
                        }
                    }
                }

                else{
                    if (cl_follow($me['id'], $user_id)) {

                        $data['status']          = 200;
                        $data['total_following'] = ($me['following'] += 1);

                        cl_update_user_data($me['id'], array(
                            'following' => $data['total_following']
                        ));

                        cl_update_user_data($user_id, array(
                            'followers' => ($udata['followers'] += 1)
                        ));

                        cl_notify_user(array(
                            'subject'  => 'subscribe',
                            'user_id'  => $user_id,
                            'entry_id' => $user_id,
                        ));

                        if ($udata['profile_privacy'] == 'followers') {
                            $data['refresh'] = 1;
                        }
                    }
                }
            }
        }
    }
}

else if($action == 'delete_post') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = 0;
        $data['status']   = 400;
        $post_id          = fetch_or_get($_POST['id'], 0);

        if (is_posnum($post_id)) {
            $post_data = cl_raw_post_data($post_id);

            if (not_empty($post_data) && ($post_data['user_id'] == $me['id'] || not_empty($cl['is_admin']))) {

                $post_owner = cl_raw_user_data($post_data['user_id']);

                if (not_empty($post_owner)) {
                    if ($post_data['target'] == 'publication') {

                        $data['posts_total'] = ($post_owner['posts'] -= 1);
                        $data['posts_total'] = ((is_posnum($data['posts_total'])) ? $data['posts_total'] : 0);

                        cl_update_user_data($post_data['user_id'], array(
                            'posts' => $data['posts_total']
                        ));

                        $db = $db->where('publication_id', $post_id);
                        $qr = $db->delete(T_POSTS);
                    }

                    else {
                        $data['url'] = cl_link(cl_strf("thread/%d", $post_data['thread_id']));

                        cl_update_thread_replys($post_data['thread_id'], 'minus');
                    }
                    
                    cl_recursive_delete_post($post_id);
                    
                    $data['status'] = 200;
                }
            }
        }
    }
}

else if($action == 'like_post') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = 0;
        $data['status']   = 400;
        $post_id          = fetch_or_get($_POST['id'], 0);

        if (is_posnum($post_id)) {
            $post_data = cl_raw_post_data($post_id);

            if (not_empty($post_data)) {
                if (cl_has_liked($me['id'], $post_id) != true) {
                    $db->insert(T_LIKES, array(
                        'pub_id'  => $post_id,
                        'user_id' => $me['id'],
                        'time'    => time()
                    ));

                    $likes_count         = ($post_data['likes_count'] += 1);
                    $data['status']      = 200;
                    $data['likes_count'] = $likes_count;

                    cl_update_post_data($post_id, array(
                        'likes_count' => $likes_count
                    ));

                    if ($post_data['user_id'] != $me['id']) {
                        cl_notify_user(array(
                            'subject'  => 'like',
                            'user_id'  => $post_data['user_id'],
                            'entry_id' => $post_id,
                        ));
                    }
                }
                else {
                    $db                  = $db->where('pub_id', $post_id);
                    $db                  = $db->where('user_id', $me['id']);
                    $qr                  = $db->delete(T_LIKES);
                    $data['status']      = 200;
                    $likes_count         = ($post_data['likes_count'] -= 1);
                    $data['likes_count'] = $likes_count;

                    cl_update_post_data($post_id, array(
                        'likes_count' => $likes_count
                    ));

                    $db = $db->where('notifier_id', $me['id']);
                    $db = $db->where('recipient_id', $post_data['user_id']);
                    $db = $db->where('subject', 'like');
                    $db = $db->where('entry_id', $post_id);
                    $rq = $db->delete(T_NOTIFS);
                }
            }
        }
    }
}

else if($action == 'show_likes') {
    $data['err_code'] = 0;
    $data['status']   = 400;
    $post_id          = fetch_or_get($_POST['id'], 0);

    if (is_posnum($post_id)) {
        $post_data = cl_raw_post_data($post_id);
   
        if (not_empty($post_data)) {
            $cl['liked_post']  = $post_id;
            $cl['post_likes']  = cl_get_post_likes($post_id, 30);
            $cl['likes_count'] = cl_number($post_data['likes_count']);
            $data['status']    = 200;
            $data['html']      = cl_template('timeline/modals/likes');
        }
    }
}

else if($action == 'load_likes') {
    $data['err_code'] = 0;
    $data['status']   = 400;
    $post_id          = fetch_or_get($_GET['id'], 0);
    $offset           = fetch_or_get($_GET['offset'], 0);

    if (is_posnum($post_id) && is_posnum($offset)) {
        $cl['post_likes'] = cl_get_post_likes($post_id, 30, $offset);
        $html_arr         = array();
   
        if (not_empty($cl['post_likes'])) {
            foreach ($cl['post_likes'] as $cl['li']) {
                $html_arr[] = cl_template('timeline/includes/like_li');
            }

            $data['status'] = 200;
            $data['html']   = implode('', $html_arr);
        }
    }
}

else if($action == 'bookmark_post') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = 0;
        $data['status']   = 400;
        $post_id          = fetch_or_get($_POST['id'], 0);
        $a                = fetch_or_get($_POST['a'], 'none');

        if (is_posnum($post_id)) {
            $post_data = cl_raw_post_data($post_id);

            if (not_empty($post_data)) {
                if (cl_has_saved($me['id'], $post_id) != true) {
                    $db->insert(T_BOOKMARKS, array(
                        'publication_id' => $post_id,
                        'user_id'        => $me['id'],
                        'time'           => time()
                    ));

                    $data['status']      = 200;
                    $data['status_code'] = '1';
                }
                else {
                    $db                  = $db->where('publication_id', $post_id);
                    $db                  = $db->where('user_id', $me['id']);
                    $qr                  = $db->delete(T_BOOKMARKS);
                    $data['status']      = 200;
                    $data['status_code'] = '0';
                }
            }
        }
    }
}

else if($action == 'repost') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['err_code'] = 0;
        $data['status']   = 400;
        $post_id          = fetch_or_get($_POST['id'], 0);

        if (is_posnum($post_id)) {
            $post_data = cl_raw_post_data($post_id);

            if (not_empty($post_data)) {
                if (cl_has_reposted($me['id'], $post_id) != true) {
                    $db->insert(T_POSTS, array(
                        'publication_id'  => $post_id,
                        'user_id'         => $me['id'],
                        'type'            => 'repost',
                        'time'            => time()
                    ));

                    $reposts_count         = ($post_data['reposts_count'] += 1);
                    $data['status']        = 200;
                    $data['reposts_count'] = $reposts_count;

                    cl_update_post_data($post_id, array(
                        'reposts_count' => $reposts_count
                    ));

                    if ($post_data['user_id'] != $me['id']) {
                        cl_notify_user(array(
                            'subject'  => 'repost',
                            'user_id'  => $post_data['user_id'],
                            'entry_id' => $post_id,
                        ));
                    }
                }
                else {
                    $db     = $db->where('publication_id', $post_id);
                    $db     = $db->where('user_id', $me['id']);
                    $db     = $db->where('type', 'repost');
                    $repost = $db->getOne(T_POSTS);

                    if (cl_queryset($repost)) {
                        $db                    = $db->where('publication_id', $post_id);
                        $db                    = $db->where('user_id', $me['id']);
                        $db                    = $db->where('type', 'repost');
                        $qr                    = $db->delete(T_POSTS);
                        $data['status']        = 200;
                        $data['repost_id']     = $repost['id'];
                        $reposts_count         = ($post_data['reposts_count'] -= 1);
                        $data['reposts_count'] = $reposts_count;

                        cl_update_post_data($post_id, array(
                            'reposts_count' => $reposts_count
                        ));

                        $db = $db->where('notifier_id', $me['id']);
                        $db = $db->where('recipient_id', $post_data['user_id']);
                        $db = $db->where('subject', 'repost');
                        $db = $db->where('entry_id', $post_id);
                        $rq = $db->delete(T_NOTIFS);
                    }
                }
            }
        }
    }
}

else if($action == 'update_msb_indicators') {
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }
    else {
        $data['status']        = 200;
        $data['notifications'] = cl_total_new_notifs();
        $data['messages']      = cl_total_new_messages();
    }
}

else if($action == 'search') {
    $data['err_code'] = 0;
    $data['status']   = 400;
    $search_query     = fetch_or_get($_GET['query'], false); 
    $type             = fetch_or_get($_GET['type'], false); 

    if (not_empty($search_query) && len_between($search_query,3, 32) && in_array($type, array('users','htags'))) {
        require_once(cl_full_path("core/apps/search/app_ctrl.php"));

        if ($type == "htags") {
            $search_query = cl_text_secure($search_query);
            $search_query = cl_croptxt($search_query, 32);
            $query_result = cl_search_hashtags($search_query, false, 150);
            $html_arr     = array();
            
            if (not_empty($query_result)) {
                foreach ($query_result as $cl['li']) {
                    $html_arr[] = cl_template('main/includes/search/htags_li');
                }

                $data['status'] = 200;
                $data['html']   = implode("", $html_arr);
            }  
        }
        else {
            $search_query = cl_text_secure($search_query);
            $search_query = cl_croptxt($search_query, 32);
            $query_result = cl_search_people($search_query, false, 150);
            $html_arr     = array();

            if (not_empty($query_result)) {
                foreach ($query_result as $cl['li']) {
                    $html_arr[] = cl_template('main/includes/search/users_li');
                }

                $data['status'] = 200;
                $data['html']   = implode("", $html_arr);
            }
        }
    }
}
//author : KSUN
else if($action == 'report_an_issue'){
    if (empty($cl["is_logged"])) {
        $data['status'] = 400;
        $data['error']  = 'Invalid access token';
    }else{
        $data['err_code'] = 0;
        $data['status'] = 400;
        $post_id = fetch_or_get($_POST['postId'], 0);
        $report_id = fetch_or_get($_POST['reportId'], 0);

        if (is_posnum($post_id)) {
            $post_data = cl_raw_post_data($post_id);
            if (not_empty($post_data)) {
                $db->insert(T_REPORTS, array(
                    'post_id' => $post_id,
                    'user_id' => $me['id'],
                    'report_id' => $report_id,
                    'time' => time()
                ));
                $data['status'] = 200;
                $data['message'] = $report_id;
                $data['status_code'] = '1';
            }
        }
    }
}