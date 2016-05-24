<?php namespace Pixelpeter\Genderize\Test;

use PHPUnit_Framework_TestCase;
use Pixelpeter\Genderize\Models\Meta;
use Carbon\Carbon;

class MetaTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Pixelpeter\Genderize\Models\Meta
     */
    protected $meta;

    /**
     * Set up
     */
    public function setUp()
    {
        $data = (object) [
            'code' => 200,
            'headers' => [
                'X-Rate-Limit-Limit' => 7000,
                'X-Rate-Limit-Remaining' => 1000,
                'X-Rate-Reset' => 0
            ]
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
