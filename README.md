# Gestor ADSO

## 1. Descripción del proyecto

Gestor ADSO es un proyecto integrador del programa ADSO del SENA. Su objetivo es construir progresivamente una aplicación utilizando PHP, Laravel y una base de datos MariaDB/MySQL.

## 2. Herramientas utilizadas y versiones

Las versiones deben corresponder a las instaladas y verificadas en el equipo.

- **PHP:** [Pegar resultado de `php -v`]
- **Composer:** [Pegar resultado de `composer -V`]
- **Laravel:** [Pegar resultado de `php artisan --version`]
- **Git:** [Pegar resultado de `git --version`]
- **Base de datos:** MariaDB/MySQL mediante XAMPP.
- **Editor de código:** Visual Studio Code.
- **Sistema operativo:** Windows.

## 3. Requisitos previos

Para ejecutar el proyecto se necesitan las siguientes herramientas:

- XAMPP con PHP y MariaDB/MySQL.
- Composer.
- Git.
- Visual Studio Code.
- Laravel instalado mediante Composer.

## 4. Instalación y configuración

### Paso 1. Ubicar el proyecto

Abrir una terminal en la carpeta `gestor-adso`.

### Paso 2. Configurar el archivo de entorno

Si el archivo `.env` no existe, crearlo a partir de `.env.example`.

En CMD:

```bash
copy .env.example .env
```

Generar la clave de la aplicación:

```bash
php artisan key:generate
```

### Paso 3. Configurar la base de datos

Iniciar MySQL desde el panel de control de XAMPP y crear la base de datos `gestor_adso`.

Configurar los siguientes valores en el archivo `.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestor_adso
DB_USERNAME=root
DB_PASSWORD=
```

Estas credenciales corresponden al entorno local de desarrollo utilizado en la guía.

### Paso 4. Ejecutar las migraciones

Limpiar la caché de configuración:

```bash
php artisan config:clear
```

Crear las tablas de la base de datos:

```bash
php artisan migrate
```

### Paso 5. Iniciar el servidor

Ejecutar el siguiente comando desde la carpeta del proyecto:

```bash
php artisan serve
```

Abrir en el navegador la dirección:

http://127.0.0.1:8000

## 5. Estructura del proyecto

- `app/`: lógica principal de la aplicación.
- `routes/`: definición de las rutas.
- `resources/`: vistas y recursos de la aplicación.
- `database/`: migraciones, seeders y factories.
- `public/`: punto de entrada público de la aplicación.
- `config/`: archivos de configuración.
- `storage/`: archivos generados y registros.
- `.env`: configuración del entorno.
- `artisan`: interfaz de comandos de Laravel.
- `composer.json`: dependencias del proyecto.

## 6. Control de versiones

El proyecto utiliza Git para registrar los cambios realizados.

Comandos utilizados:

```bash
git status
git add .
git commit -m "Semana 1: Entorno listo + Laravel base"
```

## 7. Evidencias del proceso

Se deben registrar capturas de pantalla que demuestren:

1. PHP instalado y apuntando a la ruta de XAMPP.
2. Extensiones PHP requeridas habilitadas.
3. Composer y Git funcionando correctamente.
4. Laravel instalado y funcionando en el navegador.
5. Base de datos `gestor_adso` creada y migraciones ejecutadas exitosamente.
6. Proyecto abierto en Visual Studio Code y primer commit registrado.

Cada captura debe incluir una breve explicación del comando ejecutado, su función y el resultado obtenido.

## 8. Estado del proyecto

El entorno de desarrollo inicial de Gestor ADSO se configura con PHP, Laravel, Composer, XAMPP y Git. Esta base permitirá continuar el desarrollo del proyecto integrador durante las siguientes semanas del programa ADSO.