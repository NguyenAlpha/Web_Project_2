<?php
 class AddressModel extends BaseModel
 {
    const  TABLE = "address";
    public function getAddressbyuserID($id) {
   // $sql = "SELECT * FROM address WHERE userID = $userID";
    }
      public function deleteAddress($userID) {
      return $this->delete(self::TABLE,'userID',$userID);
   }
}
?>