#include <Adafruit_INA219.h>
#include <DHT.h>
#include <SoftwareSerial.h>
#include <Servo.h>

// Sensor and serial initialization
SoftwareSerial uno(2, 3); // RX, TX
DHT dht(12, DHT22); // DHT sensor pin and type
Adafruit_INA219 ina219;

// Servo initialization
Servo horizontal;
Servo vertical;
int servoh = 90; // Initial horizontal servo position
const int servohLimitHigh = 175;
const int servohLimitLow = 5;
int servov = 90;  // Initial vertical servo position
const int servovLimitHigh = 100;
const int servovLimitLow = 1;

// LDR pin connections
const int ldrlt = A0; // LDR top left
const int ldrrt = A3; // LDR top right
const int ldrld = A1; // LDR down left
const int ldrrd = A2; // LDR down right

// Control parameters
const float kp = 0.1; // Proportional control constant

void setup() {
  // Initialize serial communications
  uno.begin(9600);
  Serial.begin(9600);
  
  // Initialize sensors
  dht.begin();
  ina219.begin();
  
  // Initialize servos
  horizontal.attach(9);
  vertical.attach(10);
  horizontal.write(servoh);
  vertical.write(servov);
  delay(2000); // Delay for stabilization
}

void loop() {
  // Read data from DHT22 sensor
  float humid = dht.readHumidity();
  float temp = dht.readTemperature();

  // Read data from INA219 sensor
  float arus_mA = ina219.getCurrent_mA();
  float tegangan_V = ina219.getBusVoltage_V();

  // Send data to SoftwareSerial if available
  if (uno.available() > 0) {
    uno.print(humid);
    uno.print(",");
    uno.print(temp);
    uno.print(",");
    uno.print(arus_mA);
    uno.print(",");
    uno.print(tegangan_V);
    uno.print("\n");
  }

  // Send data to Serial Monitor
  Serial.print("Temperature: ");
  Serial.print(temp);
  Serial.print(" *C, Humidity: ");
  Serial.print(humid);
  Serial.print(" %, Arus: ");
  Serial.print(arus_mA);
  Serial.print(" mA, Tegangan: ");
  Serial.print(tegangan_V);
  Serial.print(" V");
  Serial.println();

  // Read LDR values
  int lt = analogRead(ldrlt); // Top left
  int rt = analogRead(ldrrt); // Top right
  int ld = analogRead(ldrld); // Down left
  int rd = analogRead(ldrrd); // Down right

  // Display LDR values on the Serial Monitor
  Serial.print("lt: ");
  Serial.print(lt);
  Serial.print(" || rt: ");
  Serial.print(rt);
  Serial.print(" || ld: ");
  Serial.print(ld);
  Serial.print(" || rd: ");
  Serial.println(rd);

  int tol = 50; // Tolerance level
  int avt = (lt + rt) / 2; // Average value top
  int avd = (ld + rd) / 2; // Average value down
  int avl = (lt + ld) / 2; // Average value left
  int avr = (rt + rd) / 2; // Average value right

  int dvert = avt - avd; // Difference of up and down
  int dhoriz = avl - avr; // Difference of left and right

  // Proportional control for smoother servo movement
  servov = constrain(servov + kp * dvert, servovLimitLow, servovLimitHigh);
  servoh = constrain(servoh + kp * dhoriz, servohLimitLow, servohLimitHigh);

  // Move servos
  vertical.write(servov);
  horizontal.write(servoh);

  delay(100); // Delay to read data again and smooth servo movement
}
