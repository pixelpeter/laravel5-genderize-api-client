<?php namespace Pixelpeter\Genderize\Test;

use Pixelpeter\Genderize\Models\Name;

class NameTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \Pixelpeter\Genderize\Models\Name
     */
    protected $name;

    /**
     * Set up
     */
    public function setUp()
    {
        $data = (object)[
            'gender' => 'male',
            'name' => 'John',
            'probability' => 0.98,
            'count' => 1234
        ];

        $this->name = new Name($data);
    }

    /**
     * Check data is set correctly
     *
     * @test
     */
    public function data_is_set_correctly()
    {
        $this->assertSame('male', $this->name->gender);
        $this->assertSame('John', $this->name->name);
        $this->assertSame(0.98, $this->name->probability);
        $this->assertSame(1234, $this->name->count);
    }

    /**
     * Check default properties are added correctly
     *
     * @test
     */
    public function defaults_added_correctly()
    {
        $data = (object)[];

        $name = new Name($data);

        $this->assertNull($name->gender);
        $this->assertNull($name->name);
        $this->assertNull($name->probability);
        $this->assertNull($name->count);
    }

    /**
     * Check isMale() is working
     *
     * @test
     */
    public function isMale()
    {
        $this->assertTrue($this->name->isMale());
    }

    /**
     *Check isNotMail() is working
     *
     * @test
     */
    public function isNotMale()
    {
        $this->assertFalse($this->name->isNotMale());
    }

    /**
     * Check isFemale() is working
     *
     * @test
     */
    public function isFemale()
    {
        $this->assertFalse($this->name->isFemale());
    }

    /**
     * Check isNotFemail() is working
     *
     * @test
     */
    public function isNotFemale()
    {
        $this->assertTrue($this->name->isNotFemale());
    }
}
