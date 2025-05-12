<?php
include 'connection.php';
$db = new Database();
$conn = $db->conn;

$message = "";

// Top up logic
if (isset($_POST['topup'])) {
    $agent_code = trim($_POST['agent_code']);
    $amount = floatval($_POST['amount']);

    $stmt = $conn->prepare("UPDATE agents SET balance = balance + ? WHERE agent_code = ?");
    if ($stmt->execute([$amount, $agent_code])) {
        $message = "<p class='success'> Balance of Rwf $amount topped up successfully to agent <strong>$agent_code</strong>.</p>";
    } else {
        $message = "<p class='error'> Failed to update balance.</p>";
    }
}

$agents = $conn->query("SELECT * FROM agents")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Agent Management</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f2f5;
            padding: 40px;
            color: #333;
        }

        h2, h3 {
            text-align: center;
            color: #2c3e50;
        }

        .success {
            color: green;
            text-align: center;
        }

        .error {
            color: red;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 16px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #0066cc;
            color: white;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        form {
            max-width: 500px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #004b99;
        }
    </style>
</head>
<body>

<h2>Admin Dashboard</h2>

<?= $message ?>

<table>
    <tr>
        <th>Agent Code</th>
        <th>Full Name</th>
        <th>Balance (Rwf)</th>
    </tr>
    <?php foreach ($agents as $agent): ?>
    <tr>
        <td><?= htmlspecialchars($agent['agent_code']) ?></td>
        <td><?= htmlspecialchars($agent['full_name']) ?></td>
        <td><?= number_format($agent['balance'], 2) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Top Up Agent Balance</h3>
<form method="POST">
    <label for="agent_code">Agent Code:</label>
    <input type="text" name="agent_code" id="agent_code" required>

    <label for="amount">Amount (Rwf):</label>
    <input type="number" name="amount" id="amount" step="0.01" min="0" required>

    <input type="submit" name="topup" value="Top Up Balance">
</form>

</body>
</html>
