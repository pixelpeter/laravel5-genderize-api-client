<?php

namespace Pixelpeter\Genderize;

use Mockery;
use Unirest\Request;
use Unirest\Response;

class GenderizeClientTest extends TestCase
{
    /**
     * @var \Pixelpeter\Genderize\GenderizeClient
     */
    protected $client;

    /**
     * @var \Unirest\Request
     */
    protected $request;

    /**
     * @var \Unirest\Response
     */
    protected $response;

    /**
     * Set up
     */
    public function setUp()
    {
        parent::setUp();

        $this->response = new Response(
            200,
            '{"name":"B\u00e4rbel","gender":"female","probability":"0.75","count":4,"country_id":"DE"}',
            "content-type: text/html; charset=UTF-8\r\n" .
            "X-Frame-Options: SAMEORIGIN\r\n" .
            "X-Powered-By: PHP/5.5.9-1ubuntu4.6\r\n" .
            "X-Rate-Limit-Limit: 1000\r\n" .
            "X-Rate-Limit-Remaining: 970\r\n" .
            "X-Rate-Reset: 79614\r\n"
        );

        $this->request = Mockery::mock('\Unirest\Request');
        $this->client = new GenderizeClient($this->request);
    }

    /**
     * Name sets names correctly when given as a string
     *
     * @test
     */
    public function name_works_correctly_with_string()
    {
        $this->client->name('John');
        $names = $this->getPrivateProperty(\Pixelpeter\Genderize\GenderizeClient::class, 'names');

        $this->assertTrue(is_array($names->getValue($this->client)));
        $this->assertSame('John', $names->getValue($this->client)[0]);
    }

    /**
     * Name sets names correctly when given as an array
     *
     * @test
     */
    public function name_works_correctly_with_arrays()
    {
        $this->client->name(['John', 'Jane']);
        $names = $this->getPrivateProperty(\Pixelpeter\Genderize\GenderizeClient::class, 'names');

        $this->assertTrue(is_array($names->getValue($this->client)));
        $this->assertSame('John', $names->getValue($this->client)[0]);
        $this->assertSame('Jane', $names->getValue($this->client)[1]);
    }

    /**
     * Names sets names correctly when given as an array
     *
     * @test
     */
    public function names_works_correctly_with_arrays()
    {
        $this->client->names(['John', 'Jane']);
        $names = $this->getPrivateProperty(\Pixelpeter\Genderize\GenderizeClient::class, 'names');

        $this->assertTrue(is_array($names->getValue($this->client)));
        $this->assertSame('John', $names->getValue($this->client)[0]);
        $this->assertSame('Jane', $names->getValue($this->client)[1]);
    }

    /**
     * Country sets country correctly
     *
     * @test
     */
    public function country_works_correctly()
    {
        $this->client->name('John')->country('US')->lang('EN');
        $country = $this->getPrivateProperty(\Pixelpeter\Genderize\GenderizeClient::class, 'country');

        $this->assertSame('US', $country->getValue($this->client));
    }

    /**
     * Lang set lang correctly
     *
     * @test
     */
    public function lang_works_correctly()
    {
        $this->client->name('John')->country('US')->lang('EN');
        $lang = $this->getPrivateProperty(\Pixelpeter\Genderize\GenderizeClient::class, 'lang');

        $this->assertSame('EN', $lang->getValue($this->client));
    }

    /**
     * Getting a response works correctly
     *
     * @test
     */
    public function get_works_correctly()
    {
        $this->request->shouldReceive('get')->once()->andReturn($this->response);
        $response = $this->client->name('John')->get();

        $this->assertInstanceOf('\Pixelpeter\Genderize\Models\GenderizeResponse', $response);
    }

    /**
     * Tear down
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
