document.addEventListener("DOMContentLoaded", function() {
	const toggleButton = document.querySelector(".menu-toggle");
	const navLinks = document.querySelector(".nav-links");

	toggleButton.addEventListener("click", () => {
		navLinks.classList.toggle("show");
	});
});

document.addEventListener('DOMContentLoaded', () => {

	const productForm = document.getElementById('productForm');

	if (productForm) {
		productForm.addEventListener('submit', async function(event) {
			event.preventDefault();

			const formData = new FormData(productForm);

			try {
				const response = await fetch('create.php', {
					method: 'POST',
					body: formData,
				});

				const result = await response.json();

				if (response.ok) {
					console.log('Product Added:', result);
					window.location.href = 'products.php';
				} else {
					console.error('Errror:', result);
				}
			} catch (error) {
				console.error('Errror:', error)
			}
		})
	}

});

document.addEventListener('DOMContentLoaded', () => {
	// Select all delete buttons
	const deleteButtons = document.querySelectorAll('.btn_delete');

	deleteButtons.forEach((btn) => {
		btn.addEventListener('click', async function(event) {
			event.preventDefault();
			const productId = btn.parentElement.parentElement.getAttribute('id');
			// Confirm before deleting
			if (!confirm('Are you sure you want to delete this product?')) return;

			try {
				const response = await fetch('../delete.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json',
					},
					body: JSON.stringify({ id: productId }),
				});
				const result = await response.json();
				console.log(result);
				if (result.success) {
					window.location.href = '../products.php';
				} else {
					alert('Failed to delete product: ' + result.message);
				}
			} catch (error) {
				console.error('Error deleting product:', error);
				alert('An error occurred while trying to delete the product.');
			}
		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
	// Select all delete buttons
	const updateButtons = document.querySelectorAll('.btn_update');

	updateButtons.forEach((btn) => {
		btn.addEventListener('click', async function(event) {
			event.preventDefault();
			const productId = btn.parentElement.parentElement.getAttribute('id');

			window.location.href = `/update-product.php?id=${productId}`;

		});
	});
});

document.addEventListener('DOMContentLoaded', () => {
	const updateForm = document.getElementById('updateForm');

	if (updateForm) {
		updateForm.addEventListener('submit', async function(event) {
			event.preventDefault();

			const formData = new FormData(updateForm);

			try {
				const response = await fetch('update.php', {
					method: 'POST',
					body: formData,
				});

				const result = await response.json();

				if (response.ok) {
					console.log('Product Updated:', result);
					window.location.href = 'products.php'; // Redirect to the products page
				} else {
					console.error('Error:', result);
				}
			} catch (error) {
				console.error('Error:', error);
			}
		});
	}
});

