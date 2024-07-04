<?php

namespace App\Repositories;
use App\Models\Affiliate;
use App\Repositories\BaseRepository;

class AffiliateRepository extends BaseRepository {
    public function getModel()
    {
        return Affiliate::class;
    }
}