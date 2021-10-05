<?php

namespace TeamBuilder\model\entity;

use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{

    /**
     * @covers \TeamBuilder\model\entity\Team::all()
     */
    public function testAll()
    {
        $this->assertCount(15, Team::all());
    }

    /**
     * @covers \TeamBuilder\model\entity\Team::find(id)
     */
    public function testFind()
    {
        $this->assertInstanceOf(Team::class, Team::find(1));
        $this->assertNull(Team::find(1000));
    }

    /**
     * @covers \TeamBuilder\model\entity\Team->create()
     */
    public function testCreate()
    {
        $team = new Team();
        $team->name = "XXX";
        $team->state_id = 1;
        $this->assertTrue($team->create());
        $this->assertFalse($team->create());
    }

    /**
     * @covers \TeamBuilder\model\entity\Team->save()
     */
    public function testSave()
    {
        $team = Team::find(1);
        $savename = $team->name;
        $team->name = "newname";
        $this->assertTrue($team->save());
        $this->assertEquals("newname", Team::find(1)->name);
        $team->name = $savename;
        $team->save();
    }

    /**
     * @covers \TeamBuilder\model\entity\Team->save() doesn't allow duplicates
     */
    public function testSaveRejectsDuplicates()
    {
        $team = Team::find(1);
        $team->name = Team::find(2)->name;
        $this->assertFalse($team->save());
    }

    /**
     * @covers \TeamBuilder\model\entity\Team->delete()
     */
    public function testDelete()
    {
        $team = Team::find(1);
        $this->assertFalse($team->delete()); // expected to fail because of foreign key
        $team = Team::make(["name" => "dummy", "state_id" => 1]);
        $team->create();
        $id = $team->id;
        $this->assertTrue($team->delete()); // expected to succeed
        $this->assertNull(Team::find($id)); // we should not find it back
    }

    /**
     * @covers \TeamBuilder\model\entity\Team::destroy(id)
     */
    public function testDestroy()
    {
        $this->assertFalse(Team::destroy(1)); // expected to fail because of foreign key
        $team = Team::make(["name" => "dummy", "state_id" => 1]);
        $team->create();
        $id = $team->id;
        $this->assertTrue(Team::destroy($id)); // expected to succeed
        $this->assertNull(Team::find($id)); // we should not find it back
    }
}
