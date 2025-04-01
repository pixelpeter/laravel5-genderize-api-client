<?php

namespace Pixelpeter\Genderize\Test;

use Carbon\Carbon;
use Pixelpeter\Genderize\Models\Meta;

class MetaTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Pixelpeter\Genderize\Models\Meta
     */
    protected $meta;

    /**
     * Set up
     */
    protected function setUp(): void
    {
        $data = (object) [
            'code' => 200,
            'headers' => [
                'x-rate-limit-limit' => 7000,
                'x-rate-limit-remaining' => 1000,
                'x-rate-reset' => 0,
            ],
        ];

        $this->meta = new Meta($data);
    }

    /**
     * Check data is set correctly
     *
     * @test
     */
    public function data_is_set_correctly()
    {
        $this->assertSame(200, $this->meta->code);
        $this->assertSame(7000, $this->meta->limit);
        $this->assertSame(1000, $this->meta->remaining);
        $this->assertInstanceOf('Carbon\Carbon', $this->meta->reset);
        $this->assertSame(Carbon::now()->toDateTimeString(), $this->meta->reset->toDateTimeString());
    }
}
