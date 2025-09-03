<?php
// Setup script for DreamsPOS
require_once __DIR__ . '/partials/config.php';

$setup_complete = false;
$error_message = '';
$success_message = '';

// Database is already configured in config.php
$success_message = "Database connection established successfully!";

// Check if tables exist
$tables_exist = false;
$check_tables_sql = "SHOW TABLES LIKE 'users'";
$tables_result = mysqli_query($link, $check_tables_sql);
if ($tables_result && mysqli_num_rows($tables_result) > 0) {
    $tables_exist = true;
}

if (!$tables_exist) {
    // Read and execute the database schema
    $schema_file = 'database_schema.sql';
    if (file_exists($schema_file)) {
        $schema_content = file_get_contents($schema_file);
        $queries = explode(';', $schema_content);
        
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                if (!mysqli_query($link, $query)) {
                    $error_message = "Error executing query: " . mysqli_error($link);
                    break;
                }
            }
        }
        
        if (empty($error_message)) {
            $setup_complete = true;
            $success_message = "Database schema created successfully!";
        }
    } else {
        $error_message = "Database schema file not found!";
    }
} else {
    $setup_complete = true;
    $success_message = "Database already set up!";
}

// Handle admin user creation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create_admin'])) {
    $admin_username = trim($_POST['admin_username']);
    $admin_email = trim($_POST['admin_email']);
    $admin_password = $_POST['admin_password'];
    $admin_confirm_password = $_POST['admin_confirm_password'];
    
    if (empty($admin_username) || empty($admin_email) || empty($admin_password)) {
        $error_message = "All fields are required!";
    } elseif ($admin_password !== $admin_confirm_password) {
        $error_message = "Passwords do not match!";
    } elseif (strlen($admin_password) < 6) {
        $error_message = "Password must be at least 6 characters long!";
    } else {
        // Check if user already exists
        $check_user_sql = "SELECT id FROM users WHERE email = ? OR username = ?";
        if ($stmt = mysqli_prepare($link, $check_user_sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $admin_email, $admin_username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) == 0) {
                // Create admin user
                $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
                $insert_user_sql = "INSERT INTO users (username, email, password, full_name, role) VALUES (?, ?, ?, ?, 'admin')";
                
                if ($insert_stmt = mysqli_prepare($link, $insert_user_sql)) {
                    mysqli_stmt_bind_param($insert_stmt, "ssss", $admin_username, $admin_email, $hashed_password, $admin_username);
                    
                    if (mysqli_stmt_execute($insert_stmt)) {
                        $success_message = "Admin user created successfully! You can now login.";
                        $setup_complete = true;
                    } else {
                        $error_message = "Error creating admin user: " . mysqli_error($link);
                    }
                    mysqli_stmt_close($insert_stmt);
                }
            } else {
                $error_message = "User with this email or username already exists!";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DreamsPOS Setup</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/feather.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center min-vh-100 align-items-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">DreamsPOS Setup</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($error_message)): ?>
                            <div class="alert alert-danger"><?php echo $error_message; ?></div>
                        <?php endif; ?>
                        
                        <?php if (!empty($success_message)): ?>
                            <div class="alert alert-success"><?php echo $success_message; ?></div>
                        <?php endif; ?>
                        
                        <div class="setup-steps">
                            <div class="step completed">
                                <i class="feather-check-circle text-success"></i>
                                <span>Database connection established</span>
                            </div>
                            
                            <?php if (!$setup_complete): ?>
                                <div class="step">
                                    <i class="feather-clock text-warning"></i>
                                    <span>Setting up tables...</span>
                                </div>
                            <?php else: ?>
                                <div class="step completed">
                                    <i class="feather-check-circle text-success"></i>
                                    <span>Tables created successfully</span>
                                </div>
                            <?php endif; ?>
                                
                                <?php if ($setup_complete): ?>
                                    <div class="mt-4">
                                        <h5>Create Admin User</h5>
                                        <form method="POST">
                                            <div class="mb-3">
                                                <label class="form-label">Username</label>
                                                <input type="text" name="admin_username" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="admin_email" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Password</label>
                                                <input type="password" name="admin_password" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirm Password</label>
                                                <input type="password" name="admin_confirm_password" class="form-control" required>
                                            </div>
                                            <button type="submit" name="create_admin" class="btn btn-primary">Create Admin User</button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="mt-4">
                                    <a href="src/signin.php" class="btn btn-success">Go to Login</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html> 