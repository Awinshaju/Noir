<?php
/**
 * Front Page Template - NOIR
 *
 * @package Custom_Local_Theme
 * @since 2.0.0
 */

get_header();
?>

<!-- ========================================
     SECTION A: HERO
     ======================================== -->
<section class="hero" id="hero" style="background-image: url('<?php echo esc_url( get_theme_file_uri( '/assets/images/noir-hero.png' ) ); ?>');">
	<div class="hero-content">
		<div class="hero-eyebrow">
			<?php esc_html_e( 'Independent Streetwear / Est. 2026', 'custom-local-theme' ); ?>
		</div>

		<h1>
			<?php esc_html_e( 'Not Made', 'custom-local-theme' ); ?><br><?php esc_html_e( 'To Fit In.', 'custom-local-theme' ); ?>
		</h1>

		<p class="hero-subtext">
			<?php esc_html_e( 'Uniforms for the unapologetically individual.', 'custom-local-theme' ); ?>
		</p>

		<div class="hero-cta">
			<a href="#collection" class="button button-primary hero-button-primary">
				<?php esc_html_e( 'Explore the Collection', 'custom-local-theme' ); ?>
			</a>
			<a href="#story" class="button button-secondary hero-button-secondary">
				<?php esc_html_e( 'Discover NOIR', 'custom-local-theme' ); ?>
			</a>
		</div>
	</div>

	<div class="scroll-indicator" id="scroll-indicator">
		<div class="scroll-indicator-text"><?php esc_html_e( 'Scroll to Explore', 'custom-local-theme' ); ?></div>
		<div class="scroll-indicator-arrow">↓</div>
	</div>
</section>

<!-- ========================================
     SECTION B: COLLECTION INTRO
     ======================================== -->
<section class="content-section" id="collection">
	<div class="container">
		<div class="section-label">
			<?php esc_html_e( '01 / The Collection', 'custom-local-theme' ); ?>
		</div>

		<h2 class="section-headline">
			<?php esc_html_e( 'Built for\AYour Own Lane.', 'custom-local-theme' ); ?>
		</h2>

		<p class="section-intro">
			<?php esc_html_e( 'Everyday essentials. Considered silhouettes. No unnecessary noise.', 'custom-local-theme' ); ?>
		</p>

		<p style="font-size: 0.875rem; letter-spacing: 0.08em; text-transform: uppercase; color: #888888; margin-top: 3rem;">
			<?php esc_html_e( 'Collection 001 — The Everyday Uniform', 'custom-local-theme' ); ?>
		</p>
	</div>
</section>

<!-- ========================================
     SECTION C: FEATURED PRODUCTS
     ======================================== -->
<section class="content-section">
	<div class="container">
		<div class="products-grid">
			<!-- Product 1 -->
			<article class="product-card">
				<div class="product-image">
					<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/heavyweight-tee.png' ) ); ?>" alt="<?php esc_attr_e( 'The Heavyweight Tee', 'custom-local-theme' ); ?>" loading="lazy">
				</div>
				<div class="product-index"><?php esc_html_e( '001', 'custom-local-theme' ); ?></div>
				<h3 class="product-name"><?php esc_html_e( 'The Heavyweight Tee', 'custom-local-theme' ); ?></h3>
				<div class="product-category"><?php esc_html_e( 'Essentials', 'custom-local-theme' ); ?></div>
				<div class="product-price">₹1,499</div>
			</article>

			<!-- Product 2 -->
			<article class="product-card">
				<div class="product-image">
					<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/oversized-hoodie.png' ) ); ?>" alt="<?php esc_attr_e( 'The Oversized Hoodie', 'custom-local-theme' ); ?>" loading="lazy">
				</div>
				<div class="product-index"><?php esc_html_e( '002', 'custom-local-theme' ); ?></div>
				<h3 class="product-name"><?php esc_html_e( 'The Oversized Hoodie', 'custom-local-theme' ); ?></h3>
				<div class="product-category"><?php esc_html_e( 'Outerwear', 'custom-local-theme' ); ?></div>
				<div class="product-price">₹3,499</div>
			</article>

			<!-- Product 3 -->
			<article class="product-card">
				<div class="product-image">
					<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/utility-cargo.png' ) ); ?>" alt="<?php esc_attr_e( 'The Utility Cargo', 'custom-local-theme' ); ?>" loading="lazy">
				</div>
				<div class="product-index"><?php esc_html_e( '003', 'custom-local-theme' ); ?></div>
				<h3 class="product-name"><?php esc_html_e( 'The Utility Cargo', 'custom-local-theme' ); ?></h3>
				<div class="product-category"><?php esc_html_e( 'Bottoms', 'custom-local-theme' ); ?></div>
				<div class="product-price">₹2,799</div>
			</article>
		</div>

		<p style="text-align: center; font-size: 0.85rem; color: #888888; margin-top: 3rem; letter-spacing: 0.05em;">
			<?php esc_html_e( 'These are demonstration products. Not available for purchase in this prototype.', 'custom-local-theme' ); ?>
		</p>
	</div>
</section>

<!-- ========================================
     SECTION D: CAMPAIGN EDITORIAL
     ======================================== -->
