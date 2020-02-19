<?php


namespace Hell\Vephar\Contracts;


use Throwable;

class ContractException extends \Exception
{
    public function __construct($contract = "", $code = 0, Throwable $previous = null)
    {
        $message = "You must pass a instance of " . $contract;
        parent::__construct($message, $code, $previous);
    }
}
