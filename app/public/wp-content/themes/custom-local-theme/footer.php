	</main><!-- End of main content -->

	<footer id="site-footer">
		<div class="container">
			<div class="footer-content">
				<!-- Company Info -->
				<div class="footer-section">
					<h3><?php esc_html_e( 'NOIR', 'custom-local-theme' ); ?></h3>
					<p style="font-size: 0.85rem; color: #888888; margin-top: var(--spacing-sm);">
						<?php esc_html_e( 'Premium streetwear. Built around individuality.', 'custom-local-theme' ); ?>
					</p>
				</div>

				<!-- Collection -->
				<div class="footer-section">
					<h3><?php esc_html_e( 'Collection', 'custom-local-theme' ); ?></h3>
					<ul>
						<li><a href="#collection"><?php esc_html_e( 'The Everyday Uniform', 'custom-local-theme' ); ?></a></li>
						<li><a href="#collection"><?php esc_html_e( 'Campaign 001', 'custom-local-theme' ); ?></a></li>
						<li><a href="#collection"><?php esc_html_e( 'New Arrivals', 'custom-local-theme' ); ?></a></li>
					</ul>
				</div>

				<!-- Community -->
				<div class="footer-section">
					<h3><?php esc_html_e( 'Community', 'custom-local-theme' ); ?></h3>
					<ul>
						<li><a href="#story"><?php esc_html_e( 'Our Story', 'custom-local-theme' ); ?></a></li>
						<li><a href="#hero"><?php esc_html_e( 'About NOIR', 'custom-local-theme' ); ?></a></li>
						<li><a href="#"><?php esc_html_e( 'Contact', 'custom-local-theme' ); ?></a></li>
					</ul>
				</div>

				<!-- Legal -->
				<div class="footer-section">
					<h3><?php esc_html_e( 'Legal', 'custom-local-theme' ); ?></h3>
					<ul>
						<li><a href="#"><?php esc_html_e( 'Privacy Policy', 'custom-local-theme' ); ?></a></li>
						<li><a href="#"><?php esc_html_e( 'Terms of Service', 'custom-local-theme' ); ?></a></li>
						<li><a href="#"><?php esc_html_e( 'Shipping Info', 'custom-local-theme' ); ?></a></li>
					</ul>
				</div>
			</div>

			<div class="footer-bottom">
				<div>
					<div class="footer-branding"><?php bloginfo( 'name' ); ?></div>
					<div class="footer-tagline"><?php esc_html_e( 'Own Your Direction.', 'custom-local-theme' ); ?></div>
				</div>

				<div class="footer-copyright">
					<?php
						printf(
							esc_html__( '&copy; %d %s. All rights reserved.', 'custom-local-theme' ),
							date( 'Y' ),
							esc_html( get_bloginfo( 'name' ) )
						);
					?>
				</div>

				<button class="back-to-top" id="back-to-top" aria-label="<?php esc_attr_e( 'Back to Top', 'custom-local-theme' ); ?>">
					<?php esc_html_e( '↑ BACK TO TOP', 'custom-local-theme' ); ?>
				</button>
			</div>
		</div>
	</footer>

	<?php wp_footer(); ?>

	<script>
		// NOIR JavaScript - Core Interactions
		(function() {
			'use strict';

			// ========== Mobile Menu Toggle ==========
			const menuToggle = document.getElementById('menu-toggle');
			const mainMenu = document.querySelector('.main-menu');
			const body = document.body;

			if (menuToggle && mainMenu) {
				menuToggle.addEventListener('click', function(e) {
					e.preventDefault();
					mainMenu.classList.toggle('active');
					body.classList.toggle('menu-open');
					this.setAttribute('aria-expanded', mainMenu.classList.contains('active') ? 'true' : 'false');
				});

				// Close menu on link click
				const menuLinks = mainMenu.querySelectorAll('a');
				menuLinks.forEach(link => {
					link.addEventListener('click', function() {
						mainMenu.classList.remove('active');
						body.classList.remove('menu-open');
						menuToggle.setAttribute('aria-expanded', 'false');
					});
				});

				// Close menu on Escape
				document.addEventListener('keydown', function(e) {
					if (e.key === 'Escape') {
						mainMenu.classList.remove('active');
						body.classList.remove('menu-open');
						menuToggle.setAttribute('aria-expanded', 'false');
					}
				});

				// Close menu when clicking outside
				document.addEventListener('click', function(e) {
					if (!e.target.closest('header') && mainMenu.classList.contains('active')) {
						mainMenu.classList.remove('active');
						body.classList.remove('menu-open');
						menuToggle.setAttribute('aria-expanded', 'false');
					}
				});
			}

			// ========== Header Scroll Effect ==========
			const header = document.getElementById('site-header');
			window.addEventListener('scroll', function() {
				if (window.scrollY > 50) {
					header.classList.add('scrolled');
				} else {
					header.classList.remove('scrolled');
				}
			});

			// ========== Scroll Indicator Click ==========
			const scrollIndicator = document.getElementById('scroll-indicator');
			if (scrollIndicator) {
				scrollIndicator.addEventListener('click', function() {
					document.getElementById('collection').scrollIntoView({ behavior: 'smooth' });
				});
			}

			// ========== Newsletter Form ==========
			const newsletterForm = document.getElementById('newsletter-form');
			if (newsletterForm) {
				newsletterForm.addEventListener('submit', function(e) {
					e.preventDefault();
					
					const emailInput = document.getElementById('newsletter-email');
					const messageDiv = document.getElementById('newsletter-message');
					const email = emailInput.value.trim();

					// Simple email validation
					const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
					
					if (!emailRegex.test(email)) {
						messageDiv.textContent = '<?php esc_html_e( 'Please enter a valid email address.', 'custom-local-theme' ); ?>';
						messageDiv.classList.add('error');
						messageDiv.classList.remove('success');
						return;
					}

					// Show success message
					messageDiv.textContent = '<?php esc_html_e( 'Thank you! Welcome to the NOIR frequency.', 'custom-local-theme' ); ?>';
					messageDiv.classList.add('success');
					messageDiv.classList.remove('error');

					// Reset form
					emailInput.value = '';

					// Clear message after 5 seconds
					setTimeout(function() {
						messageDiv.classList.remove('success', 'error');
						messageDiv.textContent = '';
					}, 5000);
				});
			}

			// ========== Back to Top Button ==========
			const backToTopBtn = document.getElementById('back-to-top');
			if (backToTopBtn) {
				backToTopBtn.addEventListener('click', function() {
					window.scrollTo({ top: 0, behavior: 'smooth' });
				});
			}

			// ========== Smooth Scroll for Anchor Links ==========
			document.querySelectorAll('a[href^="#"]').forEach(anchor => {
				anchor.addEventListener('click', function(e) {
					const href = this.getAttribute('href');
					
					// Skip if href is just '#'
					if (href === '#' || href === '#menu-toggle') {
						return;
					}

					const target = document.querySelector(href);
					if (target) {
						e.preventDefault();
						target.scrollIntoView({ behavior: 'smooth', block: 'start' });
					}
				});
			});

			// ========== Reveal on Scroll Animation ==========
			if ('IntersectionObserver' in window) {
				const observer = new IntersectionObserver(function(entries) {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							entry.target.style.opacity = '1';
							entry.target.style.transform = 'translateY(0)';
						}
					});
				}, { threshold: 0.1 });

				// Observe specific elements
				document.querySelectorAll('.product-card, .principle').forEach(el => {
					el.style.opacity = '0';
					el.style.transform = 'translateY(20px)';
					el.style.transition = 'opacity 600ms cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 600ms cubic-bezier(0.25, 0.46, 0.45, 0.94)';
					observer.observe(el);
				});
			}

			// ========== Escape key to close menu ==========
			document.addEventListener('keydown', function(e) {
				if (e.key === 'Escape' && mainMenu && mainMenu.classList.contains('active')) {
					mainMenu.classList.remove('active');
					body.classList.remove('menu-open');
					menuToggle.setAttribute('aria-expanded', 'false');
				}
			});
		})();
	</script>
</body>
</html>
