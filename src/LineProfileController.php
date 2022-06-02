<?php
namespace Purin\LineLogin;

use Purin\LineLogin\OAuthController;

class LineProfileController{
    private $configManager;

    const BASEURL = 'https://api.line.me/v2/';

    public function __construct(ConfigManager $configManager){
        $this->configManager = $configManager;
    }

    /**
     * 取得User資料 Get User Profile
     *
     * @see https://developers.line.biz/en/reference/line-login/#get-user-profile
     * @param $token
     * @return string
     */
    public function getUserprofile($token){
        $config = $this->configManager->getConfigs();
        $param = [
            'access_token' => $token,
            'client_id' => $config[ $this->configManager::CLIENT_ID ],
            'client_secret' => $config[ $this->configManager::CLIENT_SECRET ],
        ];

        $header = ["Authorization: Bearer ".$token];

        $url = self::BASEURL."profile";
        $info = Tool::curl($url, $param, 'GET', $header);
        if(isset($info->error)){
            throw new Exception($info);
        }
        return $info;
    }

}