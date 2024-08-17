<?php


class User
{
    // fetch user and then user data

    public function getAll($conn)
    {
        return [];
    }

    public function addUser($conn, $email, $firstName, $lastName)
    {
        try {
            $sql = "INSERT INTO winner_user(email, first_name, last_name)
                   VALUES (:email, :first_name, :last_name)";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->bindValue(':first_name', $firstName, PDO::PARAM_STR);
            $stmt->bindValue(':last_name', $lastName, PDO::PARAM_STR);

            if ($stmt->execute())
                return true;
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function checkUser($conn, $email)
    {
        $sql = "SELECT winner_user.email 
                FROM winner_user
                WHERE winner_user.email = :email";

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetchColumn();

        if ($result) return true;
        return false;
    }
}
