<?php
/**
* The template for displaying archive pages
*
* @link https://codex.wordpress.org/Template_Hierarchy
*
* @package WordPress
* @subpackage Twenty_Seventeen
* @since 1.0
* @version 1.0
*/
global $_wp_additional_image_sizes;
 
    $_wp_additional_image_sizes[ 'instit' ] = array(
        'width'  => 200,
        'height' => 200,
        'crop'   => true
    );

get_header(); 
$categories = get_the_category();
$cats=array();
foreach($categories as $cat){
$cats[] = $cat->term_id;
}
$category_id = $categories[0]->cat_ID;
$iscons=false;
$isdata = false;
$islogos=false;
foreach($categories as $c){
if($c->cat_ID == 31){ $iscons = true;}
if($c->term_id == 47){ $islogos = true;}
if($c->cat_ID == 30){ $isdata = true;}
if($c->parent == 31){ $iscons = true;}
if($c->parent == 30){ $isdata = true;}
}
//echo $category_id;
//if($_SERVER['REQUEST_URI'] == '/category/consortium/institutional-partners/'){
if($islogos){
?>
<div class="wrap">
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
<?php
$posts_array = get_posts(
    array(
        'posts_per_page' => -1,
//        'post_type' => 'fabric_building',
//'post_type' => 'post',
        'tax_query' => array(
            array(
              'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => 47,
            )
        )
    )
);
  //  $args = array( 'category' => 31, 'post_type' =>  'post' ); 
//    $postslist = get_poss( $args );    
$county=0;
echo '<table><tr>';
    foreach ($posts_array as $post) :  setup_postdata($post); 
$county += 1
    ?>  
    <?php 
	if ( '' !== get_the_post_thumbnail() && ! is_single() ){
echo '<td>'; 
//echo '<td style="border: 2px solid #FAFAFA; padding: 5px;">'; 
 the_post_thumbnail( 'instit' );
echo '</td>';
if ($county == 3){
echo '</tr><tr>';
$county = 0;
}
 //the_post_thumbnail( 'twentyseventeen-featured-image' );
}
	?>  
    <?php endforeach; ?> <?php
echo '</tr></table>';
} else {
if($iscons){
if($categories[0]->term_id != 43){
//if($categories[0]['term_id'] == 43){
//echo 'SEES';
// get_template_part( 'template-parts/header/data' );
//} else {
 get_template_part( 'template-parts/header/consortium' );}
}
else if($isdata){
if($_SERVER['REQUEST_URI'] == '/category/data/'){
 get_template_part( 'template-parts/header/data' );
}
}
?>
<div class="wrap">
<?php
//if (strpos($_SERVER['REQUEST_URI'], 'projects/') !== false){
//echo '<a style="position: absolute; right: 100px; border: 2px solid grey; padding: 5px;" href="https://amsterdamtimemachine.nl/wp-admin/post-new.php">Add project</a>';
//}
if($iscons || $isdata){
echo '<table><tr>';
}
?>

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>
<?php
//if($isdata){die();}
if($_SERVER['REQUEST_URI'] == '/category/data/'){
die();
}

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<?php
			/* Start the Loop */
$odd=true;
			while ( have_posts() ) : the_post();
if($iscons || $isdata){
if($odd){
//echo '1';
//echo '</div><div style="width: 200px; display: inline-block; border: 6px solid red;" >';
echo '</tr><tr>';
}else{
//echo '2';
echo '<td>&nbsp;</td>';
}
$odd = !$odd;
//echo '<div style=" float: left;" >';
echo '<td width="40%" >';
}
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/content', get_post_format() );
if($iscons || $isdata){
echo '</td>';
}
			endwhile;

			the_posts_pagination( array(
				'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif; 
if($iscons || $isdata){
echo '</table>';
}
}
?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
