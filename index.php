<?php

require_once './app/Class/BankWallet.php';
require_once './app/Class/BonusWallet.php';
require_once './app/Class/WalletService.php';
require_once './app/Class/User.php';


$user = User::find(1);

$bankWallet = new BankWallet($user);
$bonusWallet = new BonusWallet($user);

$bankWalletService = new WalletService($bankWallet);
$bonusWalletService = new WalletService($bonusWallet);

$bankWalletService->deposit(3850.42,"Dell Inspiron 3501 Fb1005f82c I3 1005g1");
//$bankWalletService->withdraw(3850.42,"Dell Inspiron 3501 Fb1005f82c I3 1005g1");

$bonusWalletService->deposit(38.5,"Dell Inspiron 3501 Fb1005f82c I3 1005g1 Bonus");
//$bonusWalletService->withdraw(38.5,"Dell Inspiron 3501 Fb1005f82c I3 1005g1 Bonus");