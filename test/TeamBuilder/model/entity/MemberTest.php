<?php

namespace TeamBuilder\model\entity;

use TeamBuilder\TestHelper;
use PHPUnit\Framework\TestCase;

class MemberTest extends TestCase
{

    protected function setUp(): void
    {
        TestHelper::createDatabase();
    }

    /**
     * @covers \TeamBuilder\model\entity\MemberMember::all()
     */
    public function testAll()
    {
        $this->assertCount(51, Member::all());
    }

    /**
     * @covers \TeamBuilder\model\entity\Member::find(id)
     */
    public function testFind()
    {
        $member = Member::find(1);
        $this->assertInstanceOf(Member::class, $member);
        $this->assertNull(Member::find(1000));
    }

    /**
     * @covers \TeamBuilder\model\entity\Member::where(criteria)
     */
    public function testWhere()
    {
        $this->assertCount(5, Member::where("role_id", 2));
        $this->assertCount(0, Member::where("role_id", 222));
    }

    /**
     * @covers \TeamBuilder\model\entity\Member->create()
     * @depends testAll
     */
    public function testCreate()
    {
        $member = Member::make(["name" => "XXX", "password" => 'XXXPa$$w0rd', "role_id" => 1]);
        $this->assertTrue($member->create());
        $this->assertFalse($member->create());
    }

    /**
     * @covers \TeamBuilder\model\entity\Member->save()
     */
    public function testSave()
    {
        $member = Member::find(1);
        $saveName = $member->name;
        $member->name = "newname";
        $this->assertTrue($member->save());
        $this->assertEquals("newname", Member::find(1)->name);
        $member->name = $saveName;
        $member->save();
    }

    /**
     * @covers \TeamBuilder\model\entity\Member->save() doesn't allow duplicates
     */
    public function testSaveRejectsDuplicates()
    {
        $member = Member::find(1);
        $member->name = Member::find(2)->name;
        $this->assertFalse($member->save());
    }

    /**
     * @covers \TeamBuilder\model\entity\Member->delete()
     */
    public function testDelete()
    {
        $member = Member::find(1);
        $this->assertFalse($member->delete()); // expected to fail because of foreign key
        $member = Member::make(["name" => "dummy", "password" => "dummy", "role_id" => 1]);
        $member->create(); // to get an id from the db
        $id = $member->id;
        $this->assertTrue($member->delete()); // expected to succeed
        $this->assertNull(Member::find($id)); // we should not find it back
    }

    /**
     * @covers \TeamBuilder\model\entity\Member::destroy(id)
     */
    public function testDestroy()
    {
        $this->assertFalse(Member::destroy(1)); // expected to fail because of foreign key
        $member = Member::make(["name" => "dummy", "password" => "dummy", "role_id" => 1]);
        $member->create(); // to get an id from the db
        $id = $member->id;
        $this->assertTrue(Member::destroy($id)); // expected to succeed
        $this->assertNull(Member::find($id)); // we should not find it back
    }

    /**
     * Assume the well-know dataset of 'teambuilder.sql'
     *
     * @covers \TeamBuilder\model\entity\Member::getTeams
     */
    public function testTeams()
    {
        $this->assertCount(1, Member::find(3)->getTeams());
        $this->assertCount(0, Member::find(9)->getTeams());
        $this->assertCount(3, Member::find(10)->getTeams());
    }
}
