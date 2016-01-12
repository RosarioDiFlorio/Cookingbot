<?php

class Utente {

    private $email;
    private $id;
    private $password;
    private $is_admin;
    private $attivo;

    // Metodo private per valorizzare le variabili d'istanza
    private function popolaIstanza($riga) {
        $this->email = $riga['Email'];
        $this->id = $riga['ID_Utente'];
        $this->password = $riga['Pwd'];
        $this->attivo = $riga['Attivo'];
        $this->is_admin = $riga['Is_admin'];
    }
    /*
     * COSTRUTTORE : Preleva un utente dal DB usando il suo ID.
     */
    public function prelevaDaID($id) {
        global $conn;
        if (!empty($this->email))
            throw new Exception("Hai gia' caricato le informazioni nell'oggetto.");
        $query = $conn->prepare("SELECT * FROM `utente` WHERE `ID_Utente` = :id");
        $query->bindParam(":id", $id);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($res) != 1)
            throw new Exception('Utente non esistente nel database');

        $riga = $res[0];
        $this->popolaIstanza($riga);
    }

    /*
     * COSTRUTTORE : Preleva un utente dal DB usando l'email
     */

    public function prelevaDaEmail($email) {
        global $conn;
        $query = $conn->prepare("SELECT * FROM `utente` WHERE `Email` = :us_mail");
        $query->bindParam(":us_mail", $email);
        $query->execute();
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($res) != 1)
            throw new Exception('Utente non esistente nel database');

        $riga = $res[0];
        $this->popolaIstanza($riga);
    }
    // Salva l'oggetto nel database
    public function memorizza() {
        global $conn;
        // Salva un nuovo utente nel db
        if (empty($this->email) || empty($this->password)) {
            throw new Exception("Mancano le informazioni per memorizzare un utente.");
        }

        $params = array(":email" => $this->email, ":pwd" => $this->password , ":isActive" => $this->attivo, ":Is_admin" => $this->is_admin);
        if ($this->id == NULL) {
            $query = $conn->prepare('INSERT INTO `utente`(`Email`,`Pwd`,`Attivo`,`Is_admin`) VALUES (:email, :pwd, :isActive, :Is_admin)');
            try {
                $query->execute($params);
            }
			catch (Exception $e) {
                if ($e->getCode() == '23000')
                    throw new Exception("Utente già esistente");
            }
            $this->id = $conn->lastInsertId();
            return $this->id;
        } else {
            $query = $conn->prepare("UPDATE `utente` SET `Attivo` = :isActive,`Email` = :email, `Pwd` = :pwd , `Is_admin` = :Is_admin WHERE `ID_Utente` = :id");
            $params = array(":id" => $this->id,":email" => $this->email, ":pwd" => $this->password, ":isActive" => $this->attivo, ":Is_admin" => $this->is_admin);
            $query->execute($params);
        }
    }

    public function cancella() {
        global $conn;
        if ($this->id == null)
            throw new Exception("Cancellazione fallita, l'id e' null");

        $query = $conn->prepare('DELETE FROM utente WHERE ID_Utente = :id');
        $query->bindParam(':id', $this->id);
        $query->execute();
        $righe = $query->rowCount();
        if ($righe < 1)
            throw new Exception("Cancellazione fallita");
    }

    public function getID() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function isAttivo() {
        return $this->attivo;
    }
    public function isAdmin() {
        return $this->is_admin;
    }
    public function setAdmin($boolean) {
        if( ($boolean == 0) || ($boolean == 1) )
            $this->is_admin = $boolean;
        else
            throw new Exception("Valore non consentito");
    }
    public function impostaAttivo($auth) {
        if (($auth == 0) || ($auth == 1))
            $this->attivo = $auth;
        else
            throw new Exception("Valore non consentito : deve essere 0 o 1.");
    }

    public function impostaPassword($nuova_password) {
        require_once dirname(__FILE__) . "/PasswordHash.php";
        $t_hasher = new PasswordHash(8, FALSE);
        $hash = $t_hasher->HashPassword(trim($nuova_password));
        $this->password = $hash;
    }

    public function impostaEmail($email) {
        /* Check email */
        $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})^";
        if (!preg_match($pattern, $email)) {
            throw new Exception("Formato mail non valido");
        }
        $this->email = $email;
    }
}
?>