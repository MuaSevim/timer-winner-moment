<?php

class Winner
{
    public function getAll($conn)
    {
        $sql = 'SELECT * FROM winner WHERE winner.email_participation IS NOT NULL';
        $stmt = $conn->prepare($sql);
        if ($stmt->execute())
            return $stmt->fetchAll();
    }

    public static function countColumns($conn)
    {
        $stmt = $conn->prepare('SELECT COUNT(*) FROM winner');

        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public static function initDates($conn, $dates)
    {
        try {
            if (self::countColumns($conn) > 0) return;

            $sql = 'INSERT INTO winner (date, prize)
            VALUES ';

            $values = [];
            foreach ($dates as $date)
                $values[] = "(?, 'grond')";

            $sql .= implode(', ', $values);

            $stmt = $conn->prepare($sql);

            foreach ($dates as $key => $date)
                $stmt->bindValue($key + 1, $date, PDO::PARAM_STR);

            if ($stmt->execute())
                echo "Successful";
        } catch (Exception $e) {
            var_dump($e->getMessage());
        }
    }

    public function update($conn, $date_redimido, $email_participation, $record_id)
    {

        try {
            $sql = "UPDATE winner 
                    LEFT JOIN winner_user 
                    ON winner_user.email = winner.email_participation
                    SET 
                        winner.date_redimido = :date_redimido, 
                        winner.email_participation = :email_participation,
                        winner.record_id = :record_id
                    WHERE 
                        winner.date < :date_user 
                        AND winner.email_participation IS NULL
                    ORDER BY winner.date
                    LIMIT 1";

            $stmt = $conn->prepare($sql);

            $stmt->bindValue(':date_redimido', $date_redimido, PDO::PARAM_STR);
            $stmt->bindValue(':date_user', $date_redimido, PDO::PARAM_STR);
            $stmt->bindValue(':email_participation', $email_participation, PDO::PARAM_STR);
            $stmt->bindValue(':record_id', $record_id, PDO::PARAM_STR);

            if ($stmt->execute())
                return true;
        } catch (Exception $e) {
            var_dump($e->getMessage());
            exit;
        }
    }
}
