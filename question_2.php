<?php
namespace SoftwareEngineerTest;
// Question 2 & 3 & 4

/**
 * Class Customer
 */
abstract class Customer {
	protected $id;
	protected $balance = 0;
	protected $username;
    const Bronze = 'B';
    const Silver = 'S';
    const Gold = 'G';


        public function __construct($id) {
            $this->id = $id;
	}

	public function get_balance() {
            return $this->balance;
	}
/**
* Generate Username
* Take type as input of class or string and return generated username
*@return string username
*/
	public function generate_username($type) {
            $array = array_merge(range(0,9),range('A','Z'),range('a','z')); 
            shuffle($array); 
            $characters = implode('',array_slice($array,0,10));
            
            if (($type instanceof Bronze_Customer)) {
                $this->username = self::Bronze . $characters;
            }
            
            else if (($type instanceof Silver_Customer)) {
                $this->username = self::Silver . $characters;
            } 

            else if (($type instanceof Gold_Customer)) {
                $this->username = self::Gold . $characters;
            }
        }
        
        public function get_username(){
            return $this->username;
        }

}


// Write your code below
/**
*Factory class to create instance
*@variable string
*@return class instance
*/
class CustomerFactory {  
    
    public static function get_instance($param) {
        $customer_type = array("B", "S", "G");
        
        if (!in_array(substr($param, 0, 1), $customer_type)) {
            throw new \InvalidArgumentException('Invalid Input as the First Letter should be B, S, G: given was ' . substr($param, 0, 1));
        }

        switch (substr($param, 0, 1)) {
            case "B":
                return new Bronze_Customer($param);
            case "S":
                return new Silver_Customer($param);
            case "G":
                return new Gold_Customer($param);
            default:
            //$customer = NULL;       
        }
    }

}
/**
 * Class Bronze Customer
 */
 class Bronze_Customer extends Customer{
	private $credit = 0;
	//private static $prefix = "B";
	
	public function deposit($deposit){
		if(is_numeric($deposit)){
			$deposit += $deposit*($this->credit/100); 
			return $this->balance += $deposit;
		}
	}
 }
 
 /**
 * Class Silver Customer
 */
 class Silver_Customer extends Customer{
	private $credit = 5;
	//private static $prefix = "S";
	
	public function deposit($deposit){
		if(is_numeric($deposit)){
			$deposit += $deposit*($this->credit/100); 
			return $this->balance += $deposit;
		}
	}

 }
 
 /**
 * Class Gold Customer
 */
 class Gold_Customer extends Customer{
	private $credit = 10;
	//private static $prefix = "G";
	
	public function deposit($deposit){
		if(is_numeric($deposit)){
			$deposit += $deposit*($this->credit/100); 
			return $this->balance += $deposit;
		}
	}
 }
 
 $customer = new Bronze_Customer(12);
 echo $customer->deposit(100);
 echo "<pre>";print_r($customer);echo "</pre>";
  $customer->generate_username($customer);
  echo $customer->get_username();
 echo "<br />";
 
 $silver_customer = new Silver_Customer(14);
 echo $silver_customer->deposit(100);
 echo "<pre>";print_r($silver_customer);echo "</pre>";
 echo $silver_customer->generate_username($silver_customer);
 echo $silver_customer->get_username();
 echo "<br />";
 
 $gold_customer = new Gold_Customer(16);
 echo $gold_customer->deposit(100);
 echo "<pre>";print_r($gold_customer);echo "</pre>";
 echo $gold_customer->generate_username($gold_customer);
 echo $gold_customer->get_username();
 echo "<br />";
 
 $check_customer = CustomerFactory::get_instance("GAANB878");
 echo "<pre>";print_r($check_customer);echo "</pre>";
 
