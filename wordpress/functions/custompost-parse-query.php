<?php
/* ---------------------------------------------------------------------------
 カスタム投稿タイプ毎の表示件数設定
--------------------------------------------------------------------------- */
function parse_query( $query ) {
	if ( is_admin() )
		return;
	
	if (( get_query_var( 'post_type' ) == 'news' || get_query_var( 'news-term' ) ) ) {
		$query->set( 'posts_per_page', 20 );
	}
}
add_filter( 'parse_query', 'parse_query' ); 