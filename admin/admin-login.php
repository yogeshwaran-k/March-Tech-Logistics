<?php
session_start();
include './includes/db.php';

$message = "";
$messageType = ""; // success, error

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 1) {
        $admin = $res->fetch_assoc();
        if (password_verify($password, $admin["password"])) {
            $_SESSION["admin_logged_in"] = true;
            $_SESSION["admin_username"] = $username;
            $message = "Login successful! Redirecting...";
            $messageType = "success";
            echo "<script>
                    setTimeout(function(){
                        window.location.href = 'admin-dashboard.php';
                    }, 1500);
                  </script>";
        } else {
            $message = "Invalid password.";
            $messageType = "error";
        }
    } else {
        $message = "No admin found with that username.";
        $messageType = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Admin Login</h2>

        <form method="post" class="space-y-4">
            <div>
                <label class="block mb-1 font-semibold text-gray-600">Username</label>
                <input type="text" name="username" required 
                    class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block mb-1 font-semibold text-gray-600">Password</label>
                <input type="password" name="password" required 
                    class="w-full border border-gray-300 px-3 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                Login
            </button>
        </form>

        <p class="text-center text-gray-500 text-sm mt-4">
            <a href="admin-register.php" class="text-blue-600 hover:underline">New admin? Register here</a>
        </p>
    </div>

    <?php if (!empty($message)): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $messageType; ?>',
                title: '<?php echo ucfirst($messageType); ?>',
                text: '<?php echo $message; ?>',
                confirmButtonColor: '#3085d6'
            });
        </script>
    <?php endif; ?>

</body>
</html>
