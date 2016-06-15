<?php
if ( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
     die('You are not allowed to call this page directly.');
}
/**
 * standard-wth-border.php - Similar to standard template but adds border around each post.
 *
 * This can be copied to a folder named 'featured-page-widget' in your theme
 * to customize the output.
 *
 * @package Featured Page Widget
 * @subpackage templates
 * @author GrandSlambert
 * @copyright 2009-2011
 * @access public
 * @since 2.0
 */
if ( $featured->have_posts() ) : while ($featured->have_posts()) : $featured->the_post();
?>
<div id="featured_post_<?php the_id(); ?>" class="featured-post-widget featured-post-widget-border">

     <?php if ( has_featured_post_image ( ) ) : ?>
          <div class="featured-post-image align<?php echo $instance['imagealign']; ?>">
               <?php the_featured_post_image(); ?>
          </div>
     <?php endif; ?>

     <h3 id="featured_post_title_<?php the_id(); ?>" class="featured-post-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
     </h3>

     <div id="featured_post_content_<?php the_id(); ?>" class="featured_post_content">
          <?php the_featured_post_content(); ?>
     </div>

     <div  id="featured_post_more_link_<?php the_id(); ?>" class="featured_post_more_link" style="text-align:<?php echo $instance['linkalign']; ?>;">
          <?php the_featured_post_read_more_link(); ?>
     </div>

     <div class="cleared" style="clear:both"></div>
</div>

<?php endwhile; endif; ?>