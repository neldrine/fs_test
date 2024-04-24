## This is the backend for the Rover Image Viewer

 This is built using Laravel 11 developed locally using https://herd.laravel.com/
- There are 5 Endpoints.
- The NASA API is accessible via a laravel service provider, allows you to access the service from anywhere within the $app
- I would have used laravel form requests if I had more time and kept the logic separate
- Total time to complete ~1 hr
- Note: Some Images 404 on the other endpoints

**GET - api/rover**
	- Requires an Authorization key
	- Requests without this return a 401
	- Uses a middleware to ensure only authenticated users are allowed

**GET - api/authenticate**
-  In order to get your "dynamic" token you'll need to pass an email and password
- In production I'd use something like laravel sanctum to manage this more efficiently
- A token is returned

**GET - api/token**
- This endpoint is used to get information about a token
	- Returns information about user

**POST - api/token**
- This endpoint is used if you would like to refresh the validity of the token

**DELETE - api/token**
- This endpoint is used if you would like destroy the sesssion i.e log user out


