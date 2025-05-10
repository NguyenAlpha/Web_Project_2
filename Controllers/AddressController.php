<?php
class AddressController extends BaseController
{
    private $addressModel;
    public function deleteaddress() {
        $this->loadModel("AddressModel");
        $this->addressModel = new AddressModel();
        $this->addressModel->getdeleteaddress($_GET["id"]);
}

public function updateaddress(){
    $this->loadModel("AddressModel");
    $this->addressModel = new AddressModel();

    // Lấy từ POST, không phải GET
    $newAddress = $_POST["address"];
    $id = $_GET["id"]; // ID vẫn nằm trong URL

    $this->addressModel->geteditaddress($newAddress, $id);

    // Gợi ý: nên chuyển hướng sau khi update
    header("Location: index.php?controller=Address&action=list");
    exit;
}
public function addaddress() {
    $this->loadModel("AddressModel");
    $this->addressModel = new AddressModel();

    if (isset($_POST['address'])) {
        $newAddress = $_POST['address'];
        $id = $_GET["id"];
        $this->addressModel->getaddaddress($newAddress,$id);
        header("Location: index.php?controller=Address&action=index"); 
    }
}

            }
        
    

?>