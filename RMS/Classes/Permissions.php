<!-- Demo model of Class, Object , Constructor, dynamic Getter and dynamic Setter in php-->
<?php
   class Permissions {

      //setting default value to the variable of constructor, it's useful when no value is provided.
      public function __construct($id, $type='student', $desc='decsribe here') {
        $this->id = $id;
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

  $s1 = new  Permissions("Pa1","Teacher");

  $s1->__set("desc", "nothing here yet");
  // printing values using object.
  echo $s1->__get("id");

?>
