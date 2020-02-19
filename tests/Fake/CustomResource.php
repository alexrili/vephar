<?php


namespace Hell\Vephar\Fake;




use Hell\Vephar\Contracts\ResourceContract;

/**
 * Class CustomResource
 * @packaddress Hell\Vephar\Fake
 */
class CustomResource extends ResourceContract
{

    /**
     * @var
     */
    public $name;
    /**
     * @var
     */
    public $address;

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name["name"] ?? null;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address["address"] ?? null;
    }

}
