<?php 
namespace Purin\LineLogin;

use Purin\LineLogin\Tool;

class OAuthController{

    private $configManager;

    const BASEURL = "https://api.line.me/oauth2/v2.1/";

    public function __construct(ConfigManager $configManager){
        $this->configManager = $configManager;
    }

    /**
     * 取得用戶端 Access Token
     *
     * @see https://developers.line.biz/en/reference/line-login/#issue-access-token
     * @param $code
     * @return string
     */
    public function getAccessToken($code){
        $config = $this->configManager->getConfigs();
        $param = [
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $config[ $this->configManager::CLIENT_REDIRECT_URI  ],
            'client_id' => $config[ $this->configManager::CLIENT_ID ],
            'client_secret' => $config[ $this->configManager::CLIENT_SECRET ],
        ];

        $url = self::BASEURL."token";
        $info = Tool::curl($url, $param);
        if(isset($info->error)) throw new Exception($info);

        return $info->access_token;
    }

    /**
     * 驗證用戶Token Verify Token
     *
     * @see https://developers.line.biz/en/reference/line-login/#verify-access-token
     * @param $token
     * @param $detail
     * @return string
     */
    public function VerifyAccessToken($token, $detail=false){
        $config = $this->configManager->getConfigs();
        $param = [
            'access_token' => $token
        ];

        $url = self::BASEURL."verify";
        $info = Tool::curl($url, $param, 'GET');
        if($detail) return $info; 
        return isset($info->error) ? false : true;
    }

    /**
     * 重配用戶Token Refresh Token
     *
     * @see https://developers.line.biz/en/reference/line-login/#refresh-access-token
     * @param $token
     * @return string
     */
    public function RefreshAccessToken($token){
        $config = $this->configManager->getConfigs();
        $param = [
            'grant_type' => 'refresh_token',
            'refresh_token' => $token,
            'client_id' => $config[ $this->configManager::CLIENT_ID ],
            'client_secret' => $config[ $this->configManager::CLIENT_SECRET ],
        ];

        $url = self::BASEURL."token";
        $info = Tool::curl($url, $param);
        if(isset($info->error)) throw new Exception($info);

        return $info->access_token;
    }

    /**
     * 移除用戶Token Revoke Token
     *
     * @see https://developers.line.biz/en/reference/line-login/#refresh-access-token
     * @param $token
     * @return string
     */
    public function RevokeAccessToken($token){
        $config = $this->configManager->getConfigs();
        $param = [
            'access_token' => $token,
            'client_id' => $config[ $this->configManager::CLIENT_ID ],
            'client_secret' => $config[ $this->configManager::CLIENT_SECRET ],
        ];

        $url = self::BASEURL."verify";
        $info = Tool::curl($url, $param);
        if(isset($info->error)) throw new Exception($info);
        return $info;
    }

    /**
     * 驗證用戶 ID Token Verify ID token
     *
     * @see https://developers.line.biz/en/reference/line-login/#verify-id-token
     * @param $token
     * @return string
     */
    public function VerifyIDToken($token, $detail=false){
        $config = $this->configManager->getConfigs();
        $param = [
            'access_token' => $token,
            'client_id' => $config[ $this->configManager::CLIENT_ID ],
            'client_secret' => $config[ $this->configManager::CLIENT_SECRET ],
        ];

        $url = self::BASEURL."verify";
        $info = Tool::curl($url, $param);
        if(isset($info->error)){
            print_r($info);
        }
        
        if($detail) return $info; 
        return isset($info->error) ? false : true;
    }

}