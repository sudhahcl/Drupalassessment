<?php 

namespace Drupal\Calculator\Controller;

use Drupal\Core\Controller\ControllerBase;

trait statusMsg{
    public function displayMsg() {
        $msg = "Successfully Calculated !!!... ";
        return $msg;
      }
      
      public function printMsg() {
        $msg = "Successfully !!!... ";
        return $msg;
      }
    }
class areaCalculator extends ControllerBase {
    public $num1;
    public $num2;
   // public $data;

    public function __construct ()
    {
    $this->num1 = 10;
    $this->num2 = 2;
    }
    use statusMsg; 

public function areaCal(){ 
  //public $data;
        $data.= "Area: ". $this->num1 * $this->num2 ."<br><br><br>";
        $data.= $this->displayMsg();
        $result = ['#markup'=>$this->t($data)];
        return $result;
}



}
// $numbers = new areaController(20,5);
// $numbers->areaCal();
// $numbers->displayMsg();

?>