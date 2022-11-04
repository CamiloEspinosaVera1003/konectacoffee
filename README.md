# Konecta Coffe

instalacion: 
el proyecto se conecta directamente al localhost, por lo que debe alojarse en la carpeta donde se tenga el servidor (htdocs o /var/www) dependiendo el caso.

se utiliza la siguiente configuracion de bd

nombre bd: konectacoffee
motor: Mysql
usuario: konecta
password:1234

en el archivo query.sql se encuentra el schema de las tablas utilizadas


ruta caja facuracion:
http://localhost/konectacoffee/caja.php


ruta productos:
http://localhost/konectacoffee/caja.php

NOTA: en cada uno de los links se encuentra un boton que lleva al otro modulo.



Fucnionamiento: en la caja se pueden ver los productos con sus existencias, si hay un producto que no tiene cantidades disponibles
 no aparecera en la caja.

 dando click sobre cada item se van agregando a la compra, luego de agragr los productos deseados se selecciona el metodo de pago, 
 se ingresa el valor y se da click en pagar
 nota: el campo de valor recibe decimales como en un cajero por lo que hay que digitar dos ceros de mas

 Modulo productos: 
 En este modulo podremos crear productos y en la pestaña de inventario podremos validar las disponibilidades
 nota: cuando un producto ya se le creo disponibilidad no le va a dejar crear la disponibilidad nuevamente, solo editarla, con el fin de que no se dupliquen las disponibilidades.


