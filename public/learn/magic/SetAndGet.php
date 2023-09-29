 <?php


class CloneMagicMethod{

    public $gender = 'Male';
    public $address;
    public function SayWelcome(){
        echo 'welcome';
    }

}
class SetAndGet {
    
   public $clon  ;
    public function __construct( ){
    $this->clon =   new CloneMagicMethod;


    }
    private array $data = [];

    public function __set($name, $value)
    {
       return $this->data[$name]= $value;

    }
    public function __get($name)
    {
       return  $this->data[$name];
    }
    public function SayHello(){
        echo 'hello';
    }
    public function __clone(){
        $this->clon =clone  $this->clon;
    }

}

// $obj = new CloneMagicMethod;
$o1 = new SetAndGet( );
// $o2 = new SetAndGet();
$o2 =    $o1;
echo '<br>';
var_dump($o1);
echo '<br>';

$o1->name = 'reyath';
$o1->age = 22;
$o1->list = [
    'name'=>'reyath',
    'age'=> 22,
];
var_dump($o1);

echo '<br>';
 
 
//  var_dump($o1->clon);
//  echo $o1->clon->SayWelcome();
 echo $o1->clon->gender = 'Female';
echo '<br>';
echo $o1->name .'<br>';
// echo $o1->age.'<br>';
//  echo $o1->toArray();
var_dump($o1);

echo '<br>';
echo '<br>';
echo '<br>';
 var_dump($o2 );


