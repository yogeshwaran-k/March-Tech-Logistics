<?php
include('./includes/auth-check.php');
include('./includes/db.php');

// Debug: Log SQL execution
$stmt = $conn->prepare("
    SELECT a.*, 
           j.title AS job_title, 
           IFNULL(a.status, 'new') AS status
    FROM applications a
    JOIN job_openings j ON a.job_id = j.id
    ORDER BY a.id DESC
");
if (!$stmt) {
    die("SQL Prepare Error: " . $conn->error);
}
$stmt->execute();
$apps = $stmt->get_result();
if (!$apps) {
    die("SQL Execution Error: " . $stmt->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - View Applications</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto space-y-6">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="text-3xl font-bold text-gray-800">All Applications</h2>
            <select id="statusFilter" onchange="filterTable()" 
                class="w-full sm:w-60 px-3 py-2 border rounded shadow-sm focus:ring focus:ring-blue-200">
                <option value="all">All</option>
                <option value="new">New</option>
                <option value="viewed">Viewed</option>
                <option value="interviewed">Interviewed</option>
                <option value="onboarding">Onboarding</option>
                <option value="not proceeding">Not Proceeding</option>
            </select>
        </div>

        <div class="overflow-x-auto rounded-lg shadow bg-white">
            <table class="min-w-full divide-y divide-gray-200 text-sm text-left" id="applicationsTable">
                <thead class="bg-blue-700 text-white">
                    <tr>
                        <th class="px-4 py-3">#</th>
                        <th class="px-4 py-3">Job</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Resume</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php 
                    $i = 1; 
                    if ($apps->num_rows === 0) {
                        echo "<tr><td colspan='8' class='px-4 py-2 text-center text-gray-500'>No applications found</td></tr>";
                    }
                    while($row = $apps->fetch_assoc()): 
                        $currentStatus = strtolower($row['status'] ?: 'new');
                    ?>
                    <tr class="bg-white hover:bg-gray-50 transition" 
                        data-id="<?= $row['id'] ?>" 
                        data-status="<?= $currentStatus ?>">
                        <td class="px-4 py-2 font-semibold"><?= $i++ ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['job_title']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['name']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['email']) ?></td>
                        <td class="px-4 py-2"><?= htmlspecialchars($row['phone']) ?></td>
                        <td class="px-4 py-2">
                            <a href="../<?= $row['resume_path'] ?>" 
                               target="_blank" 
                               class="text-blue-600 hover:underline">Download</a>
                        </td>
                        <td class="px-4 py-2">
                            <select onchange="updateStatus(this, <?= $row['id'] ?>)" 
                                class="border px-2 py-1 rounded">
                                <?php
                                    $statuses = ['new', 'viewed', 'interviewed', 'onboarding', 'not proceeding'];
                                    foreach ($statuses as $status):
                                ?>
                                    <option value="<?= $status ?>" <?= ($currentStatus === $status) ? 'selected' : '' ?>>
                                        <?= ucfirst($status) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td class="px-4 py-2">
                            <button onclick="confirmDelete(<?= $row['id'] ?>)" 
                                class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Delete
                            </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

<script>
function updateStatus(selectElem, id) {
    const status = selectElem.value;
    console.log(`Updating status for ID: ${id} to: ${status}`);

    fetch('update-status.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${id}&status=${encodeURIComponent(status)}`
    })
    .then(res => {
        console.log('Status update response status:', res.status);
        return res.text();
    })
    .then(response => {
        console.log('Status update raw response:', response);
        if (response.trim() === 'success') {
            const row = selectElem.closest('tr');
            row.setAttribute('data-status', status);
            Swal.fire('Updated!', 'Status updated successfully.', 'success');
            filterTable();
        } else {
            Swal.fire('Error!', 'Failed to update status.', 'error');
        }
    })
    .catch(err => console.error('Status update error:', err));
}

function confirmDelete(id) {
    console.log(`Delete requested for ID: ${id}`);
    Swal.fire({
        title: 'Are you sure?',
        text: "This will permanently delete the application.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then(result => {
        if (result.isConfirmed) {
            fetch('delete-application.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}`
            })
            .then(res => {
                console.log('Delete response status:', res.status);
                return res.text();
            })
            .then(response => {
                console.log('Delete raw response:', response);
                if (response.trim() === 'success') {
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) row.remove();
                    Swal.fire('Deleted!', 'Application removed.', 'success');
                } else {
                    Swal.fire('Error!', 'Delete failed.', 'error');
                }
            })
            .catch(err => console.error('Delete error:', err));
        }
    });
}

function filterTable() {
    const selected = document.getElementById('statusFilter').value.toLowerCase();
    console.log(`Filtering table for status: ${selected}`);
    const rows = document.querySelectorAll("#applicationsTable tbody tr");
    rows.forEach(row => {
        const rowStatus = row.getAttribute("data-status");
        row.style.display = (selected === 'all' || rowStatus === selected) ? '' : 'none';
    });
}
</script>
</body>
</html>
