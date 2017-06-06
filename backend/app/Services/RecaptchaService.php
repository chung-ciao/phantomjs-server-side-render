<?php

namespace App\Services;

class RecaptchaService
{
	private $secret_key;

	public function __construct() {
		$config = app('App\Http\Controllers\Admin\ConfigController')
			->getProperty('site_config', 'recaptcha_secret_key');
		$this->secret_key = json_decode($config)->recaptcha_secret_key;
	}

	/**
	 * @return {boolean} - 是否通過recaptcha驗證
	 * @param $recaptcha_response {string} - recaptcha response
	 */
	public function validate($recaptcha_response) {
		$recaptcha = new \ReCaptcha\ReCaptcha($this->secret_key);
		$result = $recaptcha->verify($recaptcha_response);
		return $result->isSuccess();
	}
}