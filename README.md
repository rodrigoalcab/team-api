# TEAM API REST FOR WORDPRESS
A template for WordPress with API REST for company’s internal Team Management

## Getting started

Here's what it takes to run and test the project:

#### For localhost test

- [Download and install XAMPP, so you can run projects developed in PHP](https://www.apachefriends.org/download.html)
- [Download - WordPress, Install and configure and normally like any wordpress project](https://pt.wordpress.org/download/)
- [Download the postman program for API testing](https://www.postman.com)
- [Download this project and place it in the theme directory (for a localhost test)]

#### For online test
- [Download this project and upload it to a wordpress project as a theme (for an online test]

## Features

The project can be used as a template to start the development of a REST API project for WordPress.

- This project has a Custom Post Type for Members.
- Possui também 5 endpoints para gerenciar os membros da companhia

## Endpoints and how to use
- [x] Create Team Member
```
Method: POST
Route: http://localhost/team-api/wp-json/api/members
Observation 1: Email cannot be repeated in records
Observation 2: All fields need to be filled

Json Data in the Body: 
{
    "name": "rodrigo",
    "email": "rodrigo@email.com",
    "birthday": "28-03-1989",
    "gender": "male"
}

```

- [x] List Team Members
```
Method: GET
Route: http://localhost/team-api/wp-json/api/members

```


- [x] Delete Team Member
```
Method: DELETE
Route:http://localhost/team-api/wp-json/api/members/<slug>
Observation: The slug is mandatory
```

- [x] Update Team Member
```
Method: PUT
Route: http://localhost/team-api/wp-json/api/members
Observation 1: Email cannot be changed
Observation 2: All fields need to be filled

Json Data in the Body: 
{
    "name": "rodrigo",
    "email": "rodrigo@email.com",
    "birthday": "28-03-1989",
    "gender": "male"
}

```

- [x] View Team Member
```
Method: GET
Route: http://localhost/team-api/wp-json/api/members/<slug>
Observation: The slug is mandatory
```

## Possible errors
- 403 "The fields name, email, birthday and gender can not be empty"
- 403 "This email is already registered"
- 404 "Any member registered"
- 404 "Member not found"

## Thanks
- This project was developed as a challenge, even for being the first API that I created. There is still work to be done to improve it.
This sparked my interest in showing me how powerful wordpress is. I intend to continue my studies whenever possible and improve this API.
- Thank you for the opportunity and for the learning.
