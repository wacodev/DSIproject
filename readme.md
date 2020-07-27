<p align="center">
  <img src="https://raw.githubusercontent.com/wacodev/DSIproject/master/public/img/sistema/logo_ceaa.png" style="max-width: 12%;">
</p>

# DSIproject

Sistema informático para la gestión de procesos académicos y administrativos del Centro Escolar Anastasio Aquino.

## Instalación

1. Clonar el respositorio.

```
git clone https://github.com/wacodev/DSIproject.git
```

2. Abrir una terminal y ubicarse en la carpeta raíz del proyecto.

3. Instalar las dependencias del proyecto.

```
composer install
```

4. Copiar el archivo `.env.example` y nombrarlo como `.env`.

```
cp .env.example .env
```

5. Crear una nueva API key.

```
php artisan key:generate
```

6. Editar el archivo `.env` con las credenciales de su base de datos. A continuación se presenta un ejemplo.

```
DB_DATABASE=dsiproject
DB_USERNAME=root
DB_PASSWORD=
```

> En el ejemplo anterior se usaron las credenciales de usuario por defecto de XAMPP y el nombre de la base de datos es `dsiproject`.

7. Realizar las migraciones de la base de datos.

```
php artisan migrate
```

8. En el gestor de la base de datos correr el siguiente script para crear los roles de usuario.

```sql
INSERT INTO `roles` (`id`, `codigo`, `nombre`, `estado`) VALUES
(1, 'direc', 'Director', 1),
(2, 'secre', 'Secretaria', 1),
(3, 'docen', 'Docente', 1);
```

9. Activar Tinker.

```
php artisan tinker
```

10. Crear un usuario de tipo `Director` para ingresar al sistema. A continuación se presenta un ejemplo.

```php
$user = new DSIproject\User;
$user->rol_id = 1;
$user->nombre = "William";
$user->apellido = "Coto";
$user->email = "wacodev@outlook.com";
$user->password = bcrypt("123456");
$user->dui = "11111111-1";
$user->estado = 1;
$user->save();
```

> El `rol_id` debe ser 1 porque según el paso 8 éste es el id del rol de tipo `Director` y es quien tiene los privilegios de un administrador del sistema.

10. Correr el proyecto.

```
php artisan serve
```

11. Ingresar desde un navegador web a `http://localhost:8000` o url que indique la instrucción anterior.

## Vista preliminar

<p align="center">
  <img src="https://raw.githubusercontent.com/wacodev/DSIproject/master/preview.png">
</p>

## Demo

Ingresar a https://demodsiproject.000webhostapp.com/ para usar la demo del sistema.

Las credenciales para ingresar son:

* Correo electrónico: director@mail.com
* Contraseña: 123456

> En caso que la demo no esté en funcionamiento o no se permita el acceso con las credenciales provistas, escribir al correo wacodev@outlook.com e informar del problema que se presenta.
