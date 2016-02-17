<?php

namespace App\Repositories;

use App\Models\Venue;
use InfyOm\Generator\Common\BaseRepository;

class VenueRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Venue::class;
    }
}
