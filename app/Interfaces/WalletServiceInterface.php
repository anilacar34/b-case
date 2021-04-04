<?php

interface WalletServiceInterface
{
    /**
     * WalletServiceInterface constructor.
     * @param WalletInterface $wallet
//     * @param User $user
     */
    public function __construct(WalletInterface $wallet);

    /**
     * construct metodunda tanımlanmış olan wallet'ın deposit metodunu çağırır.
     * işlem başarılı ise Log tablosuna işlemin Log verisini oluşturur.
     * @param float $amount
     * @param string $note
     * @return bool
     */
    public function deposit(float $amount, string $note): bool;

    /**
     * construct metodunda tanımlanmış olan wallet'ın withdraw metodunu çağırır.
     * işlem başarılı ise Log tablosuna işlemin Log verisini oluşturur.
     * @param float $amount
     * @param string $note
     * @return bool
     */
    public function withdraw(float $amount, string $note): bool;
}