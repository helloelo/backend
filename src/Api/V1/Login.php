<?php

namespace Helloelo\Api\V1;

use Helloelo\Entity\Organization;
use Helloelo\Entity\Player;
use Helloelo\Entity\Session;
use Yaoi\Command;
use Yaoi\Command\Definition;

class Login extends Command
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
            //$url = 'https://accounts.google.com/o/oauth2/token';
            $url = 'https://www.googleapis.com/oauth2/v4/token';

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
            $token = file_get_contents($url, false, $context);
            $tokenHeaders = $http_response_header;
            $jsonToken = json_decode($token, true);
            //trigger_error($result);

            //https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=youraccess_token
            $info = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token='
                . $jsonToken['access_token']);

            //trigger_error($info);

            $jsonInfo = json_decode($info, true);
            /*
             * {
 "id": "100745951330300743111",
 "email": "vearutop@gmail.com",
 "verified_email": true,
 "name": "Vea Rooftop",
 "given_name": "Vea",
 "family_name": "Rooftop",
 "link": "https://plus.google.com/+VeaRooftop",
 "picture": "https://lh4.googleusercontent.com/-IWvYl6hP4nU/AAAAAAAAAAI/AAAAAAAADc8/8EQx-BHK_vI/photo.jpg",
 "gender": "male",
 "locale": "ru"
}
             */
            $email = $jsonInfo['email'];
            $organizationDomain = explode('@', $email);
            $organizationDomain = $organizationDomain[1];

            $organization = new Organization();
            $organization->name = $organizationDomain;
            $organization->domain = $organizationDomain;
            $organization->findOrSave();

            $player = new Player();
            $player->name = $jsonInfo['name'];
            $player->picture = $jsonInfo['picture'];
            $player->email = $email;
            $player->fkOrganization = $organization->idOrganization;
            $player->findOrSave();

            $session = new Session();
            $session->token = md5(microtime(1));
            $session->playerId = $player->idPlayer;
            $session->save();

            setcookie(AuthRequired::TOKEN, $session->token, time() + 60 * 60 * 24 * 30, '/');

            $result = Init::makeResponse($player, $organization);
            $result['token'] = $jsonToken;
            $result['info'] = $jsonInfo;
            $result['token_headers'] = $tokenHeaders;
            $result['token_raw'] = $token;
            $result['info_raw'] = $info;
            return $result;
        } else {
            $url = 'https://accounts.google.com/o/oauth2/v2/auth?';
            $query = array(
                'response_type' => 'code',
                'client_id' => self::$clientId,
                'redirect_uri' => 'http://helloelo.tk/v1/login',
                'scope' => 'email profile',
                'prompt' => 'select_account',
            );
            $url .= http_build_query($query);
            header("Location: " . $url);
            exit();
        }
    }


}