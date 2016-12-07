<?php

use App\Events\EntryCreationRequested;
use eig\UUID\Facades\UUID;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Class CreateEntryTest
 */
class CreateEntryTest extends TestCase
{
    use DatabaseTransactions;

    protected $id;

    protected $first_name;

    protected $last_name;

    protected $phone;

    public function setUp ()
    {
        parent::setUp();
        $this->id = UUID::generate();
        $this->last_name = 'smith';
        $this->first_name = 'snuffy';
        $this->phone = '123-456-7890';
    }

    /**
     * testFireCreateEntryRequestedEvent
     *
     * @test
     */
    public function testFireCreateEntryRequestedEvent()
    {
        event(new EntryCreationRequested($this->last_name, $this->first_name, $this->phone));
        $this->seeInDatabase('entries', [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone
        ]);
    }

    public function testCreateEntryRoute()
    {
        $this->json('POST', '/api/entries/', [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone
        ])->seeJson(['saved' => true]);
        $this->seeInDatabase('entries', [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone
        ]);
    }
}
