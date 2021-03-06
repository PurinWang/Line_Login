<?php 
/**
 *  Line 設定檔 管理器
 */

namespace Purin\LineLogin;

use Dotenv\dotenv;

class ConfigManager {

    private $config;

    const CLIENT_ID = 'client_id';

    const CLIENT_SECRET = 'client_secret';
    
    const CLIENT_SCOPE = 'client_scope';

    const CLIENT_REDIRECT_URI = 'redirect_uri';

    public function __construct(){
        $dotenv = Dotenv::createImmutable(__DIR__."/../");
        $dotenv->load();
        
        $this->config[ self::CLIENT_ID ] = $_ENV['line_client_id'] ? $_ENV['line_client_id'] : "";
        $this->config[ self::CLIENT_SECRET ] = $_ENV['line_client_secret'] ? $_ENV['line_client_secret'] : "";
        $this->config[ self::CLIENT_SCOPE ] = $_ENV['line_scope'] ? $_ENV['line_scope'] : "";
        $this->config[ self::CLIENT_REDIRECT_URI ] = $_ENV['line_redirect_uri'] ? $_ENV['line_redirect_uri'] : "";
    }

    public function setClientId($id) {
        $this->config[ self::CLIENT_ID ] = $id;
        return $this;
    }

    public function setClientSecret($secret) {
        $this->config[ self::CLIENT_SECRET ] = $secret;
        return $this;
    }

    public function setScope($scope) {
        $this->config[ self::CLIENT_SCOPE ] = $scope;
        return $this;
    }

    public function setRedirectUri($uri) {
        $this->config[ self::CLIENT_REDIRECT_URI ]= $uri;
        return $this;
    }
    /**
     * @return array
     */
    public function getConfigs() {
        return $this->config;
    }

}