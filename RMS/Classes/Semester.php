<!-- Demo model of Class, Object , Constructor, dynamic Getter and dynamic Setter in php-->
<?php
   class Semester {

      //setting default value to the variable of constructor, it's useful when no value is provided.
      public function __construct($id, $name='xyz', $type='odd', $desc='decsribe here') {
        $this->id = $id;
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

  $s1 = new  Semester("AB1","5th sem","Even");

  $s1->__set("desc", "nothing");
  // printing values using object.
  echo $s1->__get("name");

?>
