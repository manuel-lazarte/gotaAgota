<div align="center">

# 💧 GotaAGota

**Sistema de Gestión Comunitaria de Agua**

[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white)](https://php.net)
[![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?logo=laravel&logoColor=white)](https://laravel.com)
[![React](https://img.shields.io/badge/React-19-61DAFB?logo=react&logoColor=black)](https://react.dev)
[![Vite](https://img.shields.io/badge/Vite-8-646CFF?logo=vite&logoColor=white)](https://vite.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?logo=mysql&logoColor=white)](https://mysql.com)

</div>

---

## Descripción

GotaAGota es un sistema de gestión comunitaria de agua que permite administrar **socios, propiedades, familias, medidores, consumos, pagos y alertas** relacionadas con la distribución del recurso hídrico.

Desarrollado para comunidades rurales y periurbanas que gestionan su propio sistema de agua potable.

---

## Stack Tecnológico

| Capa | Tecnología |
|------|-----------|
| Backend | PHP 8.4 + Laravel 13 |
| Frontend | React 19 + Vite 8 + Tailwind CSS 4 |
| Base de Datos | MySQL (producción) / SQLite (desarrollo) |
| ORM | Eloquent |
| Routing Frontend | React Router DOM 7 |

---

## Arquitectura

```
Cliente (React + Vite)
        │
        ▼ HTTP /api/v1
   Controllers
  (app/Http/Controllers/Api)
        │
        ▼
     Services
  (app/Services)
        │
        ▼
  Repositories
  (app/Repositories)
        │
        ▼
     Models
  (app/Models - Eloquent)
        │
        ▼
      MySQL
```

---

## Estructura del Proyecto

```
gotaAgota/
├── app/
│   ├── Http/
│   │   ├── Controllers/Api/     # 10 controladores REST
│   │   ├── Requests/            # 19 Form Requests (validación)
│   │   └── Resources/           # 10 API Resources (DTOs)
│   ├── Services/                # 13 servicios (CRUD + Motores)
│   ├── Repositories/
│   │   ├── Contracts/           # 11 interfaces
│   │   └── *.php                # 10 implementaciones Eloquent
│   ├── Models/                  # 10 modelos
│   └── Providers/
│       └── RepositoryServiceProvider.php
│
├── database/
│   ├── migrations/              # 10 migraciones ordenadas
│   ├── factories/               # 6 factories con datos faker
│   └── seeders/                 # SocioSeeder + PropiedadSeeder
│
├── routes/
│   └── api.php                  # 53 rutas bajo /api/v1
│
└── frontend/                    # App React
    ├── src/
    │   ├── services/api.js      # Cliente fetch centralizado
    │   ├── pages/
    │   │   ├── FamilyManagement/
    │   │   └── FamilyDetail/
    │   ├── components/
    │   │   └── Sidebar.jsx
    │   └── layouts/
    │       └── RootLayout.jsx
    └── vite.config.js
```

---

## Módulos del Sistema

| Módulo | Descripción |
|--------|-------------|
| **Socios** | Propietarios / responsables principales |
| **Teléfonos** | Múltiples teléfonos por socio |
| **Propiedades** | Lotes, viviendas e inmuebles |
| **Familias** | Grupos familiares por propiedad |
| **Medidores** | Control de consumo por propiedad |
| **Consumos** | Lecturas periódicas de medidores |
| **Pagos** | Cobros y estados de pago |
| **Cuotas de Agua** | Litros asignados por familia/mes |
| **Alertas** | PRECAUCIÓN / RESTRICCIÓN / RACIONAMIENTO |
| **Tanque Comunitario** | Disponibilidad global del recurso |

### Servicios de Negocio

- **MotorConsumoService** — calcula consumo real (`Lectura Actual - Lectura Anterior`)
- **MotorRacionamientoService** — evalúa estado del sistema según nivel del tanque
- **MotorNotificacionesService** — genera alertas automáticas

---

## API REST

Base URL: `/api/v1`

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/socios` | Listar socios |
| POST | `/socios` | Crear socio |
| GET | `/socios/{id}` | Ver socio |
| PUT | `/socios/{id}` | Actualizar socio |
| DELETE | `/socios/{id}` | Eliminar socio |
| GET | `/socios/{id}/telefonos` | Teléfonos del socio |
| GET | `/socios/{id}/pagos/pendientes` | Pagos pendientes |
| GET | `/familias` | Listar familias (con socio, cuota, medidor) |
| GET | `/familias/{id}` | Detalle con consumos recientes |
| GET | `/medidores/{id}/consumos` | Historial de lecturas |
| GET | `/tanque/resumen` | Estado del sistema de racionamiento |
| GET | `/alertas/activas` | Alertas activas |
| ... | `/propiedades` `/medidores` `/consumos` `/pagos` `/cuotas` `/alertas` `/tanque` | CRUD completo |

---

## Instalación y Configuración

### Requisitos

- PHP 8.2+
- Composer 2+
- Node.js 18+ (con npm o pnpm)
- MySQL 8 (o SQLite para desarrollo)

### Backend (Laravel)

```bash
# 1. Clonar el repositorio
git clone https://github.com/manuel-lazarte/gotaAgota.git
cd gotaAgota

# 2. Instalar dependencias PHP
composer install

# 3. Configurar entorno
cp .env.example .env
php artisan key:generate

# 4. Configurar base de datos en .env
# Para MySQL:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gotaagota
DB_USERNAME=root
DB_PASSWORD=tu_password

# Para SQLite (desarrollo rápido):
DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/al/proyecto/database/database.sqlite

# 5. Crear base de datos y correr migraciones con datos de prueba
php artisan migrate:fresh --seed

# 6. Iniciar servidor de desarrollo
php artisan serve
# API disponible en: http://localhost:8000/api/v1
```

### Frontend (React + Vite)

```bash
# Desde la raíz del proyecto
cd frontend

# Instalar dependencias
npm install
# o si tienes pnpm:
pnpm install

# Iniciar servidor de desarrollo
npm run dev
# App disponible en: http://localhost:5173

# Build de producción
npm run build
```

> El frontend ya tiene configurado un proxy en `vite.config.js` que redirige `/api` → `http://localhost:8000`, por lo que no necesitas configurar CORS durante el desarrollo.

---

## Datos de Prueba (Seeders)

El seeder genera automáticamente:

| Entidad | Cantidad |
|---------|----------|
| Socios | 25 (20 activos + 5 inactivos) |
| Teléfonos | ~35 |
| Propiedades | ~35 |
| Familias | ~35 |
| Medidores | ~35 |
| Consumos | ~210 (6 meses de historial) |
| Cuotas de Agua | ~105 (3 meses por familia) |
| Tanque Comunitario | 2 registros (nivel 65%) |
| Alertas | 2 (1 activa PRECAUCIÓN) |

```bash
# Resetear y volver a poblar la base de datos
php artisan migrate:fresh --seed
```

---

## Variables de Entorno Importantes

```env
APP_NAME=GotaAGota
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
DB_DATABASE=/ruta/absoluta/database/database.sqlite
```

---

## Flujo de Negocio

```
Socio → Propiedad → Familia → Cuota de Agua
                           ↓
                        Medidor → Consumo → Motor de Racionamiento → Alertas
```

---

## Equipo

| Rol | Responsabilidad |
|-----|----------------|
| Backend | API REST Laravel — Controllers, Services, Repositories |
| Frontend | UI React — Family Management, Family Detail |

---

## Licencia

MIT
