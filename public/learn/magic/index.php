<?php
class MethodTest
{
    public function __call($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        echo "Calling object method '$name' "
             . implode(', ', $arguments). "\n";
    }

    public static function __callStatic($name, $arguments)
    {
        // Note: value of $name is case sensitive.
        var_dump($name  );
        echo '<br>';

        var_dump(  $arguments);
        echo '<br>';
        echo "Calling static method '$name' "
             . implode(', ', $arguments). "\n";
    }
}
class mtd extends MethodTest{
    public $p1;
    public function __get($name) 
    {
        return "Get called for " . get_class() . "->\$$name \n";
    }
    
}
$obj = new mtd;
echo '<br>';
//   $obj->p2 = 'hello';
echo $obj->p2;
echo '<br>';

  $obj->runningForTest('in object context');
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';

mtd::runTest('in static context');
echo '<br>';

 