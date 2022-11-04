estados

CREATE TABLE estados(
id int AUTO_INCREMENT,
nombre varchar(255),
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (ID)
)

productos

CREATE TABLE productos
(id int AUTO_INCREMENT,
 nombre varchar(255),
 referencia varchar(255),
 precio bigint,
 peso bigint,
 categoria varchar(255),
 imagen text,
 idestado int REFERENCES estados(id),
 fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (ID))

inventario

CREATE TABLE inventario
(id int AUTO_INCREMENT,
 idproducto int REFERENCES productos(id),
 cant_disponible bigint,
 idestado int REFERENCES estados(id),
 fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
 ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (ID))


facturas

CREATE TABLE facturas(
 id int AUTO_INCREMENT,
 fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 valor bigint,
 idestado int REFERENCES estados(id),
 PRIMARY KEY (ID)
)

CREATE TABLE facturas_detalle(
id int AUTO_INCREMENT,
idfactura int REFERENCES facturas(id),
idproducto int REFERENCES productos(id),
cantidad int,
fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
idestado int REFERENCES estados(id),
PRIMARY KEY (ID)
)


Producto con mayor cantidad
SELECT p.nombre, cant_disponible  from inventario i join productos p on (p.id=i.idproducto) order by cant_disponible DESC limit 1;


Producto mas vendido
select p.nombre as producto_mas_vendido,sum(fd.cantidad) as cantidad_vendida from facturas_detalle fd join productos p on(p.id=fd.idproducto) GROUP BY p.nombre order by cantidad_vendida DESC limit 1