<?php
class AddressController extends BaseController
{
    private $addressModel;
    public function deleteaddress() {
        $this->loadModel("AddressModel");
        $this->addressModel = new AddressModel();
        $this->addressModel->getdeleteaddress($_GET["id"]);
}
}
?>