#!/bin/sh
set -e

# Change directory to application root
cd /var/www

# Wait for MySQL database container to become fully available
echo "Waiting for database connection..."
until php -r "
try {
    \$host = getenv('DB_HOST') ?: 'db';
    \$port = getenv('DB_PORT') ?: '3306';
    \$db   = getenv('DB_DATABASE') ?: 'munchgud';
    \$user = getenv('DB_USERNAME') ?: 'root';
    \$pass = getenv('DB_PASSWORD') ?: '';
    new PDO(\"mysql:host=\$host;port=\$port;dbname=\$db\", \$user, \$pass);
    exit(0);
} catch (Exception \$e) {
    fwrite(STDERR, \"PDO Connection Error: \" . \$e->getMessage() . PHP_EOL);
    exit(1);
}
"; do
    echo "Database not ready yet, sleeping 2s..."
    sleep 2
done
echo "Database is connected!"

# Ensure logs and cache directories have correct permissions
echo "Setting permissions..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Run migrations if enabled (highly recommended on production deploy)
echo "Running migrations..."
php artisan migrate --force

# Link storage folder to public directory if not already linked
echo "Verifying storage link..."
if [ ! -d "public/storage" ]; then
    php artisan storage:link
fi

# Execute CMD passed to docker container (starts PHP-FPM)
echo "Starting PHP-FPM application..."
exec "$@"
