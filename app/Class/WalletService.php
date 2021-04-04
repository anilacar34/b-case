<?php

require_once "./app/Interfaces/WalletServiceInterface.php";
require_once "./app/Class/Database.php";

class WalletService implements WalletServiceInterface
{
    private WalletInterface $wallet;
    private $database ;

    public function __construct(WalletInterface $wallet)
    {
        $this->wallet = $wallet;

        $this->database = new Database();
    }

    public function deposit(float $amount, string $note): bool
    {

        $deposit = $this->wallet->deposit($amount,$note);

        if($deposit){
            $userId = $this->wallet->getUserId();
            $walletId = $this->wallet->getWalletId();

            $this->database->getPdo()->exec('UPDATE wallets SET name = ' . $walletId . ' WHERE id = ' . $walletId);

            $this->database->getPdo()->prepare('INSERT INTO logs(user_id, wallet_id, log) VALUES('. $userId. ','. $walletId. ','. "'$note'" . ')')->execute();

            return true;
        }else{
            return false;
        }
    }

    public function withdraw(float $amount, string $note): bool
    {

        $withDraw = $this->wallet->withdraw($amount,$note);

        if($withDraw){
            $userId = $this->wallet->getUserId();
            $walletId = $this->wallet->getWalletId();

            $this->database->getPdo()->prepare('INSERT INTO logs(user_id, wallet_id, log) VALUES('. $userId. ','. $walletId. ','. "'$note'" . ')')->execute();

            return true;
        }else{
            return false;
        }
    }
}