# Guía de Despliegue en Vercel

## Requisitos Previos

1. **Base de Datos MySQL en la Nube**: Vercel no proporciona bases de datos MySQL. Necesitas configurar una base de datos en un servicio externo:
   - [PlanetScale](https://planetscale.com/) (Recomendado - MySQL compatible)
   - [Aiven](https://aiven.io/)
   - [Railway](https://railway.app/)
   - [Supabase](https://supabase.com/) (PostgreSQL, requeriría migración)
   - Cualquier VPS con MySQL

2. **Cuenta de Vercel**: Crea una cuenta en [vercel.com](https://vercel.com)

## Pasos para Desplegar

### 1. Configurar la Base de Datos

1. Crea una base de datos MySQL en tu proveedor elegido
2. Importa el archivo `db/comercio_electronico.sql` a tu nueva base de datos
3. Anota las credenciales de conexión:
   - Host
   - Usuario
   - Contraseña
   - Nombre de la base de datos
   - Puerto

### 2. Configurar Variables de Entorno en Vercel

1. Ve a tu proyecto en Vercel Dashboard
2. Navega a **Settings** → **Environment Variables**
3. Agrega las siguientes variables:

```
DB_HOST=tu-host-de-base-de-datos.com
DB_USER=tu-usuario
DB_PASSWORD=tu-contraseña
DB_DATABASE=comercio_electronico
DB_PORT=3306
```

### 3. Desplegar el Proyecto

#### Opción A: Desde GitHub (Recomendado)

1. Conecta tu repositorio de GitHub a Vercel
2. Vercel detectará automáticamente la configuración
3. Haz clic en "Deploy"

#### Opción B: Desde CLI

```bash
# Instalar Vercel CLI
npm i -g vercel

# Desplegar
vercel
```

### 4. Verificar el Despliegue

1. Visita la URL proporcionada por Vercel
2. Verifica que la página principal cargue correctamente
3. Prueba la conexión a la base de datos navegando a la página de productos

## Notas Importantes

- **Archivos Estáticos**: Las imágenes y archivos CSS/JS deben estar en las carpetas `public`, `src`, o `assets`
- **Rutas Absolutas**: Las rutas que comienzan con `/` funcionarán correctamente
- **Sesiones PHP**: Las sesiones funcionan, pero ten en cuenta que Vercel usa funciones serverless
- **Límites de Vercel**: 
  - Tiempo de ejecución máximo: 10 segundos (plan gratuito)
  - Tamaño de despliegue: 100MB

## Solución de Problemas

### Error de Conexión a Base de Datos
- Verifica que las variables de entorno estén configuradas correctamente
- Asegúrate de que tu base de datos permita conexiones desde cualquier IP (0.0.0.0/0)

### Archivos Estáticos No Cargan
- Verifica que las rutas en `vercel.json` incluyan los tipos de archivo necesarios
- Asegúrate de que los archivos no estén en `.vercelignore`

### Errores de PHP
- Vercel usa PHP 8.x por defecto
- Verifica la compatibilidad de tu código con PHP 8

## Desarrollo Local

El proyecto sigue funcionando localmente sin cambios:
- Las variables de entorno tienen valores por defecto para desarrollo local
- Puedes seguir usando XAMPP, Laragon, o cualquier servidor PHP local
