<?php

namespace Src;

use TypeError;

class ATM{
    private Account $account;
    public function __construct(){
        $this->account = new Account();
        $this->account->setBalance(1000);    
        
    }
    public function start(){
        while(true){
            //system('clear');
            echo "\e[H\e[J";
            echo <<<INTERFACE
              ******************   Welcom to ATM    ******************* 
            1.Make a transaction
            2.Cash Whitdraw
            3.Bills
            4.Balance
            5.Donations
            6.Show Transaction History
            0.Exit

            INTERFACE;
            $input = readline();
            echo "\e[H\e[J";
            try{
            switch($input){     
                case 1:
                    $this->makeTransaction();
                    break;
                case 2:
                    $this->getCash();
                    break;
                case 3:
                    $this->bills();
                    break;
                case 4:
                    $this->balance();
                    break;
                case 5:
                    $this->donation();
                    break;
                case 6 :
                    $this->showTransactions();
                    break;
                case 0 :
                    echo "Good By !!!";
                    break 2;
                
                default :
                echo "Invalid input";
               
            }
        }catch(TypeError $e){
            echo "Invalide format";
            
        }
        sleep(3);
        }
    }
    public function makeTransaction():void{
       
        echo "amount : ";
        $amount = readline();
        echo "destination :";
        $destination = readline();
        
        $this->loading();
        if($this->account->saveTransaction($amount,$destination)!= null)
        echo PHP_EOL."Transaction made succefuly";

    }
    private function  showTransactions(){
        foreach ($this->account->getTransactions() as $destination => $amount ){
            echo "$destination : $amount $".PHP_EOL;
        }
        while(true){
        echo "1.return ".PHP_EOL."0.exit".PHP_EOL;
        $input = readline();
        $this->loading();
    switch($input){
        case 0:
            exit;
        case 1:
            break 2;

        default:
        echo"Invalid input";
        echo "\e[H\e[J";

    }
    
    }
        
    }
    private function getCash(){
        echo "Amount :";
        $amount = readline(); 
        $this->loading();
            if($this->account->debiting($amount)!=null){
            echo "Cash is Out";
            
        }
       
        
     
    }
    public function balance(){
        $balance = $this->account->getBalance(); 
        echo <<<BALANCE
                         ***********************
                                $balance   $     
                         *********************** 
                         
        1.return 
        0.exit

        BALANCE;
        readline()==1?:exit;
    }
    private function bills(){
        $bills = [];
        $index =1;
        foreach($this->account->getBills() as $bill => $amount){
           array_push($bills,[$bill=>$amount]);
        }
        foreach($bills as $index=>$bill){
            $unit = array_keys($bill); 
            echo $index.".".$unit." : ".$bill[$unit];

        }
        $bill = readline();
        $amount =implode(array_values($bills[$bill]));
        $destination = implode(array_keys($bills[$bill]));
        if($this->account->saveTransaction($amount,$destination)){
            $this->loading();
            echo "Payed succefully";
        }



    }
    private function donation(){
        $donations = $this->account->getDonation();
        foreach($donations as $index => $value){
            echo ($index+1).".".$value.PHP_EOL;
        }
        $donation = readline();
         echo "amout :";
        $amount = readline();
        $this->loading();
        if($this->account->saveTransaction($amount ,$donations[$donation-1]))
        echo "Donated succefully";
        
        


    }
    private function loading(){
      echo "Loading :";
     for($i=0;$i<4;$i++){
                echo "*";
                sleep(1);
        }
      echo PHP_EOL;
    }
    private function checkInput($start,$end,$input){
        if($input<$start || $input >$end ){
            echo "Invalid input";
            sleep(3);
        }
        else{
            $this->loading();
            echo "Operation made succefully";
        }
    }
    


}




?>