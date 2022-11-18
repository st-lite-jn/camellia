<?php
# -----------------------------------------------------------------
# 検索対象にカスタムフィールドの値を含める
# -----------------------------------------------------------------
/**
 * Extend WordPress search to include custom fields
 * http://adambalee.com
 * Join posts and postmeta tables
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cmll_cf_search_join($join) {
	global $wpdb;
	if (is_search()) {
		$join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
	}
	return $join;
}
add_filter('posts_join', 'cmll_cf_search_join');

/**
 * Modify the search query with posts_where
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cmll_cf_search_where($where) {
    global $wpdb;
    if (is_search()) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cmll_cf_search_where');

/**
 * Prevent duplicates
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cmll_cf_search_distinct($where) {
    global $wpdb;
    if (is_search()) {
        return "DISTINCT";
    }
    return $where;
}
add_filter('posts_distinct', 'cmll_cf_search_distinct');
