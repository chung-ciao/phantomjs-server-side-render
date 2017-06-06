<?php

namespace App\Services;

use JWTAuth;
use JWTFactory;
use PayloadFactory;
class JwtService
{
	/**
	 * 建立JWT Token
	 *
	 * @return {object} - JWT Token
	 * @param {object} $credentials - 用來產生token的使用者資訊
	 * @param {object} $customClaims - 自訂欄位, 預設為null
	 */
	public function createToken($credentials, $customClaims = null)
	{
		if($customClaims == null) {
			$token = JWTAuth::fromUser($credentials);
		}
		
		else {
			$token = JWTAuth::fromUser($credentials, $customClaims);
		}
		return $token;
	}

	/**
	 * 取得token中的資訊
	 *
	 * @return {object} - token中指定欄位的資訊
	 * @param {string} $key - 欄位名稱
	 */
	public function getInfo($key)
	{
		return JWTAuth::decode(JWTAuth::getToken())[$key];
	}

	/**
	 * 更新token
	 *
	 * @return {object} - 更新完成的token
	 */
	public function refreshToken()
	{
		$user = $this->getInfo('user');
    $userInfo = ['user' => $user];
    $token = $this->createToken((object)$user, $userInfo);
		return $token;
	}
}