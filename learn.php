<?php include('./includes/header.php'); ?>

<section class="relative bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700 text-white py-24 px-6 text-center">
    <div class="container mx-auto max-w-4xl" data-aos="fade-up">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-yellow-300">Understanding Incoterms</h1>
        <p class="text-lg max-w-3xl mx-auto opacity-90 leading-relaxed">
            International Commercial Terms (Incoterms) are the cornerstone of global trade agreements — they determine
            crucial responsibilities between buyers and sellers including transportation, insurance, customs clearance,
            and transfer of risk. Mastering these terms empowers freight forwarders to operate with clarity and
            confidence.
        </p>
    </div>
</section>

<br><br>
<!-- Incoterms Carousel -->
<div class="relative overflow-hidden rounded-3xl shadow-2xl border border-blue-200 mb-20" data-aos="fade-up"
    data-aos-delay="200" style="min-height: 360px;">
    <div id="incotermsCarousel" class="flex transition-transform duration-700 ease-in-out will-change-transform"
        style="transform: translateX(0);">
        <?php
        $incoterms = [
            ["EXW – Ex Works", "Makes goods available at seller’s premises.", "All transport, customs, insurance.", "Buyers with own logistics setup."],
            ["FOB – Free On Board", "Delivers goods to departure port, loads onto vessel.", "Main freight, insurance, import clearance.", "Ocean shipments."],
            ["CIF – Cost, Insurance & Freight", "Pays for freight & insurance to destination port.", "Import clearance, local delivery.", "Inclusive ocean freight offers."],
            ["DAP – Delivered At Place", "Handles all transport to buyer’s location.", "Import clearance & duties.", "Time-sensitive shipments."],
            ["DDP – Delivered Duty Paid", "Full responsibility including import duties.", "None.", "Buyers wanting full door-to-door service."],
        ];
        foreach ($incoterms as $term) { ?>
            <div
                class="min-w-full p-12 bg-gradient-to-tr from-blue-50 to-white flex flex-col items-center justify-center rounded-3xl select-none">
                <h3 class="text-2xl font-extrabold mb-6 text-blue-900 drop-shadow-sm tracking-wide">
                    <?php echo $term[0]; ?>
                </h3>
                <ul class="list-disc list-inside space-y-3 text-gray-700 text-lg max-w-2xl">
                    <li><strong class="text-blue-700">Seller Responsibility:</strong> <?php echo $term[1]; ?></li>
                    <li><strong class="text-blue-700">Buyer Responsibility:</strong> <?php echo $term[2]; ?></li>
                    <li><strong class="text-blue-700">Ideal For:</strong> <?php echo $term[3]; ?></li>
                </ul>
            </div>
        <?php } ?>
    </div>
    <!-- Carousel Navigation Dots -->
    <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex space-x-3 z-20" id="carouselDots">
        <?php for ($i = 0; $i < count($incoterms); $i++) { ?>
            <button
                class="w-4 h-4 rounded-full bg-blue-300 hover:bg-blue-600 transition-colors border-2 border-white shadow-lg"
                data-slide="<?php echo $i; ?>"></button>
        <?php } ?>
    </div>
</div>

<!-- Educational Content Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-12 max-w-7xl mx-auto" data-aos="fade-up" data-aos-delay="300">

    <!-- Why Incoterms -->
    <article class="bg-blue-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-blue-900 mb-5 border-b border-blue-300 pb-3">
            Why Incoterms Matter
        </h3>
        <p class="text-gray-700 leading-relaxed text-base mb-4">
            Clearly defining obligations and risk transfers, Incoterms help avoid costly disputes and delays, forging
            trust between buyers and sellers globally.
        </p>
        <blockquote class="text-blue-700 italic border-l-4 border-blue-400 pl-4">
            “A shipment is only as smooth as the clarity behind its terms.”
        </blockquote>
    </article>

    <!-- Freight Journey Overview -->
    <article class="bg-blue-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-blue-900 mb-5 border-b border-blue-300 pb-3">
            Your Freight Journey
        </h3>
        <ul class="list-decimal list-inside text-gray-700 space-y-3 leading-relaxed text-base max-w-full">
            <li>Booking & Job Creation: Seamless ERP integration to secure carrier space, with expert HS code
                verification.</li>
            <li>Document Preparation: Accurate bills of lading, airway bills, invoices, and customs forms.</li>
            <li>Origin Handling: Efficient pickup, inspection, labeling, and warehouse management.</li>
            <li>International Transit: Real-time air, sea, or road shipment tracking.</li>
            <li>Destination Handling: Smooth customs clearance and coordinated delivery.</li>
            <li>Post-Shipment Support: Comprehensive invoicing, reconciliations, and KPI reporting.</li>
        </ul>
    </article>

    <!-- Partner With Us -->
    <article class="bg-blue-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300">
        <h3 class="text-xl font-semibold text-blue-900 mb-5 border-b border-blue-300 pb-3">
            Why Partner With March Tech Solutions?
        </h3>
        <p class="text-gray-700 leading-relaxed text-base mb-4">
            Leverage 45+ years of combined industry expertise delivering cost-efficient, confidential, and reliable
            freight forwarding back-office support across global markets.
        </p>
        <p class="italic text-blue-700 font-semibold">
            “We help you move at ease — streamlining your operations, so you can focus on growth.”
        </p>
    </article>
</div>
</div>
</section>

<!-- Enhanced Carousel JavaScript -->
<script>
    const carousel = document.getElementById('incotermsCarousel');
    const dots = document.querySelectorAll('#carouselDots button');
    let currentIndex = 0;
    const totalSlides = dots.length;

    // Update carousel position and active dot
    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach(d => d.classList.remove('bg-blue-600'));
        dots[currentIndex].classList.add('bg-blue-600');
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
        });
    });

    updateCarousel();

    // Optional: Auto-advance carousel every 8 seconds
    setInterval(() => {
        currentIndex = (currentIndex + 1) % totalSlides;
        updateCarousel();
    }, 3000);
</script>

<?php include('./includes/footer.php'); ?>