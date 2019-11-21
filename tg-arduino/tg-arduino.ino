#include <EEPROM.h> // biblioteca para uso da memória EEPROM

//portas de saída para relé
int atuador1 = 13;int atuador2 = 12;int atuador3 = 11;

//variáveis auxiliares das saídas
boolean estado1 = true;boolean estado2 = true;boolean estado3 = true;

//endereços EEPROM
int ad00 = 0;int ad01 = 1;int ad02 = 2;int ad03 = 3;
int ad04 = 4;int ad05 = 5;

// variáveis simulando sensores
long sensor1;long sensor2;long sensor3;

void setup() {
  //define as portas dos atuadores como saída
  pinMode(atuador1, OUTPUT);  pinMode(atuador2, OUTPUT);
  pinMode(atuador3, OUTPUT);
  //define a velocidade de comunicação serial
  Serial.begin(9600); 
  //envia para as saídas o último valor gravado na memória
  digitalWrite(atuador1, EEPROM.read(ad00));
  digitalWrite(atuador2, EEPROM.read(ad01));
  digitalWrite(atuador3, EEPROM.read(ad02));
  //gera rúido para a simulação dos sensores
  randomSeed(analogRead(0));
}

//função que informa os estados dos atuadores
void atuadores(){
      if(EEPROM.read(ad00)){
        Serial.println("OFF");
        }
      else if(!(EEPROM.read(ad00))){
        Serial.println("ON");
        }
      if((EEPROM.read(ad01))){
        Serial.println("OFF");
        }
      else if(!(EEPROM.read(ad01))){
        Serial.println("ON");
        }
        if((EEPROM.read(ad02))){
        Serial.println("OFF");
        }
      else if(!(EEPROM.read(ad02))){
        Serial.println("ON");
        }
  }

//função que atribui número randômico aos sensores  
void sensores(){
    sensor1 = random(100);// sensor 1 é randômico de 0 a 100
    Serial.println(sensor1);// escreve valor do sensor 1 na serial
    sensor2 = random(100);// sensor 2 é randômico de 0 a 100
    Serial.println(sensor2);// escreve valor do sensor 2 na serial
    sensor3 = random(100);// sensor 3 é randômico de 0 a 100
    Serial.println(sensor3);// escreve valor do sensor 3 na serial
  }

void loop() {

  //variável para armazenar valores da serial
  char recebido;
  //se houver dados na serial, armazena na variável
  if(Serial.available()){
    recebido = Serial.read();
    


  switch (recebido){

    //mede sensores ao receber 0
    case ('0'): // caso receba 0
    sensores();
    break;    

    //liga ou desliga atuador 1 ao receber 1
    case ('1'):  
    estado1 = !(EEPROM.read(ad00));
    EEPROM.write(ad00, estado1);    
    digitalWrite(atuador1, EEPROM.read(ad00));
    atuadores();
    break;    

    //liga ou desliga atuador 2 ao receber 2
    case ('2'):  
    estado2 = !(EEPROM.read(ad01));
    EEPROM.write(ad01, estado2);    
    digitalWrite(atuador2, EEPROM.read(ad01));    
    atuadores();      
    break;

    //liga ou desliga atuador 3 ao receber 3
    case ('3'):   
    estado3 = !(EEPROM.read(ad02));
    EEPROM.write(ad02, estado3);
    digitalWrite(atuador3, EEPROM.read(ad02));  
    atuadores();
    break;

    //verifica últimos valores de sensores e atuadores
    case ('4'):
    Serial.println(sensor1);
    Serial.println(sensor2);
    Serial.println(sensor3);
    atuadores();
          
    }  
  }
                     
}
