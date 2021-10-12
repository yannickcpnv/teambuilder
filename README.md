# TeamBuilder

TeamBuilder is a PHP application for the module PRW-1.

## Installation

Use the package manager [composer](https://getcomposer.org/download/).

```bash
git clone https://github.com/yannickcpnv/teambuilder.git
composer install
```

## Usage

1. In the _config_ folger youcan find a _.example.env_ file, rename it to _.env_.
2. Use your personal variables.
   ```dotenv
   DB_SQL_DRIVER   = mysql
   DB_HOSTNAME     = localhost
   DB_PORT         = 3306
   DB_CHARSET      = utf8
   DB_NAME         = dbname
   DB_USER_NAME    = username
   DB_USER_PWD     = password
   DB_DSN          = ${DB_SQL_DRIVER}:host=${DB_HOSTNAME};dbname=${DB_NAME};port=${DB_PORT};charset=${DB_CHARSET}
   
   WEB_USER_ID     = 0
   ```
3. Enable php extensions :
   1. ext-pdo => Database access
   2. ext-intl => Internationalization, sort and compare utf8 strings, etc.

## Test

```bash
composer test
```
