#!/bin/bash

echo "Iniciando configuración del entorno con Laravel Sail..."

# 1. Copiar archivo de entorno si no existe
if [ ! -f .env ]; then
    echo "Creando archivo .env desde .env.example..."
    cp .env.example .env
else
    echo "El archivo .env ya existe. Omitiendo copia."
fi

# 2. Instalar dependencias con contenedor efímero de Composer
echo "Instalando dependencias de PHP vía Docker..."
docker run --rm \
    -u "$(id-u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs --no-scripts

# 3. Registrar el alias de 'sail' en ~/.bashrc si no está ya
if ! grep -q "alias sail=" ~/.bashrc; then
    echo "Configurando el alias 'sail' en ~/.bashrc..."
    echo "alias sail='./vendor/bin/sail'" >> ~/.bashrc
fi

# 4. Levantar los contenedores de Sail
echo "Levantando contenedores con Sail..."
./vendor/bin/sail up -d

# 5. Generar el autodescubrimiento de paquetes
echo "Descubriendo paquetes de Laravel dentro del contenedor..."
./vendor/bin/sail artisan package:discover

# 6. Generar la clave de la aplicación
echo "Generando APP_KEY..."
./vendor/bin/sail artisan key:generate

# 7. Enlazar almacenamiento de archivos público
echo "Creando enlace simbólico de almacenamiento..."
./vendor/bin/sail artisan storage:link

# 8. Ejecutar migraciones y datos de prueba
echo "Ejecutando migraciones y seeders..."
./vendor/bin/sail artisan migrate:fresh --seed

# 9. Instalar dependencias del frontend
echo "Instalando dependencias de Node..."
./vendor/bin/sail npm install

echo "¡Entorno configurado con éxito!"
echo " NOTA IMPORTANTE: Para usar 'sail' directamente en tu terminal, ejecuta una vez:"
echo "    source ~/.bashrc"
echo ""
echo "Para iniciar el compilador frontend ejecuta: sail npm run dev"
