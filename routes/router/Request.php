<?php

class Request {
    protected $request;
    protected $data;
    public $method;

    public function __construct($request, $flag = true) {
        $this->request = $request;
        $this->extractData();
        $this->setExtraData($flag);
    }

    public function extractData() {
        $this->data = array();
        foreach($this->request as $field => $value) {
            if(is_object($value) || is_array($value)) {
                $this->data[$field] = new Request($value, false);
            } else {
                if($field != "http_referer") {
                    $this->data[$field] = $value;
                }
            }
        }
    }

    public function setExtraData($flag) {
        if($flag) {
            $this->method = $_SERVER["REQUEST_METHOD"];
            $this->data["http_referer"] = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null;
            
            $headers = apache_request_headers();
            $this->data["headers"] = new Request($headers, false);
        }
    }

    public function __get($field) {
        return isset($this->data[$field]) ? $this->data[$field] : null;
    }

    public function __set($field, $value) {
        $this->data[$field] = $value;
    }

    public function all() {
        return $this->data;
    }
}