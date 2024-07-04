<?php

namespace App\Repositories;

use App\Models\Customer;
use App\Repositories\BaseRepository;

class CustomerRepository extends BaseRepository {
    public function getModel()
    {
        return Customer::class;
    }
}