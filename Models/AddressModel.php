<?php
 class AddressModel extends BaseModel
 {
    const TABLE = "address";
    public function getdeleteaddress($id)
    {
    
    $this->delete("address","id",$id);
   
    header("Location: ./index.php?controller=user&action=show"); 
    }
    
 }