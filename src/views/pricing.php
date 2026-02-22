<?php include __DIR__ . '/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Pricing - Select Tickets</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }
        .pricing-container {
            max-width: 1000px;
            margin: 20px auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            padding-bottom: 120px;
        }
        .pricing-header {
            background: #333;
            color: white;
            padding: 20px;
        }
        .pricing-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .session-info {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: #f9f9f9;
            border-bottom: 1px solid #ddd;
        }
        .session-info img {
            width: 120px;
            height: 180px;
            object-fit: cover;
            border-radius: 4px;
        }
        .session-details h2 {
            margin: 0 0 10px 0;
            font-size: 20px;
        }
        .session-details p {
            margin: 5px 0;
            color: #666;
        }
        .banner {
            background: #fff3cd;
            padding: 15px 20px;
            border-bottom: 1px solid #ffc107;
        }
        .banner p {
            margin: 0;
            color: #856404;
        }
        .ticket-selection {
            padding: 20px;
        }
        .ticket-type {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        .ticket-type:last-child {
            border-bottom: none;
        }
        .ticket-info h3 {
            margin: 0 0 5px 0;
            font-size: 16px;
        }
        .ticket-info p {
            margin: 0;
            font-size: 14px;
            color: #666;
        }
        .ticket-controls {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        .ticket-price {
            font-size: 18px;
            font-weight: bold;
            min-width: 80px;
            text-align: right;
        }
        .quantity-controls {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-qty {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid #ddd;
            background: white;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s;
        }
        .btn-qty:hover {
            background: #f0f0f0;
        }
        .btn-qty.add {
            background: #ffc107;
            border-color: #ffc107;
            color: white;
        }
        .btn-qty.add:hover {
            background: #ffb300;
        }
        .quantity {
            font-size: 24px;
            font-weight: bold;
            min-width: 40px;
            text-align: center;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #ffc107;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .total-info {
            color: #333;
        }
        .total-info h3 {
            margin: 0 0 5px 0;
            font-size: 14px;
            font-weight: normal;
        }
        .total-info .amount {
            font-size: 28px;
            font-weight: bold;
        }
        .btn-confirm {
            background: #333;
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-confirm:hover {
            background: #000;
        }
        .btn-confirm:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="pricing-container">
        <div class="pricing-header">
            <h1>Room <?php echo htmlspecialchars($reservationDetails['roomId'] ?? 'N/A'); ?></h1>
        </div>

        <div class="session-info">
            <?php if (!empty($reservationDetails['filmPoster'])): ?>
                <img src="/pictures/<?php echo htmlspecialchars($reservationDetails['filmPoster']); ?>" 
                     alt="<?php echo htmlspecialchars($reservationDetails['filmTitle'] ?? 'Film'); ?>">
            <?php endif; ?>
            <div class="session-details">
                <h2><?php echo htmlspecialchars($reservationDetails['filmTitle'] ?? 'Film Title'); ?></h2>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($reservationDetails['sceanceDate'] ?? 'N/A'); ?></p>
                <p><strong>Seats:</strong> <?php echo $numberOfSeats; ?> seat<?php echo $numberOfSeats > 1 ? 's' : ''; ?></p>
                <p><strong>Room:</strong> <?php echo htmlspecialchars($reservationDetails['roomCharacteristic'] ?? 'Standard'); ?></p>
            </div>
        </div>

        <div class="banner">
            <p>Select your ticket types and quantities</p>
        </div>

        <form method="POST" action="/reservation/confirm" id="pricingForm">
            <div class="ticket-selection">
                <div class="ticket-type">
                    <div class="ticket-info">
                        <h3>Full Price</h3>
                        <p>Standard ticket</p>
                    </div>
                    <div class="ticket-controls">
                        <span class="ticket-price">13.50€</span>
                        <div class="quantity-controls">
                            <button type="button" class="btn-qty" onclick="changeQty('full', -1)">−</button>
                            <span class="quantity" id="qty-full">0</span>
                            <button type="button" class="btn-qty add" onclick="changeQty('full', 1)">+</button>
                        </div>
                    </div>
                </div>

                <div class="ticket-type">
                    <div class="ticket-info">
                        <h3>Student</h3>
                        <p>With valid student card</p>
                    </div>
                    <div class="ticket-controls">
                        <span class="ticket-price">11.30€</span>
                        <div class="quantity-controls">
                            <button type="button" class="btn-qty" onclick="changeQty('student', -1)">−</button>
                            <span class="quantity" id="qty-student">0</span>
                            <button type="button" class="btn-qty add" onclick="changeQty('student', 1)">+</button>
                        </div>
                    </div>
                </div>

                <div class="ticket-type">
                    <div class="ticket-info">
                        <h3>Under 18</h3>
                        <p>For minors</p>
                    </div>
                    <div class="ticket-controls">
                        <span class="ticket-price">11.30€</span>
                        <div class="quantity-controls">
                            <button type="button" class="btn-qty" onclick="changeQty('under18', -1)">−</button>
                            <span class="quantity" id="qty-under18">0</span>
                            <button type="button" class="btn-qty add" onclick="changeQty('under18', 1)">+</button>
                        </div>
                    </div>
                </div>

                <div class="ticket-type">
                    <div class="ticket-info">
                        <h3>Cinema Club</h3>
                        <p>Member discount</p>
                    </div>
                    <div class="ticket-controls">
                        <span class="ticket-price">8.50€</span>
                        <div class="quantity-controls">
                            <button type="button" class="btn-qty" onclick="changeQty('club', -1)">−</button>
                            <span class="quantity" id="qty-club">0</span>
                            <button type="button" class="btn-qty add" onclick="changeQty('club', 1)">+</button>
                        </div>
                    </div>
                </div>

                <div class="ticket-type">
                    <div class="ticket-info">
                        <h3>Under 14</h3>
                        <p>For children</p>
                    </div>
                    <div class="ticket-controls">
                        <span class="ticket-price">7.90€</span>
                        <div class="quantity-controls">
                            <button type="button" class="btn-qty" onclick="changeQty('under14', -1)">−</button>
                            <span class="quantity" id="qty-under14">0</span>
                            <button type="button" class="btn-qty add" onclick="changeQty('under14', 1)">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <input type="hidden" name="tickets[full]" id="input-full" value="0">
            <input type="hidden" name="tickets[student]" id="input-student" value="0">
            <input type="hidden" name="tickets[under18]" id="input-under18" value="0">
            <input type="hidden" name="tickets[club]" id="input-club" value="0">
            <input type="hidden" name="tickets[under14]" id="input-under14" value="0">
            <input type="hidden" name="total" id="input-total" value="0">

            <div class="footer">
                <div class="total-info">
                    <h3>Total to pay</h3>
                    <div class="amount" id="total-amount">0.00€</div>
                </div>
                <button type="submit" class="btn-confirm" id="confirmBtn" disabled>
                    <span id="remaining-seats"><?php echo $numberOfSeats; ?> ticket<?php echo $numberOfSeats > 1 ? 's' : ''; ?> remaining to select</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        const prices = {
            full: 13.50,
            student: 11.30,
            under18: 11.30,
            club: 8.50,
            under14: 7.90
        };

        const maxSeats = <?php echo $numberOfSeats; ?>;
        let quantities = {
            full: 0,
            student: 0,
            under18: 0,
            club: 0,
            under14: 0
        };

        function changeQty(type, delta) {
            const current = quantities[type];
            const total = Object.values(quantities).reduce((a, b) => a + b, 0);
            
            if (delta > 0 && total >= maxSeats) {
                return;
            }
            
            const newQty = Math.max(0, current + delta);
            quantities[type] = newQty;
            
            updateDisplay();
        }

        function updateDisplay() {
            const total = Object.values(quantities).reduce((a, b) => a + b, 0);
            const amount = Object.entries(quantities).reduce((sum, [type, qty]) => {
                return sum + (qty * prices[type]);
            }, 0);

            // Update quantities
            Object.keys(quantities).forEach(type => {
                document.getElementById(`qty-${type}`).textContent = quantities[type];
                document.getElementById(`input-${type}`).value = quantities[type];
            });

            // Update total
            document.getElementById('total-amount').textContent = amount.toFixed(2) + '€';
            document.getElementById('input-total').value = amount.toFixed(2);

            // Update button
            const remaining = maxSeats - total;
            const btn = document.getElementById('confirmBtn');
            const remainingText = document.getElementById('remaining-seats');
            
            if (remaining === 0) {
                btn.disabled = false;
                remainingText.textContent = 'Confirm Reservation';
            } else {
                btn.disabled = true;
                remainingText.textContent = remaining + ' ticket' + (remaining > 1 ? 's' : '') + ' remaining to select';
            }
        }
    </script>
</body>
</html>
