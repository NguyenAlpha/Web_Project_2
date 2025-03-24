<?php 
    class BaseController {
        const VIEW_FOLDER = "./Views/";
        const MODEL_FOLDER = "./Models/";
        
        protected function loadView($view, $data = []) {
            foreach($data as $key => $value) {
                $$key = $value;
            }
            require(self::VIEW_FOLDER . $view);
        }

        protected function loadModel($model) {
            include(self::MODEL_FOLDER . $model . ".php");
        }
    }
?>

