<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="Home.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="container">
        <!-- Hero Section -->
        <div class="hero-section">
            <h2>Welcome to Our Airline Booking System</h2>
            <p>We bring together the best airlines to make your travel experience seamless and enjoyable.</p>
            <p>Explore our services and book your next flight with ease.</p>
            <a href="booking.php" class="cta-button">Book Now</a>
        </div>
        <a href="logout.php" class="cta-button">Logout</a>
        <!-- Airline Section -->
        <div class="airline-section">
            <h2>Airline Partners</h2>
            <div class="cards">
                <?php
                require_once 'AirlineClasses.php';
                $airlines = [
                    new PhilippineAirlines(),
                    new CebuPacific(),
                    new AirAsia(),
                    new SkyJet(),
                    new SunlightAir()
                ];
                foreach ($airlines as $airline): ?>
                    <div class="card">
                        <img src="<?php echo $airline->getImageFile(); ?>" alt="<?php echo $airline->getBrand(); ?>">
                        <h3><?php echo $airline->getBrand(); ?></h3>
                        <ul>
                            <?php foreach ($airline->getDetails() as $detail): ?>
                                <li><?php echo $detail; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


    <?php include 'footer.php'; ?>
</body>
</html>
