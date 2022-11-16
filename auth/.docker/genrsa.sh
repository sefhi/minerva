#!/usr/bin/env bash

if [ ! -f .docker/config/private.key ]; then
  openssl genrsa -out .docker/config/private.key 2048;
  chmod 660 .docker/config/private.key;
fi

if [ ! -f .docker/config/public.key ]; then
  openssl rsa -in .docker/config/private.key -pubout -out .docker/config/public.key;
  chmod 660 .docker/config/public.key;
fi