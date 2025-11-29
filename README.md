# Captcha Solver

This package provides a simple and convenient way to solve captchas using different services.

## Supported Services

- `anticaptcha` - api.anti-captcha.com
- `capmonster` - api.capmonster.cloud
- `capsolver` - api.capsolver.com

## Installation

```bash
composer require dazza-dev/captcha-solver
```

## Usage

### Configuration

Before using the package, you need to configure the captcha solver service and API key.

```php
use DazzaDev\CaptchaSolver\CaptchaSolverClient;

$captchaSolver = new CaptchaSolverClient;
$captchaSolver->setService('service-name');
$captchaSolver->setApiKey('your-api-key-here');
```

### Get Balance

```php
$balance = $captchaSolver->getBalance();

echo $balance;
```

### Solve reCaptcha V2

```php
$result = $captchaSolver->solveReCaptchaV2(
    websiteUrl: 'website_url',
    websiteKey: 'website_key',
);

echo $result;
```

### Solve reCaptcha V3

```php
$result = $captchaSolver->solveReCaptchaV3(
    websiteUrl: 'website_url',
    websiteKey: 'website_key',
);

echo $result;
```

## Contributions

Contributions are welcome. If you find any bugs or have ideas for improvements, please open an issue or send a pull request. Make sure to follow the contribution guidelines.

## Author

Captcha Solver was created by [DAZZA](https://github.com/dazza-dev).

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
