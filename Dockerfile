FROM python:3.12

WORKDIR /app

RUN pip install --upgrade pip "poetry==1.8.3"

COPY poetry.lock pyproject.toml ./

RUN poetry config virtualenvs.create false --local

RUN poetry install

COPY ./blog_project ./