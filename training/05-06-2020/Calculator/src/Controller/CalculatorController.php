<?php

namespace Drupal\Calculator\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * Custom configuration controller.
 *
 * @package Drupal\Calculator\Controller
 */
interface CalculatorInterface { 
   public  function Add(); 
   public  function Subtract(); 
   public  function Multiply(); 
   public  function Divide(); 
}
   class CalculatorController extends ControllerBase implements CalculatorInterface {
      /* Member variables */
      public $num1;
      public $num2;
      //public $result;
      
      public function __construct ()
      {
      $this->num1 = 10;
      $this->num2 = 5;
      }
      /* Member functions */
      public function Add(){
         return $this->num1 + $this->num2  ." <br/>";

      }
      
      public function Subtract(){
         return $this->num1 - $this->num2  ." <br/>";
      }
      
      public function Multiply(){
         return $this->num1 * $this->num2 . " <br/>";
      }
      
      public function Divide(){
         return $this->num1 / $this->num2 ." <br/>";    
         }
   public function calFunc(){
   //public $result;
   $result.= "Addition : " .$this->Add()."<br>";
   $result.= "Subtraction : " .$this->Subtract()."<br>";
   $result.= "Multiply :" .$this->Multiply()."<br>";
   $result.= "Division: " .$this->Divide()."<br><br><br>";

   $data = ['#markup'=>$this->t($result)];
   return $data;
   }
         
   }
   
  
  // $numbers = new CalculatorController(20,5);
  // $numbers->CalFunc();

?>
