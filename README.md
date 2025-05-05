# Pokedex-PHP

Este proyecto es una Pokedex desarrollada en PHP.

## Requisitos

Para ejecutar este proyecto correctamente, asegúrate de tener instalado lo siguiente:

* **Servidor Web:** Se recomienda utilizar Apache.
* **PHP:** Versión 7.0 o superior.
* **MySQL:** Servidor de base de datos MySQL.

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1.  **Clonar el repositorio (opcional):** Si obtuviste el código desde un repositorio Git, puedes clonarlo a tu máquina local.

    ```bash
    git clone [https://del-source.com/](https://del-source.com/)
    ```

2.  **Guardar en htdocs:** Copia o mueve la carpeta completa del proyecto (`Pokedex-PHP`) al directorio `htdocs` de tu instalación de Apache. La ubicación típica de este directorio es:
    * **Windows (XAMPP):** `C:\xampp\htdocs\`
    * **macOS (MAMP):** `/Applications/MAMP/htdocs/`
    * **Linux (LAMP):** `/var/www/html/`

    Asegúrate de que la estructura de carpetas del proyecto (`Pokedex-PHP`) se mantenga intacta dentro del directorio `htdocs`.

3.  **Importar la base de datos:**
    * Localiza el archivo `ini.sql` dentro de Pokadex-PHP/repo.
    * Abre tu cliente de MySQL (por ejemplo, phpMyAdmin, MySQL Workbench, la línea de comandos de MySQL).
    * Importa el archivo `ini.sql`. Este archivo crear la base de datos y contiene la estructura de las tablas y los datos iniciales necesarios para el funcionamiento del proyecto.

## Ejecución

Una vez que hayas completado los pasos de instalación, puedes probar el proyecto abriendo tu navegador web y navegando a la siguiente URL:
**localhost/Pokedex-PHP**