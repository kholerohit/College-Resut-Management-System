<?php
   class Exam {

      public function __construct($id ,$name='xyz', $type='midsem', $date='000', $time='0:0', $desc='5th sem TY complimentory') {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->date = $date;
        $this->time = $time;
        $this->desc = $desc;
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
  
  $s1 = new  Exam("EB1","midsem","R15");

  $s1->__set("time", "12:50");
  echo $s1->__get("desc");

?>
