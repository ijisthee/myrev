<?php

namespace myrev\Model;

class User
{
    public $user_id;
    public $first_name;
    public $last_name;
    public $user_name;
    public $email;
    public $password;
    public $first_login;
    public $last_login;

    public function exchangeArray(array $data)
    {
        $this->user_id      = !empty($data['user_id'])      ? $data['user_id']      : null;
        $this->first_name   = !empty($data['first_name'])   ? $data['first_name']   : null;
        $this->last_name    = !empty($data['last_name'])    ? $data['last_name']    : null;
        $this->user_name    = !empty($data['user_name'])    ? $data['user_name']      : null;
        $this->email        = !empty($data['email'])        ? $data['email']        : null;
        $this->password     = !empty($data['password'])     ? $data['password']     : null;
        $this->first_login  = !empty($data['first_login'])  ? $data['first_login']  : null;
        $this->last_login   = !empty($data['last_login'])   ? $data['last_login']   : null;
    }
}