<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "singleproduct";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products from database
$sql = "SELECT name, price, image FROM products";
$result = $conn->query($sql);

$products = array();
if ($result) {
    // If results are found, fetch data into an array
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    } else {
        echo "No products found";
    }
} else {
    // If query fails, handle the error
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close MySQL connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>TimeZenith  - Luxury Smart Watch</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Poppins:wght@200;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <div class="container-fluid sticky-top">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <a href="index.php" class="navbar-brand">
                    <h2 class="text-white">TimeZenith</h2>
                </a>
                <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
    <span class="navbar-toggler-icon" style="filter: brightness(0) invert(1);"></span>
</button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a href="index.php" class="nav-link active">Home</a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="product.php" class="nav-link">Products</a></li>
                        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                        <?php if (isset($_SESSION['username'])): ?>
                            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                                <li class="nav-item"><a href="admin_dashboard.php" class="nav-link">Admin Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item"><a href="customer_login.php" class="nav-link">Login</a></li>
                        <?php endif; ?>
                    </ul>
                    <?php if (!isset($_SESSION['role']) || (isset($_SESSION['role']) && $_SESSION['role'] != 'admin')): ?>
                        <a href="#" class="btn btn-custom py-2 px-4 d-none d-lg-inline-block">Shop Now</a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Hero Start -->
    <div class="container-fluid bg-primary hero-header mb-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 text-center text-lg-start">
                    <h3 class="fw-light text-white animated slideInRight">Luxury</h3>
                    <h1 class="display-4 text-white animated slideInRight">Smart <span class="fw-light text-dark">Watch</span> For Healthy LifeStyle</h1>
                    <p class="text-white mb-4 animated slideInRight">Experience elegance and innovation with TimeZenith. This premium smartwatch blends metal and leather, offering up to 14 days of battery life. Waterproof and packed with features like heart rate monitoring and NFC, it's perfect for every lifestyle. Discover the future of timekeeping today.</p>
                    <a href="" class="btn btn-custom py-2 px-4 me-3 animated slideInRight">Shop Now</a>
                    <a href="" class="btn btn-custom py-2 px-4 me-3 animated slideInRight">Contact Us</a>
                </div>
                <div class="col-lg-6">
                    <img class="img-fluid animated pulse infinite" src="img/watch5-removebg.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->


    <!-- Feature Start -->
<div class="container-fluid py-5">
    <div class="container">
    <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
    <h1 class="text-primary mb-3" style="color: black;">
        <span class="fw-light" style="color: black;">Discover the Health Benefits of Our</span> TimeZenith Smartwatch
    </h1>
    <p class="mb-5" style="color: black;">Embrace a healthier lifestyle with features designed to monitor and enhance your well-being.</p>
</div>
        <div class="row g-4">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <div class="feature position-relative bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-heartbeat fa-3x text-dark mb-4"></i>
                        <h5 class="text-white mb-0">Heart Rate Monitoring</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="feature position-relative bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-tint fa-3x text-dark mb-4"></i>
                        <h5 class="text-white mb-0">Blood Oxygen Detection</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="feature position-relative bg-primary text-center p-3">
                    <div class="border py-5 px-3">
                        <i class="fa fa-bed fa-3x text-dark mb-4"></i>
                        <h5 class="text-white mb-0">Sleep Monitoring</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->



    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid animated pulse infinite" src="img/watch7-removebg.png">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="text-primary mb-4">Embrace a Healthy Lifestyle <span class="fw-light text-dark">with TimeZenith Smartwatch</span></h1>
                    <p class="mb-4">Elevate your health with advanced features like heart rate monitoring, blood pressure measurement, sleep tracking, and blood oxygen detection.</p>
                    <p class="mb-4">Crafted from premium materials, this smartwatch is your perfect partner for a healthy lifestyle.</p>
                    <a class="btn btn-custom py-2 px-4" href="">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Deal Start -->
    <div class="container-fluid deal bg-primary my-5 py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <img class="img-fluid animated pulse infinite" src="img/watch4-removebg.png">
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-black text-center p-4">
                        <div class="border p-4">
                            <p class="mb-2">TimeZenith Smartwatch</p>
                            <h2 class="fw-bold text-uppercase mb-4 b">Deals of the Day</h2>
                            <h1 class="display-4 mb-4">₱1300</h1>
                            <h5>Healthy and Stylish</h5>
                            <p class="mb-4">Track your heart rate, monitor sleep, measure blood pressure, and detect blood oxygen levels—all with one sleek device. Perfect for an active lifestyle, this premium smartwatch is your ultimate health companion.</p>
                            <div class="row g-0 cdt mb-4">
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-days"></h1>
                                </div>
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-hours"></h1>
                                </div>
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-minutes"></h1>
                                </div>
                                <div class="col-3">
                                    <h1 class="display-6" id="cdt-seconds"></h1>
                                </div>
                            </div>
                            <a class="btn btn-primary py-2 px-4" href="">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal End -->


    <!-- Feature Start -->
<div class="container-fluid py-5">
    <div class="container">
    <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
    <h1 class="text-primary mb-3" style="color: black;">
        <span class="fw-light" style="color: black;">Discover the Health Benefits of</span> TimeZenith Smartwatch
    </h1>
    <p class="mb-5" style="color: black;">Stay ahead in your health journey with TimeZenith. This premium smartwatch is designed to monitor and improve your overall well-being.</p>
</div>
        <div class="row g-4 align-items-center">
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                <div class="row g-5">
                    <div class="col-12 d-flex">
                        <div class="btn-square rounded-circle border flex-shrink-0"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h5 style="color: black;">Heart Rate Monitoring</h5>
                            <hr class="w-25 bg-primary my-2">
                            <span>Keep track of your heart health with real-time monitoring.</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="btn-square rounded-circle border flex-shrink-0"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h5 style="color: black;">Blood Pressure Measurement</h5>
                            <hr class="w-25 bg-primary my-2">
                            <span>Monitor your blood pressure on the go for a healthier lifestyle.</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="btn-square rounded-circle border flex-shrink-0"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h5 style="color: black;">Sleep Tracking</h5>
                            <hr class="w-25 bg-primary my-2">
                            <span>Improve your sleep quality with detailed tracking and analysis.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                <img class="img-fluid animated pulse infinite" src="img/watch18-removebg.png" alt="TimeZenith Smartwatch">
            </div>
            <div class="col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                <div class="row g-5">
                    <div class="col-12 d-flex">
                        <div class="btn-square rounded-circle border flex-shrink-0"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h5 style="color: black;">Blood Oxygen Detection</h5>
                            <hr class="w-25 bg-primary my-2">
                            <span>Measure your blood oxygen levels to stay informed about your health.</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="btn-square rounded-circle border flex-shrink-0"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h5 style="color: black;">Waterproof Design</h5>
                            <hr class="w-25 bg-primary my-2">
                            <span>Wear it confidently in any weather or during workouts.</span>
                        </div>
                    </div>
                    <div class="col-12 d-flex">
                        <div class="btn-square rounded-circle border flex-shrink-0"
                             style="width: 80px; height: 80px;">
                            <i class="fa fa-check fa-2x text-primary"></i>
                        </div>
                        <div class="ps-3">
                            <h5 style="color: black;">Smart Reminders</h5>
                            <hr class="w-25 bg-primary my-2">
                            <span>Stay on top of your tasks with smart notifications and reminders.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->



    <!-- How To Use Start -->
<div class="container-fluid bg-primary my-5 py-5">
    <div class="container text-white py-5">
        <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="text-white mb-3"><span class="fw-light text-dark">How To Use Your</span> TimeZenith Smartwatch</h1>
            <p class="mb-5">Follow these simple steps to get the most out of your TimeZenith Smartwatch and enhance your daily routine.</p>
        </div>
        <div class="row g-5">
            <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.1s">
                <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                    <i class="fa fa-power-off fa-3x text-dark"></i>
                </div>
                <h5 class="text-white">Power On the Watch</h5>
                <hr class="w-25 bg-light my-2 mx-auto">
                <span>Press and hold the power button until the watch turns on. Make sure it is fully charged before initial use.</span>
            </div>
            <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.3s">
                <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                <i class="fa fa-link fa-3x text-dark"></i>
                </div>
                <h5 class="text-white">Connect via Bluetooth</h5>
                <hr class="w-25 bg-light my-2 mx-auto">
                <span>Open the Bluetooth settings on your smartphone and connect it to your TimeZenith Smartwatch for seamless integration.</span>
            </div>
            <div class="col-lg-4 text-center wow fadeIn" data-wow-delay="0.5s">
                <div class="btn-square rounded-circle border mx-auto mb-4" style="width: 120px; height: 120px;">
                    <i class="fa fa-cogs fa-3x text-dark"></i>
                </div>
                <h5 class="text-white">Customize Settings</h5>
                <hr class="w-25 bg-light my-2 mx-auto">
                <span>Adjust the settings to suit your preferences, including watch face, notifications, and health monitoring options.</span>
            </div>
        </div>
    </div>
</div>
<!-- How To Use End -->


    <!-- Testimonial Start -->
<div class="container-fluid my-5 py-5">
    <div class="container text-black py-5">
    <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
    <h1 style="color: black;" class="mb-3">Our Customers Said <span class="fw-light">About TimeZenith Smartwatch</span></h1>
    <p style="color: black;" class="mb-5">Discover what our satisfied customers have to say about their experience with our smartwatches and how it has improved their health and lifestyle.</p>
</div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="owl-carousel testimonial-carousel wow fadeIn" data-wow-delay="0.1s">
                    <div class="testimonial-item text-center" data-dot="1">
                        <img class="img-fluid border p-2" src="img/testimonial-1.jpg" alt="">
                        <h5 style="color: black;" class="fw-light lh-base text-black">"TimeZenith Smartwatch has revolutionized my daily routine. The health monitoring features are top-notch and have helped me keep track of my fitness goals."</h5>
                        <h5 style="color: black;" class="mb-1">Jane Doe</h5>
                        <h6 style="color: black;" class="fw-light text-black fst-italic mb-0">Fitness Enthusiast</h6>
                    </div>
                    <div class="testimonial-item text-center" data-dot="2">
                        <img class="img-fluid border p-2" src="img/testimonial-2.jpg" alt="">
                        <h5 style="color: black;" class="fw-light lh-base text-black">"I love the sleep monitoring function. It's been incredibly accurate and has helped me improve my sleep quality. Highly recommend TimeZenith!"</h5>
                        <h5 style="color: black;" class="mb-1">John Smith</h5>
                        <h6 style="color: black;" class="fw-light text-black fst-italic mb-0">Tech Blogger</h6>
                    </div>
                    <div class="testimonial-item text-center" data-dot="3">
                        <img class="img-fluid border p-2" src="img/testimonial-3.jpg" alt="">
                        <h5 style="color: black;" class="fw-light lh-base text-black">"The heart rate and blood oxygen monitoring are life-changing. It's like having a personal health assistant on my wrist."</h5>
                        <h5 style="color: black;" class="mb-1">Emily Johnson</h5>
                        <h6 style="color: black;" class="fw-light text-black fst-italic mb-0">Healthcare Professional</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->
    
    <!-- Newsletter Start -->
    <div class="container-fluid bg-primary py-5 my-5">
        <div class="container py-5">
            <div class="mx-auto text-center wow fadeIn" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-white mb-3"><span class="fw-light text-dark">Let's Subscribe</span> The Newsletter</h1>
                <p class="text-white mb-4">Subscribe now to get 30% discount on any of our products</p>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 wow fadeIn" data-wow-delay="0.5s">
                    <div class="position-relative w-100 mt-3 mb-2">
                        <input class="form-control w-100 py-4 ps-4 pe-5" type="text" placeholder="Enter Your Email"
                            style="height: 48px;">
                        <button type="button" class="btn shadow-none position-absolute top-0 end-0 mt-1 me-2"><i
                                class="fa fa-paper-plane text-white fs-4"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Newsletter End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-white footer">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                    <a href="index.php" class="d-inline-block mb-3">
                        <h1 class="text-primary">TimeZenith</h1>
                    </a>
                    <p class="mb-0">Discover the benefits our satisfied customers rave about and join the journey towards a healthier, more connected life with TimeZenith.</p>
                </div>
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                    <h5 class="mb-4">Get In Touch</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>Philippines</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+63 932 869 7579</p>
                    <p><i class="fa fa-envelope me-3"></i>timezenith@gmail.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i class="fab fa-instagram"></i></a>
                        <a class="btn btn-square btn-outline-primary me-1" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                   
                <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                    <h5 class="mb-4">Popular Link</h5>
                    <a class="btn btn-link" href="">About Us</a>
                    <a class="btn btn-link" href="">Contact Us</a>
                    <a class="btn btn-link" href="">Privacy Policy</a>
                    <a class="btn btn-link" href="">Terms & Condition</a>
                    <a class="btn btn-link" href="">Career</a>
                </div>
            </div>
        </div>
        <div class="container wow fadeIn" data-wow-delay="0.1s">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">TimeZenith</a>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Home</a>
                            <a href="">Cookies</a>
                            <a href="">Help</a>
                            <a href="">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>