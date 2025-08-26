<?php
include('./includes/header.php');
include('./includes/db.php');

// Fetch open job listings from the DB
$stmt = $conn->prepare("SELECT * FROM job_openings WHERE status = 'open' ORDER BY deadline");
$stmt->execute();
$result = $stmt->get_result();
$jobs = $result->fetch_all(MYSQLI_ASSOC);
?>

<section class="relative bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white py-24 px-6 text-center">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-center text-yellow-300 mb-12">Careers at March Tech</h2>
</section>

<section class="bg-gradient-to-b from-blue-50 to-white py-16 px-4 sm:px-8 lg:px-16 min-h-screen">

    <div class="max-w-7xl mx-auto">
        <?php if (count($jobs) > 0): ?>
            <div class="grid gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                <?php foreach ($jobs as $job): ?>
                    <div 
                        class="bg-white border border-gray-200 rounded-2xl shadow-md hover:shadow-xl transition-shadow duration-300 p-8 flex flex-col"
                        style="will-change: transform, opacity;"
                        data-aos="fade-up"
                    >
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-blue-700 mb-3 leading-tight"><?= htmlspecialchars($job['title']) ?></h3>
                            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line"><?= htmlspecialchars($job['description']) ?></p>
                        </div>

                        <div class="mt-6 border-t border-gray-100 pt-4 text-sm text-gray-500 space-y-1">
                            <p><span class="font-medium text-gray-700">Location:</span> <?= htmlspecialchars($job['location']) ?></p>
                            <p><span class="font-medium text-gray-700">Application Deadline:</span> <?= date('M d, Y', strtotime($job['deadline'])) ?></p>
                        </div>

                        <div class="mt-8 text-center">
                            <a href="apply.php?job_id=<?= $job['id'] ?>"
                               class="inline-block bg-gradient-to-r from-blue-600 to-blue-800 hover:from-blue-700 hover:to-blue-900
                               text-white font-semibold py-3 px-6 rounded-xl shadow-md transition duration-300 w-full max-w-xs mx-auto"
                            >
                                Apply Now
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="text-center py-20">
                <p class="text-yellow-500 text-2xl max-w-xl mx-auto">There are currently no job openings. Kindly check back later.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- AOS animation script -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script>
  AOS.init({
    duration: 700,
    once: true,
    easing: 'ease-in-out',
  });
</script>

<?php include('./includes/footer.php'); ?>
