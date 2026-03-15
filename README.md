# InfoLm - Sistema de Gestión Empresarial

## Descripción

InfoLm es un sistema de gestión empresarial desarrollado en PHP y MySQL, diseñado para facilitar la administración de inventarios, facturación, gastos y usuarios. Incluye funcionalidades como control de productos, categorías, facturas por pagar, notificaciones de vencimientos y un sistema de login seguro.

Este proyecto está desarrollado por ING. LEONARDO MORALES (LEINFORMAT@GMAIL.COM, +57 311 809 3398).

## Características Principales

- **Gestión de Usuarios**: Sistema de login y sesiones seguras.
- **Inventario**: Control de productos, categorías y cantidades.
- **Facturación**: Manejo de facturas, pagos y vencimientos.
- **Gastos**: Categorización y registro de gastos.
- **Interfaz Web**: Utiliza Bootstrap para una interfaz responsiva y moderna.
- **Mantenimiento**: Modo de mantenimiento integrado.
- **Notificaciones**: Alertas para facturas vencidas.

## Tecnologías Utilizadas

- **Backend**: PHP 7.2+
- **Base de Datos**: MySQL/MariaDB
- **Frontend**: HTML5, CSS3, JavaScript
- **Frameworks/Librerías**:
  - Bootstrap 3/4
  - jQuery
  - Chart.js
  - DataTables
  - Font Awesome
  - IonIcons
  - y otras (ver carpeta bower_components)

## Requisitos del Sistema

- Servidor web: Apache (recomendado con XAMPP)
- PHP 7.2 o superior
- MySQL/MariaDB
- Navegador web moderno

## Instalación

1. **Clona o descarga el proyecto** en el directorio `htdocs` de XAMPP (o equivalente en tu servidor web).

2. **Configura la base de datos**:
   - Crea una base de datos en MySQL (por ejemplo, `leinformat`).
   - Importa el archivo `leinformat.sql` en tu base de datos.

3. **Configura la conexión**:
   - Edita el archivo `sistem/php/conexion.php` para configurar los detalles de conexión a la base de datos (host, usuario, contraseña, nombre de BD).

4. **Inicia el servidor**:
   - Asegúrate de que Apache y MySQL estén ejecutándose en XAMPP.
   - Accede al proyecto en tu navegador: `http://localhost/software/`

5. **Modo de Mantenimiento**:
   - En `index.php`, cambia `$mantenimiento = 0;` a `1` para activar el modo de mantenimiento.

## Uso

1. **Login**: Accede con tus credenciales de usuario.
2. **Navegación**: Usa el menú lateral para acceder a diferentes secciones (productos, facturas, gastos, etc.).
3. **Gestión**: Agrega, edita o elimina registros según los permisos.
4. **Reportes**: Utiliza las herramientas integradas para visualizar datos y gráficos.

## Estructura del Proyecto

- `index.php`: Punto de entrada, redirige a login o mantenimiento.
- `login/`: Archivos para el sistema de autenticación.
- `sistem/`: Núcleo de la aplicación.
  - `inc/`: Componentes de la interfaz (header, menu, etc.).
  - `paginas/`: Páginas específicas.
  - `php/`: Scripts PHP backend.
- `bower_components/`: Librerías de terceros.
- `css/`, `js/`: Estilos y scripts personalizados.
- `imagenes/`: Recursos gráficos.
- `leinformat.sql`: Dump de la base de datos.

## Contribución

Para contribuir al proyecto:
1. Realiza un fork del repositorio.
2. Crea una rama para tu feature (`git checkout -b feature/nueva-funcionalidad`).
3. Realiza tus cambios y commits.
4. Envía un pull request.

## Licencia

Este proyecto está bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

## Contacto

- Desarrollador: ING. LEONARDO MORALES
- Email: LEINFORMAT@GMAIL.COM
- Teléfono: +57 311 809 3398

---