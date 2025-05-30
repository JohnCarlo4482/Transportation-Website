<?php
include('db_connection.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $address = trim($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username) || empty($email) || empty($address) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ? OR address = ?");
        $stmt->bind_param("sss", $email, $username, $address);  
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email, username, or address already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, address, password) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $email, $address, $hashed_password);  
            if ($stmt->execute()) {
                echo "Registration successful! <a href='Login.html'>Login here</a>";
                exit();
            } else {
                $error = "Something went wrong. Please try again later.";
            }
        }
        $stmt->close();
    }
}

$conn->close();
?>

<form action="register_process.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="number" name="school_id" placeholder="School ID" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
</form>
