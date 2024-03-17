<?php

namespace Src;

use TypeError;

class Account{
    private int $balance;
    private array $bills;
    private array $transactionHistory;
    private array $donation;
    public function __construct()
    {       
            $this->setBills();
            $this->setDonation();
            $this->transactionHistory = [];
            
    }
    public function setBills(){
        $this->bills = [
            "IAM"=>123,
            "Redal"=>2000,
            "ASM"=>325
        ];
    }
    public function debiting(int $amount):?Account{
        if($this->balance - $amount >0){
        $this->balance-=$amount;
        return $this;}
        else {
        echo PHP_EOL."You don't have enought Money";
        return null;}

        
    }
    public function saveTransaction(int $amount,string $destination):?Account{
       
        if($this->debiting($amount) != null ){
        $this->transactionHistory[$destination] = $amount;
        return $this;}
        else return null;
        
    }
    public function getBalance():int{
        return $this->balance;
    }
    public function setBalance(int $amount):Account{
        $this->balance = $amount;
        return $this;
    }
    public function getTransactions():array{
        return $this->transactionHistory;
    }
    public function setDonation():void{
        $this->donation = [
            "UEFO",
            "MND",
        ];
    }
    public function getDonation(){
        return $this->donation;
    }
    public function getBills(){
        return $this->bills;
    }


}



?>