<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package stairways
 */

?>

<section class="no-results not-found">
	<div class="page-content">
		<?php
		if ( is_search() ) :
			?>

			<p><?php esc_html_e( 'Ничего не нашли по вашему запросу', 'stairways' ); ?></p>
			<?php
			get_search_form();

		else :
			?>

			<p><?php esc_html_e( 'Пока тут пусто, скоро мы наполним этот раздел', 'stairways' ); ?></p>
			<?php
		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
