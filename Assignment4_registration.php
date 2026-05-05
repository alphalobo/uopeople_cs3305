<?php
    // Check if the request method is POST (form submission)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Initialize an array to hold validation errors
        $errors = [];

        // Sanitize and retrieve input values to prevent XSS and other issues
        $username = preg_replace('/[^a-zA-Z0-9_]/', '', trim($_POST['username'] ?? ''));
        $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'] ?? '';
        $confirm_password = $_POST['confirm_password'] ?? '';

        // Check if all required fields are filled
        if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
            $errors[] = 'All fields are required.';
        }

        // Validate email format if provided
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        }

        // Validate password: minimum 8 characters, at least one number and one special character
        if (strlen($password) < 8
         || !preg_match('/[0-9]/', $password)
         || !preg_match('/[!@#$%^&*()_+\-=\[\]{};\':"\\|,.<>\/?]/', $password)) {
            $errors[] = 'Password must be at least 8 characters long and include at least one number and one special character.';
        }

        // Check if passwords match
        if ($password !== $confirm_password) {
            $errors[] = 'Passwords do not match.';
        }

        // If no errors, process the registration
        if (empty($errors)) {
            $userId = uniqid(); // Simulate a user ID for demonstration purposes
            // Hash the password for secure storage (actual save to database would go here)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            // Redirect to user info page with query parameters
            header("Location: Assignment4_userinfo.php?name=" . urlencode($username) . "&email=" . urlencode($email) . "&user_id=" . urlencode($userId));
            exit;
        } else {
            // Display validation errors
            foreach ($errors as $error) {
                echo '<p style="color: red;">' . htmlspecialchars($error) . '</p>';
            }
        }
    }
?>

<!-- HTML form for user registration -->
<form method="POST" action="">
    <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label for="username" style="width: 150px;">*Username:</label>
        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
    </div>
    
    <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label for="email" style="width: 150px;">*Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
    </div>
    
    <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label for="password" style="width: 150px;">*Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    
    <div style="display: flex; align-items: center; margin-bottom: 10px;">
        <label for="confirm_password" style="width: 150px;">*Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>
    
    <button type="submit">Register</button>
</form>