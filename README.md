# CakePHP Application CakeDC/Api & Admad/cakephp-jwt-auth

* Working with CakeDC/Api plugin And JWT (Jason Web Token) authentication, the jwt was adapted 
for de Api plugin from * [ADmad Auth Plugin](https://github.com/ADmad/cakephp-jwt-auth)



## Installation

1. Config your database
2. ```bin/cake migrations migrate ```

##Using Postman for Request

* [PostMan APP](https://www.getpostman.com/)

### login action [POST]

```bash
curl -X POST \
  http://localhost:8765/api/auth/login \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -H 'cache-control: no-cache' \
  -d 'username=admin&password=password'

```
    
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

```bash
# Change the {mega-string-toke}
curl -X GET \
  http://localhost:8765/api/posts \
  -H 'Authorization: Bearer YOUR-TOKEN' \
  -H 'cache-control: no-cache'
```
    
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

```bash
curl -X POST \
  http://localhost:8765/api/posts \
  -H 'Authorization: Bearer YOUR-TOKEN' \
  -H 'cache-control: no-cache' \
  -d 'user_id=1&title=hello-jwt&body=mi-post-with-jwt-content'
```
    
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
### update action [PUT]

```bash
curl -X PUT \
  http://localhost:8765/api/posts/7 \
  -H 'Authorization: Bearer YOUR-TOKEN' \
  -H 'Content-Type: application/x-www-form-urlencoded' \
  -d 'id=7&user_id=3cc5ca7e-df19-4724-9ab2-0bf447e19abc&body=this%20the%20post%20modified'
```
    
The response should be something like this:
````json
{
    "status": "success",
        "data": {
            "id": 7,
            "user_id": "3cc5ca7e-df19-4724-9ab2-0bf447e19abc",
            "title": "this is the test post",
            "body": "this the post modified",
            "created": "2019-02-10T23:36:50+00:00",
            "modified": "2019-02-25T00:37:50+00:00"
        },

    "links": []
}
````


### view action [GET]

```bash
curl -X GET \
  http://localhost:8765/api/posts/7 \
  -H 'Authorization: Bearer YOUR-TOKEN' \
  
```
    
The response should be something like this:
````json
{
    "status": "success",
       "data": {
           "id": 7,
           "user_id": "3cc5ca7e-df19-4724-9ab2-0bf447e19abc",
           "title": "This is a new post",
           "body": "post content",
           "created": "2019-02-10T23:36:50+00:00",
           "modified": "2019-02-10T23:36:50+00:00"
       },

    "links": []
}
````

### Delete action [DELETE]

```bash
curl -X DELETE \
  http://localhost:8765/api/posts/21 \
  -H 'Authorization: Bearer YOUR-TOKEN' \
  
```
    
The response should be something like this:
````json
{
    "status": "success",
    "data": true,
    "links": []
}
````

