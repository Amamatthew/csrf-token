## Install

```sh
composer require thanhtaivtt/csrf
```
## Usages

- get input token

```php
$csrf = new CSRF();
$csrf->tokenField();
```
- check pass token

```php
$csrf = new CSRF();
$csrf->validate();
```
## tutorial
- ***[toidicode.com](https://toidicode.com)***