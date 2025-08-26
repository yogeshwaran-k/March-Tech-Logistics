<?php include('./includes/header.php'); ?>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-900 to-blue-700 text-white">
    <div class="container mx-auto px-4 py-16 md:py-20 text-center max-w-3xl">
        <h1 class="text-3xl md:text-4xl font-extrabold mb-3 drop-shadow-lg text-yellow-300">Contact Us</h1>
        <p class="opacity-90 text-base md:text-lg leading-relaxed max-w-xl mx-auto drop-shadow-md">
            We’re here to help! Whether you have questions or want to explore how March Tech Solutions can power your logistics, drop us a message or reach out via phone.
        </p>
    </div>
    <div class="absolute top-0 left-0 w-32 h-32 bg-blue-600 rounded-full opacity-30 -translate-x-1/2 -translate-y-1/2 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-48 h-48 bg-blue-800 rounded-full opacity-20 translate-x-1/2 translate-y-1/2 blur-3xl pointer-events-none"></div>
</section>

<!-- Contact Info & Form -->
<section class="container mx-auto px-4 py-16 grid md:grid-cols-3 gap-5 md:gap-10">

    <!-- Contact Info Cards -->
    <div class="space-y-6 md:space-y-10">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 border-b border-blue-600 pb-2 max-w-max">Contact Information</h2>

        <div class="flex items-center space-x-3 p-4 md:p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition cursor-default">
           <img src="assets/mail.png" style="width:30px; height:30px;" alt="Mail" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8m-18 8h18" />
            </svg>
            <div>
                <p class="font-semibold text-gray-900 text-sm md:text-base">Email</p>
                <a href="mailto:info@marchtechsolutions.com" class="text-blue-600 hover:underline text-sm md:text-base">info@marchtechsolutions.com</a>
            </div>
        </div>

        <div class="flex items-center space-x-3 p-4 md:p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition cursor-default">
                      <img src="assets/telephone.png" style="width:30px; height:30px;" alt="Phone" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h2l.4 2M7 6h10l4 8v4a2 2 0 01-2 2H5a2 2 0 01-2-2V6z" />
            </svg>
            <div>
                <p class="font-semibold text-gray-900 text-sm md:text-base">Phone</p>
                <p class="text-gray-700 text-sm md:text-base">+91 99404 63384 | Ext 300</p>
            </div>
        </div>

        <div class="flex items-center space-x-3 p-4 md:p-6 bg-white rounded-xl shadow-lg hover:shadow-2xl transition cursor-default">
                       <img src="assets/PIN.png" style="width:30px; height:30px;" alt="Location" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a4 4 0 00-5.656 0l-1.414 1.414a4 4 0 000 5.656l1.414 1.414a4 4 0 005.656 0l4.243-4.243a4 4 0 000-5.656z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <div>
                <p class="font-semibold text-gray-900 text-sm md:text-base">Address</p>
                <address class="not-italic text-gray-700 text-sm md:text-base leading-relaxed">
                    MARCH TECH SOLUTIONS PVT LTD<br>
                    2/43A, Mangadu Main Road, Moulivakkam,<br>
                    Chennai, Tamil Nadu, India – 600125
                </address>
            </div>
        </div>
    </div>

    <!-- Contact Form -->
    <div class="md:col-span-2 bg-white rounded-2xl shadow-xl p-8 md:p-10 animate-fadeInUp" style="animation-duration: 700ms;">
        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 mb-6 md:mb-8 border-b border-blue-600 pb-2 max-w-max">Send Us a Message</h2>
        <form action="contact.php" method="POST" class="space-y-5 md:space-y-6">
            <div class="relative">
                <input type="text" id="name" name="name" required
                    class="peer w-full border border-gray-300 rounded-lg px-4 pt-5 pb-2 text-sm md:text-base text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Your Name" />
                <label for="name"
                    class="absolute left-4 top-2 text-gray-500 text-xs md:text-sm font-medium peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-gray-600 peer-focus:text-xs md:peer-focus:text-sm transition-all cursor-text">
                    Your Name
                </label>
            </div>

            <div class="relative">
                <input type="email" id="email" name="email" required
                    class="peer w-full border border-gray-300 rounded-lg px-4 pt-5 pb-2 text-sm md:text-base text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Your Email" />
                <label for="email"
                    class="absolute left-4 top-2 text-gray-500 text-xs md:text-sm font-medium peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-gray-600 peer-focus:text-xs md:peer-focus:text-sm transition-all cursor-text">
                    Your Email
                </label>
            </div>

            <div class="relative">
                <input type="text" id="subject" name="subject" required
                    class="peer w-full border border-gray-300 rounded-lg px-4 pt-5 pb-2 text-sm md:text-base text-gray-900 placeholder-transparent focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Subject" />
                <label for="subject"
                    class="absolute left-4 top-2 text-gray-500 text-xs md:text-sm font-medium peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-gray-600 peer-focus:text-xs md:peer-focus:text-sm transition-all cursor-text">
                    Subject
                </label>
            </div>

            <div class="relative">
                <textarea id="message" name="message" rows="4" required
                    class="peer w-full border border-gray-300 rounded-lg px-4 pt-5 pb-2 text-sm md:text-base text-gray-900 placeholder-transparent resize-none focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition" placeholder="Your Message"></textarea>
                <label for="message"
                    class="absolute left-4 top-2 text-gray-500 text-xs md:text-sm font-medium peer-placeholder-shown:top-4 peer-placeholder-shown:text-sm peer-placeholder-shown:text-gray-400 peer-focus:top-2 peer-focus:text-gray-600 peer-focus:text-xs md:peer-focus:text-sm transition-all cursor-text">
                    Your Message
                </label>
            </div>

            <button type="submit" name="send"
                class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold rounded-lg py-2.5 md:py-3 text-base md:text-lg transition shadow-md hover:shadow-lg">
                Send Message
            </button>
        </form>
    </div>
