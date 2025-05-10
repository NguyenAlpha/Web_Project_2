<?php
 class AddressModel extends BaseModel
 {
    const TABLE = "address";
    public function getdeleteaddress($id)
    {
    
    $this->delete("address","id",$id);
   
    header("Location: ./index.php?controller=user&action=show"); 
    }
    



   public function geteditaddress($address,$id){
      $this->update("address",["address"=>$address],"id",$id);
      header("Location: ./index.php?controller=user&action=show"); 
   }

   public function getaddaddress($address, $id) {
      $sql = "INSERT INTO address (address, id) VALUES ('$address', '$id')";

      $this->add($sql);
  }
  
 }
