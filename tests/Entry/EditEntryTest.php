<?php

use App\Entries\Entry;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class EditEntryTest
 */
class EditEntryTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var
     */
    protected $first_name;

    /**
     * @var
     */
    protected $last_name;

    /**
     * @var
     */
    protected $phone;

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
        $this->last_name = 'smith';
        $this->first_name = 'snuffy';
        $this->phone = '123-456-7890';
    }

    /**
     * testEdit
     *
     * @test
     */
    public function testEdit()
    {
        $this->json('PATCH', '/api/entries/' . $this->entry->id, [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'id' => $this->entry->id
        ])->seeJson(['saved' => true, 'id' => $this->entry->id]);
        $this->seeInDatabase('entries', [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone
        ]);
    }
}
