<?php
/*Getting user agent info*/
$user_agent = $_SERVER['HTTP_USER_AGENT'];

class webxspark_admin
{
    public function get_uri()
    {
        return $uri = $_SERVER['REQUEST_URI'];
    }
    public function getLink()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = "https://";
        } else {
            $url = "http://";
        }
        // Append the host(domain name, ip) to the URL.
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $url .= $_SERVER['REQUEST_URI'];

        return $url;
    }
    static function randomize_bg(){
        $c_array = ["bg-red","bg-green","bg-yellow","bg-purple","bg-orange","bg-pink"];
        $random = array_rand($c_array,1);
        return $c_array[$random];
    }
    public function minifyText($text, $length)
    {
        return substr($text, 0, $length) . ((strlen($text) > $length) ? "...&nbsp;" : "");
    }
    public function generate_security_fragment()
    {
        return [
            'device' => [
                "OS" => $this::getOS(),
                "client" => [
                    'browser' => $this::getBrowser(),
                    'userAgent' => $this::getUserAgentInfo()
                ]
            ],
            'network' => [
                'ip' => $this::fetch_ip(),
                'event' => [
                    'timestamp' => $this::getCurrentTime()
                ]
            ]
        ];
    }
    public function slug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }
    public function encrypt_str($string)
    {
        return $string = openssl_encrypt($string, "AES-128-ECB", ENC_ROUTE);
    }
    public function decrypt_str($string)
    {
        return $string = openssl_decrypt($string, "AES-128-ECB", ENC_ROUTE);
    }
    public function replace($to_replace_word, $replace_word_with, $string)
    {
        return $string = str_replace($to_replace_word, $replace_word_with, $string);
    }
    public function set_cookie($cookie_name, $cookie_value)
    {
        setcookie("$cookie_name", $cookie_value, time() + 876000000, '/', false, true); //Cookies validity: 100Years
    }
    public function unset_cookie($cookie_name, $cookie_value)
    {
        setcookie("$cookie_name", $cookie_value, time() - 876000000, '/', false, true); //Cookies validity: 100Years
    }
    public function set_cookie_custom($cookie_name, $cookie_value, $duration)
    {
        setcookie("$cookie_name", $cookie_value, time() + $duration, '/', false, true);
    }
    public function format_date($database_date)
    {
        $date = date_create($database_date);
        return date_format($date, "d F Y ");
    }
    public function generate_license($suffix = null)
    {
        // Default tokens contain no "ambiguous" characters: 1,i,0,o
        if (isset($suffix)) {
            // Fewer segments if appending suffix
            $num_segments = 3;
            $segment_chars = 6;
        } else {
            $num_segments = 4;
            $segment_chars = 5;
        }
        $tokens = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $license_string = '';
        // Build Default License String
        for ($i = 0; $i < $num_segments; $i++) {
            $segment = '';
            for ($j = 0; $j < $segment_chars; $j++) {
                $segment .= $tokens[rand(0, strlen($tokens) - 1)];
            }
            $license_string .= $segment;
            if ($i < ($num_segments - 1)) {
                $license_string .= '-';
            }
        }
        // If provided, convert Suffix
        if (isset($suffix)) {
            if (is_numeric($suffix)) {   // Userid provided
                $license_string .= '-' . strtoupper(base_convert($suffix, 10, 36));
            } else {
                $long = sprintf("%u\n", ip2long($suffix), true);
                if ($suffix === long2ip($long)) {
                    $license_string .= '-' . strtoupper(base_convert($long, 10, 36));
                } else {
                    $license_string .= '-' . strtoupper(str_ireplace(' ', '-', $suffix));
                }
            }
        }
        return $license_string;
    }
    public function time_elapsed_string($datetime, $full = false)
    {
        date_default_timezone_set('Asia/Kolkata');
        $now  = new DateTime;
        $ago  = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            $string = array_slice($string, 0, 1);
        }

        return $string ? implode(', ', $string) . ' ago' : 'Just now';
    }
    public function getSingleOutputIndexDb($conn, $where_condition, $bind_param_obj, $db, $index)
    {
        $sql  = "SELECT * FROM $db WHERE $where_condition=? LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $bind_param_obj);
        $stmt->execute();
        $result = $stmt->get_result();
        $count  = $result->num_rows;
        if ($count > 0) {
            $row = mysqli_fetch_assoc($result);
            return $row[$index];
        } else {
            return 0;
        }
    }
    public function getObjCountFromDb($conn, $db, $tbl, $object, $custom_andSelectorQuery = '')
    {
        $sql  = "SELECT * FROM $db WHERE $tbl=? $custom_andSelectorQuery";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $object);
        $stmt->execute();
        $tmp_res = $stmt->get_result();
        return $tmp_res->num_rows;
    }
    public function generate_random_strings($length_int)
    {
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($str_result), 0, $length_int);
    }
    public function update_single_val_db($conn, $db, $tbl, $ref_tbl, $ref_obj, $newObj)
    {
        $sql  = "UPDATE $db SET $tbl=? WHERE $ref_tbl= '$ref_obj' ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $newObj);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function getSingleOutputDb($conn, $db, $tbl, $ref_obj)
    {
        $sql  = "SELECT * FROM $db WHERE $tbl= '$ref_obj' LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $out    = mysqli_fetch_assoc($result);
        return $out;
    }
    public function check_login_status()
    {
        if (!isset($_COOKIE[TAG]) && !isset($_COOKIE[USERNAME]) && !isset($_COOKIE[EMAIL])) {
            return 0;
        } elseif (!isset($_SESSION[TAG]) && !isset($_SESSION[USERNAME]) && !isset($_SESSION[EMAIL])) {
            //set session var from cookies
            $_SESSION[TAG]           = $_COOKIE[TAG];
            $_SESSION[USERNAME]         = $_COOKIE[USERNAME];
            $_SESSION[EMAIL]        = $_COOKIE[EMAIL];
            return 1;
        } else {
            return 1;
        }
    }
    public function getJsonArray($dir)
    {
        $contents = file_get_contents($dir);
        return json_decode($contents, true);
    }
    public function create_file($file, $dir)
    {
        if (!file_exists($dir)) {
            $fp = fopen($dir, 'w');
            fwrite($fp, $file);
            fclose($fp);
            return true;
        } else {
            return 0;
        }
    }
    public static function todays_date()
    {
        return date('d/m/Y');
    }
    public static function open_file($dir)
    {
        return file_get_contents($dir);
    }
    public static function spit_words_to_array($string)
    {
        return explode(' ', $string);
    }
    public function update_file($file, $dir)
    {
        if (file_exists($dir)) {
            if (file_put_contents($dir, $file)) {
                return true;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }
    public function is_json($string, $return_data = false)
    {
        $data = json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE) ? ($return_data ? $data : true) : false;
    }
    public static function getOS()
    {

        global $user_agent;

        $os_platform = "Unknown OS Platform";

        $os_array = array(
            '/windows nt 11/i'      => 'Windows 11',
            '/windows nt 10/i'      => 'Windows 10',
            '/windows nt 6.3/i'     => 'Windows 8.1',
            '/windows nt 6.2/i'     => 'Windows 8',
            '/windows nt 6.1/i'     => 'Windows 7',
            '/windows nt 6.0/i'     => 'Windows Vista',
            '/windows nt 5.2/i'     => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i'     => 'Windows XP',
            '/windows xp/i'         => 'Windows XP',
            '/windows nt 5.0/i'     => 'Windows 2000',
            '/windows me/i'         => 'Windows ME',
            '/win98/i'              => 'Windows 98',
            '/win95/i'              => 'Windows 95',
            '/win16/i'              => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i'        => 'Mac OS 9',
            '/linux/i'              => 'Linux',
            '/ubuntu/i'             => 'Ubuntu',
            '/iphone/i'             => 'iPhone',
            '/ipod/i'               => 'iPod',
            '/ipad/i'               => 'iPad',
            '/android/i'            => 'Android',
            '/blackberry/i'         => 'BlackBerry',
            '/webos/i'              => 'Mobile',
        );

        foreach ($os_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $os_platform = $value;
            }
        }

        return $os_platform;
    }
    public static function getBrowser()
    {

        global $user_agent;

        $browser = "Unknown Browser";

        $browser_array = array(
            '/msie/i'      => 'Internet Explorer',
            '/firefox/i'   => 'Firefox',
            '/safari/i'    => 'Safari',
            '/chrome/i'    => 'Chrome',
            '/edge/i'      => 'Edge',
            '/opera/i'     => 'Opera',
            '/netscape/i'  => 'Netscape',
            '/maxthon/i'   => 'Maxthon',
            '/konqueror/i' => 'Konqueror',
            '/mobile/i'    => 'Handheld Browser',
        );

        foreach ($browser_array as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }

        return $browser;
    }
    public static function getUserAgentInfo()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }
    public static function getCurrentTime()
    {
        return date('d-m-Y h:i:s A');
    }
    public static function url_view($string)
    {
        $url = '/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/';

        return preg_replace($url, '<a href="$0" target="_blank" rel="nofollow noreferrer noopener" title="$0">$0</a>', $string);
    }
    public static function fetch_ip()
    {
        //whether ip is from the share internet
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the remote address
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    public function listDir($path)
    {
        $dir  = new DirectoryIterator($path);
        $json = [];
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                $data = $fileinfo->getFilename();
                array_push($json, $data);
            }
        }
        return $json;
    }
    public function checkDir($dirs, $toCheck)
    {
        $notfount = [];
        foreach ($toCheck as $tc) {
            if (!in_array($tc, $dirs, 1)) {
                array_push($notfount, $tc);
            }
        }
        return $notfount;
    }
    public function createDir($arr, $targetdir)
    {
        $errors  = [];
        $success = 0;
        foreach ($arr as $x) {
            if (mkdir($targetdir . DIRECTORY_SEPARATOR . $x)) {
                $success = $success + 1;
            } else {
                array_push($errors, 'Something Went wrong while creating directory ' . $x . ' in path ' . $targetdir . '');
            }
        }
        return ([
            "success" => $success,
            "errors"  => $errors,
        ]);
    }
    public function deviceInfo($device_id)
    {
        return [
            'ip'         => $this->fetch_ip(),
            'OS'         => $this::getOS(),
            'browser'    => $this::getBrowser(),
            'user_agent' => $this::getUserAgentInfo(),
            'device_id'  => $device_id,
            'timestamp'  => $this::getCurrentTime(),
        ];
    }
    public function logEventData()
    {
        return [
            'ip'         => $this->fetch_ip(),
            'OS'         => $this::getOS(),
            'browser'    => $this::getBrowser(),
            'user_agent' => $this::getUserAgentInfo(),
            'timestamp'  => $this::getCurrentTime(),
        ];
    }
    public static function HTTPStatus($num)
    {
        $http = array(
            100 => 'HTTP/1.1 100 Continue',
            101 => 'HTTP/1.1 101 Switching Protocols',
            200 => 'HTTP/1.1 200 OK',
            201 => 'HTTP/1.1 201 Created',
            202 => 'HTTP/1.1 202 Accepted',
            203 => 'HTTP/1.1 203 Non-Authoritative Information',
            204 => 'HTTP/1.1 204 No Content',
            205 => 'HTTP/1.1 205 Reset Content',
            206 => 'HTTP/1.1 206 Partial Content',
            300 => 'HTTP/1.1 300 Multiple Choices',
            301 => 'HTTP/1.1 301 Moved Permanently',
            302 => 'HTTP/1.1 302 Found',
            303 => 'HTTP/1.1 303 See Other',
            304 => 'HTTP/1.1 304 Not Modified',
            305 => 'HTTP/1.1 305 Use Proxy',
            307 => 'HTTP/1.1 307 Temporary Redirect',
            400 => 'HTTP/1.1 400 Bad Request',
            401 => 'HTTP/1.1 401 Unauthorized',
            402 => 'HTTP/1.1 402 Payment Required',
            403 => 'HTTP/1.1 403 Forbidden',
            404 => 'HTTP/1.1 404 Not Found',
            405 => 'HTTP/1.1 405 Method Not Allowed',
            406 => 'HTTP/1.1 406 Not Acceptable',
            407 => 'HTTP/1.1 407 Proxy Authentication Required',
            408 => 'HTTP/1.1 408 Request Time-out',
            409 => 'HTTP/1.1 409 Conflict',
            410 => 'HTTP/1.1 410 Gone',
            411 => 'HTTP/1.1 411 Length Required',
            412 => 'HTTP/1.1 412 Precondition Failed',
            413 => 'HTTP/1.1 413 Request Entity Too Large',
            414 => 'HTTP/1.1 414 Request-URI Too Large',
            415 => 'HTTP/1.1 415 Unsupported Media Type',
            416 => 'HTTP/1.1 416 Requested Range Not Satisfiable',
            417 => 'HTTP/1.1 417 Expectation Failed',
            500 => 'HTTP/1.1 500 Internal Server Error',
            501 => 'HTTP/1.1 501 Not Implemented',
            502 => 'HTTP/1.1 502 Bad Gateway',
            503 => 'HTTP/1.1 503 Service Unavailable',
            504 => 'HTTP/1.1 504 Gateway Time-out',
            505 => 'HTTP/1.1 505 HTTP Version Not Supported',
        );

        header($http[$num]);

        return
            array(
                'code'  => $num,
                'error' => $http[$num],
            );
    }
}
class utilities
{
    private function __replace($to_replace_word, $replace_word_with, $string)
    {
        return $string = str_replace($to_replace_word, $replace_word_with, $string);
    }
    private function __replace_extension($filename, $new_extension)
    {
        $info = pathinfo($filename);
        return ($info['dirname'] ? $info['dirname'] . DIRECTORY_SEPARATOR : '')
            . $info['filename']
            . '.'
            . $new_extension;
    }
    public function download_file($url, $filename, $parent_dir, $extension)
    {
        $extension  = $this->__replace('.', '', $extension);
        $newFileDir = $parent_dir . $this->__replace_extension($filename, $extension);
        if (file_put_contents($newFileDir, file_get_contents($url))) {
            return '{"status": 200}';
        } else {
            return '{"status": 0}';
        }
    }
    public function handle_json($json)
    {
        $json_obj = json_decode($json, 1);
        return $json_obj;
    }
    public function getLink()
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $url = "https://";
        } else {
            $url = "http://";
        }
        // Append the host(domain name, ip) to the URL.
        $url .= $_SERVER['HTTP_HOST'];

        // Append the requested resource location to the URL
        $url .= $_SERVER['REQUEST_URI'];

        return $url;
    }
}

class App extends webxspark_admin
{
    public function isBotDetected()
    {
        return (isset($_SERVER['HTTP_USER_AGENT'])
            && preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])
        );
    }
}
