<?php
function acf_blocks() {
	if( function_exists('acf_register_block_type') ) {
		acf_register_block_type(array(
			'name'				=> 'cb_hero',
			'title'				=> __('CB Hero'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_hero.php',
			'keywords'			=> array( 'hero' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_hero_short',
			'title'				=> __('CB Short Hero'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_hero_short.php',
			'keywords'			=> array( 'short', 'hero' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_icon_hero',
			'title'				=> __('CB Application Hero'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_icon_hero.php',
			'keywords'			=> array( 'application', 'icon', 'hero' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_three_col_nav',
			'title'				=> __('CB Three Col Nav'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_three_col_nav.php',
			'keywords'			=> array( 'three', 'col', 'nav' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_support_cta',
			'title'				=> __('CB Support CTA'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_support_cta.php',
			'keywords'			=> array( 'support', 'cta' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_text_video',
			'title'				=> __('CB Text Video'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_text_video.php',
			'keywords'			=> array( 'text', 'video' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_text_image',
			'title'				=> __('CB Text / Image'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_text_image.php',
			'keywords'			=> array( 'text', 'image' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_breakout',
			'title'				=> __('CB Breakout'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_breakout.php',
			'keywords'			=> array( 'breakout' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_product_range_nav',
			'title'				=> __('CB Product Range Nav'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_product_range_nav.php',
			'keywords'			=> array( 'product', 'range', 'nav' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_stat_block',
			'title'				=> __('CB Stat Block'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_stat_block.php',
			'keywords'			=> array( 'stat', 'block' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_children',
			'title'				=> __('CB Page Children'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_children.php',
			'keywords'			=> array( 'page', 'children' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_children_icons',
			'title'				=> __('CB Page Children (with icons)'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_children_icons.php',
			'keywords'			=> array( 'page', 'children', 'icons' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_sub_page_title',
			'title'				=> __('CB Sub-Page Title'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_sub_page_title.php',
			'keywords'			=> array( 'sub', 'page', 'title' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_products_by_application',
			'title'				=> __('CB Products by Application'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_products_by_application.php',
			'keywords'			=> array( 'products', 'by', 'application' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_products_by_type',
			'title'				=> __('CB Products by Type'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_products_by_type.php',
			'keywords'			=> array( 'products', 'by', 'type' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_products_by_industry',
			'title'				=> __('CB Products by Industry'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_products_by_industry.php',
			'keywords'			=> array( 'products', 'by', 'industry' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_products_by_process',
			'title'				=> __('CB Products by Process'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_products_by_process.php',
			'keywords'			=> array( 'products', 'by', 'process' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_products',
			'title'				=> __('CB Products'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_products.php',
			'keywords'			=> array( 'products' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_latest',
			'title'				=> __('CB Latest Articles'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_latest.php',
			'keywords'			=> array( 'latest' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_product_selector',
			'title'				=> __('CB Product Selector'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_product_selector.php',
			'keywords'			=> array( 'product', 'selector' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_hs_form',
			'title'				=> __('CB HubSpot Form'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_hs_form.php',
			'keywords'			=> array( 'hubspot', 'form' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false, 'anchor' => true),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_downloads',
			'title'				=> __('CB Downloads'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_downloads.php',
			'keywords'			=> array( 'downloads' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_process_cards',
			'title'				=> __('CB Mechanical Installation Cards'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_process_cards.php',
			'keywords'			=> array( 'process', 'cards', 'mechanical', 'installation' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_application_icons',
			'title'				=> __('CB Application Icons'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_application_icons.php',
			'keywords'			=> array( 'application', 'icons' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		// unused
		acf_register_block_type(array(
			'name'				=> 'cb_installation_points',
			'title'				=> __('CB Installation Points'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_installation_points.php',
			'keywords'			=> array( 'application', 'icons' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		// unused
		acf_register_block_type(array(
			'name'				=> 'cb_process_benefits',
			'title'				=> __('CB Process Benefits'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_process_benefits.php',
			'keywords'			=> array( 'process', 'benefits' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_process_overview',
			'title'				=> __('CB Process Overview'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_process_overview.php',
			'keywords'			=> array( 'process', 'overview' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_three_cards',
			'title'				=> __('CB Three Cards'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_three_cards.php',
			'keywords'			=> array( 'three', 'cards' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_material_process_cards',
			'title'				=> __('CB Material and Process Cards'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_material_process_cards.php',
			'keywords'			=> array( 'material', 'cards', 'process' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_benefits',
			'title'				=> __('CB Benefits'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_benefits.php',
			'keywords'			=> array( 'benefits' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_accordion',
			'title'				=> __('CB Accordion'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_accordion.php',
			'keywords'			=> array( 'accordion' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_aggregate_plant',
			'title'				=> __('CB Aggregate Plant'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_aggregate_plant.php',
			'keywords'			=> array( 'aggregate', 'plant' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block_type(array(
			'name'				=> 'cb_steps',
			'title'				=> __('CB Steps'),
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'render_template'	=> 'page-templates/blocks/cb_steps.php',
			'keywords'			=> array( 'steps' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block(array(
			'name'				=> 'cb_filtered_news',
			'title'				=> __('CB Filtered News'),
			'description'		=> __(''),
			'render_template'	=> 'page-templates/blocks/cb_filtered_news.php',
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'keywords'			=> array( 'filtered', 'news' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block(array(
			'name'				=> 'cb_related_downloads',
			'title'				=> __('CB Related Downloads'),
			'description'		=> __(''),
			'render_template'	=> 'page-templates/blocks/cb_related_downloads.php',
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'keywords'			=> array( 'related', 'downloads' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block(array(
			'name'				=> 'cb_single_post',
			'title'				=> __('CB Single Post'),
			'description'		=> __(''),
			'render_template'	=> 'page-templates/blocks/cb_single_post.php',
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'keywords'			=> array( 'single', 'post' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block(array(
			'name'				=> 'cb_two_posts',
			'title'				=> __('CB Two Posts'),
			'description'		=> __(''),
			'render_template'	=> 'page-templates/blocks/cb_two_posts.php',
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'keywords'			=> array( 'two', 'posts' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block(array(
			'name'				=> 'cb_search',
			'title'				=> __('CB Search'),
			'description'		=> __(''),
			'render_template'	=> 'page-templates/blocks/cb_search.php',
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'keywords'			=> array( 'search' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));
		acf_register_block(array(
			'name'				=> 'cb_three_col_video',
			'title'				=> __('CB Three Col Video'),
			'description'		=> __(''),
			'render_template'	=> 'page-templates/blocks/cb_three_col_video.php',
			'category'			=> 'layout',
			'icon'				=> 'cover-image',
			'keywords'			=> array( 'three','col','video' ),
			'mode'	=> 'edit',
            'supports' => array('mode' => false),
		));    }
}
add_action('acf/init', 'acf_blocks');

// Gutenburg core modifications
add_filter( 'register_block_type_args', 'core_image_block_type_args', 10, 3 );
function core_image_block_type_args( $args, $name ) {
    if ( $name == 'core/paragraph' ) {
        $args['render_callback'] = 'modify_core_add_container';
    }
    if ( $name == 'core/list' ) {
        // $args['render_callback'] = 'modify_core_add_container';
    }
    if ( $name == 'core/columns' ) {
        // $args['render_callback'] = 'modify_core_add_container';
    }
    if ( $name == 'core/heading' ) {
        $args['render_callback'] = 'modify_core_heading';
    }
    if ( $name == 'core/button' ) {
        $args['render_callback'] = 'modify_core_buttons';
    }
    return $args;
}

function modify_core_add_container($attributes, $content) {
    ob_start();
	$class = $block['className'];
    ?>
    <div class="container-xl">
		<?=$content?>
    </div>
    <?php
    $content = ob_get_clean();
	return $content;
}

function modify_core_heading($attributes, $content) {
    ob_start();
    $id = strtolower( wp_strip_all_tags( $content ) );
    $id = cbslugify($id);
    ?>
    <div class="container-xl pt-4" id="<?=$id?>">
        <?=$content?>
    </div>
    <?php
    $content = ob_get_clean();
	return $content;
}

function modify_core_buttons($attributes, $content) {
	ob_start();

	$btn = $content;

	preg_match('/class="wp-block-button (.*?)"/', $btn, $class);
	
	preg_match('/href="(.*?)"/', $btn, $link);

	preg_match('/target="(.*?)" rel="(.*?)"/', $btn, $target);

	preg_match('/<a.*?>(.*?)<\/a>/', $btn, $label);

	?>
	<a class="btn <?=$class[1]?>" href="<?=$link[1]?>" target="<?=$target[1]?>" rel="<?=$target[2]?>"><?=$label[1]?></a>
	<?php
	$content = ob_get_clean();
	return $content;
}