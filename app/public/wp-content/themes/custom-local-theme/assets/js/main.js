/**
 * Custom Local Theme - Main JavaScript
 *
 * @package Custom_Local_Theme
 * @since 1.0.0
 */

(function() {
	'use strict';

	// Mobile menu toggle
	function initMobileMenu() {
		const menuToggle = document.getElementById('menu-toggle');
		const mainMenu = document.querySelector('.main-menu');

		if (!menuToggle || !mainMenu) {
			return;
		}

		// Toggle menu on button click
		menuToggle.addEventListener('click', function(e) {
			e.preventDefault();
			mainMenu.classList.toggle('active');
			const isActive = mainMenu.classList.contains('active');
			this.setAttribute('aria-expanded', isActive ? 'true' : 'false');
		});

		// Close menu when clicking outside
		document.addEventListener('click', function(e) {
			if (!e.target.closest('header')) {
				mainMenu.classList.remove('active');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});

		// Close menu when clicking a link
		const menuLinks = mainMenu.querySelectorAll('a');
		menuLinks.forEach(link => {
			link.addEventListener('click', function() {
				mainMenu.classList.remove('active');
				menuToggle.setAttribute('aria-expanded', 'false');
			});
		});

		// Close menu on Escape key
		document.addEventListener('keydown', function(e) {
			if (e.key === 'Escape') {
				mainMenu.classList.remove('active');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});
	}

	// Smooth scroll behavior for anchor links
	function initSmoothScroll() {
		const links = document.querySelectorAll('a[href^="#"]');

		links.forEach(link => {
			link.addEventListener('click', function(e) {
				const href = this.getAttribute('href');

				// Ignore empty hashes and menu toggles
				if (href === '#' || href === '#menu-toggle') {
					return;
				}

				const target = document.querySelector(href);

				if (target) {
					e.preventDefault();

					target.scrollIntoView({
						behavior: 'smooth',
						block: 'start'
					});
				}
			});
		});
	}

	// Lazy load images (if needed for performance)
	function initLazyLoad() {
		if ('IntersectionObserver' in window) {
			const images = document.querySelectorAll('img[data-src]');

			const imageObserver = new IntersectionObserver((entries) => {
				entries.forEach(entry => {
					if (entry.isIntersecting) {
						const img = entry.target;
						img.src = img.dataset.src;
						img.removeAttribute('data-src');
						imageObserver.unobserve(img);
					}
				});
			}, {
				rootMargin: '50px'
			});

			images.forEach(img => imageObserver.observe(img));
		}
	}

	// Add active class to current page menu item
	function setActiveMenuItems() {
		const currentUrl = window.location.href;
		const menuLinks = document.querySelectorAll('.main-menu a');

		menuLinks.forEach(link => {
			if (link.href === currentUrl) {
				link.classList.add('current');
				link.parentElement.classList.add('current-menu-item');
			}
		});
	}

	// Initialize all scripts when DOM is ready
	document.addEventListener('DOMContentLoaded', function() {
		initMobileMenu();
		initSmoothScroll();
		initLazyLoad();
		setActiveMenuItems();
	});

	// Re-run menu setup after AJAX (for dynamic content)
	if (typeof window.jQuery !== 'undefined') {
		jQuery(document).on('wp_ajax_success', function() {
			setActiveMenuItems();
		});
	}

})();

// Accessibility: Focus management
(function() {
	'use strict';

	// Show focus outline on keyboard navigation
	let keyboardPressed = false;

	document.addEventListener('keydown', function() {
		keyboardPressed = true;
	});

	document.addEventListener('mousedown', function() {
		keyboardPressed = false;
	});

	// Apply focus styles only when keyboard is used
	document.addEventListener('focus', function(e) {
		if (keyboardPressed && e.target.matches('a, button, input, textarea, select')) {
			e.target.classList.add('keyboard-focus');
		}
	}, true);

	document.addEventListener('blur', function(e) {
		if (e.target.matches('a, button, input, textarea, select')) {
			e.target.classList.remove('keyboard-focus');
		}
	}, true);

})();
