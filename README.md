
### 1. Productos
La tabla `products` contiene:

- id  
- name  
- description  
- price  
- stock_quantity  
- image  

Incluye un CRUD completo para gestionar artículos en inventario.

### 2. Movimientos de inventario
La tabla `inventory_movements` registra:

- Entradas  
- Salidas  
- Cantidades  
- Referencia al producto  
- Notas  
- Fecha y hora  

Cada movimiento actualiza automáticamente el stock del producto relacionado.

---

## Instalación

Sigue estos pasos para instalar el proyecto localmente:

### 1. Clonar el repositorio

git clone https://github.com/ReneFuentes21/inventario.git
cd inventario
composer install
npm install
npm run build

### 2. Configurar la base de datos
DB_DATABASE=inventario
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

### 3. Generar clave del proyecto
php artisan key:generate

### 4. Ejecutar migraciones
php artisan migrate

### 5. Iniciar el servidor
php artisan serve

### Desde el módulo de productos puedes agregar:
- Nombre
- Descripción
- Precio
- Cantidad inicial
- Imagen

### Registrar entradas y salidas
- Desde el módulo de movimientos puedes:
- Seleccionar un producto
- Elegir el tipo (entrada/salida)
- Indicar la cantidad
- (Opcional) Agregar una nota

### Cada registro genera un movimiento y actualiza el stock del producto.

### Comandos útiles
Compilar assets
npm run dev
npm run build

### Limpiar caché
php artisan optimize:clear