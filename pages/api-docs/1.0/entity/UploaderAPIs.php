<?php
require_once ROOT_DIR.'/pages/api-docs/APIView.php';

class UploaderAPIs extends APIView{
    public function __construct() {
        parent::__construct('Uploader','webfiori/entity');
        new APIPage($this->getClassAPIObj());
    }

    public function defineClassFunctions() {
        $this->addFunctionDef(array(
            'name'=>'',
            'short-desc'=>'',
            'long-desc'=>'',
            'access-modifier'=>'public',
            'params'=>array(
                array(
                    'name'=>'',
                    'type'=>'',
                    'description'=>'',
                )
            ),
            'return-types'=>'',
            'return-desc'=>''
        ));
    }

    public function defineClassAttributes() {

    }
}
new UploaderAPIs();