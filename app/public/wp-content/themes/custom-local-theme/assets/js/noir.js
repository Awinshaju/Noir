/**
 * NOIR Theme - Enhanced JavaScript Interactions
 * 
 * Handles:
 * - Mobile menu functionality
 * - Header scroll effects
 * - Smooth scrolling
 * - Newsletter form
 * - Back to top button
 * - Scroll reveal animations
 *
 * @since 2.0.0
 */

(function() {
	'use strict';

	// Initialize NOIR theme
	const noir = {
		selectors: {
			menuToggle: '#menu-toggle',
			mainMenu: '.main-menu',
			header: '#site-header',
			scrollIndicator: '#scroll-indicator',
			newsletterForm: '#newsletter-form',
			newsletterEmail: '#newsletter-email',
			newsletterMessage: '#newsletter-message',
			backToTop: '#back-to-top',
			body: 'body',
			anchorLinks: 'a[href^="#"]'
		},

		classes: {
			active: 'active',
			menuOpen: 'menu-open',
			scrolled: 'scrolled'
		},

		init: function() {
			this.setupMobileMenu();
			this.setupScrollEffects();
			this.setupNewsletterForm();
			this.setupBackToTop();
			this.setupSmoothScroll();
			this.setupScrollReveal();
		},

		// Mobile Menu Setup
		setupMobileMenu: function() {
			const menuToggle = document.querySelector(this.selectors.menuToggle);
			const mainMenu = document.querySelector(this.selectors.mainMenu);
			const body = document.querySelector(this.selectors.body);

			if (!menuToggle || !mainMenu) return;

			// Toggle menu on button click
			menuToggle.addEventListener('click', (e) => {
				e.preventDefault();
				mainMenu.classList.toggle(this.classes.active);
				body.classList.toggle(this.classes.menuOpen);
				menuToggle.setAttribute('aria-expanded', 
					mainMenu.classList.contains(this.classes.active) ? 'true' : 'false'
				);
			});

			// Close menu on link click
			const menuLinks = mainMenu.querySelectorAll('a');
			menuLinks.forEach(link => {
				link.addEventListener('click', () => {
					this.closeMenu(mainMenu, menuToggle, body);
				});
			});

			// Close menu on escape key
			document.addEventListener('keydown', (e) => {
				if (e.key === 'Escape') {
					this.closeMenu(mainMenu, menuToggle, body);
				}
			});

			// Close menu on outside click
			document.addEventListener('click', (e) => {
				if (!e.target.closest('header') && mainMenu.classList.contains(this.classes.active)) {
					this.closeMenu(mainMenu, menuToggle, body);
				}
			});
		},

		closeMenu: function(menu, toggle, body) {
			menu.classList.remove(this.classes.active);
			body.classList.remove(this.classes.menuOpen);
			toggle.setAttribute('aria-expanded', 'false');
		},

		// Header Scroll Effects
		setupScrollEffects: function() {
			const header = document.querySelector(this.selectors.header);
			if (!header) return;

			window.addEventListener('scroll', () => {
				if (window.scrollY > 50) {
					header.classList.add(this.classes.scrolled);
				} else {
					header.classList.remove(this.classes.scrolled);
				}
			});
		},

		// Newsletter Form
		setupNewsletterForm: function() {
			const form = document.querySelector(this.selectors.newsletterForm);
			if (!form) return;

			form.addEventListener('submit', (e) => {
				e.preventDefault();
				
				const emailInput = document.querySelector(this.selectors.newsletterEmail);
				const messageDiv = document.querySelector(this.selectors.newsletterMessage);
				const email = emailInput.value.trim();

				// Email validation
				const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
				
				if (!emailRegex.test(email)) {
					this.showMessage(messageDiv, 'Please enter a valid email address.', 'error');
					return;
				}

				// Success
				this.showMessage(messageDiv, 'Thank you! Welcome to the NOIR frequency.', 'success');
				emailInput.value = '';

				// Clear message after 5 seconds
				setTimeout(() => {
					messageDiv.classList.remove('success', 'error');
					messageDiv.textContent = '';
				}, 5000);
			});
		},

		showMessage: function(element, message, type) {
			element.textContent = message;
			element.classList.add(type);
			element.classList.remove(type === 'error' ? 'success' : 'error');
		},

		// Back to Top Button
		setupBackToTop: function() {
			const btn = document.querySelector(this.selectors.backToTop);
			if (!btn) return;

			btn.addEventListener('click', () => {
				window.scrollTo({ top: 0, behavior: 'smooth' });
			});
		},

		// Smooth Scroll for Anchor Links
		setupSmoothScroll: function() {
			document.querySelectorAll(this.selectors.anchorLinks).forEach(anchor => {
				anchor.addEventListener('click', (e) => {
					const href = anchor.getAttribute('href');
					
					// Skip if href is just '#' or menu toggle
					if (href === '#' || href === '#menu-toggle') return;

					const target = document.querySelector(href);
					if (target) {
						e.preventDefault();
						target.scrollIntoView({ behavior: 'smooth', block: 'start' });
					}
				});
			});

			// Scroll indicator click
			const scrollIndicator = document.querySelector(this.selectors.scrollIndicator);
			if (scrollIndicator) {
				scrollIndicator.addEventListener('click', () => {
					const collection = document.getElementById('collection');
					if (collection) {
						collection.scrollIntoView({ behavior: 'smooth' });
					}
				});
			}
		},

		// Scroll Reveal Animation
		setupScrollReveal: function() {
			if ('IntersectionObserver' in window) {
				const observer = new IntersectionObserver((entries) => {
					entries.forEach(entry => {
						if (entry.isIntersecting) {
							entry.target.style.opacity = '1';
							entry.target.style.transform = 'translateY(0)';
						}
					});
				}, { threshold: 0.1 });

				// Observe elements for reveal animation
				document.querySelectorAll('.product-card, .principle').forEach(el => {
					el.style.opacity = '0';
					el.style.transform = 'translateY(20px)';
					el.style.transition = 'opacity 600ms cubic-bezier(0.25, 0.46, 0.45, 0.94), transform 600ms cubic-bezier(0.25, 0.46, 0.45, 0.94)';
					observer.observe(el);
				});
			}
		}
	};

	// Initialize when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', () => {
			noir.init();
		});
	} else {
		noir.init();
	}

	// Expose to window for debugging
	window.noir = noir;

})();
