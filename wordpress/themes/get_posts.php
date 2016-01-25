<?php
	$paged		= (get_query_var('paged')) ? get_query_var('paged') : 1;
	$year		= get_query_var('year');
	$monthnum	= get_query_var('monthnum');
	$post_type	= get_post_type();
	$cat_id		= get_query_var('cat');
	$term		= get_query_var('term');
	
	//ベースクエリ
	$base = array(
			'numberposts'	=> get_option('posts_per_page')
		,	'paged'			=> $paged
	);
	//投稿タイプページ
	$tmpType = array();
	if($post_type){
		$tmpType = array(
			'post_type'		=> array($post_type)
		);
	}
	//月別アーカイブページ
	$tmpMonthly = array();
	if($monthnum){
		$tmpMonthly = array(
			'year'			=> $year
		,	'monthnum'		=> $monthnum
		);
	}
	//カテゴリアーカイブ
	$tmpCategory = array();
	if($cat_id){
		$tmpCategory = array(
			'cat'		=> $cat_id
		);
	}
	//タクソノミーアーカイブ
	$tmpTerm = array();
	if($term){
		$current_taxonomy = get_queried_object()->taxonomy;
		$tmpTerm = array(
			'taxonomy'		=> $current_taxonomy
		,	'term'			=> $term
		);
	}
	//各ページのパラメータをマージ
	$args = array_merge($base, $tmpType, $tmpMonthly, $tmpCategory, $tmpTerm);
	
	$posts = get_posts($args);
	if($posts){
		foreach($posts as $post){
			setup_postdata($post);
?>

<?php
		}
		wp_reset_postdata();
		
		//ページネーション
		if (function_exists('pagination')) {
			$additional_loop = new WP_Query($args);
			$max_pager_num = ceil($additional_loop->max_num_pages);
			pagination($max_pager_num);
		}
	} else {
		echo '<p>登録された記事がありません。</p>';
	}
?>