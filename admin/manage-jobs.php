<?php
include './includes/db.php';
include './includes/auth-check.php';

$jobs = $conn->query("SELECT * FROM job_openings ORDER BY deadline");
if (!$jobs) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Jobs</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen flex flex-col">

    <div class="max-w-6xl mx-auto p-4 sm:p-6 flex-1 w-full">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <h2 class="text-2xl font-bold text-indigo-700">Manage Job Openings</h2>
            <div class="flex flex-wrap gap-3">
                <a href="admin-dashboard.php" class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg shadow transition">
                    ← Back to Dashboard
                </a>
                <a href="add-job.php" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow transition">
                    ➕ Add New Job
                </a>
            </div>
        </div>

        <!-- Job Table -->
        <?php if ($jobs->num_rows > 0): ?>
            <div class="overflow-x-auto bg-white shadow-lg rounded-xl">
                <table class="w-full border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="py-3 px-4 text-left">Title</th>
                            <th class="py-3 px-4 text-left">Location</th>
                            <th class="py-3 px-4 text-left hidden sm:table-cell">Description</th>
                            <th class="py-3 px-4 text-left">Deadline</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($job = $jobs->fetch_assoc()): ?>
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="py-3 px-4 font-medium"><?= htmlspecialchars($job['title']) ?></td>
                                <td class="py-3 px-4"><?= htmlspecialchars($job['location']) ?></td>
                                <td class="py-3 px-4 hidden sm:table-cell"><?= htmlspecialchars($job['description']) ?></td>
                                <td class="py-3 px-4"><?= htmlspecialchars($job['deadline']) ?></td>
                                <td class="py-3 px-4">
                                    <span class="<?= $job['status'] ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' ?>">
                                        <?= $job['status'] ? 'Active' : 'Closed' ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-center flex flex-wrap gap-2 justify-center">
                                    <a href="edit-job.php?id=<?= $job['id'] ?>" 
                                       class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded shadow text-sm">
                                        Edit
                                    </a>
                                    <button 
                                        onclick="confirmDelete(<?= $job['id'] ?>)" 
                                        class="px-3 py-1 bg-red-500 hover:bg-red-600 text-white rounded shadow text-sm">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center mt-6 text-gray-600">No job openings found.</p>
        <?php endif; ?>
    </div>

    <script>
        function confirmDelete(jobId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This job will be permanently deleted.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e3342f',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'delete-job.php?id=' + jobId;
                }
            });
        }
    </script>
</body>
</html>
