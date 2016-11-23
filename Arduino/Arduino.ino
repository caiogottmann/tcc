#include <SPI.h>
#include <Ethernet.h>
#include <MFRC522.h> //RFID
#include <LiquidCrystal.h>

#define SS_PIN 53
#define RST_PIN 9

MFRC522 mfrc522(SS_PIN, RST_PIN);

byte mac[] = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED };
char server[] = "192.168.0.14"; //URL do site
//IPAddress server(192,168,1,37);
IPAddress ip(192, 168, 0, 177); //ip UNICO que sera do arduino dentro da rede

EthernetClient client;

LiquidCrystal lcd(22, 23, 24, 25, 26, 27);

int porta_rele1 = 28;
int porta_rele2 = 29;

char keys[4][4] = {{'1','2','3','A'},
                   {'4','5','6','B'},
                   {'7','8','9','C'},
                   {'*','0','#','D'}
                  };
                

int BUZZER = 7;
int x = 0;

String tag, senha, rfid, nome;
String key = "b0399d2029f64d445bd131ffaa399a42d2f8e7dc";
  
void setup(){   
  Serial.begin(9600);
  lcd.begin(20, 4);
  
  lcd.print("Iniciando...");
  Serial.println("Iniciando...");
  
  SPI.begin();
  mfrc522.PCD_Init();
 
  pinMode(BUZZER,OUTPUT);
  pinMode(porta_rele1, OUTPUT); 
  pinMode(porta_rele2, OUTPUT);

  //Pinos ligados aos pinos 1, 2, 3 e 4 do teclado - Linhas
  pinMode(30, OUTPUT);
  pinMode(31, OUTPUT);
  pinMode(32, OUTPUT);
  pinMode(33, OUTPUT);
   
  //Pinos ligados aos pinos 5, 6, 7 e 8 do teclado - Colunas
  pinMode(34, INPUT);
  pinMode(35, INPUT);
  pinMode(36, INPUT);
  pinMode(37, INPUT); 
  
  if (Ethernet.begin(mac) == 0) {
    Serial.println("Failed to configure Ethernet using DHCP");
    Ethernet.begin(mac, ip);
  }
  delay(1000);
  inicio();
}

void loop(){ 
  rfid = retornaRfid();
  if (rfid != ""){  
    Serial.println(rfid);
    conexaoRfid();
  }
  teclado();
}

void inicio(){
  lcd.clear();
  lcd.print("Controle de Acesso");
  Serial.println("Controle de Acesso");
  lcd.setCursor(0,1);
  lcd.print("V1.0");
  Serial.println("V1.0");
  lcd.setCursor(0,3);
}

void erro(){
  tone(BUZZER,200,500);
  delay(500);
}

void aceito() {
  tone(BUZZER,500,150);
  delay(200);
  tone(BUZZER,1000,100);   
}

String retornaRfid() {
  if ( (mfrc522.PICC_IsNewCardPresent()) and (mfrc522.PICC_ReadCardSerial()) ) {
    tag = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      tag.concat(String(mfrc522.uid.uidByte[i] < 0x10 ? "0" : ""));
      tag.concat(String(mfrc522.uid.uidByte[i], HEX));
    }
    
    tag.toUpperCase();
    return tag;
  }
  else {
    return "";
  }
}

void rele(int tempo){
  digitalWrite(porta_rele1, HIGH);
  delay(tempo);
  digitalWrite(porta_rele1, LOW);
}

char teclado() {
  for (int ti = 30; ti<34; ti++)
    {
    //Alterna o estado dos pinos das linhas
    digitalWrite(30, LOW);
    digitalWrite(31, LOW);
    digitalWrite(32, LOW);
    digitalWrite(33, LOW);
    digitalWrite(ti, HIGH);
    //Verifica se alguma tecla da coluna 1 foi pressionada
    if (digitalRead(34) == HIGH)
    {
      imprime_linha_coluna(ti-29, 1);
      while(digitalRead(34) == HIGH){}
    }
 
    //Verifica se alguma tecla da coluna 2 foi pressionada    
    if (digitalRead(35) == HIGH)
    {
      imprime_linha_coluna(ti-29, 2);
      while(digitalRead(35) == HIGH){};
    }
     
    //Verifica se alguma tecla da coluna 3 foi pressionada
    if (digitalRead(36) == HIGH)
    {
      imprime_linha_coluna(ti-29, 3);
      while(digitalRead(36) == HIGH){}
    }
     
    //Verifica se alguma tecla da coluna 4 foi pressionada
    if (digitalRead(37) == HIGH)
    {
      imprime_linha_coluna(ti-29, 4);
      while(digitalRead(37) == HIGH){} 
    }
   }
   delay(10);
}

void imprime_linha_coluna(int x, int y)
{
 Serial.println(keys[(x-1)][(y-1)]);
    if((keys[(x-1)][(y-1)]) == (keys[(3)][0])) {
      Serial.println(senha);
      conexaoSenha();
    }
    else {
        lcd.print("*");
        senha += keys[(x-1)][(y-1)];
    }
  
}

void conexaoSenha() {
    if (client.connect(server, 80)) {
      Serial.println("Conectando...");
      client.println("GET /tcc/EntradaSaida/arduinoSenha/"+senha+"/"+key+" HTTP/1.1");
      client.println("Host: 192.168.0.14");
      client.println("Connection: close");
      client.println();
    } else {
      Serial.println("connection failed");
    }

    while(true) {
      if (client.available()) {
        char res = client.read();
        if( res == 60 ){
          x = 1;          
        }
  
        if( (x == 1) and (res != 60) and (res != 62) ) {
          nome += res;
        }
        
      if( res == 62) {
        lcd.clear();
        lcd.print(nome);
        Serial.println(nome);
        client.stop();
        
        if (nome != "Senha Invalida") {
          aceito();
          delay(100);
          rele(1000);
          delay(500);
        } else {
          erro();
        }

        nome = "";
        senha = "";
        rfid = "";
        x = 0;

        delay(2000);
        inicio();

        return;
      }
      }
    }  
}

void conexaoRfid() {

    if (client.connect(server, 80)) {
      Serial.println("Conectando...");
      client.println("GET /tcc/EntradaSaida/arduinoRfid/"+rfid+"/"+key+" HTTP/1.1");
      client.println("Host: 192.168.0.14");
      client.println("Connection: close");
      client.println();
    } else {
      Serial.println("connection failed");
    }

    while(true) {
      if (client.available()) {
        char res = client.read();
        if( res == 60 ){
          x = 1;          
        }
  
        if( (x == 1) and (res != 60) and (res != 62) ) {
          nome += res;
        }
        
      if( res == 62) {
        lcd.clear();
        lcd.print(nome);
        Serial.println(nome);
        client.stop();

        if (nome != "Tag Invalida") {
          aceito();
          delay(100);
          rele(1000);
          delay(500);
        } else {
          erro();
        }

        nome = "";
        senha = "";
        rfid = "";
        x = 0;

        delay(2000);
        inicio();

        return;
      }
      }
  }
}

