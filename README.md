# CakePHP Application CakeDC/Api & Admad/cakephp-jwt-auth

* Working with CakeDC/Api plugin And JWT (Jason Web Token) authenticate, the jwt was adapted 
for de Api plugin

## Installation

1. Config your database
2. ```bin/cake migrations migrate ```

##Using Postman for Request

* [PostMan APP](https://www.getpostman.com/)

### login action [POST]

* Url: myapp.local/auth/login
* Headers:
    * key: Content-Type
    * value: application/x-www-form-urlencoded
* Body:
    * username / user
    * password / yourpass
    
The response should be something like this:
    
````json
{
    "status": "success",
    "data": {
        "success": true,
        "data": {
            "token": "encripted_token"
        },
        "_serialize": [
            "success",
            "data"
        ]
    },
    "links": []
}
````

### index action [GET]

* Url: myapp.local/posts
* Authorization:
    * Bearer Token
    * token: (data.token string in the action before)
    
The response should be something like this:
    
````json
{
    "status": "success",
    "data": [
        {
            "id": 1,
            "user_id": "3cc5ca7e-df19-4724-9ab2-0bf447e19abc",
            "title": "my first post",
            "body": "my first post content",
            "created": "2019-02-10T17:25:22+00:00",
            "modified": null
        }
    ],
    "pagination": {
        "page": 1,
        "limit": 20,
        "pages": 1,
        "count": 8
    },
    "links": [
        {
            "name": "self",
            "href": "http://myapp.local/api/posts",
            "rel": "/api/posts",
            "method": "GET"
        },
        {
            "name": "posts:add",
            "href": "http://myapp.local/api/posts",
            "rel": "/api/posts",
            "method": "POST"
        }
    ]
}
````
### add action [POST]

* Url: myapp.local/posts
* Authorization:
    * Bearer Token
    * token: (data.token string in the action before)
* Body: x-www-form-urlencoded
    * key: user_id     /   value: 3cc5ca7e-df19-4724-9ab2-0bf447e19abc
    * key: title     /   value: my second post
    * key: body     /   value: my second post content
    
The response should be something like this:
````json
{
    "status": "success",
    "data": {
        "user_id": "3cc5ca7e-df19-4724-9ab2-0bf447e19abc",
        "title": "my second post",
        "body": "my second post content",
        "created": "2019-02-11T00:36:07+00:00",
        "modified": "2019-02-11T00:36:07+00:00",
        "id": 9
    },
    "links": []
}
````

