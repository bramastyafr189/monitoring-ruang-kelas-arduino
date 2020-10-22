#include<ESP8266WiFi.h>
#include<ESP8266HTTPClient.h>

const char* ssid = "Sertifikasi D3TI";                 
const char* password = "d3gayeng";          
const char* server = "http://m3116085.d3tiuns.com";

#include <SPI.h>
#include <RFID.h>
#include <Wire.h>

#define SS_PIN 0
#define RST_PIN 2

RFID rfid(SS_PIN, RST_PIN);
char TAG[20];
byte ldr = 16;  
int nilai;      
int ruang = 101;

void setup() {
  Serial.begin(9600);
  Wire.begin(D1, D2);
  SPI.begin();
  rfid.init();

  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print
    (".");
  }
  Serial.println("Terhubung");
}

void loop() {
  if (rfid.isCard()) {
    if (rfid.readCardSerial()) {
      sprintf(TAG, "%d%d%d%d", rfid.serNum[0], 
      rfid.serNum[1], rfid.serNum[2], rfid.serNum[3] );
      Serial.println(TAG);
      nilai= digitalRead(ldr);
      Serial.println(nilai);
      input();
      delay(500);
    }
    rfid.halt();
  }
}

void input() {
  String URL = String("") + server + 
  "/absen_ruang/input.php?tag=" + TAG + 
  "&nilai=" + nilai + "&ruang=" + ruang;
  Serial.println(URL);
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(URL);
    int httpCode = http.GET();
    if (httpCode > 0) {
      String payload = http.getString();
      Serial.println(payload);
      if (payload == "Ini kunci Admin" || 
      payload == "Ada Jadwal Kelas Cocok" || 
      payload == "Kamu bisa masuk" || 
      payload == "Kamu bisa keluar") {
        Serial.println("1");
        Wire.beginTransmission(8);  
        Wire.write("1");            
        Wire.endTransmission();     
      }
      if (payload == "Kartu Tidak Terdaftar") {
        Serial.println("2");
        Wire.beginTransmission(8);  
        Wire.write("2");            
        Wire.endTransmission();     
      }
      if (payload == "Ada Jadwal Kelas Tidak Cocok" || 
      payload == "Tidak Ada Jadwal" || 
      payload == "Kamu tidak bisa masuk" || 
      payload == "Kamu tidak bisa keluar") {
        Serial.println("3");
        Wire.beginTransmission(8);  
        Wire.write("3");            
        Wire.endTransmission();     
      }
    }
    http.end();
  }
}
