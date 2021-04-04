<?php

require_once "./app/Interfaces/WalletInterface.php";

class BankWallet implements WalletInterface
{

    private int $userId = 0;
    protected const walletId = 1;
    private const walletName = 'BankWallet';
    private $database ;

    public function __construct(User $user)
    {
        $this->userId   = $user->id;
        $this->walletId = $this->getWalletId();
        $this->database = new Database();
    }

    public function getWalletId(): int
    {
        return self::walletId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function deposit(float $amount, string $note): bool
    {
        $amountResponse = $this->database->getPdo()->query('SELECT amount FROM user_wallets WHERE wallet_id = ' . self::walletId)->fetchObject();

        $newAmount = floatval($amountResponse->amount) + $amount;

        $result = $this->database->getPdo()->exec('UPDATE user_wallets SET amount = ' . $newAmount . ' WHERE wallet_id = ' . self::walletId);

        if($result){

            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,'https://localhost/wallet/deposit?user_id='.$this->userId);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $curlResult = curl_exec($curl);

            if(curl_errno($curl)){
                echo 'Error:' . curl_error($curl);
            }
            curl_close($curl);

            if($curlResult){

            }else{
                $this->database->getPdo()->exec('UPDATE user_wallets SET amount = ' . $amountResponse->amount . ' WHERE wallet_id = ' . self::walletId);
            }

            return true;
        }else{
            return false;
        }
    }

    public function withdraw(float $amount, string $note): bool
    {
        $amountResponse = $this->database->getPdo()->query('SELECT amount FROM user_wallets WHERE wallet_id = ' . self::walletId)->fetchObject();

        $newAmount = floatval($amountResponse->amount) - $amount;

        $result = $this->database->getPdo()->exec('UPDATE user_wallets SET amount = ' . $newAmount . ' WHERE wallet_id = ' . self::walletId);

        if($result){

            $curl = curl_init();
            curl_setopt($curl,CURLOPT_URL,'https://localhost/wallet/withdraw?user_id='.$this->userId);
            curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $curlResult = curl_exec($curl);

            if(curl_errno($curl)){
                echo 'Error:' . curl_error($curl);
            }
            curl_close($curl);

            if($curlResult){

            }else{
                $this->database->getPdo()->exec('UPDATE user_wallets SET amount = ' . $amountResponse->amount . ' WHERE wallet_id = ' . self::walletId);
            }

            return true;
        }else{
            return false;
        }
    }
}