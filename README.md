
# Sistema de Gestión Comercial – Base de Datos I

Proyecto desarrollado como trabajo final del curso **Base de Datos I** (UNSA).
El sistema implementa una arquitectura **MVC en PHP**, integrando una base de datos MySQL con **procedimientos almacenados**, **triggers** y control de roles.

## 📌 Descripción

Este sistema permite la gestión integral de un negocio comercial, cubriendo:

* Ventas
* Compras
* Inventario
* Clientes y proveedores
* Usuarios y roles
* Auditoría del sistema
* Reportes

Está orientado a reforzar buenas prácticas de diseño de bases de datos y desarrollo web.

## 🛠️ Tecnologías utilizadas

* **PHP** (arquitectura MVC)
* **MySQL**
* **HTML5 / CSS3 / JavaScript**
* **Stored Procedures y Triggers**
* **Git y GitHub**

## 📂 Estructura del proyecto

* `controllers/` Controladores del sistema
* `models/` Modelos de acceso a datos
* `views/` Vistas organizadas por módulo
* `database/` Scripts SQL (schema, datos, SP)
* `assets/` Recursos CSS, JS e imágenes
* `middleware/` Control de autenticación y roles

## ⚙️ Instalación y configuración

1. Clonar el repositorio:

```bash
git clone https://github.com/david-s-l/proyecto_BD_I.git
```

2. Crear la base de datos en MySQL

3. Importar los archivos:

   * `database/schema.sql`
   * `database/sp.sql`
   * `database/data.sql` (opcional)

4. Configurar la conexión en:

```
config/db.php
```

5. Ejecutar el proyecto desde un servidor local (Apache / XAMPP / LAMP)

## 🔐 Roles del sistema

* Administrador
* Usuario

Cada rol tiene permisos específicos controlados mediante middleware.

## 📊 Funcionalidades principales

* Registro y control de ventas con stock
* Registro de compras y entradas a inventario
* Gestión de productos y categorías
* Auditoría de acciones
* Reportes por fechas y proveedores

## ✍️ Autores


---

Proyecto académico – UNSA 2025
