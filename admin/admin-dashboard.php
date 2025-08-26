<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

include './includes/db.php';

// Fetch job count
$jobQuery = $conn->query("SELECT COUNT(*) as total FROM job_openings");
$jobCount = $jobQuery ? $jobQuery->fetch_assoc()['total'] : 0;

// Fetch applicants count
$applicantQuery = $conn->query("SELECT COUNT(*) as total FROM applications");
$applicantCount = $applicantQuery ? $applicantQuery->fetch_assoc()['total'] : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex justify-between items-center">
            <h1 class="text-xl font-bold text-indigo-600">Logistics Admin</h1>
            <button onclick="confirmLogout()" class="text-red-500 hover:text-red-700 font-medium">Logout</button>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto p-6 flex-1">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            Welcome, <?= htmlspecialchars($_SESSION['admin_username']) ?>
        </h2>

        <!-- Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <!-- Jobs -->
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center hover:shadow-xl transition transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-indigo-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6h6v6h5l-8 8-8-8h5z" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700">Total Job Openings</h3>
                <p class="text-4xl font-bold text-indigo-600 mt-2"><?= $jobCount ?></p>
            </div>

            <!-- Applicants -->
            <div class="bg-white rounded-xl shadow-md p-6 flex flex-col items-center hover:shadow-xl transition transform hover:scale-105">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-green-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-4a4 4 0 00-4 4v2h5m-6 0h6" />
                </svg>
                <h3 class="text-lg font-semibold text-gray-700">Total Applicants</h3>
                <p class="text-4xl font-bold text-green-600 mt-2"><?= $applicantCount ?></p>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-10">
            <a href="manage-jobs.php" class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-lg shadow transition">Manage Jobs</a>
            <a href="view-applications.php" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow transition">View Applicants</a>
            <a href="add-admin.php" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg shadow transition">Add Admin</a>
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
    </script>

</body>
</html>
