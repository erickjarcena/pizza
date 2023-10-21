<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Order Completed</title>
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

        .message {
            margin-top: 20px;
            font-size: 24px;
            color: #007bff;
        }
        .back-button {
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
    </style>
</head>

<body>
    <div class="container">
        <img class="pizza-image" src="pizza.png" alt="Pizza">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "menu";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $firstName = isset($_POST['firstName']) ? htmlspecialchars($_POST['firstName']) : '';
            $lastName = isset($_POST['lastName']) ? htmlspecialchars($_POST['lastName']) : '';

            $totalPrice = isset($_POST['totalPrice']) ? floatval($_POST['totalPrice']) : 0;
            $amountPaid = isset($_POST['amountPaid']) ? floatval($_POST['amountPaid']) : 0;
            $orders = isset($_POST['orderedItems']) ? htmlspecialchars($_POST['orderedItems']) : '';

            $changeAmount = $amountPaid - $totalPrice;

            $orderDate = date('Y-m-d H:i:s');

            $sql = "INSERT INTO orders (first_name, last_name, total_amount, change_amount, order_date, orders, cash) VALUES ('$firstName', '$lastName', '$totalPrice', '$changeAmount', '$orderDate', '$orders', '$amountPaid')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='message'>Order Completed! <br> Your change is PHP $changeAmount <br> Thank you, $firstName $lastName, hope you order again!</div>";
                echo '<a class="back-button" href="index.html">Back to Registration</a>';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
    </div>
</body>

</html>