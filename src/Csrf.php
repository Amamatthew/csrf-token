<?php

namespace thanhtaivtt\csrf;

class CSRF
{
    /**
     * token string
     * @var string
     */
    private $token = null;
    /**
     * method use CSRF_token
     * @var all|get|post
     */
    private $method = 'post';
    /**
     * random string md5
     * @var string
     */
    private $listString = 'abcdefghiklmnopqrtvABCRTDKGFDL0123456789';
    /**
     * auto generate token
     * @var boolean
     */
    private $autoGenerate = false;
    /**
     * exprire live token
     * @var integer
     */
    private $exprire = 3600;
    /**
     * name of token
     * @var string
     */
    private $tokenName = 'csrf_token';
    /**
     * initialize class
     */
    public function __construct()
    {
        $this->setToken();
    }
    /**
     * return value now token
     * @return string
     */
    public function getValueToken()
    {
        return isset($_COOKIE[$this->tokenName]) ? $_COOKIE[$this->tokenName] : null;
    }
    /**
     * set token
     * @return void
     */
    public function setToken()
    {
        if ($this->autoGenerate == false && isset($_COOKIE[$this->tokenName])) {

        } else {
            $this->token = md5(str_shuffle($this->listString));
            setcookie($this->tokenName, $this->token, time() + $this->exprire);
        }
    }
    /**
     * get html input of token
     * @return string
     */
    public function tokenField()
    {
        echo '<input type="hidden" name="' . $this->tokenName . '" value="' . $this->getValueToken() . '">';
    }
    /**
     * validate method
     * @return boolean
     */
    public function validate()
    {
        if (isset($_COOKIE[$this->tokenName])) {
            switch (strtolower($this->method)) {
                case 'get':
                    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                        if (!isset($_GET[$this->tokenName]) || $_GET[$this->tokenName] != $this->getValueToken()) {
                            return;
                        }
                    }
                    return true;
                    break;
                case 'post':
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if (!isset($_POST[$this->tokenName]) || $_POST[$this->tokenName] != $this->getValueToken()) {
                            return;
                        }
                    }
                    return true;
                    break;
                default:
                    if (isset($_POST[$this->tokenName]) && $_POST[$this->tokenName] == $this->getValueToken()) {
                        return true;
                    } else if (isset($_GET[$this->tokenName]) && $_GET[$this->tokenName] == $this->getValueToken()) {
                        return true;
                    } else {
                        return;
                    }
                    break;
            }
        } else {
            return;
        }
    }
}
