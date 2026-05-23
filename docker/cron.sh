#!/bin/sh

# Infinite loop to run Laravel scheduler every 60 seconds
while [ true ]
do
  echo "Running scheduler: $(date)"
  php /var/www/artisan schedule:run --verbose --no-interaction &
  sleep 60
done
