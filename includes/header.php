<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>March Tech</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/jpeg" href="assets/logo.jpeg">
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header -->
<header class="sticky top-0 bg-white shadow z-50 transition-transform duration-300">
  <div class="container mx-auto px-6 py-3 flex justify-between items-center">
    
    <!-- Logo + Title -->
    <div class="flex items-center space-x-3">
      <a href="index.php" class="flex-shrink-0">
        <img src="assets/logo.jpg" alt="MARCH Tech Solutions" class="h-12 w-12 rounded-full shadow-md hover:scale-105 transition-transform duration-200">
      </a>
      <div class="flex flex-col leading-tight">
        <span class="text-lg font-extrabold text-blue-700">MARCH TECH</span>
        <span class="text-xs text-gray-600 tracking-wide">Marine Air Road Cargo Handlers</span>
      </div>
    </div>

    <!-- Desktop Navbar -->
    <nav class="hidden md:flex space-x-6 text-sm font-medium" id="navbar">
      <a href="index.php" class="hover:text-blue-600 transition-colors">Home</a>
      <a href="about.php" class="hover:text-blue-600 transition-colors">About</a>
      <a href="services.php" class="hover:text-blue-600 transition-colors">Services</a>
      <a href="learn.php" class="hover:text-blue-600 transition-colors">Learn</a>
      <a href="careers.php" class="hover:text-blue-600 transition-colors">Careers</a>
      <a href="contact.php" class="hover:text-blue-600 transition-colors">Contact</a>
    </nav>

    <!-- Mobile Menu Button -->
    <button id="mobile-menu-btn" class="md:hidden focus:outline-none p-2 rounded hover:bg-gray-100 transition">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-700" fill="none" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
      </svg>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden bg-white px-6 pb-4 shadow-lg rounded-b-lg space-y-2">
    <a href="index.php" class="block py-2 hover:text-blue-600 transition-colors">Home</a>
    <a href="about.php" class="block py-2 hover:text-blue-600 transition-colors">About</a>
    <a href="services.php" class="block py-2 hover:text-blue-600 transition-colors">Services</a>
    <a href="learn.php" class="block py-2 hover:text-blue-600 transition-colors">Learn</a>
    <a href="careers.php" class="block py-2 hover:text-blue-600 transition-colors">Careers</a>
    <a href="contact.php" class="block py-2 hover:text-blue-600 transition-colors">Contact</a>
  </div>
</header>

<script>
document.getElementById("mobile-menu-btn").addEventListener("click", function() {
  document.getElementById("mobile-menu").classList.toggle("hidden");
  this.classList.toggle("bg-blue-100");
});
</script>
<script>
  const header = document.querySelector('header');
  let lastScrollTop = 0;
  let ticking = false;

  window.addEventListener('scroll', function() {
  if (!ticking) {
    window.requestAnimationFrame(() => {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    if (scrollTop > lastScrollTop && scrollTop > 100) {
      // Scrolling down, hide header
      header.style.transform = 'translateY(-100%)';
    } else {
      // Scrolling up, show header
      header.style.transform = 'translateY(0)';
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
    ticking = false;
    });

    ticking = true;
  }
  });
</script>
</body>
</html>
