<?php

namespace App\Repositories;
use App\Models\AffiliateCustomer;
use App\Repositories\BaseRepository;

class AffiliateCustomerRepository extends BaseRepository {
    public function getModel()
    {
        return AffiliateCustomer::class;
    }

    public function queryWithAffiliatesAndCustomers()
    {
        return $this->model->with(['customer:id,name,email', 'affiliate:id,name,email']);;
    }
}