<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class ViewEntriesTest
 */
class ViewEntriesTest extends TestCase
{

    /**
     * testViewEntries
     *
     * @test
     */
    public function testViewEntries()
    {
        $this->json('GET', '/api/entries')
            ->seeJsonStructure([
                'entries'
            ]);
    }
}
