<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include './includes/db.php';

$message = "";
$messageType = ""; // "success" | "error"

// ⚠️ Set a real secret and share only with trusted admins
$valid_secret = "MY_SUPER_SECRET_KEY_2025";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Basic sanitization
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";
    $confirm_password = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";
    $secret_key = isset($_POST["secret_key"]) ? $_POST["secret_key"] : "";

    if ($secret_key !== $valid_secret) {
        $message = "Invalid secret key. Access denied.";
        $messageType = "error";
    } elseif ($username === "" || strlen($username) < 3) {
        $message = "Username must be at least 3 characters.";
        $messageType = "error";
    } elseif (strlen($password) < 6) {
        $message = "Password must be at least 6 characters.";
        $messageType = "error";
    } elseif ($password !== $confirm_password) {
        $message = "Passwords do not match.";
        $messageType = "error";
    } else {
        if (!$conn) {
            $message = "Database connection not available.";
            $messageType = "error";
        } else {
            // Check username
            $check = $conn->prepare("SELECT 1 FROM admin_users WHERE username = ? LIMIT 1");
            if (!$check) {
                $message = "Prepare failed (check query/table): " . $conn->error;
                $messageType = "error";
            } else {
                $check->bind_param("s", $username);
                $check->execute();
                $check->store_result();

                if ($check->num_rows > 0) {
                    $message = "Username already taken.";
                    $messageType = "error";
                } else {
                    $hashed = password_hash($password, PASSWORD_BCRYPT);
                    $stmt = $conn->prepare("INSERT INTO admin_users (username, password) VALUES (?, ?)");
                    if (!$stmt) {
                        $message = "Insert prepare failed: " . $conn->error;
                        $messageType = "error";
                    } else {
                        $stmt->bind_param("ss", $username, $hashed);
                        if ($stmt->execute()) {
                            $message = "Admin registered successfully!";
                            $messageType = "success";
                        } else {
                            $message = "Insert failed: " . $stmt->error;
                            $messageType = "error";
                        }
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 (load BEFORE any use of Swal) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-2xl rounded-2xl p-8 w-full max-w-md">
        <h2 class="text-3xl font-extrabold text-center mb-6 text-gray-800">🔐 Admin Registration</h2>

        <form method="post" id="registerForm" class="space-y-5" autocomplete="off" novalidate>
            <!-- STEP 1 -->
            <div id="step1">
                <div>
                    <label class="block mb-1 font-semibold text-gray-600">Username</label>
                    <input type="text" id="username" name="username" required
                           class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                           autocomplete="off" />
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-600">Password</label>
                    <input type="password" id="password" name="password" required minlength="6"
                           class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                           autocomplete="new-password" />
                </div>

                <div>
                    <label class="block mb-1 font-semibold text-gray-600">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required minlength="6"
                           class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                           autocomplete="new-password" />
                </div>

                <div class="flex gap-3">
                    <button type="button" id="nextBtn"
                        class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg font-semibold hover:from-blue-700 hover:to-indigo-700 shadow-md transition duration-200">
                        Next ➡️
                    </button>
                </div>
            </div>

            <!-- STEP 2 -->
            <div id="step2" class="hidden">
                <div>
                    <label class="block mb-1 font-semibold text-gray-600">Secret Key</label>
                    <input type="password" id="secret_key" name="secret_key" required
                           placeholder="Enter secret key"
                           class="w-full border border-red-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 shadow-sm" />
                    <p class="text-xs text-gray-500 mt-1">⚠️ Only users with the secret key can register.</p>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="backBtn"
                        class="w-1/3 bg-gray-200 text-gray-800 py-3 rounded-lg font-semibold hover:bg-gray-300 shadow-md transition duration-200">
                        ⬅️ Back
                    </button>
                    <button type="submit"
                        class="flex-1 bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 shadow-md transition duration-200">
                        Register ✅
                    </button>
                </div>
            </div>
        </form>

        <p class="text-center text-gray-500 text-sm mt-5">
            <a href="admin-login.php" class="text-blue-600 hover:underline">Already have an account? Login</a>
        </p>
    </div>

    <!-- SweetAlert after PHP processing -->
    <?php if ($message !== ""): ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const type = <?php echo json_encode($messageType ?: "info"); ?>;
                const msg  = <?php echo json_encode($message); ?>;

                if (typeof Swal !== "undefined") {
                    Swal.fire({
                        icon: type,
                        title: type.charAt(0).toUpperCase() + type.slice(1),
                        text: msg,
                        confirmButtonColor: '#3085d6'
                    }).then(() => {
                        <?php if ($messageType === "success"): ?>
                        window.location.href = "admin-login.php";
                        <?php endif; ?>
                    });
                } else {
                    alert((type.toUpperCase()) + ": " + msg);
                    <?php if ($messageType === "success"): ?>
                    window.location.href = "admin-login.php";
                    <?php endif; ?>
                }
            });
        </script>
    <?php endif; ?>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const nextBtn = document.getElementById("nextBtn");
            const backBtn = document.getElementById("backBtn");
            const step1   = document.getElementById("step1");
            const step2   = document.getElementById("step2");

            // Guard in case elements are missing
            if (nextBtn) {
                nextBtn.addEventListener("click", () => {
                    const username = document.getElementById("username").value.trim();
                    const password = document.getElementById("password").value;
                    const confirm  = document.getElementById("confirm_password").value;

                    if (username.length < 3) {
                        Swal.fire("Error", "Username must be at least 3 characters long.", "error");
                        return;
                    }
                    if (password.length < 6) {
                        Swal.fire("Error", "Password must be at least 6 characters long.", "error");
                        return;
                    }
                    if (password !== confirm) {
                        Swal.fire("Error", "Passwords do not match.", "error");
                        return;
                    }

                    step1.classList.add("hidden");
                    step2.classList.remove("hidden");
                });
            }

            if (backBtn) {
                backBtn.addEventListener("click", () => {
                    step2.classList.add("hidden");
                    step1.classList.remove("hidden");
                });
            }
        });
    </script>
</body>
</html>
