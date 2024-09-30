#!/bin/sh

python manage.py makemigrations
python manage.py migrate
python manage.py collectstatic
exec gunicorn blog_project.wsgi:application --bind 0.0.0.0:8000