<?php
header('Content-Type: application/json');

class Servo {
    public $position;

    public function __construct($initialPosition) {
        $this->position = $initialPosition;
    }

    public function setPosition($newPosition) {
        $this->position = $newPosition;
    }
}

function constrain($value, $min, $max) {
    return max($min, min($max, $value));
}

$lt = isset($_POST['lt']) ? (int)$_POST['lt'] : 0;
$rt = isset($_POST['rt']) ? (int)$_POST['rt'] : 0;
$ld = isset($_POST['ld']) ? (int)$_POST['ld'] : 0;
$rd = isset($_POST['rd']) ? (int)$_POST['rd'] : 0;

$servoHorizontal = new Servo(90); // Initial horizontal servo position
$servoVertical = new Servo(90); // Initial vertical servo position

$servohLimitHigh = 180;
$servohLimitLow = 0;
$servovLimitHigh = 100;
$servovLimitLow = 1;

// Control parameters
$kp = 0.1; // Proportional control constant

$avt = ($lt + $rt) / 2; // Average value top
$avd = ($ld + $rd) / 2; // Average value down
$avl = ($lt + $ld) / 2; // Average value left
$avr = ($rt + $rd) / 2; // Average value right

$dvert = $avt - $avd; // Difference of up and down
$dhoriz = $avl - $avr; // Difference of left and right

// Proportional control for smoother servo movement
$servoVertical->position = constrain($servoVertical->position + $kp * $dvert, $servovLimitLow, $servovLimitHigh);
$servoHorizontal->position = constrain($servoHorizontal->position + $kp * $dhoriz, $servohLimitLow, $servohLimitHigh);

$response = [
    'servo_h' => ($servoHorizontal->position) * 2,
    'servo_v' => $servoVertical->position
];

echo json_encode($response);
?>