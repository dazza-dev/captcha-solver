## Installation

You can install this package via Composer.

```bash
composer require dazza-dev/captcha-solver
```

## Captcha Resolution

### Solve reCaptcha Google

```php
use DazzaDev\CaptchaSolver\CaptchaSolverClient;

public function solveReCaptcha(): mixed
{
    $solver = new CaptchaSolverClient();

    return $solver->solveReCaptchaV2('websiteUrl', 'websiteKey');
}
```

## Contributions

Contributions are welcome. If you find any bugs or have ideas for improvements, please open an issue or send a pull request. Make sure to follow the contribution guidelines.

## Author

Captcha Solver was created by [DAZZA](https://github.com/dazza-dev).

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
