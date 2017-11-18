<?php
namespace Bnb\Tests;

use Bnb\Uuid\Uuid;
use PHPUnit\Framework\TestCase;

class UuidTest extends TestCase
{

    public function test_it_returns_a_uuid_v4()
    {
        $uuid = Uuid::v4()->full();

        $this->assertFullMatch($uuid);
    }


    public function test_it_format_short_uuid()
    {
        $uuid = Uuid::v4()->short();

        $this->assertShortMatch($uuid);
    }


    public function test_it_encodes_base36_uuid()
    {
        $uuid = Uuid::v4()->base36();

        $this->assertBase36Match($uuid);
    }


    public function test_it_uses_global_helpers()
    {
        $uuid = uuid_v4();

        $this->assertFullMatch($uuid);

        $uuid = uuid_v4_short();

        $this->assertShortMatch($uuid);

        $uuid = uuid_v4_base36();

        $this->assertBase36Match($uuid);
    }


    /**
     * @param $uuid
     */
    private function assertFullMatch($uuid)
    {
        $this->assertEquals(36, strlen($uuid));
        $this->assertRegExp('/([a-f0-9]{4}-){4}[a-f0-9]{12}/', $uuid);
    }


    /**
     * @param $uuid
     */
    private function assertShortMatch($uuid)
    {
        $this->assertEquals(32, strlen($uuid));
        $this->assertRegExp('/([a-f0-9]{4}){4}[a-f0-9]{12}/', $uuid);
    }


    /**
     * @param $uuid
     */
    private function assertBase36Match($uuid)
    {
        $this->assertEquals(25, strlen($uuid));
        $this->assertRegExp('/[a-z0-9]{25}/', $uuid);
    }
}
