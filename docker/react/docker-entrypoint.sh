#!/bin/sh
set -e

if [ "${1#-}" != "$1" ]; then
	set -- yarn "$@"
fi

if [ "$1" = 'yarn' ]; then
  yarn install
fi

exec "$@"
