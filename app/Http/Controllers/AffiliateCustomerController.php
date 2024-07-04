<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Service\AffiliateCustomerService;
use Illuminate\Validation\ValidationException;

class AffiliateCustomerController extends Controller
{
    protected $affiliateCustomerService;
    public function __construct(AffiliateCustomerService $affiliateCustomerService) {
        $this->affiliateCustomerService = $affiliateCustomerService;
    }
    public function save(Request $request)
    {
        try {
            $request->validate([
                'affiliate_id' => 'required|exists:affiliates,id',
                'customer_id' => 'required|exists:customers,id',
            ]);
    
            $ok = $this->affiliateCustomerService->save($request['affiliate_id'], $request['customer_id']);

            if ($ok) {
                return response()->json(['message' => 'Customer connected to affiliate successfully'], Response::HTTP_CREATED);
            }

            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
       
    }

    public function getAll(Request $request)
    {
        $sortBy = $request->input('sort_by');
        $searchTerm = $request->input('search');
        $perPage = $request->input('per_page');

        try {
            $relationships = $this->affiliateCustomerService->getAll($sortBy, $searchTerm, $perPage);
            return response()->json($relationships);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error retrieving relationships', 'error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
