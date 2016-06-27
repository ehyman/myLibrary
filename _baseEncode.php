<?php
/**
 * 基础加密解密类
 * User: HymanShi
 * Date: 2015/1/20
 * Time: 8:57
 */
class _baseEncode {
    /**
     * 加密密钥
     * @var string
     */
    private static $secret_key = '1ef704ce164f7b19df03c97c7b0b1d7f';

    /**
     * @var null
     */
    private static $_encode_handle = NULL;
	
	private function __construct()
	{
		
	}
	
	//单例获取实例
	static public function getInstance($secret_key = '')
	{
		if( NULL === self::$_encode_handle ) {
			self::$_encode_handle = new self();
		}

		if(!empty($secret_key)) {
			self::_setSecret($secret_key);
		}

		return self::$_encode_handle;
	}

    /**
     * 设置密钥
     * @param $secret_key
     */
    static private function _setSecret($secret_key)
    {
        self::$secret_key = md5( $secret_key );
    }

    /**
     * 加密
     * @param $encrypt
     * @return mixed
     */
     public function encrypt($encrypt) {
         $iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND );
         $encrypted = mcrypt_encrypt ( MCRYPT_RIJNDAEL_256, self::$secret_key, $encrypt, MCRYPT_MODE_ECB, $iv );
         $encode = base64_encode ( $encrypted );
         return $encode;
     }

    /**
     * 解密
     * @param $decrypt
     * @return mixed
     */
    public function decrypt($decrypt) {
        $decoded = base64_decode ( $decrypt );
        $iv = mcrypt_create_iv ( mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB ), MCRYPT_RAND );
        $decrypted = mcrypt_decrypt ( MCRYPT_RIJNDAEL_256, self::$secret_key, $decoded, MCRYPT_MODE_ECB, $iv );
        return $decrypted;
    }

	public function __clone()
	{
		trigger_error('Clone is not allow' ,E_USER_ERROR);
	}
}
