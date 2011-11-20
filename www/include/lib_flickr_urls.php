<?php

	loadlib("flickr_photos");
	loadlib("flickr_users");

	#################################################################

	function flickr_urls_photo_thumb_flickr(&$photo){
		return "http://farm{$photo['farm']}.static.flickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_t.jpg";
	}

	#################################################################

	function flickr_urls_photo_static(&$photo){

		if (!$GLOBALS['cfg']['enable_storagemode']) {
			return _flickr_urls_photo_local_path($photo);

		} elseif ($photo['storagemode'] == 0) {
			return _flickr_urls_photo_local_path($photo);

		} elseif ($photo['storagemode'] == 1) {
			return _flickr_urls_photo_remote_uri($photo);
		}

	}
	
	function _flickr_urls_photo_local_path($photo) {
		$secret = $photo['secret'];
		$sz = "z";
		$ext = "jpg";
		
		$root = $GLOBALS['cfg']['flickr_static_url'];
		$path = flickr_photos_id_to_path($photo['id']);
		$fname = "{$photo['id']}_{$secret}_{$sz}.{$ext}";

		return $root . $path . "/" . $fname;
	}
	
	function _flickr_urls_photo_remote_uri($photo) {
		$sz = "z";
		$ext = "jpg";

	    return "http://farm{$photo['farm']}.static.flickr.com/{$photo['server']}/{$photo['id']}_{$photo['secret']}_{$sz}.{$ext}";
        
	}

	#################################################################

	function flickr_urls_photo_original(&$photo){

		$secret = $photo['originalsecret'];
		$sz = "o";
		$ext = $photo['originalformat'];

		$root = $GLOBALS['cfg']['flickr_static_url'];
		$path = flickr_photos_id_to_path($photo['id']);
		$fname = "{$photo['id']}_{$secret}_{$sz}.{$ext}";

		return $root . $path . "/" . $fname;
	}

	#################################################################

	function flickr_urls_photo_page(&$photo){

		$flickr_user = flickr_users_get_by_user_id($photo['user_id']);
		$alias = ($flickr_user['path_alias']) ? $flickr_user['path_alias'] : $flickr_user['nsid'];

		$root = $GLOBALS['cfg']['abs_root_url'];

		return $root . "photos/" . $alias . "/" . $photo['id'] . "/";
	}

	#################################################################

	function flickr_urls_photo_page_flickr(&$photo){

		$flickr_user = flickr_users_get_by_user_id($photo['user_id']);
		$alias = ($flickr_user['path_alias']) ? $flickr_user['path_alias'] : $flickr_user['nsid'];

		return "http://www.flickr.com/photos/" . $alias . "/" . $photo['id'] . "/";
	}

	#################################################################

	function flickr_urls_photos_user(&$user){

		$flickr_user = flickr_users_get_by_user_id($user['id']);
		$alias = ($flickr_user['path_alias']) ? $flickr_user['path_alias'] : $flickr_user['nsid'];

		$root = $GLOBALS['cfg']['abs_root_url'];

		return $root . "photos/" . $alias . "/";
	}

	#################################################################

	function flickr_urls_contacts_user(&$user){

		return flickr_urls_photos_user($user) . "contacts/";
	}

	#################################################################

	function flickr_urls_faves_user(&$user){

		return flickr_urls_photos_user($user) . "faves/";
	}

	#################################################################

?>
