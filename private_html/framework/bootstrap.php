<?php
define('FW_VER', '0.1.0');
define('FW_NAME', 'VC Framework');

if (version_compare(PHP_VERSION, '5.3.0', '<')) {
  die('PHP 5.3.0 or newer is required.');
}

define('DS', DIRECTORY_SEPARATOR);

define('ROOT', dirname(dirname(__DIR__)));

// Composer support ->
$composer_autoload = ROOT . DS . 'vendor' . DS . 'autoload.php';
if (file_exists($composer_autoload)) {
    require_once $composer_autoload;
}
// <- Composer support

define('PRIV', basename(dirname(__DIR__)));

if (PHP_SAPI === 'cli' || (defined('FAKE_CLI') && FAKE_CLI)) {
  define('PUB', 'public_html');
} else {
  $trace = debug_backtrace();

  $caller = isset($trace[0]['file'])
    ? $trace[0]['file']
    : null;

  define(
    'PUB',
    $caller !== null
      ? basename(dirname($caller))
      : 'public_html'
  );
}

define('FW', basename(__DIR__));

define('APP', 'app');

if ( ! file_exists(ROOT . DS . PRIV . DS . APP)) {
  die('The ' . APP . ' directory does not exist.');
}

define('LOG', 'log');

if ( ! file_exists(ROOT . DS . PRIV . DS . LOG)) {
  die('The ' . LOG . ' directory does not exist.');
}

define('CONFIG', 'config');

if ( ! file_exists(ROOT . DS . PRIV . DS . APP . DS . CONFIG)) {
  die('The ' . CONFIG . ' directory does not exist.');
}

foreach (glob(ROOT . DS . PRIV . DS . APP . DS . CONFIG . DS . '*.php') as $file) {
  if (substr($file, -11) === '-sample.php') {
    continue;
  }

  require_once $file;
}

ini_set('log_errors', '1');

ini_set(
  'error_log',
  ROOT . DS . PRIV . DS . LOG . DS . 'error_log'
);

if (defined('APP_ENV') && APP_ENV === 'prod') {
  ini_set('display_errors', '0');
} else {
  ini_set('display_errors', '1');
}

function db()
{
  static $db = null;

  if ($db instanceof mysqli) {
    return $db;
  }

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  $db = new mysqli(
    DB_HOST,
    DB_USER,
    DB_PASS,
    DB_NAME
  );

  $db->set_charset(DB_CHAR);

  $db->query("SET time_zone = '" . DB_TIME . "'");

  return $db;
}

if (defined('APP_TZ')) {
  date_default_timezone_set(APP_TZ);
}

if (PHP_SAPI !== 'cli' && (!defined('FAKE_CLI') || !FAKE_CLI)) {
  if (session_id() === '') {
    session_start();
  }

  require_once ROOT . DS . PRIV . DS . FW . DS . 'router.php';
}
