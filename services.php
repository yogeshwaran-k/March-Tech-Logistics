<?php include('./includes/header.php'); ?>

<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-blue-900 via-blue-700 to-blue-500 text-white overflow-hidden">
  <div class="absolute inset-0 bg-[url('assets/hero-bg.jpg')] bg-cover bg-center opacity-20"></div>
  <div class="container mx-auto px-6 py-24 text-center max-w-5xl relative z-10">
    <h1 class="text-4xl md:text-5xl font-extrabold mb-6 drop-shadow-lg tracking-tight text-yellow-300">Our Services</h1>
    <p class="max-w-3xl mx-auto text-lg md:text-xl opacity-95 leading-relaxed font-light">
      Comprehensive logistics solutions to move your business forward with precision and care.
    </p>
  </div>
</section>

<!--Services Section-->

<?php
$services = [
  [
    "title" => "ERP Job Processing",
    "desc" => "Accurate and timely job creation in your freight ERP system.",
    "icon" => "⚙️",
  ],
  [
    "title" => "Freight Documentation Preparation",
    "desc" => "BL, AWB, Cargo Manifests, Customs forms, Certificates of Origin, and compliance paperwork.",
    "icon" => "📄",
  ],
  [
    "title" => "Invoice & Billing Support",
    "desc" => "Preparing vendor and customer invoices with complete accuracy.",
    "icon" => "🧾",
  ],
  [
    "title" => "Weekly Tracking Reports",
    "desc" => "Consolidated updates on all active shipments.",
    "icon" => "📊",
  ],
  [
    "title" => "Freight Rate & Quote Management",
    "desc" => "Updating rate sheets, preparing quotes, and maintaining tariff databases.",
    "icon" => "💹",
  ],
  [
    "title" => "Pre-Alert & Post-Shipment Communication",
    "desc" => "Coordinating with agents and clients for smooth operations.",
    "icon" => "📞",
  ],
  [
    "title" => "Data & Document Archiving",
    "desc" => "Secure digital storage of shipment records for compliance.",
    "icon" => "🗄️",
  ],
  [
    "title" => "Operational KPI Reporting",
    "desc" => "Measuring and improving operational performance.",
    "icon" => "📈",
  ],
];
?>

<section class="container mx-auto px-6 py-20 max-w-7xl">
  <h2 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-16 text-center tracking-tight">What We Offer</h2>
  <div class="grid md:grid-cols-4 gap-10">
    <?php foreach ($services as $service) { ?>
    <div class="bg-white rounded-xl shadow-md p-8 flex flex-col items-center text-center cursor-pointer transition-shadow duration-300 hover:shadow-lg hover:-translate-y-1">
      
      <div class="text-5xl mb-6 text-blue-600">
        <?= htmlspecialchars($service['icon']) ?>
      </div>
      
      <h3 class="text-xl font-semibold text-gray-900 mb-3">
        <?= htmlspecialchars($service['title']) ?>
      </h3>
      
      <p class="text-gray-600 text-sm leading-relaxed">
        <?= htmlspecialchars($service['desc']) ?>
      </p>
      
      <div class="mt-6 w-20 border-b-2 border-blue-600 rounded"></div>
    </div>
    <?php } ?>
  </div>
</section>

<!-- Why Choose Us -->
<section class="bg-blue-50 py-16">
  <div class="container mx-auto px-6 max-w-5xl text-center">
    <h2 class="text-2xl md:text-3xl font-bold mb-10 text-blue-900">Why Choose March Tech Solutions?</h2>
    <div class="grid md:grid-cols-2 gap-10 text-left text-gray-700 text-base leading-relaxed items-center">
      <ul class="list-disc list-inside space-y-4 text-blue-900 font-medium bg-white rounded-xl shadow p-8 border border-blue-100">
        <li><strong>Industry Expertise</strong> – Over 45 years of combined experience in operations, HR, and administration.</li>
        <li><strong>Global Understanding</strong> – We understand forwarders in multiple markets.</li>
        <li><strong>Cost Efficiency</strong> – Reduce overhead without losing quality.</li>
        <li><strong>Confidential & Reliable</strong> – Data handled with utmost security.</li>
      </ul>
      <img src="assets/services.jpg" alt="Team Collaboration" class="rounded-2xl shadow-lg object-cover w-full border-4 border-blue-100 hover:scale-105 transition-transform duration-300" style="display:block;" />
    </div>
  </div>
</section>

<!-- Animations & Carousel Script -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@heroicons/vue@2.0.16/dist/heroicons.min.css">
<style>
  @keyframes fadeInUp {
    0% {opacity: 0; transform: translateY(15px);}
    100% {opacity: 1; transform: translateY(0);}
  }
  .scroll-fade-in {
    animation: fadeInUp 0.7s ease forwards;
    will-change: transform, opacity;
  }
  /* Carousel Dots */
  #carouselDots button.active {
    background-color: #2563eb;
    box-shadow: 0 0 0 2px #fff, 0 0 0 4px #2563eb;
  }
</style>

<script>
  // Incoterms auto sliding carousel with dots
  const carousel = document.getElementById('incotermsCarousel');
  const dots = document.querySelectorAll('#carouselDots button');
  const totalSlides = carousel.children.length;
  let currentSlide = 0;
  let carouselInterval;

  function goToSlide(idx) {
    const width = carousel.children[0].offsetWidth;
    currentSlide = idx;
    carousel.style.transform = `translateX(-${currentSlide * width}px)`;
    dots.forEach((dot, i) => dot.classList.toggle('active', i === currentSlide));
  }

  function slideCarousel() {
    goToSlide((currentSlide + 1) % totalSlides);
  }

  dots.forEach((dot, i) => {
    dot.addEventListener('click', () => {
      goToSlide(i);
      clearInterval(carouselInterval);
      carouselInterval = setInterval(slideCarousel, 4000);
    });
  });

  window.addEventListener('resize', () => {
    carousel.style.transition = 'none';
    carousel.style.transform = `translateX(-${currentSlide * carousel.children[0].offsetWidth}px)`;
    setTimeout(() => carousel.style.transition = 'transform 1s ease-in-out', 50);
  });

  // Start carousel
  goToSlide(0);
  carouselInterval = setInterval(slideCarousel, 4000);

  // Scroll Fade In Animation (optional, add .scroll-fade-in to elements you want animated)
  const fadeElems = document.querySelectorAll('.scroll-fade-in');
  function checkFade() {
    const triggerBottom = window.innerHeight * 0.9;
    fadeElems.forEach(el => {
      const rect = el.getBoundingClientRect();
      if(rect.top < triggerBottom) {
        el.style.opacity = 1;
        el.style.transform = 'translateY(0)';
        el.style.animationPlayState = 'running';
      }
    });
  }
  window.addEventListener('scroll', checkFade);
  window.addEventListener('load', checkFade);
</script>

<?php include('./includes/footer.php'); ?>
