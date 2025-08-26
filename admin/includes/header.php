<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logistics Co.</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<!-- Header -->
<header class="sticky top-0 bg-white shadow z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="index.php" class="text-2xl font-bold text-blue-700">Logistics Co.</a>
        <nav class="hidden md:flex space-x-6">
            <a href="index.php" class="hover:text-blue-600">Home</a>
            <a href="about.php" class="hover:text-blue-600">About</a>
            <a href="services.php" class="hover:text-blue-600">Services</a>
            <a href="careers.php" class="hover:text-blue-600">Careers</a>
            <a href="contact.php" class="hover:text-blue-600">Contact</a>
        </nav>
        <button id="mobile-menu-btn" class="md:hidden focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
    <div id="mobile-menu" class="hidden md:hidden bg-white px-6 pb-4">
        <a href="index.php" class="block py-2 hover:text-blue-600">Home</a>
        <a href="about.php" class="block py-2 hover:text-blue-600">About</a>
        <a href="services.php" class="block py-2 hover:text-blue-600">Services</a>
        <a href="careers.php" class="block py-2 hover:text-blue-600">Careers</a>
        <a href="contact.php" class="block py-2 hover:text-blue-600">Contact</a>
    </div>
</header>

<script>
document.getElementById("mobile-menu-btn").addEventListener("click", function() {
    document.getElementById("mobile-menu").classList.toggle("hidden");
});
</script>
