<?php

    require_once("constants.php");

    class Rest {

        protected $request;
        protected $serviceName;
        protected $param;

        public function __construct() {

            if ($_SERVER['REQUEST_METHOD'] !== "POST") {
                
                $message = "Request is not Valid.";

                $this->throwError(REQUEST_METHOD_NOT_VALID, $message);
            
            } else { 

                $handler = fopen('php://input', 'r');
                $this->request = stream_get_contents($handler);
                $this->validateRequest($this->request);
            
            }
        }

        public function validateRequest($request) {

            if ($_SERVER['CONTENT_TYPE'] !== "application/json") {
                $message = "Request Content type is not Valid.";
                $this->throwError(REQUEST_CONTENTTYPE_NOT_VALID, $message);
            } else {

                $data = json_decode($request, true);
                
                if (!isset($data['name']) || $data['name'] == "") {
                    $message = "API Name is Required.";
                    $this->throwError(API_NAME_REQUIRED, $message);
                }

                $this->serviceName = $data['name'];

                if (!is_array($data['param'])) {
                    $message = "API Parameters are Required.";
                    $this->throwError(API_PARAM_REQUIRED, $message);
                }

                $this->param = $data['param'];


            }

        }

        public function processApi() {



        }

        public function validateParameter($fieldName, $value, $dataType, $required) {



        }

        public function throwError($code, $message) {
            header("content-type: application/json");
            $errorMsg = json_encode(['error' => ['status' => $code, 'message' => $message]]);
            echo $errorMsg; exit;

        }

        public function returnResponse() {



        }

    }


?>