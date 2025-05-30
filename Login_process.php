<?php
session_start();
include('db_connection.php'); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format. <a href='Login.php'>Try again</a>";
            exit();
        }

        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                session_regenerate_id(true); 
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = htmlspecialchars($user['username']);

                header("Location: index.php");
                exit();
            } else {
                echo "Invalid password. <a href='Login.php'>Try again</a>";
            }
        } else {
            echo "No account found with that email. <a href='Login.php'>Try again</a>";
        }

        $stmt->close();
    } else {
        echo "Please provide both email and password. <a href='Login.php'>Try again</a>";
    }
}

$conn->close();
?>
<form action="Login_process.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
