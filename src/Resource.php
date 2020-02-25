<?php

namespace Hell\Vephar;

use Hell\Vephar\Contracts\ResourceContract;

/**
 * Class Resource
 * @package Hell\Vephar
 */
class Resource extends ResourceContract
{
    public function __construct($data, $setters = false)
    {
        parent::__construct($data, $setters);
    }
}
