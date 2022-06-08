<?php 

use PHPUnit\Framework\TestCase;
use Purin\LineLogin\ConfigManager;

// use Dotenv\dotenv;

class ConfigManagerTest extends TestCase{
    public function testSetData(){
        $cm = new ConfigManager();
        $config = $cm->getConfigs();

        $this->assertSame($_ENV['line_client_id'],$config[$cm::CLIENT_ID]);
        $this->assertSame($_ENV['line_client_secret'],$config[$cm::CLIENT_SECRET]);
        $this->assertSame($_ENV['line_scope'],$config[$cm::CLIENT_SCOPE]);
        $this->assertSame($_ENV['line_redirect_uri'],$config[$cm::CLIENT_REDIRECT_URI]);
        
    }
}
