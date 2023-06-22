# 🚘 Tesla API Package

This is a composer package that allows you to access your Tesla products through Tesla's API. You're able to view products, send commands, get metrics, and more from your Tesla account.

## Installation

You can install this package via composer:

```bash
composer require kirilcvetkov/tesla-api
```

## Usage

#### Step 1 - Get the Code
Generate a `code` value by authenticating yourself with the Tesla auth service using your Tesla account credentials.<br>
You can get the URL using this code snippet:
```php
$url = (new Authenticate())->getLoginUrl();
```
Which returns rougly the same URL: <a href="https://auth.tesla.com/oauth2/v3/authorize?client_id=ownerapi&code_challenge_method=S256&redirect_uri=https%3A%2F%2Fauth.tesla.com%2Fvoid%2Fcallback&locale=en&prompt=login&response_type=code&scope=email&state=123" target="_blank">auth.tesla.com</a>

#### Step 2 - swap the Code for a Token
After using your Tesla credentials, you'll arrive at a "Page Not Found" page, which is to be expected.<br>
From this URL, copy the `code` parameter and swap it for a more permanent token:

```php
$code = '63729ba81e9d8d8a8421aa27e3138389f0c4cbf8eccf33c55020a851f4a0';
$token = (new Authenticate())->getToken($code);
```

With this token, you can access Tesla's API.

#### Step 3 - Access the API

```php
$tesla = new Tesla($token);
$products = $tesla->products();
$vehicles = $tesla->vehicles();
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email kcvetkov@live.com instead of using the issue tracker.

## Credits

-   [Kiril Cvetkov](https://github.com/kirilcvetkov)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
