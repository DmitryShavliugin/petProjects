<?php
    function Connection($query) {
        $servername = "";
        $username = "";
        $password = "";

        //Create connection
        $conn = new mysqli($servername, $username, $password);
        $sql = 'USE';
        $conn->query($sql);

        $result = $conn->query($query);

        $conn->close();

        return $result;
    }

    function CheckUser($chat_Id, $name, $message){
        $sql = 'SELECT Chat_Id FROM Users WHERE Chat_Id = "'. $chat_Id . '";';
        $resultQuery = Connection($sql);
        if ($resultQuery->num_rows > 0) {
            AddMessage($chat_Id, $message);
        } 
        else{
            $sql = 'INSERT INTO Users (Full_Name, Chat_Id)
                    VALUES("'. $name .'", "'. $chat_Id .'");';
            Connection($sql);
            AddMessage($chat_Id, $message);
        }
    }

    function AddMessage($chat_Id, $message){
        $flag = MessageCheck($message);
        if($flag == true){
            $sql = 'INSERT INTO Messages (Tchat_Id, Message_Text)
                        VALUES("'. $chat_Id .'", "'. $message .'");';
            Connection($sql);
        }
    }

    function MessageCheck($message){

        if($message !== 'кнопки' && $message !== '/start' && $message !== 'gg' && $message !== 'гласные' && $message !== 'согласные' && $message !== 'гласные. период: последнее сообщение.' && $message !== 'гласные. период: последние 10 сообщений.' && $message !== 'cогласные. период: последнее сообщение.' && $message !== 'cогласные. период: последние 10 сообщений.'){
            if(isRussian($message)){
                return true;
            }
            else{
                return false;
            }
        }
        else
        {
            return false;
        }
    }

    function isRussian($text) {
        return preg_match('/[А-Яа-яЁё]/u', $text);
    }

    function ConsonantsPeriodOne($chat_Id){
        $message = GetLast($chat_Id);
        return Consonants($message);
    }

    function ConsonantsPeriodTen($chat_Id){
        $message = GetLastTen($chat_Id);
        return Consonants($message);
    }

    function VowelsPeriodOne($chat_Id){
        $message = GetLast($chat_Id);
        return Vowels($message);
    }

    function VowelsPeriodTen($chat_Id){
        $message = GetLastTen($chat_Id);
        return Vowels($message);
    }

    function Consonants($text){
        $size = mb_strlen($text);
        $count = 0;

        $Consonants_Letter = array(
            'б', 'в', 'г', 'д', 'ж', 'з', 'й', 'к', 'л', 'м', 'н', 'п', 'р', 
            'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'
        );
            for($i = 0; $i < $size; $i++){
                foreach($Consonants_Letter as $alf){
                    if(mb_substr($text, $i, 1) == $alf){
                        $count++;
                    }
                }
            }
            return $count;
    }

    function Vowels($text){
        $size = mb_strlen($text);
        $count = 0;

        $Vowels_Letter = array(
            'а', 'е', 'ё', 'и', 'о', 'у', 'ы',  'э', 'ю', 'я'
        );
            for($i = 0; $i < $size; $i++){
                foreach($Vowels_Letter as $alf){
                    if(mb_substr($text, $i, 1) == $alf){
                        $count++;
                    }
                }
            }
            return $count;
    }

    function GetLast($chat_Id){
        $sql = 'SELECT Message_Text FROM Messages WHERE Tchat_Id = "'. $chat_Id . '" ' . 'ORDER BY Id DESC LIMIT 1;';
        $resultQuery = Connection($sql);
        $result = '';
        if ($resultQuery->num_rows > 0) {
            while($row = $resultQuery->fetch_assoc()) {
                $result = $result . ' ' . $row['Message_Text'];
            }
        }

        return strval($result);
    }
    

    function GetLastTen($chat_Id){
        $sql = 'SELECT Message_Text FROM Messages WHERE Tchat_Id = "'. $chat_Id . '" ' . 'ORDER BY Id DESC LIMIT 10;';
        $resultQuery = Connection($sql);
        $result = '';
        if ($resultQuery->num_rows > 0) {
            while($row = $resultQuery->fetch_assoc()) {
                $result = $result . ' ' . $row['Message_Text'];
            }
        }

        return strval($result);
    }
?>