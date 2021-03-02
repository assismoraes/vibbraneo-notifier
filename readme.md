# Vibbraneo Notifier

#### Requirements to deploy

 - Docker
 - Docker compose
 
#### About applications structure
For deploy it will be used 3 docker containers
 - Container docker with a database(mysql)
 - Container docker with nginx
 - Container PHP to execute the main laravel application(web and API)

Theses containers are detailed in the docker-compose.yml file, in the project root folder.
Beside that there is a Dockerfile in the same folder. It has all commands to build a PHP enviroment to deploy the Laravel application.

#### Deploy instructions
```sh
$ git clone http://git.vibbra.com.br/assis/vibbraneo-notifier.git vibbraneo-notifier
$ cd vibbraneo-notifier/
$ docker run --rm -v $(pwd):/app composer install
$ docker-compose down && docker-compose up
```
##### After containers started, in another terminal:
```sh
$ docker exec -it app php artisan migrate
$ docker exec -it app php artisan passport:install
```
#### After these commands, you can access the laravel application by typing http://localhost:8000 in your browser

This is an web application with an API to send SMS, Web Push and Email notifications, but only e-mail notifications are avaiable. Users can manage applications, channels, html templates for e-mails and notifications.
First of all, users have to be registered to this application. There are two ways it can be done: by web form and by google account. Accessing [http://localhost:8000/](http://localhost:8000/), it can be done.
After that, user can access both web application and API endpoints.

#### Important.: All no public endpoints need the following headers:
- Accept: application/json
- Content-Type: application/json
- Authorization: Bearer {access_token} (This is the access_token retrieved by authentication endpoint request /api/auth)

### API user authentication
  - POST /api/auth (PUBLIC: yes)
  ```json
  {
    "username": "EMAIL_REGISTERED",
    "password": "PASSWORD_REGISTERED",
}
  ```
  - RESPONSE: 
  ```json
 {
    "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiODcyMzFkYTg1ZDZkOGMxMjg2ZWZkZTAzZDA4ZDNlMzQ5ODdiYTExZThmZTYyMTg3OTUyNDQ1YjlmNzQ4MTUzMDIzZWJjMmI3ZGU4N2U4ZGYiLCJpYXQiOjE2MTQ2OTA2ODIsIm5iZiI6MTYxNDY5MDY4MiwiZXhwIjoxNjE0Nzc3MDgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.O_1f8c4Gbf2GcCKXjuEukYC5xbzXKQ4cAPCuSAzOvhIbOD91ZZuzXphTvHhHx-4jyy1iCK8tYZ8tWFc9oy69E9HvGMTsoHuEKF6VCdzCck46l1IujxGSnhmQMRrk2cworQp8X-oWQhE_k9ggYKhsidxLfvwKhAytaF3Urn1ldnHNhKEqYIdcr8woUJJRuVjoK_LA-eVhymca3WmJEOqLFxcsa5HLS-toJfilvFFEfNLnQ_PuE3MKxhVRibEqvGAXsY5Qov24bhib3SbpUsBbOGXqSNtx74kqDyk7CX5kuz-a3I1t98ZqW5TViaQhZcQWl0uWrJlb7aiGw5x_AWlhutIoa0R7FutMtPRpqBymWeEyKfSGYyv_zk7102jlDE4qZqjJt_dUm2eWKJAQZ5vQ-RVrBKQJi3SA5s4BJcQSAcq2a9uw8lnKOZv2XkBJayfp2i-ywgfBNMV1HIf1gOkYZuZteH2IaJ7WrirzwbFzqPYlZRFD9IfNaQGkmWE6tVMVJl2fMfwZIWQ9_22z5DDd-p7ak3wSm87IwG2SWlKCWnWE9KPWuq5b6bdU3ZSETr-XyR4svg_BtROlJY4d_Z-cgoixqrxChd1SZHnWKuwoIK3rBkxlzJItsPbHbYJHAmJblH8ZaWOIG8Ka-_2H6j8AODX631TNrvJ44qbGOd7E9yc"
}
  ```

### Retrieve current user
  - GET /api/user (PUBLIC: no)
  ```json
  {
    "username": "EMAIL_REGISTERED",
    "password": "PASSWORD_REGISTERED",
}
  ```
  - RESPONSE: 
 ```json
 {
    "id": 1,
    "name": "João de Santo Cristo",
    "email": "joaosantocristo@gmail.com",
    "email_verified_at": null,
    "created_at": "2021-03-02 06:34:35",
    "updated_at": "2021-03-02 06:34:35",
    "company_name": "JSC LTDA",
    "phone_number": "86994521114",
    "address": "Avenida JSC, 1827"
}
```

### Creating application
  - POST /api/applications (PUBLIC: no)
  ```json
  {
	"name": "My application name"
	"uses_sms: "uses_sms", (optional. Default will be false)
	"uses_web_push: "uses_web_push", (optional. Default will be false)
	"uses_email: "uses_email", (optional. Default will be false)
}
  ```
  - RESPONSE: 
 ```json
 {
    "name": "My application name",
    "uses_web_push": false,
    "uses_email": false,
    "uses_sms": false,
    "updated_at": "2021-03-02 08:53:24",
    "created_at": "2021-03-02 08:53:24",
    "id": 2
}
```

### Updating application
  - PUT /api/applications/{application_id} (PUBLIC: no)
  ```json
  {
	"name": "My application name"
	"uses_sms: "uses_sms", (optional. Default will be false)
	"uses_web_push: "uses_web_push", (optional. Default will be false)
	"uses_email: "uses_email", (optional. Default will be false)
}
  ```
  - RESPONSE: 
 ```json
 {
    "name": "My application name",
    "uses_web_push": false,
    "uses_email": false,
    "uses_sms": false,
    "updated_at": "2021-03-02 08:53:24",
    "created_at": "2021-03-02 08:53:24",
    "id": 2
}
```
### Listing applications
  - GET /api/applications/ (PUBLIC: no)
  
  - RESPONSE: 
 ```json
 [
    {
        "id": 1,
        "name": "App 1",
        "uses_web_push": false,
        "uses_email": true,
        "uses_sms": false,
        "created_at": "2021-03-02 08:51:12",
        "updated_at": "2021-03-02 08:51:29"
    },
    {
        "id": 2,
        "name": "App 2",
        "uses_web_push": true,
        "uses_email": false,
        "uses_sms": false,
        "created_at": "2021-03-02 08:53:24",
        "updated_at": "2021-03-02 08:54:11"
    }
]
```
### Detail application
  - GET /api/applications/{application_id} (PUBLIC: no)
  
  - RESPONSE: 
 ```json
 {
    "name": "My application name",
    "uses_web_push": false,
    "uses_email": false,
    "uses_sms": false,
    "updated_at": "2021-03-02 08:53:24",
    "created_at": "2021-03-02 08:53:24",
    "id": 2
}
```
### Configure email channel
  - POST /api/email-channels (PUBLIC: no)
   ```json
 {
	 "smtp_server_name": "smtp.gmail.com",
	 "port": 587,	
	 "login": "axmraz@gmail.com",
	 "password": "pass1234"
}
```
  - RESPONSE: 
 ```json
 {
    "id": 1,
    "smtp_server_name": "smtp.gmail.com",
    "port": 587,
    "login": "axmraz@gmail.com",
    "password": "pass1234",
    "created_at": "2021-03-02 08:55:33",
    "updated_at": "2021-03-02 08:56:09",
    "is_enabled": false
}
```
### Toggle email channel
  - GET /api/email-channels/toggle (PUBLIC: no)
  
  - RESPONSE: 
 ```json
 {
    "id": 1,
    "smtp_server_name": "smtp.gmail.com",
    "port": 587,
    "login": "axmraz@gmail.com",
    "password": "pass1234",
    "created_at": "2021-03-02 08:55:33",
    "updated_at": "2021-03-02 08:56:09",
    "is_enabled": false
}
```

### Retrieve email channel
  - GET /api/email-channels (PUBLIC: no)
  
  - RESPONSE: 
 ```json
 {
    "id": 1,
    "smtp_server_name": "smtp.gmail.com",
    "port": 587,
    "login": "axmraz@gmail.com",
    "password": "pass1234",
    "created_at": "2021-03-02 08:55:33",
    "updated_at": "2021-03-02 08:56:09",
    "is_enabled": true
}
```
### Save email template
  - POST /api/email-templates (PUBLIC: no)
	  - send via form-data the following parameters
			  - name: string
			  - template: file (.html file)
  - RESPONSE: 
 ```json
 {
    "name": "Laravel 6x",
    "content": "<!DOCTYPE html><!-- saved from url=(0060)https://laravel.com/docs/6.x/authentication#login-throttling --><html lang=\"en\"><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">        <title>Authentication - Laravel - The PHP Framework For Web Artisans</title>    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, viewport-fit=cover\">        <link rel=\"canonical\" href=\"https://laravel.com/docs/8.x/authentication\">        <!-- ...",
    "updated_at": "2021-03-02 10:53:48",
    "created_at": "2021-03-02 10:53:48",
    "id": 10
}
```
### Listing email templates
  - GET /api/email-templates (PUBLIC: no)
##### This request accepts a 'page' filter. Ex.: /api/email-templates?page=3
  - RESPONSE: 
 ```json
 {
    "current_page": 1,
    "data": [
        {
            "id": 8,
            "name": "OAuth the PHP league",
            "content": "<h1>template content</h1>",
            "created_at": "2021-03-02 07:16:20",
            "updated_at": "2021-03-02 07:16:20"
        },
        {
            "id": 9,
            "name": "Laravel 6x",
            "content": "<h1>template content</h1>",
            "created_at": "2021-03-02 07:16:41",
            "updated_at": "2021-03-02 07:16:41"
        }
    ],
    "first_page_url": "http://localhost:8000/api/email-templates?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/email-templates?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/email-templates",
    "per_page": 5,
    "prev_page_url": null,
    "to": 2,
    "total": 2
}
```
### Retrieve email template
  - GET /api/email-templates/{email_template_id} (PUBLIC: no)
  
  - RESPONSE: 
 ```json
 {
    "id": 8,
    "name": "OAuth the PHP league",
    "content": "<h1>template content</h1>",
    "created_at": "2021-03-02 07:16:20",
    "updated_at": "2021-03-02 07:16:20"
}
```
if the template do not exists:
 ```json
 {
    "message": "Invalid email template"
}
```
### Deleting email template
  - GET /api/email-templates/{email_template_id}/delete (PUBLIC: no)
  
  - RESPONSE: 
 ```json
 {
    "message": "Email template deleted successfully"
}
```
### Listing e-mail notifications
  - GET /api/notifications?page=2&channel=email&sending_source=WEB_PLATFORM&from=2021-01-01&to=2021-10-10 (PUBLIC: no)
##### page -> number of the page(Ex.: 1, 54, 28)
##### channel -> sms | email | webPush
##### sending_source -> API | WEB_PLATFORM
##### from, to -> date in the format yyyy-MM-dd (Ex.: 2021-10-03)
```json
	{
	"sender_name": "Assis Moraes",
	"email": "axmraz@gmail.com",
	"application_id": 2,
	"email_template_id": 9
}
```
  - RESPONSE: 200 OK
 ```json
 {
    "message": "Email notification sent successfully"
}
```