<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package stairways
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="container">
			<section class="error-404 not-found">
				<p class="error-number">404</p>


				<div class="page-content">
					<h1 class="offer__title heading_title"><?php esc_html_e( 'Упс... не нашли такой страницы', 'stairways' ); ?></h1>
					<p class="offer__subtitle">Попробуйте вернуться на главную страницу</p>
					<a href="<?php echo get_home_link(); ?>" class="button button--primary">Вернуться на главную</a>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</div>
		<style>
			.error-404 .error-number {
				text-align: center;
				font-size: 20rem;
				font-weight: 700;
				line-height: 1;
			}
			@media (max-width: 600px) {
				.error-404 .error-number {
					font-size: 10rem;
				}
			}
			.error-404 .page-content {
				max-width: 600px;
				margin-left: auto;
				margin-right: auto;
				display: flex;
				text-align: center;
				justify-content: center;
				flex-direction: column;
				padding-bottom: 5rem;
			}
		</style>	

	</main><!-- #main -->

<?php
get_footer();