<section class="content-section">
	<div class="container">
		<div class="campaign-grid">
			<div class="campaign-image">
				<img src="<?php echo esc_url( get_theme_file_uri( '/assets/images/noir-campaign-01.png' ) ); ?>" alt="<?php esc_attr_e( 'NOIR Campaign Study', 'custom-local-theme' ); ?>">
			</div>

			<div class="campaign-content">
				<div class="campaign-label">
					<?php esc_html_e( '02 / Campaign', 'custom-local-theme' ); ?>
				</div>
				<h2><?php esc_html_e( 'Built Different.', 'custom-local-theme' ); ?></h2>
				<p class="campaign-intro"><?php esc_html_e( 'A new perspective on everyday streetwear.', 'custom-local-theme' ); ?></p>
				<p class="campaign-text"><?php esc_html_e( 'Designed around the pieces you reach for. Defined by the way you make them your own.', 'custom-local-theme' ); ?></p>
				<a href="#collection" class="button button-primary campaign-cta">
					<?php esc_html_e( 'Explore Collection', 'custom-local-theme' ); ?>
				</a>
				<div class="campaign-caption">
					<?php esc_html_e( 'NOIR Campaign — 001', 'custom-local-theme' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- ========================================
     SECTION E: BRAND STORY
     ======================================== -->
<section class="content-section" id="story">
	<div class="container">
		<div class="section-label">
			<?php esc_html_e( '03 / The NOIR Point of View', 'custom-local-theme' ); ?>
		</div>

		<h2 class="section-headline">
			<?php esc_html_e( 'Style Isn\'t\APermission.', 'custom-local-theme' ); ?>
		</h2>

		<p class="section-intro" style="max-width: 700px; margin-bottom: var(--spacing-3xl);">
			<?php esc_html_e( 'NOIR is a fictional independent streetwear concept built around individuality, thoughtful design, and the freedom to move on your own terms. Less about following a uniform. More about making it your own.', 'custom-local-theme' ); ?>
		</p>

		<div class="principles-grid">
			<!-- Principle 1 -->
			<div class="principle">
				<div class="principle-number">01 — Individuality</div>
				<h4 class="principle-title"><?php esc_html_e( 'Wear it your way.', 'custom-local-theme' ); ?></h4>
				<p class="principle-description">
					<?php esc_html_e( 'No dress codes. No expectations. Your uniform, your rules.', 'custom-local-theme' ); ?>
				</p>
			</div>

			<!-- Principle 2 -->
			<div class="principle">
				<div class="principle-number">02 — Intention</div>
				<h4 class="principle-title"><?php esc_html_e( 'Nothing without reason.', 'custom-local-theme' ); ?></h4>
				<p class="principle-description">
					<?php esc_html_e( 'Every stitch. Every seam. Every choice matters.', 'custom-local-theme' ); ?>
				</p>
			</div>

			<!-- Principle 3 -->
			<div class="principle">
				<div class="principle-number">03 — Movement</div>
				<h4 class="principle-title"><?php esc_html_e( 'Always becoming.', 'custom-local-theme' ); ?></h4>
				<p class="principle-description">
					<?php esc_html_e( 'Fashion evolves. So do you. Stay moving.', 'custom-local-theme' ); ?>
				</p>
			</div>
		</div>
	</div>
</section>

<!-- ========================================
     SECTION F: BRAND STATEMENT
     ======================================== -->
<section class="statement-section">
	<div class="container">
		<h2>
			<?php esc_html_e( 'You Don\'t Need\ATo Fit the Frame.', 'custom-local-theme' ); ?>
		</h2>
	</div>
</section>

<!-- ========================================
     SECTION G: NEWSLETTER
     ======================================== -->
<section class="content-section">
	<div class="container">
		<div class="newsletter-section">
			<div class="section-label" style="text-align: center;">
				<?php esc_html_e( 'The NOIR Frequency', 'custom-local-theme' ); ?>
			</div>

			<h2 class="section-headline" style="text-align: center;">
				<?php esc_html_e( 'Stay in the Loop.', 'custom-local-theme' ); ?>
			</h2>

			<p class="section-intro" style="text-align: center; max-width: 500px; margin: 0 auto var(--spacing-2xl);">
				<?php esc_html_e( 'Campaigns, new ideas, and collection updates. Nothing unnecessary.', 'custom-local-theme' ); ?>
			</p>

			<form class="newsletter-form" id="newsletter-form">
				<input 
					type="email" 
					class="newsletter-input" 
					id="newsletter-email" 
					placeholder="<?php esc_attr_e( 'Your email address', 'custom-local-theme' ); ?>" 
					required
				>
				<button type="submit" class="button button-primary">
					<?php esc_html_e( 'Join the List', 'custom-local-theme' ); ?>
				</button>
				<div id="newsletter-message" class="newsletter-message"></div>
			</form>

			<p style="text-align: center; font-size: 0.75rem; color: #888888; margin-top: var(--spacing-lg); letter-spacing: 0.05em;">
				<?php esc_html_e( 'This is a demonstration form. No data is collected.', 'custom-local-theme' ); ?>
			</p>
		</div>
	</div>
</section>

<?php get_footer();
