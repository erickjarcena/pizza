<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Registration Confirmation</title>
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

        p {
            margin-bottom: 20px;
            font-weight: bold;
        }

        .back-button,
        .order-button {
            background-color: #ff6f61;
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 18px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-decoration: none;
            margin: 25px;
            font-weight: bold;
        }

        .back-button:hover,
        .order-button:hover {
            background-color: #e26056;
        }

        .dish-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .dish-item img {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            margin-right: 10px;
        }

        .dish-item label {
            font-size: 16px;
            flex-grow: 1;
            text-align: left;
        }
        .error-message {
            color: #ff6f61;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img class="pizza-image" src="pizza.png" alt="Pizza">
        <h2>Thank You for Registering!</h2>
        <p>Your registration is confirmed.</p>
        <p>First Name:
            <?php echo htmlspecialchars($_POST["firstName"]); ?>
        </p>
        <p>Last Name:
            <?php echo htmlspecialchars($_POST["lastName"]); ?>
        </p>
        <div class="dish-menu">
            <form action="process_order.php" method="post" onsubmit="return validateForm();">
                <input type="hidden" name="firstName" value="<?php echo htmlspecialchars($_POST["firstName"]); ?>">
                <input type="hidden" name="lastName" value="<?php echo htmlspecialchars($_POST["lastName"]); ?>">
                <div class="dish-item">
                    <img src="pepperoni_pizza.jpg" alt="Pepperoni Pizza">
                    <label>
                        <input type="checkbox" name="dishes[]" value="Pepperoni Pizza">
                        Pepperoni Pizza - PHP 500
                        <input type="hidden" name="prices[]" value="500">
                    </label>
                </div>
                <div class="dish-item">
                    <img src="margherita_pizza.jpg" alt="Margherita Pizza">
                    <label>
                        <input type="checkbox" name="dishes[]" value="Margherita Pizza">
                        Margherita Pizza - PHP 700
                        <input type="hidden" name="prices[]" value="700">
                    </label>
                </div>
                <div class="dish-item">
                    <img src="vegetarian_pizza.jpg" alt="Vegetarian Pizza">
                    <label><input type="checkbox" name="dishes[]" value="Vegetarian Pizza">
                        Vegetarian Pizza - PHP 600
                        <input type="hidden" name="prices[]" value="600"></label>
                </div>
                <div id="errorMessage" class="error-message" style="display: none;">
                    Please select at least one dish before placing the order.
                </div>
                <input class="order-button" type="submit" value="Place Order">
            </form>
        </div>
        <a class="back-button" href="index.html">Back to Registration</a>
    </div>
</body>
<script>
    function validateForm() {
        var checkboxes = document.getElementsByName("dishes[]");
        var isChecked = false;

        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }

        if (!isChecked) {
            errorMessage.style.display = "block";
            return false; 
        } 
        
        errorMessage.style.display = "none";
        return true;
    }
</script>

</html>