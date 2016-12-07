<?php

use App\Entries\Factory;
use eig\UUID\Facades\UUID;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


/**
 * Class EntryFactoryTest
 */
class EntryFactoryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * testCreateEntry
     *
     * @test
     */
    public function testCreateEntry()
    {
        $id = UUID::generate()->toString();
        $entry = Factory::create($id, 'smith', 'snuffy', '123-456-7890');
        $this->assertNotNull($entry);
        $this->seeInDatabase('entries', [
            'id' => $id,
            'first_name' => 'snuffy',
            'last_name' => 'smith',
            'phone' => '123-456-7890'
        ]);
    }
}
