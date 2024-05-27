<?php
require_once 'stripe-php-13.5.0-beta.1/init.php';
require_once 'config.php';
session_start();

$user_id = $_SESSION['user_id'];

$stripe = new Stripe\StripeClient(STRIPE_SECRET_KEY);

// Fetch cart items from the database
$lineItems = []; // Initialize an empty array to store all line items
$cart_total = 0;

$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if (mysqli_num_rows($cart_query) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($cart_query)) {
        // Build line items for Stripe checkout session dynamically from the cart
        $cart_total += $fetch_cart['price'] * $fetch_cart['quantity'];

        $lineItems[] = [
            'price_data' => [
                'currency' => 'lkr',
                'product_data' => [
                    'name' => $fetch_cart['name'],
                ],
                'unit_amount' => $fetch_cart['price'] * 100, // Convert price to cents
            ],
            'quantity' => $fetch_cart['quantity'],
        ];
    }
}
            

//Create Stripe checkout session
$checkoutSession = $stripe->checkout->sessions->create([
    'line_items' => $lineItems,
    'mode' => 'payment',
    'success_url' => 'http://localhost/XOXO/cardpayment-success.php?provider_session_id={CHECKOUT_SESSION_ID}',
    'cancel_url' => 'http://localhost/XOXO/checkout.php?provider_session_id={CHECKOUT_SESSION_ID}'
]);
            

// Retrieve provider_session_id. Store in database.

// $providerSessionId = $checkoutSession->id;
// if ($providerSessionId) {
    
// }
// Use a test card number for checkout
$testCardNumber = '4242424242424242';

// Send user to Stripe
header('Content-Type: application/json');
header("HTTP/1.1 303 See Other");
header("Location: " . $checkoutSession->url);
exit;