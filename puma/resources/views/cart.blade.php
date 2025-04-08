<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Keranjang Belanja - Puma Store</title>
    <style>
        /* Previous CSS styles remain the same */
        body {
            background: linear-gradient(135deg, #ffffff, #d9d9d9); /* Subtle light gradient */
            color: #333;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
        }

        .cart-container {
            background: linear-gradient(135deg, #333, #666); /* Darker gradient for elegance */
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 40px;
            color: #fff;
            max-width: 800px;
            width: 90%;
            margin-top: 15px;
            margin-left: 150px;
        }

        .cart-header {
            background: linear-gradient(to right, #000, #CC0033); /* Eye-catching gradient */
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
            text-align: center;
            font-size: 1.5em;
            font-weight: bold;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 20px 15px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #444, #666); /* Sleek gradient for items */
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .cart-item img {
            max-width: 120px;
            margin-right: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .total-section {
            background: linear-gradient(135deg, #555, #777); /* Smooth gradient for totals */
            padding: 25px;
            border-radius: 10px;
            margin-top: 30px;
            color: white;
            font-size: 1.2em;
            font-weight: bold;
            text-align: center;
        }

        .checkout-btn {
            background: linear-gradient(to right, #CC0033, #FF0000); /* Bold and inviting button */
            border: none;
            color: white;
            font-size: 1.1em;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        .checkout-btn:hover {
            background: linear-gradient(to right, #A30029, #CC0033); /* Darker hover effect */
            transform: scale(1.1);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.5);
        }

    </style>
</head>
<body>
<!-- Header and navigation remain the same -->
<header class="bg-dark text-white">
    <nav class="container navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="index.php">
            <img src="images/logo.png" alt="Logo" style="height: 65px; width: auto;">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
                <li class="nav-item"><a class="nav-link" href="tentang.php">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="kontak.php">Kontak</a></li>
            </ul>
        </div>
    </nav>
</header>

<div class="container">
    <div class="cart-container">
        <div class="cart-header">
            <h2 class="text-center mb-0">Keranjang Belanja</h2>
        </div>

        <div id="cart-items">
            <!-- Cart items will be dynamically added here -->
        </div>

        <div class="total-section">
            <div class="row">
                <div class="col-md-6">
                    <h4 style="font-weight: bold;">Total Harga</h4>
                </div>
                <div class="col-md-6 text-right">
                    <h4 id="total-price" style="font-weight: bold;">Rp 0</h4>
                </div>
            </div>
            <button id="checkout-btn" class="btn checkout-btn text-white mt-3" onclick="checkout()">Checkout</button>
        </div>
    </div>
</div>

<!-- Footer remains the same -->
<footer class="bg-dark text-white text-center py-3 mt-4">
    <nav>
        <ul class="list-inline">
            <li class="list-inline-item"><a class="text-white" href="index.html">Menu</a></li>
            <li class="list-inline-item"><a class="text-white" href="pembayaran.html">Pembayaran</a></li>
            <li class="list-inline-item"><a class="text-white" href="medsos.html">Medsos</a></li>
            <li class="list-inline-item"><a class="text-white" href="kontak.html">Kontak</a></li>
        </ul>
    </nav>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadCartItems();
});

function loadCartItems() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear existing items

    cart.forEach((item, index) => {
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="flex-grow-1">
                <h5>${item.name}</h5>
                <p>Harga: Rp ${parseFloat(item.price).toLocaleString()}</p>
                <p>Quantity: ${item.quantity || 1}</p>
            </div>
            <button class="btn btn-danger" onclick="removeItem(${index})">Hapus</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    updateTotal();
}

function removeItem(index) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cart));
    loadCartItems();
    updateTotalPrice();
    updateCartCount();
    Toastify({
        text: 'Item berhasil dihapus dari keranjang!',
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: "#4caf50"
    }).showToast();
}

function updateTotal() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let total = cart.reduce((sum, item) => {
        return sum + (parseFloat(item.price) * (item.quantity || 1));
    }, 0);
    document.getElementById('total-price').textContent = `Rp ${total.toLocaleString()}`;
}

function checkout() {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    if (cart.length === 0) {
        Toastify({
            text: 'Keranjang anda kosong!',
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#f44336",
        }).showToast();
        return;
    }

    // Add user confirmation
    if (!confirm('Apakah Anda yakin ingin melakukan checkout?')) {
        return;
    }

    // Show loading indicator
    document.getElementById('checkout-btn').disabled = true;
    document.getElementById('checkout-btn').innerHTML = 'Memproses...';

    // Prepare order data
    const orderData = {
        items: cart.map(item => ({
            nama_produk: item.name,
            harga: parseFloat(item.price),
            quantity: item.quantity || 1,
            image: item.image || ''
        })),
        total: cart.reduce((sum, item) => sum + (parseFloat(item.price) * (item.quantity || 1)), 0)
    };

    console.log('Sending checkout data:', orderData);

    // Send to server
    console.log('Sending to URL:', window.location.origin + '/proses_checkout.php');
    fetch(window.location.origin + '/proses_checkout.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(orderData)
    })
    .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);

        if (!response.ok) {
            throw new Error('Network response was not ok: ' + response.statusText);
        }

        // Clone the response so we can log it and still use it
        const responseClone = response.clone();
        responseClone.text().then(text => {
            console.log('Raw response:', text);
        });

        return response.json();
    })
    .then(data => {
        console.log('Checkout response:', data);
        if (data.success) {
            // Log verification results
            if (data.verification) {
                console.log('Order verification:', data.verification);
            }

            // Clear cart
            localStorage.removeItem('cart');

            // Show success message
            document.getElementById('cart-items').innerHTML = `
                <div class="text-center p-4">
                    <h4 class="mb-3">Terima kasih sudah berbelanja!</h4>
                    <p>Pesanan Anda telah berhasil disimpan ke database.</p>
                    <p>Order ID: ${data.order_id}</p>
                    ${data.verification ? `
                    <p><small>Verifikasi: Order ada=${data.verification.order_exists},
                       Detail=${data.verification.details_count},
                       Items=${data.verification.items_count}</small></p>
                    ` : ''}
                    <a href="index.php" class="btn btn-primary mt-3">Kembali Berbelanja</a>
                </div>
            `;
            updateTotal();

            // Reset checkout button
            document.getElementById('checkout-btn').innerHTML = 'Checkout';
            document.getElementById('checkout-btn').disabled = true;

            // Show success notification
            Toastify({
                text: 'Pesanan berhasil disimpan ke database!',
                duration: 5000,
                gravity: "top",
                position: "right",
                backgroundColor: "#4caf50",
            }).showToast();
        } else {
            // Reset checkout button
            document.getElementById('checkout-btn').innerHTML = 'Checkout';
            document.getElementById('checkout-btn').disabled = false;

            // Show error notification
            Toastify({
                text: data.message || 'Gagal melakukan checkout. Silakan coba lagi.',
                duration: 3000,
                gravity: "top",
                position: "right",
                backgroundColor: "#f44336",
            }).showToast();
        }
    })
    .catch(error => {
        console.error('Error:', error);

        // Reset checkout button
        document.getElementById('checkout-btn').innerHTML = 'Checkout';
        document.getElementById('checkout-btn').disabled = false;

        // Show error notification
        Toastify({
            text: 'Terjadi kesalahan saat menghubungi server. Silakan coba lagi.',
            duration: 3000,
            gravity: "top",
            position: "right",
            backgroundColor: "#f44336",
        }).showToast();
    });
}
</script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
