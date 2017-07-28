<?php
require_once __DIR__ . '/../Utils/JsonUtils.php';
require_once __DIR__ . '/../Model/Member.php';
require_once __DIR__ . '/JsonKey.php';
require_once __DIR__ . '/Response.php';


class ResponseSearch extends Response
{


    private $members; //array of class Day


    public function __construct()
    {
        parent::__construct();
        $this->members = array();
    }


    public function setError($cause, $error = null)
    {
        parent::setError($cause, $error);
        if ($error !== 0) {
            $this->clearMembers();
        }
    }

    public function clearMembers()
    {
        $this->members = array();
    }

    /**
     * @param array $members
     */
    public function setMembers(array $members)
    {
        $this->members = $members;
    }



    public function printJSON()
    {
        $response = parent::getResponseArray();

        $response[JsonKey::MEMBERS] = Member::getArray($this->members);

        JsonUtils::printJson($response);
    }


}