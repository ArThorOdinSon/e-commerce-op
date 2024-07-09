<?php
include('session.php');

// Redirect to login page if not logged in as admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: admin_login.php");
    exit;
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'singleproduct');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add Product
if (isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // File upload handling
    if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $image = $_FILES['image'];
        $uploadDir = 'uploads/'; // Directory where images will be uploaded
        $uploadFile = $uploadDir . basename($image['name']);

        if (move_uploaded_file($image['tmp_name'], $uploadFile)) {
            // Insert product into database
            $sql = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssds", $name, $description, $price, $uploadFile);
            if ($stmt->execute()) {
                // Product added successfully
                header("Location: admin_dashboard.php");
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $stmt->close();
        } else {
            echo '<div class="alert alert-danger" role="alert">Sorry, there was an error uploading your file.</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">File upload error. Please try again.</div>';
    }
}

// Delete Product
if (isset($_GET['delete_product'])) {
    $id = $_GET['delete_product'];
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        // Product deleted successfully
        header("Location: admin_dashboard.php");
        exit;
    } else {
        echo "Error deleting product: " . $conn->error;
    }
    $stmt->close();
}

// Fetch Products
$sql = "SELECT * FROM products";
$products = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TimeZenith - Single Product Website Template</title>
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
                    <div class="navbar-nav ms-auto">
                        <a href="index.php" class="nav-item nav-link active">Home</a>
                        <a href="about.php" class="nav-item nav-link">About</a>
                        <a href="product.php" class="nav-item nav-link">Products</a>
                        <a href="contact.php" class="nav-item nav-link">Contact</a>
                        <?php if (isset($_SESSION['username'])): ?>
                            <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
                            <?php if ($_SESSION['role'] == 'admin'): ?>
                                <li class="nav-item"><a href="admin_dashboard.php" class="nav-link">Admin Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item"><a href="admin_login.php" class="nav-link">Login</a></li>
                        <?php endif; ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->

    <div class="container-fluid bg-primary hero-header mb-5">
        <div class="container">
            <h1 class="mb-4">Admin Dashboard</h1>

            <form method="POST" action="admin_dashboard.php" class="mb-4" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Product Name" required>
                </div>
                <div class="mb-3">
                    <textarea name="description" class="form-control" placeholder="Description"></textarea>
                </div>
                <div class="mb-3">
                    <input type="number" name="price" class="form-control" placeholder="Price" required>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div>
                <button type="submit" name="add_product" class="btn btn-primary">Add Product</button>
            </form>

            <h2 class="mb-4">Product List</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($product = $products->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars($product['description']); ?></td>
                        <td><?php echo htmlspecialchars($product['price']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($product['image']); ?>" alt="" width="50"></td>
                        <td>
                            <a href="admin_dashboard.php?delete_product=<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-white footer">
        <div class="container py-5">
            <!-- Footer content -->
        </div>
    </div>
    <!-- Footer End -->

    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Additional scripts as needed -->
</body>
</html>
