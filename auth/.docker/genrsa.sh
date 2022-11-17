#!/usr/bin/env bash


BASE_URL=/var/www/html
PRIVATE_KEY_FILE=$BASE_URL/.docker/config/private.key
PUBLIC_KEY_FILE=$BASE_URL/.docker/config/public.key

if [ ! -f "$PRIVATE_KEY_FILE" ]; then
  echo 'Creating private key';
  openssl genrsa -out "$PRIVATE_KEY_FILE" 2048;
  chmod 660 "$PRIVATE_KEY_FILE";
  chown -R www-data:www-data "$PRIVATE_KEY_FILE"
fi

if [ ! -f "$PUBLIC_KEY_FILE" ]; then
  echo 'Creating public key';
  openssl rsa -in "$PRIVATE_KEY_FILE" -pubout -out "$PUBLIC_KEY_FILE";
  chmod 660 "$PUBLIC_KEY_FILE";
  chown -R www-data:www-data "$PUBLIC_KEY_FILE"
fi