<?php
class LineNotifyLib
{
    private $_CLIENT_ID;
    private $_CLIENT_SECRET;
    private $_CALLBACK_URL;
    private $_STATE_KEY = 'random_state_str';
     
    public function __construct($_CLIENT_ID,$_CLIENT_SECRET,$_CALLBACK_URL)
    {
        $this->_CLIENT_ID = $_CLIENT_ID;
        $this->_CLIENT_SECRET = $_CLIENT_SECRET;
        $this->_CALLBACK_URL = $_CALLBACK_URL;
    }   
 
    public function authorizeLineNotify()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
         
        $_SESSION[$this->_STATE_KEY] = $this->randomToken();
 
        $url = "https://notify-bot.line.me/oauth/authorize?".
            http_build_query(array(
                'response_type' => 'code',
                'client_id' => $this->_CLIENT_ID,
                'redirect_uri' => $this->_CALLBACK_URL,
                'scope' => 'notify',
                'state' => $_SESSION[$this->_STATE_KEY]
            )
        );
        if(!header("Location: {$url}")){
            echo '<meta http-equiv="refresh" content="0;URL=$url">';
        }
    }
     
    public function requestAccessToken($params, $returnResult = NULL, $ssl = NULL)
    {
        $_SSL_VERIFYHOST = (isset($ssl))?2:0;
        $_SSL_VERIFYPEER = (isset($ssl))?1:0;
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
             
        if(!isset($_SESSION[$this->_STATE_KEY]) || $params['state'] !== $_SESSION[$this->_STATE_KEY]){
            if(isset($_SESSION[$this->_STATE_KEY])){ unset($_SESSION[$this->_STATE_KEY]); }
            return false;
        }
         
        if(isset($_SESSION[$this->_STATE_KEY])){ unset($_SESSION[$this->_STATE_KEY]); }
         
        $code = $params['code'];
        $tokenURL = "https://notify-bot.line.me/oauth/token";
          
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded'
        );
        $data = array(
            'grant_type' => 'authorization_code',
            'code' => (string)$code,
            'redirect_uri' => $this->_CALLBACK_URL,
            'client_id' => $this->_CLIENT_ID,
            'client_secret' => $this->_CLIENT_SECRET              
        );
         
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $tokenURL);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, $_SSL_VERIFYHOST);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, $_SSL_VERIFYPEER);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close( $ch );
         
        $result = json_decode($result,TRUE);
 
        if(!is_null($result) && array_key_exists('status',$result)){
            if(is_null($returnResult)){
                if($result['status']==200){
                    return $result['access_token'];
                }else{
                    return NULL;    
                }
            }else{
                return $result;     
            }
        }else{
            return NULL;    
        }       
    }
     
    public function sendLineNotify($accessToken, $data, $returnResult = NULL, $ssl = NULL)
    {
        $_SSL_VERIFYHOST = (isset($ssl))?2:0;
        $_SSL_VERIFYPEER = (isset($ssl))?1:0;
        $accToken = $accessToken;
        $notifyURL = "https://notify-api.line.me/api/notify";
         
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$accToken
        );
             
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $notifyURL);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, $_SSL_VERIFYHOST);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, $_SSL_VERIFYPEER);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close( $ch );
 
        $result = json_decode($result,TRUE);
 
        if(!is_null($result) && array_key_exists('status',$result)){
            if(is_null($returnResult)){
                if($result['status']==200){
                    return true;    
                }else{
                    return NULL;    
                }
            }else{
                return $result;     
            }
        }else{
            return NULL;    
        }
    }
     
    public function statusToken($accessToken, $returnResult = NULL, $ssl = NULL)
    {
        $_SSL_VERIFYHOST = (isset($ssl))?2:0;
        $_SSL_VERIFYPEER = (isset($ssl))?1:0;
        $accToken = $accessToken;
        $statusURL = "https://notify-api.line.me/api/status";
         
        $headers = array(
            'Authorization: Bearer '.$accToken
        );
         
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $statusURL);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, $_SSL_VERIFYHOST);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, $_SSL_VERIFYPEER);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close( $ch );
 
        $result = json_decode($result,TRUE);
 
        if(!is_null($result) && array_key_exists('status',$result)){
            if(is_null($returnResult)){
                if($result['status']==200){
                    return true;    
                }else{
                    return NULL;    
                }
            }else{
                return $result;     
            }
        }else{
            return NULL;    
        }
    }
 
    public function revokeToken($accessToken, $returnResult = NULL, $ssl = NULL)
    {
        $_SSL_VERIFYHOST = (isset($ssl))?2:0;
        $_SSL_VERIFYPEER = (isset($ssl))?1:0;
        $accToken = $accessToken;
        $revokeURL = "https://notify-api.line.me/api/revoke";
         
        $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer '.$accToken
        );
         
        $data = array();
 
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, $revokeURL);
        curl_setopt( $ch, CURLOPT_POST, 1);
        curl_setopt( $ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, $_SSL_VERIFYHOST);
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, $_SSL_VERIFYPEER);
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec( $ch );
        curl_close( $ch );
 
        $result = json_decode($result,TRUE);
 
        if(!is_null($result) && array_key_exists('status',$result)){
            if(is_null($returnResult)){
                if($result['status']==200){
                    return true;    
                }else{
                    return NULL;    
                }
            }else{
                return $result;     
            }
        }else{
            return NULL;    
        }
    }
     
    public function setStateKey($stateKey){
        $this->_STATE_KEY = $stateKey;   
    }
     
    public function randomToken($length = 32)
    {
        if(!isset($length) || intval($length) <= 8 ){
          $length = 32;
        }
        if(function_exists('random_bytes')) {
            return bin2hex(random_bytes($length));
        }
        if(function_exists('mcrypt_create_iv')) {
            return bin2hex(mcrypt_create_iv($length, MCRYPT_DEV_URANDOM));
        } 
        if(function_exists('openssl_random_pseudo_bytes')) {
            return bin2hex(openssl_random_pseudo_bytes($length));
        }
    }
     
}
?>