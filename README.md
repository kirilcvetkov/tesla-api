# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kirilcvetkov/tesla-api.svg?style=flat-square)](https://packagist.org/packages/kirilcvetkov/tesla-api)
[![Total Downloads](https://img.shields.io/packagist/dt/kirilcvetkov/tesla-api.svg?style=flat-square)](https://packagist.org/packages/kirilcvetkov/tesla-api)
![GitHub Actions](https://github.com/kirilcvetkov/tesla-api/actions/workflows/main.yml/badge.svg)

This is where your description should go. Try and limit it to a paragraph or two, and maybe throw in a mention of what PSRs you support to avoid any confusion with users and contributors.

## Installation

You can install the package via composer:

```bash
composer require kirilcvetkov/tesla-api
```

## Usage

### Step 1 - Get the Code
Generate `code` by authenticating yourself with the Tesla auth service using your Tesla account credentials.

```php
$url = (new Authenticate())->getLoginUrl();
```

Which returns rougly the same URL: [https://auth.tesla.com/oauth2/v3/authorize](https://auth.tesla.com/oauth2/v3/authorize?client_id=ownerapi&code_challenge_method=S256&redirect_uri=https%3A%2F%2Fauth.tesla.com%2Fvoid%2Fcallback&locale=en&prompt=login&response_type=code&scope=email&state=123)

### Step 2 - swap code for Token
After using your Tesla credentials, you'll arrive at a "Page Not Found" page, which is to be expected.
From this URL, copy the `code` parameter, which should look like this: `63729ba81e9d8d8d8421aa27e3138389f0c4cbf8eccf33c55020a851f4a0`
Then, swap it for a more permanent token:

```php
$code = '63729ba81e9d8d8d8421aa27e3138389f0c4cbf8eccf33c55020a851f4a0';
$token = (new Authenticate())->getToken($code);
```

With this token, you can access Tesla's API.

### Step 3 - use the Token

```php
$tesla = new TeslaApi($token);
$products = $tesla->products();
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
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
