
<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-size: cover;
            background-repeat: no-repeat;
            transition: background-image 2s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Successfully Logged In</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1>Welcome!</h1>
                        <a href="logout.php" class="btn btn-warning">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Array of background images
        const backgroundImages = [
            'first.gif',
            'second.gif',
            'hello.gif',
            'third.gif',
            'fourth.gif',
            'fifth.gif',
            'sixth.gif'
        
        ];

        let currentImageIndex = 0;

        function changeBackgroundImage() {
            const imageUrl = backgroundImages[currentImageIndex];
            document.body.style.backgroundImage = `url('${imageUrl}')`;
            currentImageIndex = (currentImageIndex + 1) % backgroundImages.length;
        }

        // Call the function initially
        changeBackgroundImage();

        // Change background image every 5 seconds (5000 milliseconds)
        setInterval(changeBackgroundImage, 5000);
    </script>
</body>
</html>
