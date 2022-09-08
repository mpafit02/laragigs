<?php

namespace App\Models;

class Listing
{
    // Get all the listings
    public static function all()
    {
        return [
            [
                'id' => 1,
                'title' => 'Listing One',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam numquam asperiores ab voluptas quasi dignissimos et ex consequuntur laboriosam nihil! Hic placeat eos dolores explicabo pariatur consectetur blanditiis cumque molestiae?'
            ],
            [
                'id' => 2,
                'title' => 'Listing Two',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam numquam asperiores ab voluptas quasi dignissimos et ex consequuntur laboriosam nihil! Hic placeat eos dolores explicabo pariatur consectetur blanditiis cumque molestiae?'
            ]
        ];
    }

    // find a listing given an id
    public static function find($id)
    {
        $listings = self::all();

        // find a specific listing by comparing the id of all the listings
        foreach ($listings as $listing) {
            if ($listing['id'] == $id) {
                return $listing;
            }
        }
    }
}
