<?php

class ResultModel
    {
        public $initialSql = 'SELECT * FROM emails';
        public $sql;
        public $qAll;
        public $q;
        public $provider;
        public $capitalisedBtnTexts = array();
        public $rowIds = array();
        private $allEmailEndings = array();
        public $uniqueEmailEndings = array();

        public function getAllEmails()
        {
            $pdo = new PDO("mysql:host=localhost;dbname=magebit_test", "root", "");
            $this->qAll = $pdo->query($this->initialSql);
            $this->qAll->setFetchMode(PDO::FETCH_ASSOC);
        }

        public function getEmails()
        {
            $pdo = new PDO("mysql:host=localhost;dbname=magebit_test", "root", "");
            $this->q = $pdo->query($this->sql);
            $this->q->setFetchMode(PDO::FETCH_ASSOC);
        }

        public function getEmailProviderArray($q)
        {  
            while ($row = $q->fetch()) {
                $email = $row['email'];
                $a = "@";
                $pos = strpos($email, $a)+1;
                $mailending = substr($email, $pos);
        
                array_push($this->allEmailEndings, $mailending);
                array_push($this->rowIds, $row['id']);

                $this->uniqueEmailEndings = array_unique($this->allEmailEndings);
            }
        }

        public function deleteEmail($ids)
        {
            foreach ($ids as $theId) {
                if(isset($_POST["$theId"])) {
                    $pdo = new PDO("mysql:host=localhost;dbname=magebit_test", "root", "");
                    $sql = "DELETE FROM `emails` WHERE `id` = $theId";
                    $q = $pdo->prepare($sql);
                    return $q->execute();
                }
            }
        }
    }
