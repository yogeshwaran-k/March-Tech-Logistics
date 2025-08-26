<?php include('./includes/header.php'); ?>

<!-- AOS CSS for scroll animations -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />

<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-no-repeat h-[550px]" style="background-image: url('assets/hero.jpg');" data-aos="fade-in" data-aos-duration="1200">
    <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col items-center justify-center text-center px-6">
        <h1 class="text-5xl font-bold text-yellow-300 mb-4">Move at Ease</h1>
        <p class="text-lg text-white max-w-3xl mb-8">
            You focus on growing your business. We handle the paperwork, processing, and back-office operations that keep your shipments moving.
        </p>
         
        <p class="mt-10 italic text-blue-600 max-w-md">“I’m Captain March — your freight forwarding co-pilot!”</p>
    </div>
</section>

<!-- About Teaser -->
<section class="container mx-auto px-6 py-16" data-aos="fade-up" data-aos-delay="100">
    <div class="grid md:grid-cols-2 gap-10 items-center">
        <img src="assets/team.jpg" alt="March Tech Solutions Team"  class="rounded-lg shadow-lg w-full object-cover" />
        <div>
            <h2 class="text-3xl font-bold text-blue-700 mb-4">About March Tech Solutions</h2>
            <p class="text-gray-700 mb-4 leading-relaxed">
                At March Tech Solutions, we provide outsourced back-office support tailored for SME and medium-sized freight forwarding companies across the Middle East, Europe, and USA.  
                Our expert team brings over 45 years of combined industry experience to help you focus on growing your core business, while we manage time-consuming tasks like documentation, ERP job processing, invoicing, shipment tracking, and reporting.
            </p>
            <a href="about.php" class="text-blue-600 hover:underline font-semibold">Learn More →</a>
        </div>
    </div>
</section>

<!-- Services Teaser -->
<section class="bg-gray-100 py-16" data-aos="fade-up" data-aos-delay="200">
    <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-blue-700 mb-8 text-center">Our Services</h2>
        <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center" data-aos="zoom-in" data-aos-delay="250">
                <img src="assets/erp.jpg"  alt="ERP Job Processing" class="rounded mb-4 mx-auto object-cover" style="width:400px; height:300px;" />
                <h3 class="text-xl font-semibold mb-4">ERP Job Processing</h3>
                <p class="text-gray-700">
                    Accurate and timely job creation in your freight ERP system.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center" data-aos="zoom-in" data-aos-delay="350">
               <img src="assets/frieght.jpg"  alt="Freight Documentation" class="rounded mb-4 mx-auto object-cover" style="width:400px; height:300px;" />
                <h3 class="text-xl font-semibold mb-4">Freight Documentation</h3>
                <p class="text-gray-700">
                    BL, AWB, Cargo Manifests, Customs forms, Certificates of Origin, and compliance paperwork.
                </p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition text-center" data-aos="zoom-in" data-aos-delay="450">
                <img src="assets/invoice.jpg"  alt="Invoice and Billing Support" class="rounded mb-4 mx-auto object-cover" style="width:400px; height:300px;" />
                <h3 class="text-xl font-semibold mb-4">Invoice & Billing Support</h3>
                <p class="text-gray-700">
                    Preparing vendor and customer invoices with complete accuracy.
                </p>
            </div>
        </div>
        <div class="text-center mt-8">
            <a href="services.php" class="text-blue-600 hover:underline font-semibold">View All Services →</a>
        </div>
    </div>
</section>

<!-- Captain March Quote Section -->
<section class="py-16 px-6 text-center text-white bg-gradient-to-r from-blue-900 via-blue-800 to-blue-700" data-aos="fade-up" data-aos-delay="600">
    <h2 class="text-3xl font-bold mb-6 text-yellow-500">Captain March – Your Freight Co-Pilot</h2>
    <p class="max-w-xl mx-auto italic text-lg">
        Captain March is our friendly operations guide who ensures you move at ease. He appears across our site with helpful tips and reminders — making freight forwarding simpler and friendlier.
    </p>
    <div class="mt-10 max-w-2xl mx-auto space-y-4 text-xl font-semibold">
        <p>“The right paperwork means your cargo never gets stuck.”</p>
        <p>“A shipment is only as smooth as the data behind it.”</p>
        <p>“I’m here so you can focus on customers, not compliance.”</p>
    </div>
</section>

<!-- Call to Action -->
<section class="mt-10 py-16 text-center text-blue-700" data-aos="fade-up" data-aos-delay="700">
    <h2 class="text-3xl font-bold mb-4">Ready to Move at Ease?</h2>
    <p class="mb-6 max-w-xl mx-auto">Let us handle your back-office freight forwarding operations while you focus on growing your business.</p>
    <a href="contact.php" class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-3 rounded font-semibold transition">Get Started →</a>
</section>

<!-- AOS JS for scroll animations -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 900,
    easing: 'ease-in-out',
    once: true,
  });
</script>

<?php include('./includes/footer.php'); ?>