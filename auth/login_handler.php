<?php
require_once __DIR__ . '/../partials/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;
    
    // Validate input
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } else {
        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT id, username, email, password, full_name, role, is_active FROM users WHERE email = ? AND is_active = 1";
        
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $db_email, $hashed_password, $full_name, $role, $is_active);
                    mysqli_stmt_fetch($stmt);
                    
                    // Verify password (using password_verify for hashed passwords)
                    if (password_verify($password, $hashed_password)) {
                        // Password is correct, create session
                        $_SESSION['user_id'] = $id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $db_email;
                        $_SESSION['full_name'] = $full_name;
                        $_SESSION['role'] = $role;
                        $_SESSION['logged_in'] = true;
                        
                        // Update last login time
                        $update_sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
                        if ($update_stmt = mysqli_prepare($link, $update_sql)) {
                            mysqli_stmt_bind_param($update_stmt, "i", $id);
                            mysqli_stmt_execute($update_stmt);
                            mysqli_stmt_close($update_stmt);
                        }
                        
                        // Set remember me cookie if requested
                        if ($remember) {
                            $token = bin2hex(random_bytes(32));
                            setcookie('remember_token', $token, time() + (86400 * 30), "/"); // 30 days
                            
                            // Store token in database (you should create a separate table for this)
                            $token_sql = "UPDATE users SET remember_token = ? WHERE id = ?";
                            if ($token_stmt = mysqli_prepare($link, $token_sql)) {
                                mysqli_stmt_bind_param($token_stmt, "si", $token, $id);
                                mysqli_stmt_execute($token_stmt);
                                mysqli_stmt_close($token_stmt);
                            }
                        }
                        
                        // Redirect to dashboard
                        header("Location: ../src/dashboard.php");
                        exit();
                    } else {
                        $error = "Invalid password.";
                    }
                } else {
                    $error = "No account found with that email address.";
                }
            } else {
                $error = "Oops! Something went wrong. Please try again later.";
            }
            
            mysqli_stmt_close($stmt);
        }
    }
}

    // If there's an error, redirect back to login with error message
    if (isset($error)) {
        $_SESSION['login_error'] = $error;
        header("Location: ../src/signin.php");
        exit();
    }
?> 