<?php
require_once __DIR__ . '/../Database/Database.php';

class MemberDB
{
    public static function setMembersBy(ResponseSearch $response, string $firstname, string $surname, string $email): void
    {
        $conn = Database::getCon();

        $firstname = '%'.$firstname.'%';
        $surname = '%'.$surname.'%';
        $email = '%'.$email.'%';

        $query = "SELECT `id`, `firstname`, `surname`, `email`, `gender`, `joined_date` FROM `members` WHERE `firstname` LIKE ? AND `surname` LIKE ? AND `email`  LIKE ?";
        $stmt = $conn->prepare($query);
        if (false === $stmt) {
            $response->setErrorFromDB(__FUNCTION__, $stmt->error);
            mysqli_close($conn);
            return;
        }
        $stmt->bind_param('sss', $firstname, $surname, $email);


        // Execute the statement.
        $execute = $stmt->execute();
        if (false === $execute) {
            $response->setErrorFromDB(__FUNCTION__, $stmt->error);
            mysqli_close($conn);
            return;
        }
        $stmt->bind_result($idDB, $firstnameDB, $surnameDB, $emailDB, $genderDB, $joined_dateDB);

        $arr = [];
        while ($stmt->fetch()) {
            $member = new Member($idDB, $firstnameDB, $surnameDB, $emailDB, $genderDB, $joined_dateDB);
            $arr[] = $member;
        }

        $response->setMembers($arr);
        // Close the prepared statement.
        $stmt->close();

        mysqli_close($conn);
    }
}