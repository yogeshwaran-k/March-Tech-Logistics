<?php
include './includes/db.php';
include './includes/auth-check.php';

$id = $_GET['id'];
$job = $conn->query("SELECT * FROM job_openings WHERE id=$id")->fetch_assoc();

$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $desc = $_POST["description"];
    $location = $_POST["location"];
    $deadline = $_POST["deadline"];
    $status = isset($_POST["status"]) ? 1 : 0;

    $stmt = $conn->prepare("UPDATE job_openings SET title=?, description=?, location=?, deadline=?, status=? WHERE id=?");
    $stmt->bind_param("ssssii", $title, $desc, $location, $deadline, $status, $id);
    $stmt->execute();

    $success = true; // Trigger SweetAlert
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Job</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="bg-white w-full max-w-2xl shadow-lg rounded-lg p-8">
        <h2 class="text-3xl font-bold text-blue-700 mb-6 text-center">Edit Job Opening</h2>

        <form method="post" class="space-y-5">
            <div>
                <label class="block font-medium text-gray-700">Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($job['title']) ?>" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border px-4 py-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Description</label>
                <textarea name="description" rows="5" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border px-4 py-2"><?= htmlspecialchars($job['description']) ?></textarea>
            </div>

            <div>
                <label class="block font-medium text-gray-700">Location</label>
                <input type="text" name="location" value="<?= htmlspecialchars($job['location']) ?>" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border px-4 py-2">
            </div>

            <div>
                <label class="block font-medium text-gray-700">Deadline</label>
                <input type="date" name="deadline" value="<?= htmlspecialchars($job['deadline']) ?>" required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border px-4 py-2">
            </div>

            <div class="flex items-center space-x-2">
                <input type="checkbox" name="status" <?= $job['status'] ? 'checked' : '' ?>
                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label class="text-gray-700">Active</label>
            </div>

            <div class="flex justify-between items-center">
                <a href="manage-jobs.php" class="bg-gray-200 text-gray-800 px-5 py-2 rounded-lg hover:bg-gray-300 transition">
                    ← Back
                </a>
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                    Update Job
                </button>
            </div>
        </form>
    </div>

    <?php if ($success): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Job Updated!',
            text: 'The job has been successfully updated.',
            timer: 1500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = 'manage-jobs.php';
        });
    </script>
    <?php endif; ?>

</body>
</html>
