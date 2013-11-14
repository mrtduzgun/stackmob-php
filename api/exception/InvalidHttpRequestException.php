
<?php

class InvalidHttpRequestException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {

        $this->title = "InvalidHttpRequestException";
        parent::__construct($message, $code, $previous);

    }
}

?>