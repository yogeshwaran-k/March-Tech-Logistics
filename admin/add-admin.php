<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include './includes/db.php';

// Handle new admin form submission
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_admin'])) {
    $new_username = trim($_POST['username']);
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $alert = "Swal.fire('Error', 'Passwords do not match.', 'error');";
    } elseif (empty($new_username) || empty($new_password)) {
        $alert = "Swal.fire('Error', 'All fields are required.', 'error');";
    } else {
        // Hash password
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT);

        // Check duplicate username
        $check = $conn->prepare("SELECT * FROM admin_users WHERE username=?");
        if (!$check) {
            die("Prepare failed: " . $conn->error);
        }
        $check->bind_param("s", $new_username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $alert = "Swal.fire('Error', 'Username already exists.', 'error');";
        } else {
            $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
            if (!$stmt) {
                die("Prepare failed: " . $conn->error);
            }
            $stmt->bind_param("ss", $new_username, $hashed_password);

            if ($stmt->execute()) {
                $alert = "Swal.fire('Success', 'New admin added successfully!', 'success');";
            } else {
                $alert = "Swal.fire('Error', 'Failed to add admin.', 'error');";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600">Logistics Admin</h1>
            <div class="space-x-4">
                <a href="admin-dashboard.php" class="text-indigo-500 hover:text-indigo-700 font-medium">Dashboard</a>
                <button onclick="confirmLogout()" class="text-red-500 hover:text-red-700 font-medium">Logout</button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto p-6 flex-1">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Add New Admin</h2>

        <!-- Add New Admin Form -->
        <div class="bg-white rounded-xl shadow-md p-6 max-w-xl mx-auto">
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-gray-600 mb-1">Username</label>
                    <input type="text" name="username" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Password</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
                </div>
                <div>
                    <label class="block text-gray-600 mb-1">Confirm Password</label>
                    <input type="password" name="confirm_password" required
                           class="w-full px-4 py-2 border rounded-lg focus:ring focus:ring-indigo-300">
                </div>
                <button type="submit" name="new_admin"
                        class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-2 rounded-lg shadow">
                    Add Admin
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white shadow mt-auto">
        <div class="max-w-6xl mx-auto px-4 py-3 text-center text-gray-500 text-sm">
            &copy; <?= date("Y") ?> Logistics Company. All rights reserved.
        </div>
    </footer>

    <script>
        function confirmLogout() {
            Swal.fire({
                title: 'Logout?',
                text: "Are you sure you want to logout?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, logout'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'logout.php';
                }
            });
        }

        <?php if (isset($alert)) { echo $alert; } ?>
    </script>

</body>
</html>
