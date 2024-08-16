$(function () {
	// Add to Cart
	function showCartModal($cart) {
		$('#cart-modal .modal-cart-content').html($cart);
		const myModalEl = document.querySelector('#cart-modal');
		const modal = bootstrap.Modal.getOrCreateInstance(myModalEl);
		modal.show();

		let cartQty = $('.cart-qty').text();
		if (cartQty) {
			$('.count-items').text(cartQty);
		} else {
			$('.count-items').text('0');
		}
	}

	$('#get-cart').click(function (e) {
		e.preventDefault();

		$.ajax({
			url: 'cart/show',
			type: 'GET',
			success: function (res) {
				showCartModal(res);
			},
			error: function () {
				alert('Error');
			}
		});
	});

	$('#cart-modal .modal-cart-content').on('click', '.del-item', function (e) {
		e.preventDefault();
		const $this = $(this);
		const id = $this.data('id');

		$.ajax({
			url: 'cart/delete',
			type: 'GET',
			data: { id: id },
			success: function (res) {
				const url = window.location.toString();
				if (url.indexOf('order') !== -1) {
					window.location = url;
				} else {
					showCartModal(res);
				}
			},
			error: function () {
				alert('Error');
			}
		});
	});

	$('#cart-modal .modal-cart-content').on('click', '.clear-cart', function (e) {
		e.preventDefault();

		$.ajax({
			url: 'cart/clear',
			type: 'GET',
			success: function (res) {
				const url = window.location.toString();
				if (url.indexOf('order') !== -1) {
					window.location = url;
				} else {
					showCartModal(res);
					document.find('.product-card i').removeClass('fas fa-dolly-flatbed').addClass('fas fa-shopping-cart');
				}
			},
			error: function () {
				alert('Error');
			}
		});
	});

	$('.product-card').on('click', '.add-to-cart', function (e) {
		e.preventDefault();
		const $this = $(this);
		const id = $this.data('id');
		const qty = $('#input-quantity').val() ? $('#input-quantity').val() : 1;

		$.ajax({
			url: 'cart/add',
			type: 'GET',
			data: { id: id, qty: qty },
			success: function (res) {
				console.log(res);
				showCartModal(res);
				$this.find('i').removeClass('fas fa-shopping-cart').addClass('fas fa-dolly-flatbed');
			},
			error: function () {
				alert('Error');
			}
		});
	});
	// End cart

	// Sort
	$('#input-sort').on('change', function() {
		window.location = PATH + window.location.pathname + '?' + $(this).val();
	});
	// end sort

	// Wishlist
	$('.product-card').on('click', '.add-to-wishlist', function (e) {
		e.preventDefault();
		$this = $(this);
		id = $(this).data('id');

		$.ajax({
			url: 'wishlist/add',
			type: 'GET',
			data: { id: id},
			success: function (res) {
				result = JSON.parse(res);
				if (result.type = 'success') {
					Swal.fire({
						text: result.text,
						icon: result.type,
					});
					$this.removeClass('add-to-wishlist').addClass('delete-from-wishlist');
					$this.find('i').removeClass('far fa-heart').addClass('fas fa-hand-holding-heart');
				} else {
					Swal.fire({
						text: result.text,
						icon: result.type,
					});
				}
			},
			error: function (res) {
				console.log(res);
				alert('Error');
			}
		});
	});

	$('.product-card').on('click', '.delete-from-wishlist', function (e) {
		e.preventDefault();
		$this = $(this);
		id = $(this).data('id');

		$.ajax({
			url: 'wishlist/delete',
			type: 'GET',
			data: { id: id},
			success: function (res) {
				const url = window.location.toString();
				if (url.indexOf('wishlist') !== -1) {
					window.location = url;
				} else {
					result = JSON.parse(res);
					if (result.type == 'success') {
						Swal.fire({
							text: result.text,
							icon: result.type,
						});
						$this.removeClass('delete-from-wishlist').addClass('add-to-wishlist');
						$this.find('i').removeClass('fas fa-hand-holding-heart').addClass('far fa-heart');
					} else {
						Swal.fire({
							text: result.text,
							icon: result.type,
						});
					}
				}
			},
			error: function (res) {
				console.log(res);
				alert('Error');
			}
		});
	});
	// end wishlist

	$('.open-search').click(function (e) {
		e.preventDefault();
		$('#search').addClass('active');
	});

	$('.close-search').click(function () {
		$('#search').removeClass('active');
	});

	$(window).scroll(function () {
		if ($(this).scrollTop() > 200) {
			$('#top').fadeIn();
		} else {
			$('#top').fadeOut();
		}
	});

	$('#top').click(function () {
		$('body, html').animate({ scrollTop: 0 }, 700);
	});

	$('.sidebar-toggler .btn').click(function () {
		$('.sidebar-toggle').slideToggle();
	});

	$('.thumbnails').magnificPopup({
		type: 'image',
		delegate: 'a',
		gallery: {
			enabled: true
		},
		removalDelay: 500,
		callbacks: {
			beforeOpen: function () {
				this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
				this.st.mainClass = this.st.el.attr('data-effect');
			}
		}
	});

	$('#languages button').click(function () {
		const lang_code = $(this).data('langcode');
		window.location = PATH + '/language/change?lang=' + lang_code;
	});
});

function getData() {
	const ws = new WebSocket('ws://localhost:20205');
	let data = {
		'client': 'Hello',
	};
	ws.onopen = () => ws.send("Salam Dunya\n");
}

