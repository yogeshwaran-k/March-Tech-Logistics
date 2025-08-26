<?php
// Show PHP errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include './includes/db.php';

// Check DB connection
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Helper function to show SweetAlert and exit
function showAlert($type, $title, $message, $redirect = null) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: '<?= $type ?>',
                title: '<?= $title ?>',
                text: '<?= $message ?>'
            }).then(() => {
                <?php if ($redirect): ?>
                    window.location.href = '<?= $redirect ?>';
                <?php endif; ?>
            });
        </script>
    </body>
    </html>
    <?php
    exit;
}

// Handle POST submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = intval($_POST["job_id"]);
    $name   = trim($_POST["name"]);
    $email  = trim($_POST["email"]);
    $phone  = trim($_POST["phone"]);

    $resume = $_FILES["resume"];
    $upload_dir = "uploads/";

    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $allowed_types = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];

    if (!in_array($resume["type"], $allowed_types)) {
        showAlert('error', 'Invalid File', 'Only PDF or Word documents are allowed.', null);
    }

    $resume_name = time() . "_" . basename($resume["name"]);
    $resume_path = $upload_dir . $resume_name;

    if (!move_uploaded_file($resume["tmp_name"], $resume_path)) {
        showAlert('error', 'Upload Failed', 'Failed to upload resume.', null);
    }

    $stmt = $conn->prepare("INSERT INTO applications (job_id, name, email, phone, resume_path) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        showAlert('error', 'Database Error', 'Failed to prepare statement: ' . $conn->error, null);
    }

    $stmt->bind_param("issss", $job_id, $name, $email, $phone, $resume_path);
    if ($stmt->execute()) {
        showAlert('success', 'Success', 'Application submitted successfully!', 'careers.php');
    } else {
        showAlert('error', 'Database Error', 'Failed to save application: ' . $stmt->error, null);
    }
}

// Handle GET request to show form
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['job_id'])) {
    $job_id = intval($_GET['job_id']);
    $stmt = $conn->prepare("SELECT title, description FROM job_openings WHERE id = ?");
    $stmt->bind_param("i", $job_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $job = $result->fetch_assoc();

    if (!$job) {
        showAlert('error', 'Not Found', 'Job not found.', 'careers.php');
    }
} else {
    showAlert('error', 'Invalid Request', 'Invalid job selection.', 'careers.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for <?= htmlspecialchars($job['title']) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md mb-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-blue-700 mb-4">
                Title: <?= htmlspecialchars($job['title']) ?>
            </h1>
            <p class="text-gray-700 text-sm sm:text-base leading-relaxed">
                <?= nl2br(htmlspecialchars($job['description'])) ?>
            </p>
        </div>

        <div class="bg-white p-6 sm:p-8 rounded-lg shadow-md">
            <h2 class="text-xl sm:text-2xl font-bold mb-6 text-blue-700">Submit Your Application</h2>
            <form action="apply.php" method="post" enctype="multipart/form-data" class="space-y-5">
                <input type="hidden" name="job_id" value="<?= $job_id ?>">

                <div>
                    <label class="block mb-2 font-semibold">Full Name:</label>
                    <input type="text" name="name" required class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Email Address:</label>
                    <input type="email" name="email" required class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Phone Number:</label>
                    <input type="text" name="phone" required class="w-full p-2 border border-gray-300 rounded">
                </div>

                <div>
                    <label class="block mb-2 font-semibold">Upload Resume (PDF/DOC/DOCX):</label>
                    <input type="file" name="resume" required class="w-full p-2 border border-gray-300 rounded">
                </div>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Submit Application
                </button>
            </form>

            <br>
            <a href="careers.php" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4">
                ← Back to Careers
            </a>
        </div>
    </div>
</body>
</html>
