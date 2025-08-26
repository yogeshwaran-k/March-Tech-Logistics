<?php
include './includes/db.php';
include './includes/auth-check.php';

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $location = $_POST["location"];
    $deadline = $_POST["deadline"];
    $status = isset($_POST["status"]) ? 1 : 0;

    $stmt = $conn->prepare("INSERT INTO job_openings (title, description, location, deadline, status) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $title, $desc, $location, $deadline, $status);
    $stmt->execute();

    $success = true; // Trigger SweetAlert
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Job</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="bg-white w-full max-w-2xl shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-green-700 mb-6 text-center">Add New Job Opening</h2>

        <form method="post" class="space-y-5">
            <div>
                <label class="block font-medium text-gray-700">Title</label>
                <input type="text" name="title" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 border px-4 py-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Description</label>
                <textarea name="description" rows="5" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 border px-4 py-2"></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Location</label>
                <input type="text" name="location" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 border px-4 py-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Deadline</label>
                <input type="date" name="deadline" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500 border px-4 py-2">
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="status"
                    class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                <label class="text-gray-700">Active</label>
            </div>

            <div class="flex justify-between items-center">
                <a href="manage-jobs.php" class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-300 transition">
                    ← Back
                </a>
                <button type="submit"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition">
                    Add Job
                </button>
            </div>
        </form>
    </div>

    <?php if ($success): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Job Added!',
            text: 'The job has been successfully created.',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'manage-jobs.php';
        });
    </script>
    <?php endif; ?>

</body>
</html>
