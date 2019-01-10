FROM designmynight/dockerfiles:php7.1-cli-alpine

RUN echo "memory_limit=-1" > "$PHP_INI_DIR/conf.d/memory-limit.ini"

WORKDIR /opt

