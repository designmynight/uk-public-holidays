FROM php:5.6.31-fpm-alpine

RUN echo "memory_limit=-1" > "$PHP_INI_DIR/conf.d/memory-limit.ini"

WORKDIR /opt

