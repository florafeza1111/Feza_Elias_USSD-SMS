<?php
include 'connection.php';
$db = new Database();
$conn = $db->conn;

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = trim($_POST['full_name']);
    $agent_code = trim($_POST['agent_code']);
    $pin = trim($_POST['pin']);
    $balance = floatval($_POST['balance']);

    $stmt = $conn->prepare("INSERT INTO agents (full_name, agent_code, pin, balance) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$full_name, $agent_code, $pin, $balance])) {
        $message = "<p class='success'> Agent <strong>$full_name</strong> registered with Rwf <strong>$balance</strong>.</p>";
    } else {
        $message = "<p class='error'> Failed to register agent.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register Agent</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 40px;
        }

        form {
            background-color: #ffffff;
            max-width: 500px;
            margin: auto;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #555;
        }

        input[type="text"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: #0066cc;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #004999;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Register New Agent</h2>

<?= $message ?>

<form method="POST">
    <label for="full_name">Full Name:</label>
    <input type="text" name="full_name" id="full_name" required>

    <label for="agent_code">Agent Code:</label>
    <input type="text" name="agent_code" id="agent_code" required>

    <label for="pin">PIN:</label>
    <input type="password" name="pin" id="pin" minlength="4" maxlength="6" required>

    <label for="balance">Initial Balance (Rwf):</label>
    <input type="number" name="balance" id="balance" step="0.01" min="0" required>

    <input type="submit" value="Register Agent">
</form>

</body>
</html>
