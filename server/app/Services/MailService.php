<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send;
class MailService
{
	/**
	 * @param $config {object} - 寄信設定
	 * @param $data {object} - 寄信樣版使用資料
	 * @param $config.mail_to {array} - 收件人陣列
	 * @param $config.template {string} - 寄信樣版
	 * @param $config.form_name {string} - 寄件人名稱
	 * @param $config.form_mail {string} - 寄件人Email
	 * @param $config.subject {string} - 信件標題
	 *
	 */
	public function send($config, $data)
	{
		Mail::to($config['mail_to'])->send(new Send($config, $data));
	}
}
?>