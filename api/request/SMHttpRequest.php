<?php

class SMHttpRequest {

    protected $headers = array();
    protected $urlDomainArr = array();
    protected $urlQueryArr = null;
    protected $body = array();
    protected $requestMethod = null;

    public function __construct() {
        $this->urlQueryArr = SMConfig::apiUrl;
    }

    public function addHeader($header = array()) {

        if (is_object($header)) {
            $this->headers[] = (array)$header;         
        } else if (is_array($header)) {
            $this->headers[] = $header;
        }
    }

    public function setUrlDomain($domainArr) {

        if (!empty($domainArr) && is_array($domainArr)) {
            $this->urlDomainArr .= implode("/", $domainArr);
        } else {
            throw new InvalidHttpRequestException("Your http url domain is invalid!");
        }
    }

    public function setUrlQuery($queryArr) {

        if (!empty($queryArr) && is_array($queryArr)) {
            $this->urlQueryArr .= "?".http_build_query($queryArr);
        } else {
            throw new InvalidHttpRequestException("Your http url query is invalid!");
        }
    }

    public function setBody($body = array()) {

        if (is_object($body)) {
            $this->body[] = (array)$body;         
        } else if (is_array($body)) {
            $this->body[] = $body;
        }
    }

    public function setRequestMethod($method) {

        if (SMRestMethod::isValidMethod($method)) {
            $this->requestMethod = $method;
        } else {
            throw new InvalidHttpRequestException("Your http request method is invalid!");
        }
    }
}
?>