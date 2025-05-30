<?php
abstract class Airline {
    abstract function getDetails();
    abstract function getImageFile();
    abstract function getBrand();
}

class PhilippineAirlines extends Airline {
    private $details = ["Flag Carrier", "Comfortable Seats", "Extensive Routes", "Award-Winning Service"];
    private $image = "images/PhilippineAirlines.jpg";
    private $brand = "Philippine Airlines";
    private $price = "$100 - $500";

    public function getDetails() {
        return array_merge($this->details, ["Price: " . $this->price]);
    }

    public function getImageFile() {
        return $this->image;
    }

    public function getBrand() {
        return $this->brand;
    }
}

class CebuPacific extends Airline {
    private $details = ["Budget-Friendly", "Frequent Flights", "Accessible Destinations", "Youthful Vibe"];
    private $image = "images/cebupacific.jpg";
    private $brand = "Cebu Pacific";
    private $price = "$50 - $300";

    public function getDetails() {
        return array_merge($this->details, ["Price: " . $this->price]);
    }

    public function getImageFile() {
        return $this->image;
    }

    public function getBrand() {
        return $this->brand;
    }
}

class AirAsia extends Airline {
    private $details = ["Low-Cost Carrier", "Promos & Discounts", "Regional Routes", "On-Time Flights"];
    private $image = "images/airasia.jpg";
    private $brand = "AirAsia";
    private $price = "$40 - $200";

    public function getDetails() {
        return array_merge($this->details, ["Price: " . $this->price]);
    }

    public function getImageFile() {
        return $this->image;
    }

    public function getBrand() {
        return $this->brand;
    }
}

class SkyJet extends Airline {
    private $details = ["Boutique Airline", "Premium Service", "Short Routes", "Quick Boarding"];
    private $image = "images/skyjet.jpg";
    private $brand = "SkyJet";
    private $price = "$80 - $250";

    public function getDetails() {
        return array_merge($this->details, ["Price: " . $this->price]);
    }

    public function getImageFile() {
        return $this->image;
    }

    public function getBrand() {
        return $this->brand;
    }
}

class SunlightAir extends Airline {
    private $details = ["Private Charters", "Exclusive Destinations", "Luxury Travel", "Customizable Trips"];
    private $image = "images/sunlight_air.jpg";
    private $brand = "Sunlight Air";
    private $price = "$150 - $600";

    public function getDetails() {
        return array_merge($this->details, ["Price: " . $this->price]);
    }

    public function getImageFile() {
        return $this->image;
    }

    public function getBrand() {
        return $this->brand;
    }
}
?>
