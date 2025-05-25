<?php return array (
  2 => 'broadcasting',
  4 => 'concurrency',
  5 => 'cors',
  8 => 'hashing',
  14 => 'view',
  'app' => 
  array (
    'name' => 'RentKuy',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://localhost',
    'frontend_url' => 'http://localhost:3000',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'id',
    'fallback_locale' => 'id',
    'faker_locale' => 'id_ID',
    'cipher' => 'AES-256-CBC',
    'key' => 'base64:yE2R5GzIL0oLgXN83X1bBDLzzFJEdbyWP+OLefaX5PQ=',
    'previous_keys' => 
    array (
    ),
    'maintenance' => 
    array (
      'driver' => 'file',
      'store' => 'database',
    ),
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Concurrency\\ConcurrencyServiceProvider',
      6 => 'Illuminate\\Cookie\\CookieServiceProvider',
      7 => 'Illuminate\\Database\\DatabaseServiceProvider',
      8 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      9 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      10 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      11 => 'Illuminate\\Hashing\\HashServiceProvider',
      12 => 'Illuminate\\Mail\\MailServiceProvider',
      13 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      14 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      15 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      16 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      17 => 'Illuminate\\Queue\\QueueServiceProvider',
      18 => 'Illuminate\\Redis\\RedisServiceProvider',
      19 => 'Illuminate\\Session\\SessionServiceProvider',
      20 => 'Illuminate\\Translation\\TranslationServiceProvider',
      21 => 'Illuminate\\Validation\\ValidationServiceProvider',
      22 => 'Illuminate\\View\\ViewServiceProvider',
      23 => 'App\\Providers\\AppServiceProvider',
      24 => 'App\\Providers\\Filament\\AdminPanelProvider',
      25 => 'App\\Providers\\MidtransServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Concurrency' => 'Illuminate\\Support\\Facades\\Concurrency',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Context' => 'Illuminate\\Support\\Facades\\Context',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Number' => 'Illuminate\\Support\\Number',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Process' => 'Illuminate\\Support\\Facades\\Process',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schedule' => 'Illuminate\\Support\\Facades\\Schedule',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Uri' => 'Illuminate\\Support\\Uri',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Vite' => 'Illuminate\\Support\\Facades\\Vite',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_reset_tokens',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'cache' => 
  array (
    'default' => 'database',
    'stores' => 
    array (
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'cache',
        'lock_connection' => NULL,
        'lock_table' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'C:\\laragon\\www\\rent-vehi\\storage\\framework/cache/data',
        'lock_path' => 'C:\\laragon\\www\\rent-vehi\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'rentkuy_cache_',
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'rent_vehi',
        'prefix' => '',
        'foreign_key_constraints' => true,
        'busy_timeout' => NULL,
        'journal_mode' => NULL,
        'synchronous' => NULL,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'rent_vehi',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'mariadb' => 
      array (
        'driver' => 'mariadb',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'rent_vehi',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'rent_vehi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'search_path' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'rent_vehi',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 
    array (
      'table' => 'migrations',
      'update_date_on_publish' => true,
    ),
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'rentkuy_database_',
        'persistent' => false,
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'username' => NULL,
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'public',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\rent-vehi\\storage\\app/private',
        'serve' => true,
        'throw' => false,
        'report' => false,
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'C:\\laragon\\www\\rent-vehi\\storage\\app/public',
        'url' => 'http://localhost/storage',
        'visibility' => 'public',
        'throw' => false,
        'report' => false,
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
        'throw' => false,
        'report' => false,
      ),
    ),
    'links' => 
    array (
      'C:\\laragon\\www\\rent-vehi\\public\\storage' => 'C:\\laragon\\www\\rent-vehi\\storage\\app/public',
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => 
    array (
      'channel' => NULL,
      'trace' => false,
    ),
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'C:\\laragon\\www\\rent-vehi\\storage\\logs/laravel.log',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'C:\\laragon\\www\\rent-vehi\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
        'replace_placeholders' => true,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
          'connectionString' => 'tls://:',
        ),
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'handler_with' => 
        array (
          'stream' => 'php://stderr',
        ),
        'formatter' => NULL,
        'processors' => 
        array (
          0 => 'Monolog\\Processor\\PsrLogMessageProcessor',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
        'facility' => 8,
        'replace_placeholders' => true,
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
        'replace_placeholders' => true,
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => 'C:\\laragon\\www\\rent-vehi\\storage\\logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'scheme' => NULL,
        'url' => NULL,
        'host' => 'smtp.gmail.com',
        'port' => '465',
        'username' => 'davenalk216@gmail.com',
        'password' => 'agnqzdcwbuclxtjo',
        'timeout' => NULL,
        'local_domain' => 'localhost',
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'resend' => 
      array (
        'transport' => 'resend',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -bs -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
        'retry_after' => 60,
      ),
      'roundrobin' => 
      array (
        'transport' => 'roundrobin',
        'mailers' => 
        array (
          0 => 'ses',
          1 => 'postmark',
        ),
        'retry_after' => 60,
      ),
    ),
    'from' => 
    array (
      'address' => 'RentKuy@gmail.com',
      'name' => '${RentKuy}',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'C:\\laragon\\www\\rent-vehi\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'midtrans' => 
  array (
    'server_key' => 'SB-Mid-server-BiIsBuY89I1dJ2avP6pIeA93',
    'client_key' => 'SB-Mid-client-Xsvo1IKvYU55sOCb',
    'is_production' => false,
  ),
  'money' => 
  array (
    'defaults' => 
    array (
      'currency' => 'USD',
      'convert' => false,
    ),
    'currencies' => 
    array (
      'AED' => 
      array (
        'name' => 'UAE Dirham',
        'code' => 784,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'د.إ',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'AFN' => 
      array (
        'name' => 'Afghani',
        'code' => 971,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '؋',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ALL' => 
      array (
        'name' => 'Lek',
        'code' => 8,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'L',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'AMD' => 
      array (
        'name' => 'Armenian Dram',
        'code' => 51,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'դր.',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ANG' => 
      array (
        'name' => 'Netherlands Antillean Guilder',
        'code' => 532,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ƒ',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'AOA' => 
      array (
        'name' => 'Kwanza',
        'code' => 973,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Kz',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ARS' => 
      array (
        'name' => 'Argentine Peso',
        'code' => 32,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'AUD' => 
      array (
        'name' => 'Australian Dollar',
        'code' => 36,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ' ',
      ),
      'AWG' => 
      array (
        'name' => 'Aruban Florin',
        'code' => 533,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ƒ',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'AZN' => 
      array (
        'name' => 'Azerbaijanian Manat',
        'code' => 944,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₼',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BAM' => 
      array (
        'name' => 'Convertible Mark',
        'code' => 977,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'КМ',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BBD' => 
      array (
        'name' => 'Barbados Dollar',
        'code' => 52,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BDT' => 
      array (
        'name' => 'Taka',
        'code' => 50,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '৳',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BGN' => 
      array (
        'name' => 'Bulgarian Lev',
        'code' => 975,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'лв',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => ' ',
      ),
      'BHD' => 
      array (
        'name' => 'Bahraini Dinar',
        'code' => 48,
        'precision' => 3,
        'subunit' => 1000,
        'symbol' => 'ب.د',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BIF' => 
      array (
        'name' => 'Burundi Franc',
        'code' => 108,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BMD' => 
      array (
        'name' => 'Bermudian Dollar',
        'code' => 60,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BND' => 
      array (
        'name' => 'Brunei Dollar',
        'code' => 96,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BOB' => 
      array (
        'name' => 'Boliviano',
        'code' => 68,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Bs.',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BOV' => 
      array (
        'name' => 'Mvdol',
        'code' => 984,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Bs.',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BRL' => 
      array (
        'name' => 'Brazilian Real',
        'code' => 986,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'R$',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'BSD' => 
      array (
        'name' => 'Bahamian Dollar',
        'code' => 44,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BTN' => 
      array (
        'name' => 'Ngultrum',
        'code' => 64,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Nu.',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BWP' => 
      array (
        'name' => 'Pula',
        'code' => 72,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'P',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'BYN' => 
      array (
        'name' => 'Belarussian Ruble',
        'code' => 974,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Br',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => ' ',
      ),
      'BZD' => 
      array (
        'name' => 'Belize Dollar',
        'code' => 84,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CAD' => 
      array (
        'name' => 'Canadian Dollar',
        'code' => 124,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CDF' => 
      array (
        'name' => 'Congolese Franc',
        'code' => 976,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CHF' => 
      array (
        'name' => 'Swiss Franc',
        'code' => 756,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'CHF',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CLF' => 
      array (
        'name' => 'Unidades de fomento',
        'code' => 990,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'UF',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'CLP' => 
      array (
        'name' => 'Chilean Peso',
        'code' => 152,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'CNY' => 
      array (
        'name' => 'Yuan Renminbi',
        'code' => 156,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '¥',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'COP' => 
      array (
        'name' => 'Colombian Peso',
        'code' => 170,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'CRC' => 
      array (
        'name' => 'Costa Rican Colon',
        'code' => 188,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₡',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'CUC' => 
      array (
        'name' => 'Peso Convertible',
        'code' => 931,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CUP' => 
      array (
        'name' => 'Cuban Peso',
        'code' => 192,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CVE' => 
      array (
        'name' => 'Cape Verde Escudo',
        'code' => 132,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'CZK' => 
      array (
        'name' => 'Czech Koruna',
        'code' => 203,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Kč',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'DJF' => 
      array (
        'name' => 'Djibouti Franc',
        'code' => 262,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fdj',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'DKK' => 
      array (
        'name' => 'Danish Krone',
        'code' => 208,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'kr',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'DOP' => 
      array (
        'name' => 'Dominican Peso',
        'code' => 214,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'DZD' => 
      array (
        'name' => 'Algerian Dinar',
        'code' => 12,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'د.ج',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'EGP' => 
      array (
        'name' => 'Egyptian Pound',
        'code' => 818,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ج.م',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ERN' => 
      array (
        'name' => 'Nakfa',
        'code' => 232,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Nfk',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ETB' => 
      array (
        'name' => 'Ethiopian Birr',
        'code' => 230,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Br',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'EUR' => 
      array (
        'name' => 'Euro',
        'code' => 978,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '€',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'FJD' => 
      array (
        'name' => 'Fiji Dollar',
        'code' => 242,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'FKP' => 
      array (
        'name' => 'Falkland Islands Pound',
        'code' => 238,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GBP' => 
      array (
        'name' => 'Pound Sterling',
        'code' => 826,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GEL' => 
      array (
        'name' => 'Lari',
        'code' => 981,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₾',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GHS' => 
      array (
        'name' => 'Ghana Cedi',
        'code' => 936,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₵',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GIP' => 
      array (
        'name' => 'Gibraltar Pound',
        'code' => 292,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GMD' => 
      array (
        'name' => 'Dalasi',
        'code' => 270,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'D',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GNF' => 
      array (
        'name' => 'Guinea Franc',
        'code' => 324,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GTQ' => 
      array (
        'name' => 'Quetzal',
        'code' => 320,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Q',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'GYD' => 
      array (
        'name' => 'Guyana Dollar',
        'code' => 328,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'HKD' => 
      array (
        'name' => 'Hong Kong Dollar',
        'code' => 344,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'HNL' => 
      array (
        'name' => 'Lempira',
        'code' => 340,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'L',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'HRK' => 
      array (
        'name' => 'Croatian Kuna',
        'code' => 191,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'kn',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'HTG' => 
      array (
        'name' => 'Gourde',
        'code' => 332,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'G',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'HUF' => 
      array (
        'name' => 'Forint',
        'code' => 348,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Ft',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'IDR' => 
      array (
        'name' => 'Rupiah',
        'code' => 360,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Rp',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'ILS' => 
      array (
        'name' => 'New Israeli Sheqel',
        'code' => 376,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₪',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'INR' => 
      array (
        'name' => 'Indian Rupee',
        'code' => 356,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₹',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'IQD' => 
      array (
        'name' => 'Iraqi Dinar',
        'code' => 368,
        'precision' => 3,
        'subunit' => 1000,
        'symbol' => 'ع.د',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'IRR' => 
      array (
        'name' => 'Iranian Rial',
        'code' => 364,
        'precision' => 0,
        'subunit' => 100,
        'symbol' => '﷼',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ISK' => 
      array (
        'name' => 'Iceland Krona',
        'code' => 352,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'kr',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'JMD' => 
      array (
        'name' => 'Jamaican Dollar',
        'code' => 388,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'JOD' => 
      array (
        'name' => 'Jordanian Dinar',
        'code' => 400,
        'precision' => 3,
        'subunit' => 100,
        'symbol' => 'د.ا',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'JPY' => 
      array (
        'name' => 'Yen',
        'code' => 392,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => '¥',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KES' => 
      array (
        'name' => 'Kenyan Shilling',
        'code' => 404,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'KSh',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KGS' => 
      array (
        'name' => 'Som',
        'code' => 417,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'som',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KHR' => 
      array (
        'name' => 'Riel',
        'code' => 116,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '៛',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KMF' => 
      array (
        'name' => 'Comoro Franc',
        'code' => 174,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KPW' => 
      array (
        'name' => 'North Korean Won',
        'code' => 408,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₩',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KRW' => 
      array (
        'name' => 'Won',
        'code' => 410,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => '₩',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KWD' => 
      array (
        'name' => 'Kuwaiti Dinar',
        'code' => 414,
        'precision' => 3,
        'subunit' => 1000,
        'symbol' => 'د.ك',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KYD' => 
      array (
        'name' => 'Cayman Islands Dollar',
        'code' => 136,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'KZT' => 
      array (
        'name' => 'Tenge',
        'code' => 398,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '〒',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LAK' => 
      array (
        'name' => 'Kip',
        'code' => 418,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₭',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LBP' => 
      array (
        'name' => 'Lebanese Pound',
        'code' => 422,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ل.ل',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LKR' => 
      array (
        'name' => 'Sri Lanka Rupee',
        'code' => 144,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₨',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LRD' => 
      array (
        'name' => 'Liberian Dollar',
        'code' => 430,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LSL' => 
      array (
        'name' => 'Loti',
        'code' => 426,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'L',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LTL' => 
      array (
        'name' => 'Lithuanian Litas',
        'code' => 440,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Lt',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LVL' => 
      array (
        'name' => 'Latvian Lats',
        'code' => 428,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Ls',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'LYD' => 
      array (
        'name' => 'Libyan Dinar',
        'code' => 434,
        'precision' => 3,
        'subunit' => 1000,
        'symbol' => 'ل.د',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MAD' => 
      array (
        'name' => 'Moroccan Dirham',
        'code' => 504,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'د.م.',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MDL' => 
      array (
        'name' => 'Moldovan Leu',
        'code' => 498,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'L',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MGA' => 
      array (
        'name' => 'Malagasy Ariary',
        'code' => 969,
        'precision' => 2,
        'subunit' => 5,
        'symbol' => 'Ar',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MKD' => 
      array (
        'name' => 'Denar',
        'code' => 807,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ден',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MMK' => 
      array (
        'name' => 'Kyat',
        'code' => 104,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'K',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MNT' => 
      array (
        'name' => 'Tugrik',
        'code' => 496,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₮',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MOP' => 
      array (
        'name' => 'Pataca',
        'code' => 446,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'P',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MRO' => 
      array (
        'name' => 'Ouguiya',
        'code' => 478,
        'precision' => 2,
        'subunit' => 5,
        'symbol' => 'UM',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MUR' => 
      array (
        'name' => 'Mauritius Rupee',
        'code' => 480,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₨',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MVR' => 
      array (
        'name' => 'Rufiyaa',
        'code' => 462,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'MVR',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MWK' => 
      array (
        'name' => 'Kwacha',
        'code' => 454,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'MK',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MXN' => 
      array (
        'name' => 'Mexican Peso',
        'code' => 484,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MYR' => 
      array (
        'name' => 'Malaysian Ringgit',
        'code' => 458,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'RM',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'MZN' => 
      array (
        'name' => 'Mozambique Metical',
        'code' => 943,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'MTn',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'NAD' => 
      array (
        'name' => 'Namibia Dollar',
        'code' => 516,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'NGN' => 
      array (
        'name' => 'Naira',
        'code' => 566,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₦',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'NIO' => 
      array (
        'name' => 'Cordoba Oro',
        'code' => 558,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'C$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'NOK' => 
      array (
        'name' => 'Norwegian Krone',
        'code' => 578,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'kr',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'NPR' => 
      array (
        'name' => 'Nepalese Rupee',
        'code' => 524,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₨',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'NZD' => 
      array (
        'name' => 'New Zealand Dollar',
        'code' => 554,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'OMR' => 
      array (
        'name' => 'Rial Omani',
        'code' => 512,
        'precision' => 3,
        'subunit' => 1000,
        'symbol' => 'ر.ع.',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'PAB' => 
      array (
        'name' => 'Balboa',
        'code' => 590,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'B/.',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'PEN' => 
      array (
        'name' => 'Sol',
        'code' => 604,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'S/',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'PGK' => 
      array (
        'name' => 'Kina',
        'code' => 598,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'K',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'PHP' => 
      array (
        'name' => 'Philippine Peso',
        'code' => 608,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₱',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'PKR' => 
      array (
        'name' => 'Pakistan Rupee',
        'code' => 586,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₨',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'PLN' => 
      array (
        'name' => 'Zloty',
        'code' => 985,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'zł',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => ' ',
      ),
      'PYG' => 
      array (
        'name' => 'Guarani',
        'code' => 600,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => '₲',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'QAR' => 
      array (
        'name' => 'Qatari Rial',
        'code' => 634,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ر.ق',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'RON' => 
      array (
        'name' => 'New Romanian Leu',
        'code' => 946,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Lei',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'RSD' => 
      array (
        'name' => 'Serbian Dinar',
        'code' => 941,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'РСД',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'RUB' => 
      array (
        'name' => 'Russian Ruble',
        'code' => 643,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₽',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'RWF' => 
      array (
        'name' => 'Rwanda Franc',
        'code' => 646,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'FRw',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SAR' => 
      array (
        'name' => 'Saudi Riyal',
        'code' => 682,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ر.س',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SBD' => 
      array (
        'name' => 'Solomon Islands Dollar',
        'code' => 90,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SCR' => 
      array (
        'name' => 'Seychelles Rupee',
        'code' => 690,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₨',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SDG' => 
      array (
        'name' => 'Sudanese Pound',
        'code' => 938,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SEK' => 
      array (
        'name' => 'Swedish Krona',
        'code' => 752,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'kr',
        'symbol_first' => false,
        'decimal_mark' => ',',
        'thousands_separator' => ' ',
      ),
      'SGD' => 
      array (
        'name' => 'Singapore Dollar',
        'code' => 702,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SHP' => 
      array (
        'name' => 'Saint Helena Pound',
        'code' => 654,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SLL' => 
      array (
        'name' => 'Leone',
        'code' => 694,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Le',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SOS' => 
      array (
        'name' => 'Somali Shilling',
        'code' => 706,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Sh',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SRD' => 
      array (
        'name' => 'Surinam Dollar',
        'code' => 968,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SSP' => 
      array (
        'name' => 'South Sudanese Pound',
        'code' => 728,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'STD' => 
      array (
        'name' => 'Dobra',
        'code' => 678,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Db',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SVC' => 
      array (
        'name' => 'El Salvador Colon',
        'code' => 222,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₡',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SYP' => 
      array (
        'name' => 'Syrian Pound',
        'code' => 760,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '£S',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'SZL' => 
      array (
        'name' => 'Lilangeni',
        'code' => 748,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'E',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'THB' => 
      array (
        'name' => 'Baht',
        'code' => 764,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '฿',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TJS' => 
      array (
        'name' => 'Somoni',
        'code' => 972,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ЅМ',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TMT' => 
      array (
        'name' => 'Turkmenistan New Manat',
        'code' => 934,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'T',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TND' => 
      array (
        'name' => 'Tunisian Dinar',
        'code' => 788,
        'precision' => 3,
        'subunit' => 1000,
        'symbol' => 'د.ت',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TOP' => 
      array (
        'name' => 'Pa’anga',
        'code' => 776,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'T$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TRY' => 
      array (
        'name' => 'Turkish Lira',
        'code' => 949,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₺',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'TTD' => 
      array (
        'name' => 'Trinidad and Tobago Dollar',
        'code' => 780,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TWD' => 
      array (
        'name' => 'New Taiwan Dollar',
        'code' => 901,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'TZS' => 
      array (
        'name' => 'Tanzanian Shilling',
        'code' => 834,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Sh',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'UAH' => 
      array (
        'name' => 'Hryvnia',
        'code' => 980,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '₴',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'UGX' => 
      array (
        'name' => 'Uganda Shilling',
        'code' => 800,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'USh',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'USD' => 
      array (
        'name' => 'US Dollar',
        'code' => 840,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'UYU' => 
      array (
        'name' => 'Peso Uruguayo',
        'code' => 858,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'UZS' => 
      array (
        'name' => 'Uzbekistan Sum',
        'code' => 860,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'лв',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'VEF' => 
      array (
        'name' => 'Bolivar',
        'code' => 937,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Bs F',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'VES' => 
      array (
        'name' => 'Bolívar Soberano',
        'code' => 928,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Bs S',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'VED' => 
      array (
        'name' => 'Dijital Bolívar',
        'code' => 926,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'Bs D',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'VND' => 
      array (
        'name' => 'Dong',
        'code' => 704,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => '₫',
        'symbol_first' => true,
        'decimal_mark' => ',',
        'thousands_separator' => '.',
      ),
      'VUV' => 
      array (
        'name' => 'Vatu',
        'code' => 548,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Vt',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'WST' => 
      array (
        'name' => 'Tala',
        'code' => 882,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'T',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XAF' => 
      array (
        'name' => 'CFA Franc BEAC',
        'code' => 950,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XAG' => 
      array (
        'name' => 'Silver',
        'code' => 961,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'oz t',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XAU' => 
      array (
        'name' => 'Gold',
        'code' => 959,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'oz t',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XCD' => 
      array (
        'name' => 'East Caribbean Dollar',
        'code' => 951,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XDR' => 
      array (
        'name' => 'SDR (Special Drawing Right)',
        'code' => 960,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'SDR',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XOF' => 
      array (
        'name' => 'CFA Franc BCEAO',
        'code' => 952,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'XPF' => 
      array (
        'name' => 'CFP Franc',
        'code' => 953,
        'precision' => 0,
        'subunit' => 1,
        'symbol' => 'Fr',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'YER' => 
      array (
        'name' => 'Yemeni Rial',
        'code' => 886,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '﷼',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ZAR' => 
      array (
        'name' => 'Rand',
        'code' => 710,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'R',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ZMW' => 
      array (
        'name' => 'Zambian Kwacha',
        'code' => 967,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => 'ZK',
        'symbol_first' => false,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
      'ZWL' => 
      array (
        'name' => 'Zimbabwe Dollar',
        'code' => 932,
        'precision' => 2,
        'subunit' => 100,
        'symbol' => '$',
        'symbol_first' => true,
        'decimal_mark' => '.',
        'thousands_separator' => ',',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'connection' => NULL,
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'batching' => 
    array (
      'database' => 'mysql',
      'table' => 'job_batches',
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'services' => 
  array (
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
    'resend' => 
    array (
      'key' => NULL,
    ),
    'slack' => 
    array (
      'notifications' => 
      array (
        'bot_user_oauth_token' => NULL,
        'channel' => NULL,
      ),
    ),
    'google' => 
    array (
      'client_id' => '633637772556-s7nr7a9a611rn9t8psu6hfep5m0vpchq.apps.googleusercontent.com',
      'client_secret' => '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',
      'redirect' => 'http://localhost:8000/auth/google/callback',
    ),
  ),
  'session' => 
  array (
    'driver' => 'database',
    'lifetime' => 120,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'C:\\laragon\\www\\rent-vehi\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'rentkuy_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
    'partitioned' => false,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'reverb' => 
      array (
        'driver' => 'reverb',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'host' => NULL,
          'port' => 443,
          'scheme' => 'https',
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
          'cluster' => NULL,
          'host' => 'api-mt1.pusher.com',
          'port' => 443,
          'scheme' => 'https',
          'encrypted' => true,
          'useTLS' => true,
        ),
        'client_options' => 
        array (
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'concurrency' => 
  array (
    'default' => 'process',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => '12',
      'verify' => true,
      'limit' => NULL,
    ),
    'argon' => 
    array (
      'memory' => 65536,
      'threads' => 1,
      'time' => 4,
      'verify' => true,
    ),
    'rehash_on_login' => true,
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'C:\\laragon\\www\\rent-vehi\\resources\\views',
    ),
    'compiled' => 'C:\\laragon\\www\\rent-vehi\\storage\\framework\\views',
  ),
  'filament-export' => 
  array (
    'default_format' => 'xlsx',
    'time_format' => 'M_d_Y-H_i',
    'default_page_orientation' => 'portrait',
    'disable_additional_columns' => false,
    'disable_filter_columns' => false,
    'disable_file_name' => false,
    'disable_file_name_prefix' => false,
    'disable_preview' => false,
    'use_snappy' => false,
    'action_icon' => 'heroicon-o-arrow-down-on-square',
    'preview_icon' => 'heroicon-o-eye',
    'export_icon' => 'heroicon-o-arrow-down-on-square',
    'print_icon' => 'heroicon-o-printer',
    'cancel_icon' => 'heroicon-o-x-circle',
  ),
  'filament-currency' => 
  array (
    'default_currency' => 'USD',
    'default_convert' => false,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => 'C:\\laragon\\www\\rent-vehi\\storage\\fonts',
      'font_cache' => 'C:\\laragon\\www\\rent-vehi\\storage\\fonts',
      'temp_dir' => 'C:\\Users\\daven\\AppData\\Local\\Temp',
      'chroot' => 'C:\\laragon\\www\\rent-vehi',
      'allowed_protocols' => 
      array (
        'data://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'artifactPathValidation' => NULL,
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => false,
      'allowed_remote_hosts' => NULL,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'blade-heroicons' => 
  array (
    'prefix' => 'heroicon',
    'fallback' => '',
    'class' => '',
    'attributes' => 
    array (
    ),
  ),
  'blade-icons' => 
  array (
    'sets' => 
    array (
    ),
    'class' => '',
    'attributes' => 
    array (
    ),
    'fallback' => '',
    'components' => 
    array (
      'disabled' => false,
      'default' => 'icon',
    ),
  ),
  'filament' => 
  array (
    'broadcasting' => 
    array (
    ),
    'default_filesystem_disk' => 'public',
    'assets_path' => NULL,
    'cache_path' => 'C:\\laragon\\www\\rent-vehi\\bootstrap/cache/filament',
    'livewire_loading_delay' => 'default',
    'system_route_prefix' => 'filament',
  ),
  'livewire' => 
  array (
    'class_namespace' => 'App\\Livewire',
    'view_path' => 'C:\\laragon\\www\\rent-vehi\\resources\\views/livewire',
    'layout' => 'components.layouts.app',
    'lazy_placeholder' => NULL,
    'temporary_file_upload' => 
    array (
      'disk' => NULL,
      'rules' => NULL,
      'directory' => NULL,
      'middleware' => NULL,
      'preview_mimes' => 
      array (
        0 => 'png',
        1 => 'gif',
        2 => 'bmp',
        3 => 'svg',
        4 => 'wav',
        5 => 'mp4',
        6 => 'mov',
        7 => 'avi',
        8 => 'wmv',
        9 => 'mp3',
        10 => 'm4a',
        11 => 'jpg',
        12 => 'jpeg',
        13 => 'mpga',
        14 => 'webp',
        15 => 'wma',
      ),
      'max_upload_time' => 5,
      'cleanup' => true,
    ),
    'render_on_redirect' => false,
    'legacy_model_binding' => false,
    'inject_assets' => true,
    'navigate' => 
    array (
      'show_progress_bar' => true,
      'progress_bar_color' => '#2299dd',
    ),
    'inject_morph_markers' => true,
    'pagination_theme' => 'tailwind',
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
