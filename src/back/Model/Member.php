<?php


class Member
{
    public const ID_TEXT = 'id';
    public const FIRSTNAME_TEXT = 'firstname';
    public const SURNAME_TEXT = 'surname';
    public const EMAIL_TEXT = 'email';
    public const GENDER_TEXT = 'gender';
    public const JOINED_DATE_TEXT = 'joined_date';


    private $id;
    private $firstName;
    private $surName;
    private $email;
    private $gender;
    private $joinedDate;

    public function __construct($id, $firstname, $surname, $email, $gender, $joined_date)
    {
        $this->id = $id;
        $this->firstName = $firstname;
        $this->surName = $surname;
        $this->email = $email;
        $this->gender = $gender;
        $this->joinedDate = $joined_date;

    }


    public static function getArray(array $members): array
    {
        $newMemberArray = array();
        if ($members !== null) {
            foreach ($members as $member) {
                /* @var $member Member */
                $newMember[self::ID_TEXT] = $member->getID();
                $newMember[self::FIRSTNAME_TEXT] = $member->getFirstName();
                $newMember[self::SURNAME_TEXT] = $member->getSurName();
                $newMember[self::EMAIL_TEXT] = $member->getEmail();
                $newMember[self::GENDER_TEXT] = $member->getGender();
                $newMember[self::JOINED_DATE_TEXT] = $member->getJoinedDate();

                array_push($newMemberArray, $newMember);
            }
        }


        return $newMemberArray;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getSurName()
    {
        return $this->surName;
    }

    /**
     * @param mixed $surName
     */
    public function setSurName($surName)
    {
        $this->surName = $surName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return mixed
     */
    public function getJoinedDate()
    {
        return $this->joinedDate;
    }

    /**
     * @param mixed $joinedDate
     */
    public function setJoinedDate($joinedDate)
    {
        $this->joinedDate = $joinedDate;
    }

}