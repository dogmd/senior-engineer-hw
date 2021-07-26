# Getting Started
All of the following instructions assume that they are run in a Linux shell with docker installed and running.

## Starting the webserver/db/app
First, clone the repository and install the dependencies with composer.
```
git clone https://github.com/dogmd/senior-engineer-hw.git
cd senior-engineer-hw
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs
```
Then set up your environment file and start the development server with `./vendor/bin/sail up -d`

## Create a test user
```
vendor/bin/sail artisan tinker
>>> $user = new User();
>>> $user->password = Hash::make('123');
>>> $user->username = 'user1';
>>> $user->email = 'test@mail.com';
>>> $user->name = '';
>>> $user->save();
```

## Test the endpoints
#### Signin
```
curl --location --request POST '127.0.0.1/api/signin' \
--header 'Content-Type: application/json' \
--data-raw '{
    "username": "user2",
    "password": "123"
}'
```

#### Signout
```
curl --location --request POST '127.0.0.1/api/signout' \
--header 'Authorization: Bearer __token__'
```

#### signed_out_at
To check the signed out at attribute you can use laravel's built in endpoint with a valid token:
```
curl --location --request GET '127.0.0.1/api/user' \
--header 'Authorization: Bearer __token__'
```