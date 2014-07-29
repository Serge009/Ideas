<?php
/**
 * Created by PhpStorm.
 * User: Matrix
 * Date: 25.06.14
 * Time: 15:37
 */

class LoginModel extends Model {


    /**
     * @var PDO
     */
    private $db;

    /**
     * @param $login
     * @param $pass
     * @return bool
     * @throws ModelException
     */
    public function login($login, $pass)
    {
        try {
            $this->db = Connection::getConnection();

            //$sql = "SELECT COUNT(id) AS res  FROM users WHERE email = :email AND password = MD5(CONCAT(salt, MD5(:pass)))";
            $sql = "SELECT COUNT(id) AS res  FROM users WHERE login = :login AND password = :pass";
            $query = $this->db->prepare($sql);
            $query->execute(array(":login" => $login, ":pass" => $pass));

            if($query->fetch()->res > 0){
                return true;
            }
            return false;
        } catch (Exception $e) {
            throw new ModelException($e->getMessage(), $e->getCode(), $e);
        }
    }
} 