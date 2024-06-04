
DOCUMENTACIÓN COMPLETA APLICACIÓN WEB - RESERVAS DE HOTEL

[Documentació_ReservasHotel.pdf](https://github.com/Ruxyen/project_m07/files/11302518/Documentacio_ReservasHotel.pdf)

---------------------------------------------------------------------------------------------------------------------------

DIAGRAMA ENTIDAD RELACIÓN

![reservas_hotel](https://user-images.githubusercontent.com/68253766/233811655-334ef60c-c3cf-4bbf-bf2d-861bd12886d2.png)

---------------------------------------------------------------------------------------------------------------------------

DIAGRAMA MODELO RELACIONAL

![modelo_relacional](https://user-images.githubusercontent.com/68253766/234491590-188e6c1a-6644-47b8-b574-779618091966.png)

---------------------------------------------------------------------------------------------------------------------------

1. Descripción del proyecto

Este proyecto consiste en el desarrollo de una aplicación web para la gestión de reservas de un hotel llamado BLUESEA. 
La aplicación ha sido desarrollada en PHP y utiliza el sistema gestor de bases de datos MySQL.

2. Funcionalidad

La aplicación permite a los usuarios realizar reservas de habitaciones del hotel. 
Los usuarios pueden buscar tipos de habitaciones disponibles en el rango de fechas que haya disponibles y realizar reservas de dichas habitaciones. 
Los usuarios también pueden ver su historial de reservas.
También hay un modo administrador al iniciar sesión (user:admin, pass:1234) para el gestor de las reservas del hotel en recepción.

3. Diseño

Contiene uso de Bootstrap, CSS, HTML, Javascript, PHP…

4. Acceso y Validación de Usuarios

Para acceder a la aplicación, los usuarios deben autenticarse con sus credenciales para iniciar sesión o para registrarse. 
Las credenciales de los usuarios se almacenan en una tabla de la base de datos llamada Cliente. 
Se utiliza una sesión para mantener la autenticación del usuario mientras navega por la aplicación.

5. Requisitos

Para ejecutar la aplicación, es necesario tener instalado un servidor web compatible con PHP y una base de datos MySQL.

6. Instalación

1. Descargue el código fuente de este proyecto y colóquelo en el directorio raíz de su servidor web.
2. Cree una base de datos MySQL y importe el archivo `bd_reservas_hotel.sql` para crear la estructura de la base de datos con las tablas correspondientes.
3. Abra el archivo `conectar_bd.php` y actualice los valores de las constantes `$servername`, `$username`, `$password` y `$dbname` con los valores correspondientes a su entorno de base de datos.
4. Acceda a la aplicación a través de su navegador web y regístrese para crear una cuenta de usuario. 

---------------------------------------------------------------------------------------------------------------------------


