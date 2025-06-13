<?php
session_start();
if (!isset($_SESSION['user_id'])) header("Location: login.php");
include 'db.php';
$user_id = $_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $conn->query("INSERT INTO intake (user_id, date, amount) VALUES ($user_id, '$date', $amount)");
}
$records = $conn->query("SELECT date, amount FROM intake WHERE user_id = $user_id ORDER BY date DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Water Intake Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['role']); ?></h2>
    <form method="post">
        <label>Date:</label>
        <input type="date" name="date" required><br>
        <label>Amount (ml):</label>
        <input type="number" name="amount" required><br>
        <button type="submit">Add Intake</button>
    </form>
    <h3>Your Records</h3>
    <table>
        <thead>
            <tr><th>Date</th><th>Amount (ml)</th></tr>
        </thead>
        <tbody>
        <?php while($row = $records->fetch_assoc()) {
            echo "<tr><td>{$row['date']}</td><td>{$row['amount']}</td></tr>";
        } ?>
        </tbody>
    </table>
    <a href="logout.php">Logout</a>
</div>
</body>
</html>