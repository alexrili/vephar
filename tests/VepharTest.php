<?php

declare(strict_types=1);

namespace Hell\Vephar;

class VepharTest extends TestCase
{
    /**
     * Test that true does in fact equal true
     */
    public function testTrueIsTrue()
    {
        (new SkeletonClass())->echoPhrase("");
        $this->assertTrue(true);
    }
}