</section>

<!-- Google Map -->
<section class="container w-300 mx-auto px-4 mb-20" style="min-height: 400px;">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden animate-fadeInUp" style="animation-duration: 900ms; height: 100%;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3887.2405849909223!2d80.1395772536043!3d13.020345605301673!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a52610f79e406c7%3A0x1d62e53c7a608734!2sMarch%20Tech%20Solutions%20Pvt%20ltd!5e0!3m2!1sen!2sin!4v1754759281999!5m2!1sen!2sin"
            width="100%" height="100%" style="border:0; min-height: 400px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</section>


<style>
    /* Fade-in up animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation-name: fadeInUp;
        animation-fill-mode: forwards;
        animation-timing-function: ease-out;
    }

    /* Prevent horizontal overflow globally */
body, html {
  overflow-x: hidden;
}

/* Make sure iframe and images don't overflow container */
iframe, img {
  max-width: 100%;
  height: auto;
  display: block;
}

/* Ensure form inputs and textareas don't cause overflow */
input, textarea, button {
  max-width: 100%;
  box-sizing: border-box;
}

/* Fix any possible margin/padding overflow on small screens */
.container {
  max-width: 100vw;
  overflow-x: hidden;
}

</style>

<?php include('./includes/footer.php'); ?>

<?php
// PHP Form Handling (unchanged)
if (isset($_POST['send'])) {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Invalid Email',
                text: 'Please enter a valid email address.',
                confirmButtonColor: '#2563eb'
            });
        </script>";
        exit;
    }

    $to = "yogeshwarankumaran@gmail.com"; 
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $fullMessage = "Name: $name\nEmail: $email\n\nMessage:\n$message";

    if (mail($to, $subject, $fullMessage, $headers)) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Message Sent',
                text: 'We will get back to you shortly!',
                confirmButtonColor: '#2563eb'
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong. Please try again later.',
                confirmButtonColor: '#2563eb'
            });
        </script>";
    }
}
?>
