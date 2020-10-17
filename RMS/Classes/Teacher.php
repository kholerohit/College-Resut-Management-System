<?php
   class Teacher {

      public function __construct($id, $name='xyz', $subjects, $mo_no='000', $email='xyz@gmail.com', $addrs='abc', $photo='xyz.jpg') {
        $this->id = $id;
        $this->name = $name;
        $this->subjects = array($subjects);
        $this->mo_no = $mo_no;
        $this->email = $email;
        $this->passwd = $email;
        $this->addrs = $addrs;
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
  $s1 = new Teacher("4434231","My name ", $n);
  $s1->__set("subjects", "algo, s1, s2, s3, s4");
  echo $s1->__get("name");
  echo $s1->__get("subjects");

?>
