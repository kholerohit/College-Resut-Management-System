<?php
   class Student {

      public function __construct($PRN, $name='xyz', $mo_no='000', $email='xyz@gmail.com', $stream='no', $addrs='abc', $year='FY', $photo='xyz.jpg') {
        $this->PRN = $PRN;
        $this->name = $name;
        $this->mo_no = $mo_no;
        $this->email = $email;
        $this->stream = $stream;
        $this->passwd = $email;
        $this->addrs = $addrs;
        $this->year = $year;
        $this->photo = $photo;
      }

      function __set($name, $value){
          if(method_exists($this, $name)){
            $this->$name($value);
          }
          else{
            $this->$name = $value;
          }
      }

      function __get($name){
        if(method_exists($this, $name)){
          return $this->$name();
        }
        elseif(property_exists($this,$name)){
          return $this->$name;
        }
        return null;
      }
  }
  $n = "1111111111";
  $s1 = new Student("4434231","My name ", $n);
  $s1->__set("year", "SY");
  echo $s1->__get("name");
  echo $s1->__get("email");

?>
