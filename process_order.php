<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f7f2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .pizza-image {
            width: 150px;
            margin-bottom: 20px;
        }

        h2 {
            color: #ff6f61;
        }

        li {
            margin-bottom: 10px;
            font-weight: bold;
        }

        label {
            font-weight: bold;
        }

        .back-button,
        .submit-button {
            background-color: #ff6f61;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-decoration: none;
            margin-top: 20px;
            font-weight: bold;
            display: inline-block;
        }

        .back-button:hover {
            background-color: #e26056;
        }

        .amount-input,
        .total-price {
            width: 100%;
            height: 10px;
            font-size: 18px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px 0;
        }

        .total-price {
            pointer-events: none;
        }

        .submit-button {
            display: block;
            margin: auto;
            margin-top: 20px;
        }

        #message {
            display: block;
            padding: 12px 24px;
            border-radius: 4px;
        }

        .error-message {
            color: #ff6f61;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <form method="post" action="order_complete.php" onsubmit="return calculateChange();">
        <div class="container">
            <img class="pizza-image" src="pizza.png" alt="Pizza">
            <h2>Order Confirmation</h2>
            <input type="hidden" name="firstName"
                value="<?php echo isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : ''; ?>">
            <input type="hidden" name="lastName"
                value="<?php echo isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : ''; ?>">
            <?php
            if (isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['dishes']) && isset($_POST['prices'])) {
                echo "<p>Thank you, " . htmlspecialchars($_POST['firstName']) . " " . htmlspecialchars($_POST['lastName']) . ", for your order!</p>";

                echo "<p>You have selected the following pizzas:</p>";

                $totalPrice = 0;
                $orderedItems = [];
                for ($i = 0; $i < count($_POST['dishes']); $i++) {
                    $pizza = htmlspecialchars($_POST['dishes'][$i]);
                    $price = floatval($_POST['prices'][$i]);
                    echo "<p>$pizza - $" . number_format($price, 2) . "</p>";
                    $totalPrice += $price;
                    $orderedItems[] = $pizza;
                }
                echo '<label for="totalPrice">Total: </label>';
                echo '<input class="total-price" type="number" name="totalPrice" value="' . $totalPrice . '"><br>';
                echo '<input type="hidden" name="orderedItems" value="' . implode(', ', $orderedItems) . '">';

            } else {
                echo "<p>Invalid request. Please go back and try again.</p>";
            }
            ?>
            <label for="amountPaid">Amount Paid: </label>
            <input type="number" class="amount-input" id="amountPaid" name="amountPaid" step="0.01" required>
            <div id="errorMessage" class="error-message" style="display: none;">
                Insufficient amount.
            </div>
            <button class="submit-button" id="submitButton" type="submit">Place Order</button>
            <a class="back-button" href="index.html">Back to Registration</a>
        </div>
    </form>
</body>
<script>
    function calculateChange() {
        var totalPrice = parseFloat(document.querySelector('[name="totalPrice"]').value);
        var amountPaid = parseFloat(document.querySelector('[name="amountPaid"]').value);
        var change = amountPaid - totalPrice;

        if (change < 0) {
            errorMessage.style.display = "block";
            return false;
        }
        errorMessage.style.display = "none";
        return true;
    }
</script>

</html>