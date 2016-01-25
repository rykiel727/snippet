<?php
/* ---------------------------------------------------------------------------
 検索結果ページのURLを変更
--------------------------------------------------------------------------- */
function search_url_rewrite_rule() {
	if ( is_search() && !empty($_GET['s'])) {
		wp_redirect(home_url("/search/") . urlencode(get_query_var('s')));
		exit();
	}
}
add_action('template_redirect', 'search_url_rewrite_rule');