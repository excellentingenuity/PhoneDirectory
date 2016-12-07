<?php

use App\Entries\Entry;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class DeleteEntryTest
 */
class DeleteEntryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var
     */
    protected $entry;

    /**
     * setUp
     */
    public function setUp ()
    {
        parent::setUp();
        $this->entry = Entry::first();
    }

    /**
     * testDelete
     *
     * @test
     */
    public function testDelete()
    {
        $this->json('DELETE', '/api/entries/' . $this->entry->id)
            ->seeJson(['deleted' => true, 'id' => $this->entry->id]);
        $this->notSeeInDatabase('entries', [
            'first_name' => $this->entry->first_name,
            'last_name' => $this->entry->last_name,
            'phone' => $this->entry->phone,
            'deleted_at' => null
        ]);
    }
}
