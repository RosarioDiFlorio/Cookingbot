<?php
/**
 * Classe che modella le sessioni
 *
 */
class Sessione {

    private $uid; //ID Utente della sessione
    private $sid; //ID Sessione(autoincrementale)
    private $timestamp; //Data della sessione
    private $hash; //Hash di Sessione
    private $addr; //Indirizzo di sessione

    //Popola le variabili d'istanza dell'oggetto
    private function popolaIstanza($r) {
        $this->uid = $r['uid'];
        $this->addr = $r['addr'];
        $this->sid = $r['sid'];
        $this->timestamp = $r['timestamp'];
        $this->hash = $r['hash'];
    }

    public function getUid() {
        return $this->uid;
    }

    public function setUid($uid) {
        $this->uid = $uid;
    }

    public function getSid() {
        return $this->sid;
    }

    public function setSid($sid) {
        $this->sid = $sid;
    }

    public function getTimestamp() {
        return $this->timestamp;
    }

    public function setTimestamp($timestamp) {
        $this->timestamp = $timestamp;
    }

    public function getHash() {
        return $this->hash;
    }

    public function setHash($hash) {
        $this->hash = $hash;
    }

    public function getAddr() {
        return $this->addr;
    }

    public function setAddr($addr) {
        $this->addr = $addr;
    }
    //Salva l'oggetto sessione corrente
    public function save() {
        global $conn;
        if (empty($this->uid) or empty($this->timestamp) or empty($this->hash) or empty($this->addr))
            throw new Exception("Impossibile creare sessione con parametri mancanti");
        if ($this->sid == null) { //Se è una nuova sessione
            $params = array(
                ':uid' => $this->uid,
                ':ts' => $this->timestamp,
                ':hash' => $this->hash,
                ':addr' => $this->addr
            );
            $query = $conn->prepare('INSERT INTO sessioni(uid, timestamp, hash,addr) VALUES (:uid, :ts, :hash,:addr)');
            $query->execute($params);
            $this->sid = $conn->lastInsertId();
            return $this->sid;
        } else { //altrimenti aggiorna una sessione esistente
            $params = array(
                ':sid' => $this->sid,
                ':uid' => $this->uid,
                ':ts' => $this->timestamp,
                ':hash' => $this->hash
            );
            $query = $conn->prepare('UPDATE sessioni SET uid = :uid, timestamp = :ts, hash = :hash WHERE sid = :sid');
            $query->execute($params);
        }
    }
    //Preleva una sessione fornendo session_id, hash di sessione
    public function getSessione($sid, $hash) {
        require_once dirname(__FILE__) . '/Database.php';
        global $conn;
        $query = $conn->prepare('SELECT * FROM sessioni WHERE sid = :sid AND hash = :hash');
        $params = array(':sid' => $sid, ':hash' => $hash);
        $query->execute($params);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($res) != 1)
            throw new Exception('Sessione non esistente nel database');

        $riga = $res[0];
        $this->popolaIstanza($riga);
    }
    //Preleva una sessione usando il solo session id(usato per logout)
    public function getBySID($sid) {
        global $conn;
        $query = $conn->prepare('SELECT * FROM sessioni WHERE sid = :sid');
        $params = array(':sid' => $sid);
        $query->execute($params);

        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        if (count($res) != 1)
            throw new Exception('Sessione non esistente nel database');

        $riga = $res[0];
        $this->popolaIstanza($riga);
    }
    //Avvia una nuova sessione
    public static function startSession($id_utente,$email,$remember,$is_admin) {
        global $conn;
        /* Creiamo una nuova sessione */
        $addr = $_SERVER['REMOTE_ADDR'];
        $new_sess = new Sessione();
        $new_sess->setUid($id_utente);
        $new_sess->setHash(sha1(microtime(true) . mt_rand(10000, 90000)));
        $new_sess->setTimestamp(time());
        $new_sess->setAddr($addr);
        $new_sess->save();

        //Salvo in sessione l'ID della sessione in DB
        $_SESSION['sid'] = $new_sess->getSid();
        $_SESSION['idUtente'] = $id_utente;
        $_SESSION['email'] = $email;
        $_SESSION['is_admin'] = $is_admin;
        /* Se l'utente chiede "Ricordami" */
        if($remember) {
            //$info è serializzato nel cookie cosi che ci siano le info necessarie
            $info = array(
                's' => $new_sess->getSid(),
                'h' => $new_sess->getHash(),
            );
            setcookie('auth', serialize($info), time() + 3600 * 24 * 30, '/');
        }
        return true;
    }
    /* Check se loggato */
    public static function isLoggedIn($rememberlogin = false) {
        session_start();
        //Autologin con cookie ricordami, se l'utente è sloggato e il flag è settato a true
        if(!isset($_SESSION['idUtente']) && $rememberlogin) {
            if (!isset($_COOKIE['auth'])) //Se non c'è il cookie
                return false;
            $ck = unserialize($_COOKIE['auth']);
            if (empty($ck)) //Se il cookie è vuoto
                return false;
            global $conn;
            $old_sess = new Sessione(); //Prendiamo la sessione
            try {
                $old_sess->getSessione($ck['s'], $ck['h']);
            } catch (Exception $e) { //Se non esiste la sessione
                return false;
            }
            //Invalidiamo la vecchia sessione se tutto ok
            $old_sess->setHash(sha1(microtime(true) . mt_rand(10000, 90000)));
            $old_sess->save();
            /* Carichiamo le informazioni dell'utente */
            require_once dirname(__FILE__) . '/Utente.php';
            $usr = new Utente();
            try {
                $usr->prelevaDaID($old_sess->getUid());
            } catch (Exception $e) {
                return false;
            }
            //Verifica status utente
            $is_admin = $usr->isAdmin();
            //Avviamo sessione con impostazione "Ricordami" attiva.
            Sessione::startSession($usr->getID(),$usr->getEmail(),true,$is_admin);
        }
        if(isset($_SESSION['idUtente']))
            return true;
        else
            return false;
    }
    /*
        Verifica se l'utente è admin( restituisce true o false)
    */
    public static function isAdmin() {
        if(isset($_SESSION['is_admin']) && ($_SESSION['is_admin'] == 1))
            return true;
        return false;
    }
}
?>