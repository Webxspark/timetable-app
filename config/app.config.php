<?php
$dir_tmp = '';
if (!isset($use) || !$use) {
    $use = '';
}
if (!isset($use_dir) || !$use_dir) {
    $use_dir = '';
}
if ($use) {
    if ($use === "ajax" || $use === "App") {
        $dir_tmp = $use_dir;
    }
}
if ($use_dir) {
    $config_json = file_get_contents($dir_tmp);
} else {
    $config_json = file_get_contents('../app.config.json');
}

$APP_CONFIG = $_App = json_decode($config_json, true);
define('config_loaded', true);
/*INFO CONFIG*/
define("APP_VERSION",$APP_CONFIG['version']);
define("APP_TITLE",$APP_CONFIG['info']['title']);
define("LOGO",$APP_CONFIG['info']['logo']);
define("SUPPORT",$APP_CONFIG['info']['support']);
define('ENC_ROUTE', $APP_CONFIG['enc_route']);

/*ENCRYPTION CONFIG*/
define("DATABASE_ENC",$APP_CONFIG['encryptions']['database']);
define("EMAIL_ENC",$APP_CONFIG['encryptions']['email_bot']);

/*COOKIE_NAME CONFIG*/
define("TAG",$APP_CONFIG['cookie_key_names']['tag']);
define("USERNAME",$APP_CONFIG['cookie_key_names']['username']);
define("EMAIL",$APP_CONFIG['cookie_key_names']['user_email']);

/*DATABASE CONFIG*/
define("DB_HOST",$APP_CONFIG['database_config']['db_host']);
define("DB_NAME",$APP_CONFIG['database_config']['db_name']);
define("DB_USER",$APP_CONFIG['database_config']['db_user']);
define("DB_PASS",$APP_CONFIG['database_config']['db_pass']);