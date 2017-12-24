## Lumen Login Example

[![License](https://poser.pugx.org/laravel/lumen-framework/license.svg)](https://packagist.org/packages/laravel/lumen-framework)

Example of how to use lumen default auth functionality to secure your lumen based web application.

## Setup

	create .env file
	run composer install
	run php artisan migrate

## Routes

	post /register?email&password
	post /login?email&password return api_token
	get /user/1?api_token

### License

The Lumen framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
