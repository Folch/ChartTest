<?php
require_once __DIR__ . '/../../back/Response/CodeValues.php';
require_once __DIR__ . '/../../back/Utils/JsonUtils.php';

abstract class Response
{
    protected $code;

    protected $cause;//general message generated by me
    protected $error;//code of the error generated by the system

    private $errorHttp;

    public function __construct()
    {
        $this->code = CodeValues::OK;
        $this->errorHttp = 500;
    }


    public function hasError(): bool
    {
        return $this->code === CodeValues::ERROR;
    }

    public function setError($cause, $error = null)
    {
        if ($error !== 0) {
            $this->code = CodeValues::ERROR;
            $this->cause = $cause;
            $this->error = $error;
        }
    }
    public function setErrorFromDB($function, $error)
    {
        self::setError($function . ' - ' . htmlspecialchars($error), $error);
    }
    public function clearError()
    {
        $this->code = CodeValues::OK;
        $this->cause = null;
        $this->error = null;
    }

    public function setMethodNotImplemented()
    {
        $this->setError('Method not implemented');
        $this->setErrorHttp(500);
    }

    /**
     * @param mixed $errorHttp
     */
    public function setErrorHttp($errorHttp)
    {
        $this->errorHttp = $errorHttp;
    }

    public function printJSON()
    {
        JsonUtils::printJson(self::getResponseArray());
    }

    public function getResponseArray(): array
    {
        $response = array();

        if ($this->code === CodeValues::ERROR) {
            http_response_code($this->errorHttp);
        }
        $response[JsonKey::CODE] = $this->code;


        if ($this->cause !== null) {
            $response[JsonKey::CAUSE] = $this->cause;
        }

        if ($this->error !== null) {
            $response[JsonKey::ERROR] = $this->error;
        }
        return $response;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getCause()
    {
        return $this->cause;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

}