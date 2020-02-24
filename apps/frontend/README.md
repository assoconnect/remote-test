This project was bootstrapped with [Create React App](https://github.com/facebook/create-react-app).

# Switch from TypeScript to JavaScript

- Close Docker
- Run in root:

```
mv -f ./apps/frontend/README.md ./apps/README.md && rm -rf ./apps/frontend && yarn create react-app ./apps/frontend && mv -f ./apps/README.md ./apps/frontend/README.md && touch ./apps/frontend/.env
```

- Build and run docker: https://github.com/assoconnect/remote-test#todo-before-the-test

# Commands

## Install all dependencies

Run in root:

```
docker-compose exec react yarn
```

## Install one dependency

Run in root:

```
cd ./apps/frontend/ && yarn add <package_name> && cd ../.. && docker-compose exec react yarn
```

# Stub API endpoint documentation

For the realisation of this exercise, we put to your disposal a stub implementation of a RESTful API endpoint.

> All the data provided is generated automatically, and not saved in a database. Because of this, the values will change at each execution.

The entity you will manage is a User, as described in the tasklist.

For this entity are open the following endpoints:

## **GET** /api/users

This endpoint will return you a list of 5 fake users.

**Response (HTTP 200)**

```json
[
  {
    "email": "gregoire.bertrand@faivre.org",
    "firstname": "Thibaut",
    "id": "1ca67d8e-0795-3edd-bf3e-e43fabee9082",
    "lastname": "Couturier",
    "phone": "+3852321570941"
  },
  {
    "email": "aime64@noos.fr",
    "firstname": "Thierry",
    "id": "e138133f-bb9e-3e1f-80f8-a50dcb1dcc3b",
    "lastname": "Seguin",
    "phone": "+8822613963985"
  },
  {
    "email": "cramos@maillard.fr",
    "firstname": "Auguste",
    "id": "bec8792a-747b-3757-829d-5ad691a8bf1e",
    "lastname": "Adam",
    "phone": "+3995377489120"
  },
  {
    "email": "upascal@wanadoo.fr",
    "firstname": "Laure",
    "id": "95a6e1dc-8e8a-3566-8f58-e3f7eb21afb0",
    "lastname": "Bruneau",
    "phone": "+5187424867798"
  },
  {
    "email": "ofournier@orange.fr",
    "firstname": "Jean",
    "id": "66af23b8-a0ae-3a91-be26-40355e05ae4d",
    "lastname": "Hubert",
    "phone": "+5200427650944"
  }
]
```

## **POST** /api/users

This endpoint simulates the creation of a user, with the validation of its data.

**Request (Content type: JSON)**

```json
{
  "email": "ofournier@orange.fr",
  "firstname": "Jean",
  "lastname": "Hubert",
  "phone": "+5200427650944"
}
```

**Response (HTTP 201)**

```json
{
  "email": "upascal@wanadoo.fr",
  "firstname": "Laure",
  "id": "95a6e1dc-8e8a-3566-8f58-e3f7eb21afb0",
  "lastname": "Bruneau",
  "phone": "+5187424867798"
}
```

**Response (HTTP 400)**

```json
{
  "message": "Invalid form",
  "violations": {
    "email": "This value is not valid.",
    "lastname": "This field is missing.",
    ...
  }
}
```

## **GET** /api/users/{uuid}

This endpoint takes a UUID (as per the [RFC 4122](http://tools.ietf.org/html/rfc4122)) as parameter.

Simulating the non retrieval of a User, if the parameter you give does not follow the standard format, you will get a 404.

**Response (HTTP 200)**

```json
{
  "email": "gay.vincent@wanadoo.fr",
  "firstname": "Denis",
  "id": "7bc8d026-db1a-3f72-942b-2927fb3a1757",
  "lastname": "Paris",
  "phone": "+4691187020525"
}
```

**Response (HTTP 404)**

```json
{
  "message": "User not found"
}
```

## **PUT** /api/users/{uuid}

This endpoint takes a UUID as parameter, and will also return a 404 if the correct format isn't respected.

Otherwise, it will validate the data you submit, and respond accordingly.

**Request (Content-type: Json)**

```json
{
  "firstname": "John",
  "lastname": "Doe",
  "email": "john.doe@email.com"
}
```

**Response (HTTP 200)**

```json
{
  "email": "xleduc@lefevre.org",
  "firstname": "Arthur",
  "id": "4a5bc51b-90b1-36a3-86f9-5886d468e448",
  "lastname": "Marin",
  "phone": "+5884889479790"
}
```

**Response (HTTP 401)**

```json
{
  "message": "Invalid form",
  "violations": {
    "email": "This value is not valid."
  }
}
```

**Response (HTTP 404)**

```json
{
  "message": "User not found"
}
```

## **DELETE** /api/users/{uuid}

This endpoint takes a UUID as parameter, and will also return a 404 if the correct format isn't respected.

Otherwise, it will correctly simulate the deletion of the object.

**Response (HTTP 204)**

```json

```

**Response (HTTP 404)**

```json
{
  "message": "User not found"
}
```
