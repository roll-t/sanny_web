<h2>list page</h2>
<?php

 function edit(){
        if($_POST){
            $_name = $_POST["name"];
            $_price = $_POST["price"];
            $_category = $_POST["category"];
            $idproduct = $_POST["idProduct"];

            $_activity_category= (empty($_category))?"": " DM_ID = '".$_category."' ";

            $imgCheck = $this->checkImg();

            if($imgCheck){
            $_imgUpdate = "UPDATE `san_pham` SET ".$_activity_category." `SP_TEN` = '".$_name."', `SP_GIATIEN` = '".$_price."', `SP_IMG` = '".$imgCheck."' WHERE `san_pham`.`SP_ID` = ".$idproduct."";
            
            }
            else{
            $_imgUpdate = "UPDATE `san_pham` SET ".$_activity_category."  `SP_TEN` = '".$_name."', `SP_GIATIEN` = '".$_price."' WHERE `san_pham`.`SP_ID` = ".$idproduct."";
            
            }
            $inforEdit = $this->_model["Product"]->edit($_imgUpdate);
            if($inforEdit){
            $this->_response->redirect("/public/productadmin");
            }
        }
    }