<?php
include('db_connection.php');

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
        if (!$stmt) {
            die("Error in SELECT statement: " . $conn->error);
        }
        $stmt->bind_param("sss", $email, $username, $address);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Email, username, or address already exists.";
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, address, password) VALUES (?, ?, ?, ?)");
            if (!$stmt) {
                die("Error in INSERT statement: " . $conn->error);
            }
            $stmt->bind_param("ssss", $username, $email, $address, $hashed_password);
            if ($stmt->execute()) {
                echo "Registration successful! <a href='login.php'>Login here</a>";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-image: url('images/Background.jpg'); 
        background-size: cover; 
        background-position: center; 
        background-attachment: fixed; 
        color: #333;
        height: 100vh; 
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .register-container {
        width: 340px;  
        background-color: 0000000; 
        padding: 40px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);  
        border-radius: 8px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: space-between; 
        backdrop-filter: blur(10px); /* Subtle blur effect */
    }

    h2 {
        color: #333; /* Vibrant orange for heading */
        font-size: 2rem;
        margin-bottom: 20px;
    }

    form input, form button {
        width: 90%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid #333; /* Orange border */
        border-radius: 5px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    form input:focus, form button:focus {
        border-color: #ffc107; /* Bright yellow for focus */
        outline: none;
    }

    form button {
        background-color: #333; /* Vibrant orange button */
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: #ff6f00; /* Deeper orange on hover */
    }

    .error {
        color: #d32f2f; /* Red for error messages */
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .register-container a {
        color: #333; /* Orange for links */
        text-decoration: none;
    }

    .register-container a:hover {
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .register-container {
            width: 90%; 
            margin: 20px auto;
            padding: 20px;
            height: auto;
        }

        h2 {
            font-size: 1.5rem;
        }

        form input, form button {
            font-size: 1rem;
        }
    }

    </style>
</head>
<body>

<div class="register-container">
    <h2>Register</h2>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="address" placeholder="Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="Login.php">Login here</a></p>
</div>

</body>
</html>

