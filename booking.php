<?php
require_once 'AirlineClasses.php';

$airlines = [
    new PhilippineAirlines(),
    new CebuPacific(),
    new AirAsia(),
    new SkyJet(),
    new SunlightAir()
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="booking.css">
    <title>Booking</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">
        <h2>Book Your Flight</h2>
        
        <!-- Booking Form -->
        <form action="booking.php" method="POST" class="booking-form"> <br>
    <label for="name">Full Name:</label> <br>
    <input type="text" id="name" name="name" required placeholder="Enter your full name"> <br><br>

    <label for="email">Email Address:</label> <br>
    <input type="email" id="email" name="email" required placeholder="Enter your email"> <br><br>

    <label for="phone">Phone Number:</label> <br>
    <input type="tel" id="phone" name="phone" required placeholder="Enter your phone number"> <br><br>

    <label for="airline">Choose Airline:</label> <br>
    <select id="airline" name="airline" required>
        <option value="">Select an airline</option>
        <?php foreach ($airlines as $airline): ?>
        <option value="<?php echo $airline->getBrand(); ?>"><?php echo $airline->getBrand(); ?></option>
        <?php endforeach; ?>
    </select> <br><br>

    <label for="destination">Destination:</label> <br>
    <input type="text" id="destination" name="destination" required placeholder="Enter your destination"> <br><br>

    <label for="date">Travel Date:</label> <br>
    <input type="date" id="date" name="date" required> <br><br>

    <label for="notes">Special Requests (Optional):</label> <br>
    <textarea id="notes" name="notes" placeholder="Any special requests?"></textarea> <br><br>

    <button type="submit">Submit Booking</button>
</form>

    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
