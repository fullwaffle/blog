FROM python:3.12

WORKDIR /app

ENV PYTHONDONTWRITEBYTECODE=1
ENV PYTHONUNBUFFERED=1

RUN pip install --upgrade pip "poetry==1.8.3"
COPY poetry.lock pyproject.toml ./
RUN poetry config virtualenvs.create false --local
RUN poetry install

COPY ./entrypoint.sh ./
RUN chmod +x entrypoint.sh

COPY ./blog_project ./

ENTRYPOINT ["./entrypoint.sh"]