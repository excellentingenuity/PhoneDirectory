<?php

namespace App\Entries;


/**
 * Class Manager
 * @package App\Entries
 */
class Manager
{

    /**
     * list
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function list()
    {
        return Entry::all();
    }

    /**
     * find
     *
     * @param $id
     *
     * @return mixed
     */
    public static function find($id)
    {
        return Entry::findOrFail($id);
    }

    /**
     * findByValues
     *
     * @param $last_name
     * @param $first_name
     * @param $phone
     *
     * @return mixed
     */
    public static function findByValues($last_name, $first_name, $phone)
    {
        return Entry::where('last_name', $last_name)
            ->where('first_name', $first_name)
            ->where('phone', $phone)
            ->first();
    }

    /**
     * update
     *
     * @param \App\Entries\Entry $entry
     * @param                    $last_name
     * @param                    $first_name
     * @param                    $phone
     */
    public static function update(Entry $entry, $last_name, $first_name, $phone)
    {
        $entry->last_name = $last_name;
        $entry->first_name = $first_name;
        $entry->phone = $phone;
        $entry->save();
    }

    /**
     * delete
     *
     * @param \App\Entries\Entry $entry
     */
    public static function delete(Entry $entry)
    {
        $entry->delete();
    }
}