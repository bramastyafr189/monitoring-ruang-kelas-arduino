#include <Wire.h>

byte relay = 2;     
byte hijau = 3;     
byte merah = 4;     
byte buzzerasli = 5;
byte lampu = 6;     

void setup() {
 pinMode(relay, OUTPUT);
 pinMode(hijau, OUTPUT);
 pinMode(merah, OUTPUT);
 pinMode(buzzerasli, OUTPUT);
 pinMode(lampu, OUTPUT);
 
 Wire.begin(8);               
 Wire.onReceive(receiveEvent);
 Serial.begin(9600);          
}

void loop() {
 digitalWrite(relay, HIGH);
 digitalWrite(lampu, HIGH);
 delay(100);
}

void receiveEvent(int howMany) {
 while (0 <Wire.available()) {
    char c = Wire.read();      
    Serial.print(c);         
    if (c == '1'){             
      digitalWrite(buzzerasli, HIGH);
      delay(15000);
      digitalWrite(buzzerasli, LOW);
      delay(15000);
      digitalWrite(buzzerasli, HIGH);
      delay(15000);
      digitalWrite(buzzerasli, LOW);
      digitalWrite(relay, LOW);
      digitalWrite(hijau, HIGH);
      delay(900000);
      digitalWrite(relay, HIGH);
      digitalWrite(hijau, LOW);
    }
    if (c == '2'){             
      digitalWrite(merah, HIGH);
      delay(100000);
      digitalWrite(merah, LOW);
      delay(100000);
      digitalWrite(merah, HIGH);
      delay(100000);
      digitalWrite(merah, LOW);
      delay(100000);
      digitalWrite(merah, HIGH);
      delay(100000);
      digitalWrite(merah, LOW);
    }
    if (c == '3'){            
      digitalWrite(merah, HIGH);
      digitalWrite(buzzerasli, HIGH);
      delay(300000);
      digitalWrite(merah, LOW);
      digitalWrite(buzzerasli, LOW);
    }
  }
 Serial.println();
}
