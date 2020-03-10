<?php
    class Request
    {
        private $errors = [];
        private $keys = ['title','description','author','publication_date','category'];
        private $inputValue = [];

        public function isPost()
        {
           return $_SERVER['REQUEST_METHOD'] == 'POST';
        }

        public function clear($str)
        {
            return strip_tags( trim($str) );
        }

        public function getField($inputName)
        {
            $value = $_POST[$inputName] ?? '';
            return $this->clear($value);
        }

        public function required($inputName)
        {
            $value = $this->getField($inputName);
            if(empty($value))
            {
                $this->errors[$inputName][] = 'поле обязательно к заполнению';
            }
            else {
                array_push($this->inputValue, $value);
            }
        }

        public function getErrors()
        {
            return $this->errors;
        }

        public function getData()
        {
            return array_combine($this->keys, $this->inputValue);
        }
    }
?>