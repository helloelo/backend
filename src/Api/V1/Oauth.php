<?php

namespace Helloelo\Api\V1;

use Yaoi\Command;
use Yaoi\Command\Definition;

class Oauth extends Command
{
    public static $clientId;
    public static $clientSecret;
    public static $redirectUrl;

    static function setUpDefinition(Definition $definition, $options)
    {
    }

    public function performAction()
    {
        if (isset($_GET['code'])) {
            $url = 'https://accounts.google.com/o/oauth2/token';
            //$url = 'https://www.googleapis.com/oauth2/v4/token';

            /*
             * POST /oauth2/v4/token HTTP/1.1
Host: www.googleapis.com
Content-Type: application/x-www-form-urlencoded

code=4/P7q7W91a-oMsCeLvIaQm6bTrgtp7&
client_id=8819981768.apps.googleusercontent.com&
client_secret={client_secret}&
redirect_uri=https://oauth2-login-demo.appspot.com/code&
grant_type=authorization_code
             */
            $post = array(
                'code' => $_GET['code'],
                'client_id' => self::$clientId,
                'client_secret' => self::$clientSecret,
                'redirect_url' => self::$redirectUrl,
                'grant_type' => 'authorization_code',
            );
            $opts = array('http' =>
                array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => http_build_query($post)
                )
            );
            $context = stream_context_create($opts);
            $result = file_get_contents($url, false, $context);
            trigger_error($result);
            return $result;
        }

        return array('bich' => 'one', 'get' => $_GET);
    }


}