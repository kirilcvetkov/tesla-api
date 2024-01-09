# 🚘 Tesla API Package

This is a composer package that allows you to access your Tesla products through Tesla's API. You're able to view products, send commands, get metrics, and more from your Tesla account.

## Installation

You can install this package via composer:

```bash
composer require kirilcvetkov/tesla-api
```

## Usage

#### Step 1 - Get a single-use Token
Generate a single-use token by authenticating yourself with the Tesla's auth page using your Tesla account credentials. 
This will be a direct connection to Tesla. After logging in, you'll arrive at "Page Not Found", which is to be expected. 
Look at the URL of this page and copy the `code` parameter. This is your single-use token.

Here's how to get a link to Tesla's auth page:
```php
use KirilCvetkov\TeslaApi\Authenticate;

$url = Authenticate::create()->getLoginUrl();

echo '<a href="' . $url . '" target="_blank">Log into Tesla</a>';
```
The URL of the "Page Not Found" page should look someything like this: `https://auth.tesla.com/void/callback?locale=en-US&code=NA_code_123&state=zzz&issuer=https%3A%2F%2Fauth.tesla.com%2Foauth2%2Fv3`

#### Step 2 - swap the single-use Token for a long-term Token
Use the value of the `code` parameter to retrieve a long-term token:

```php
use KirilCvetkov\TeslaApi\Authenticate;

$singleUseToken = 'NA_code_123';
$accessToken = Authenticate::create()->getToken($singleUseToken);

echo '<pre>';
var_export($accessToken);
```

With this token, you can access Tesla's API.

#### Step 3 - Access the API

```php
use KirilCvetkov\TeslaApi\Tesla;

$tesla = Tesla::create($accessToken); // $accessToken comes from the previous example

$products = $tesla->products()->index();
echo '<pre>Product count ' . $products->totalCount . '<br>Items <br>';
var_export($products->items);

$vehicles = $tesla->vehicles()->index();
echo '<hr>Vehicle count ' . $vehicles->totalCount . '<br>Items <br>';
var_export($vehicles->items);
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
