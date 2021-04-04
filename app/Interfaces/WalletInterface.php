<?php

interface WalletInterface
{
    /**
     * WalletInterface constructor.
     * @param User $user
     */
    public function __construct(User $user);

    /**
     * bağlı bulunduğu wallet id yi döner
     * @return int
     */
    public function getWalletId(): int;

    /**
     * deposit kullanıcının ilişkili UserWallet tablosundaki
     * amount değerini arttırır. işlem başarılı olmuş ise
     * https://apigateway.localhost/wallet/deposit?user_id=[$userId] adresine istek yapar.
     * istek başarısız olur ise deposit işlemini geri alır.
     * @param float $amount
     * @param string $note
     * @return bool
     */
    public function deposit(float $amount, string $note): bool;

    /**
     * withdraw kullanıcının ilişkili UserWallet tablosundaki
     * amount değerini azaltır. işlem başarılı olmuş ise
     * https://apigateway.localhost/wallet/deposit?user_id=[$userId] adresine istek yapar.
     * istek başarısız olur ise deposit işlemini geri alır.
     * @param float $amount
     * @param string $note
     * @return bool
     */
    public function withdraw(float $amount, string $note): bool;
}