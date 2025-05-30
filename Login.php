<?php
session_start();

$servername = "localhost";  
$username_db = "root";  
$password_db = "";  
$dbname = "transportation";  

$conn = new mysqli($servername, $username_db, $password_db, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
            
        } else {
            $error = "Invalid credentials. Please try again.";
        }
    } else {
        $error = "Invalid credentials. Please try again.";
    }

    $stmt->close();  
    $conn->close();  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

    .login-container {
        width: 340px;  
        height: auto; 
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
        color: black; 
        font-size: 2rem;
        margin-bottom: 20px;
    }

    form input, form button {
        width: 90%;
        padding: 12px;
        margin: 10px 0;
        border: 1px solid black; /* Orange border */
        border-radius: 5px;
        font-size: 1rem;
        box-sizing: border-box;
    }

    form input:focus, form button:focus {
        border-color: #ffc107; /* Bright yellow for focus */
        outline: none;
    }

    form button {
        background-color: black; 
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    form button:hover {
        background-color: 00000; 
    }

    .error {
        color: #d32f2f; /* Red for error messages */
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .login-container a {
        color: black; 
        text-decoration: none;
    }

    .login-container a:hover {
        text-decoration: underline;
    }

    .login-links {
        margin-top: 1rem;
        font-size: 0.9rem;
    }

    .login-links a {
        color: black;
        text-decoration: none;  
        margin: 10px;
        font-size: 16px;
        padding: 5px 10px;
        border: 2px solid black;
        border-radius: 5px;
    }

    .login-links a:hover {
        background-color: pink; 
        text-decoration: underline; 
    }

    @media (max-width: 768px) {
        .login-container {
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

<div class="login-container">
    <h2>Login</h2>
    <form action="Login_process.php" method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <div class="login-links">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

</body>
</html>
