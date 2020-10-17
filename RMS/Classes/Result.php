<!-- Demo model of Class, Object , Constructor, dynamic Getter and dynamic Setter in php-->
<?php
   class Result {

      //setting default value to the variable of constructor, it's useful when no value is provided.
      public function __construct($id ,$re_student_id ,$name='xyz', $type='midsem', $desc='5th sem TY complimentory') {
        $this->id = $id;
        $this->$re_student_id = $re_student_id;
        $this->name = $name;
        $this->type = $type;
        $this->desc = $desc;
      }

      //creating dynamic Setter.
      function __set($name, $value){
          if(method_exists($this, $name)){
            $this->$name($value);
          }
          else{
            // Getter/Setter not defined so set as property of object.
            $this->$name = $value;
          }
      }

      //creating dynamic Getter.
      function __get($name){
        if(method_exists($this, $name)){
          return $this->$name();
        }
        elseif(property_exists($this,$name)){
          // Getter/Setter not defined so return property if it exists.
          return $this->$name;
        }
        return null;
      }
  }

  $s1 = new  Result("RB1","687793","R15");

  $s1->__set("desc", "nothing");
  // printing values using object.
  echo $s1->__get("name");

?>
