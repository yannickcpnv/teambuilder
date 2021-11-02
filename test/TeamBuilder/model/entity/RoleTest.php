<?php

namespace TeamBuilder\model\entity;

use PHPUnit\Framework\TestCase;

class RoleTest extends TestCase
{

    /**
     * @covers \TeamBuilder\model\entity\Role::all
     */
    public function testAll()
    {
        $this->assertCount(2, Role::all());
    }

    /**
     * @covers \TeamBuilder\model\entity\Role::find
     */
    public function testFind()
    {
        $this->assertInstanceOf(Role::class, Role::find(1));
        $this->assertNull(Role::find(1000));
    }

    /**
     * @covers \TeamBuilder\model\entity\Role::create
     */
    public function testCreate()
    {
        $role = new Role();
        $role->slug = "XXX";
        $role->name = "XXX";
        $this->assertTrue($role->create());
        $this->assertFalse($role->create());
    }

    /**
     * @covers \TeamBuilder\model\entity\Role->save()
     */
    public function testSave()
    {
        $role = Role::find(1);
        $savename = $role->name;
        $role->name = "newname";
        $this->assertTrue($role->save());
        $this->assertEquals("newname", Role::find(1)->name);
        $role->name = $savename;
        $role->save();
    }

    /**
     * @covers \TeamBuilder\model\entity\Role->save() doesn't allow duplicates
     */
    public function testSaveRejectsDuplicates()
    {
        $role = Role::find(1);
        $role->name = Role::find(2)->name;
        $this->assertFalse($role->save());
    }

    /**
     * @covers \TeamBuilder\model\entity\Role->delete()
     */
    public function testDelete()
    {
        $role = Role::find(1);
        $this->assertFalse($role->delete()); // expected to fail because of foreign key
        $role = new Role();
        $role->slug = "ZZZ";
        $role->name = "dummy";
        $role->create();
        $id = $role->id;
        $this->assertTrue($role->delete()); // expected to succeed
        $this->assertNull(Role::find($id)); // we should not find it back
    }

    /**
     * @covers \TeamBuilder\model\entity\Role::destroy(id)
     */
    public function testDestroy()
    {
        $this->assertFalse(Role::destroy(1)); // expected to fail because of foreign key
        $role = new Role();
        $role->slug = "ZZZ";
        $role->name = "dummy";
        $role->create();
        $id = $role->id;
        $this->assertTrue(Role::destroy($id)); // expected to succeed
        $this->assertNull(Role::find($id)); // we should not find it back
    }
}
