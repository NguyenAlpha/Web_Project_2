<?php
class AdminModel extends BaseModel{
    const TABLE = "admins";
    public function checkuser($username, $password){
        $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
        return $this->getAdmin($sql);
    }
    public function customer(){
        $sql = "SELECT * FROM `user` WHERE 1";
        
        return $this->getByQuery( $sql);
}
}
?>