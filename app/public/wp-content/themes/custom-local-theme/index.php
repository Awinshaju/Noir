<?php
/**
 * Main template file
 *
 * @package Custom_Local_Theme
 * @since 1.0.0
 */

get_header();
?>

<?php
	// Check if this is the front page
	if ( is_front_page() ) {
		// Display hero section
		?>
		<div class="hero">
			<div class="hero-content">
				<h1><?php bloginfo( 'name' ); ?></h1>
				<p><?php bloginfo( 'description' ); ?></p>
				<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="button">
					<?php esc_html_e( 'View Blog', 'custom-local-theme' ); ?>
				</a>
			</div>
		</div>

		<?php
			// Featured content section
		?>
		<section class="content-section">
			<div class="container">
				<h2 class="text-center"><?php esc_html_e( 'Welcome to Our Site', 'custom-local-theme' ); ?></h2>
				<p class="text-center">
					<?php esc_html_e( 'This is a clean, modern, responsive WordPress theme. Customize this content from your WordPress dashboard.', 'custom-local-theme' ); ?>
				</p>

				<?php
					// Display featured posts as cards
					$featured_query = new WP_Query( array(
						'posts_per_page' => 3,
						'orderby'        => 'date',
						'order'          => 'DESC',
					) );

					if ( $featured_query->have_posts() ) {
						echo '<div class="cards">';

						while ( $featured_query->have_posts() ) {
							$featured_query->the_post();
							?>
							<article class="card">
								<?php
									if ( has_post_thumbnail() ) {
										echo wp_kses_post( get_the_post_thumbnail( get_the_ID(), 'custom-medium' ) );
									}
								?>
								<div class="card-content">
									<h3 class="card-title">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h3>
									<p class="card-description">
										<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 20 ) ); ?>
									</p>
									<a href="<?php the_permalink(); ?>" class="read-more">
										<?php esc_html_e( 'Read More →', 'custom-local-theme' ); ?>
									</a>
								</div>
							</article>
							<?php
						}

						echo '</div>';
						wp_reset_postdata();
					}
				?>
			</div>
		</section>

		<?php
			// Call-to-action section
		?>
		<section class="content-section">
			<div class="container">
				<div class="cta-section">
					<h2><?php esc_html_e( 'Ready to Get Started?', 'custom-local-theme' ); ?></h2>
					<p><?php esc_html_e( 'Explore our latest content and stay updated with new posts.', 'custom-local-theme' ); ?></p>
					<div class="cta-buttons">
						<a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="button cta-button">
							<?php esc_html_e( 'Explore Blog', 'custom-local-theme' ); ?>
						</a>
						<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="button cta-button-secondary">
							<?php esc_html_e( 'Contact Us', 'custom-local-theme' ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

	<?php
	} elseif ( is_home() || is_archive() ) {
		// Blog listing page or archive
		?>
		<main class="container">
			<div style="display: grid; grid-template-columns: 1fr 300px; gap: 2rem;">
				<div>
					<?php
						if ( is_archive() ) {
							the_archive_title( '<h1 class="archive-title">', '</h1>' );
							the_archive_description( '<p>', '</p>' );
						} elseif ( is_home() ) {
							?>
							<h1><?php esc_html_e( 'Blog', 'custom-local-theme' ); ?></h1>
							<?php
						}
					?>

					<?php
						if ( have_posts() ) {
							while ( have_posts() ) {
								the_post();
								?>
								<article class="post" id="post-<?php the_ID(); ?>">
									<?php
										if ( has_post_thumbnail() ) {
											echo '<div style="margin-bottom: 1rem;">';
											echo wp_kses_post( get_the_post_thumbnail( get_the_ID(), 'custom-medium' ) );
											echo '</div>';
										}
									?>

									<h2 class="post-title">
										<a href="<?php the_permalink(); ?>">
											<?php the_title(); ?>
										</a>
									</h2>

									<?php custom_local_theme_post_meta(); ?>

									<div class="post-excerpt">
										<?php
											if ( has_excerpt() ) {
												the_excerpt();
											} else {
												the_content( esc_html__( 'Read More', 'custom-local-theme' ) );
											}
										?>
									</div>
								</article>
								<?php
							}

							// Display pagination
							custom_local_theme_pagination();
						} else {
							?>
							<p><?php esc_html_e( 'Sorry, no posts found.', 'custom-local-theme' ); ?></p>
							<?php
						}
						wp_reset_postdata();
					?>
				</div>

				<aside class="sidebar">
					<?php
						if ( is_active_sidebar( 'primary-sidebar' ) ) {
							dynamic_sidebar( 'primary-sidebar' );
						}
					?>
				</aside>
			</div>
		</main>
		<?php

	} elseif ( is_singular() ) {
		// Single post or page
		?>
		<main class="container" style="margin-top: 2rem; margin-bottom: 2rem;">
			<article class="post" id="post-<?php the_ID(); ?>">
				<?php
					if ( has_post_thumbnail() ) {
						echo '<div class="featured-image" style="margin-bottom: 2rem;">';
						echo wp_kses_post( get_the_post_thumbnail( get_the_ID(), 'custom-large' ) );
						echo '</div>';
					}
				?>

				<header class="post-header">
					<h1 class="post-title"><?php the_title(); ?></h1>

					<?php
						if ( 'post' === get_post_type() ) {
							custom_local_theme_post_meta();
						}
					?>
				</header>

				<div class="post-content">
					<?php
						the_content();

						// Display comments if enabled
						if ( comments_open() || get_comments_number() ) {
							echo '<hr style="margin: 3rem 0;">';
							comments_template();
						}
					?>
				</div>

				<?php
					// Display post navigation
					if ( 'post' === get_post_type() ) {
						$prev_post = get_previous_post();
						$next_post = get_next_post();

						if ( $prev_post || $next_post ) {
							echo '<nav style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #e5e7eb;">';

							if ( $prev_post ) {
								echo '<div>';
								echo '<p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">' . esc_html__( 'Previous Post', 'custom-local-theme' ) . '</p>';
								echo '<a href="' . esc_url( get_permalink( $prev_post->ID ) ) . '" style="font-weight: 600;">' . esc_html( $prev_post->post_title ) . '</a>';
								echo '</div>';
							}

							if ( $next_post ) {
								echo '<div style="text-align: right;">';
								echo '<p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">' . esc_html__( 'Next Post', 'custom-local-theme' ) . '</p>';
								echo '<a href="' . esc_url( get_permalink( $next_post->ID ) ) . '" style="font-weight: 600;">' . esc_html( $next_post->post_title ) . '</a>';
								echo '</div>';
							}

							echo '</nav>';
						}
					}
				?>
			</article>
		</main>
		<?php

	} else {
		// Default fallback
		?>
		<main class="container">
			<?php
				if ( have_posts() ) {
					while ( have_posts() ) {
						the_post();
						?>
						<article id="post-<?php the_ID(); ?>">
							<h1><?php the_title(); ?></h1>
							<?php the_content(); ?>
						</article>
						<?php
					}
				}
			?>
		</main>
		<?php
	}

get_footer();
