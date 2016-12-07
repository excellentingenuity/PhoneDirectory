<?php

namespace App\Entries;

use App\Entries\Entry;

class Factory
{

    /**
     * create
     * @param $id
     * @param $first_name
     * @param $last_name
     * @param $phone
     *
     * @return Entry
     */
    public static function create($id, $last_name, $first_name, $phone)
    {
        return Entry::create([
            'id' => $id,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'phone' => $phone
        ]);
    }
}