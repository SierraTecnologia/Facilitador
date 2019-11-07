# Facilitador

**Facilitador** - A remarkably magical form and input maker tool for Laravel.

[![Build Status](https://travis-ci.org/SierraTecnologiaInc/Facilitador.svg?branch=master)](https://travis-ci.org/SierraTecnologiaInc/Facilitador)
[![Maintainability](https://api.codeclimate.com/v1/badges/8c00a046fec32d8b8ac7/maintainability)](https://codeclimate.com/github/SierraTecnologiaInc/Facilitador/maintainability)
[![Packagist](https://img.shields.io/packagist/dt/sierratecnologia/facilitador.svg)](https://packagist.org/packages/sierratecnologia/facilitador)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/sierratecnologia/facilitador)

The Facilitator package provides a set of tools to quickly create an admin panel to view and manage your templates by just configuring template classes (eloquent).


##### Author(s):
* [Ricardo Rebello Sierra](https://github.com/ricardosierra) ([@sierra91jb](http://twitter.com/sierra91jb), sierra dot csi at gmail dot com)

## Requirements

1. PHP 7+
2. OpenSSL

## Compatability and Support

| Laravel Version | Package Tag | Supported |
|-----------------|-------------|-----------|
| ^6.0.x | 0.1.x | yes |
| ^5.4.x | 0.1.x | no |

## Features

## Facilitador Crud Admin

- [x] Display Dashboard with all configure models
- [x] Display Index page only with model class 
- [x] Display View Page only with model class
- [ ] Display Add Page only with model class
- [ ] Display Edit Page only with model class
- [ ] Display Search Page only with model class
- [ ] Export/Import for/from excel
- [ ] Implement policy for view/edit tables info.

## Comands

- [ ] Generate migrations from Database
- [ ] Generate models from Database
- [ ] Generate models from migrations

### Installation

Start a new Laravel project:
```php
composer create-project laravel/laravel your-project-name
```

Then run the following to add FormMaker
```php
composer require "sierratecnologia/facilitador"
```

Time to publish those assets!
```php
php artisan vendor:publish --provider="Facilitador\FacilitadorProvider"
```


## License
Facilitador is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests
Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## Inspiration

F.o.r.k. M.a.k.e.r by [Matt Lantz](https://github.com/mlantz) ([@mattylantz](http://twitter.com/mattylantz), mattlantz at gmail dot com)