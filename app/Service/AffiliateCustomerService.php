<?php

namespace App\Service;

use App\Repositories\AffiliateCustomerRepository;
use App\Repositories\AffiliateRepository;
use App\Repositories\CustomerRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class AffiliateCustomerService {
    protected $affiliateRepository;
    protected $customerRepository;
    protected $affiliateCustomerRepository;

    public function __construct(AffiliateRepository $affiliateRepository, CustomerRepository $customerRepository, AffiliateCustomerRepository $affiliateCustomerRepository)
    {
        $this->affiliateRepository = $affiliateRepository;
        $this->customerRepository = $customerRepository;
        $this->affiliateCustomerRepository = $affiliateCustomerRepository;
    }
    
    public function save($affiliateId, $customerId) {
        try {
            $this->affiliateCustomerRepository->create([$affiliateId, $customerId]);
            return true;
        }
        catch (Exception $e) {
            Log::error('Error creating connect customer: ' . $e->getMessage(), ['exception' => $e]);
            return false;
        }

    }

    public function getAll($sortBy = null, $searchTerm = null, $perPage = 10) {
        try {
            $query = $this->affiliateCustomerRepository->queryWithAffiliatesAndCustomers();

            if ($searchTerm) {
                $query->whereHas('customer', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%{$searchTerm}%")
                          ->orWhere('email', 'like', "%{$searchTerm}%");
                })->orWhereHas('affiliate', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', "%{$searchTerm}%")
                          ->orWhere('email', 'like', "%{$searchTerm}%");
                });
            }

            if ($sortBy) {
                $query->orderBy($sortBy);
            }

            return $query->paginate($perPage);
        } catch (Exception $e) {
            throw new Exception('Failed to retrieve relationships: ' . $e->getMessage());
        }
    }
}