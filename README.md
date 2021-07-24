# Getting Started
All of the following instructions assume that they are run in a Linux shell with docker installed and running.

## Starting the webserver/db/app
First, clone the repository and start it up with sail. The first startup may take a couple minutes.
```
git clone https://github.com/dogmd/senior-engineer-hw.git
cd senior-engineer-hw && vendor/bin/sail up -d
```

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