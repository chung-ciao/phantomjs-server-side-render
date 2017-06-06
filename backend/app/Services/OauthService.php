<?php
namespace App\Services;

class OauthService {
  protected $endpoints = [
    'facebook' => 'https://graph.facebook.com/v2.9/me',
    'google' => 'https://www.googleapis.com/oauth2/v2/userinfo',
  ];

	public function getUserInfo($type, $access_token) {
    if(!isset($this->endpoints[$type])) return null;
    $query = '?access_token='.$access_token;

    if($type == 'facebook'){
      $query .= '&fields=id,email,name&format=json';
    }

    $data = file_get_contents($this->endpoints[$type].$query);
    return json_decode($data);
  }
}