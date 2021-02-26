<p align="center"><a href="https://wuchemarkt.ch" target="_blank"><img src="https://wuchemarkt.ch/assets/logo.svg" width="400"></a></p>

## Local development

### Dependencies

- Docker 
- composer

### Installation Steps

1. `composer install`
2. `./vendor/bin/sail up`
3. `./vendor/bin/sail artisan migrate`
4. `./vendor/bin/sail artisan key:generate`
