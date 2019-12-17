<?php

namespace Tests\Unit;

use Tests\TestCase;



class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function testExample()
    {
        $this->visit('/')
            ->click('Авторизація')
            ->seePageIs('/login');
       // $this->assertTrue(true);
    }

}
