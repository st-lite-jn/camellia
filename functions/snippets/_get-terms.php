<?php
/**
* ポストIDからその記事が属するタクソノミーのタームを返す関数
* @param int $post_id
* @return array
*/
function cmll_get_pid_terms($post_id){
	$cat_obj = null;
	$cat_terms = null;
	$tag_obj = null;
	$tag_terms = null;
	$tax_obj_arrays = array();
	$taxnomies = array_keys(get_the_taxonomies($post_id));
	foreach($taxnomies as $taxnomy) {
		array_push($tax_obj_arrays,get_taxonomy($taxnomy));
	}
	foreach ($tax_obj_arrays as $tax_obj_array) {
		//階層があればカテゴリー、なければタグに代入
		if($tax_obj_array->hierarchical) {
			$cat_obj = $tax_obj_array;
		} else {
			$tag_obj = $tax_obj_array;
		}
	}
	if($cat_obj) {
		$cat_terms = get_the_terms($post_id , $cat_obj->name);
	}
	if($tag_obj) {
		$tag_terms = get_the_terms($post_id , $tag_obj->name);
	}
	return array($cat_terms,$tag_terms);
}

/**
* 現在表示しているページの投稿タイプに紐付いているタクソノミーのタームを返す関数
* @param int $post_id
* @param bool $hierarchical
* @return String | bool
*/
function cmll_get_pt_terms($post_type,$hierarchical = true){
	$cat_obj = null;
	$terms = null;
	$tag_obj = null;
	$tax_obj_arrays = array();
	$taxnomies = get_object_taxonomies($post_type);
	if($taxnomies) {
		foreach($taxnomies as $taxnomy) {
			array_push($tax_obj_arrays,get_taxonomy($taxnomy));
		}
		foreach ($tax_obj_arrays as $tax_obj_array) {
			//階層があればカテゴリー、なければタグに代入
			if($tax_obj_array->hierarchical) {
				$cat_obj = $tax_obj_array;
			} else {
				//post_formatは除外
				if(!($tax_obj_array->name == "post_format")) {
					$tag_obj = $tax_obj_array;
				}
			}
		}
		//階層付きのタームを返す
		if($hierarchical && $cat_obj) {
			$terms = get_terms($cat_obj->name);
		//階層無しのタームを返す
		} elseif(!$hierarchical && $tag_obj) {
			$terms = get_terms($tag_obj->name);
		}
		return $terms;
	} else {
		return false;
	}
}
