<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class FetchShopifyCustomers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:fetch-customers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch all customers from Shopify store';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $shopUrl = config('services.shopify.shop_url');
        $apiVersion = config('services.shopify.api_version');
        $accessToken = config('services.shopify.access_token');

        $client = new Client([
            'base_uri' => "https://{$shopUrl}/admin/api/{$apiVersion}/",
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Shopify-Access-Token' => $accessToken,
            ],
        ]);

        $query = '
        query($first: Int!, $after: String) {
            customers(first: $first, after: $after) {
                edges {
                    node {
                        id
                        email
                        firstName
                        lastName
                        ordersCount
                        totalSpent
                    }
                }
                pageInfo {
                    hasNextPage
                    endCursor
                }
            }
        }';

        $first = 10;
        $after = null;

        do {
            $variables = ['first' => $first, 'after' => $after];
            $response = $client->post('graphql.json', [
                'json' => [
                    'query' => $query,
                    'variables' => $variables,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true)['data']['customers'];
            $this->saveCustomers($data['edges']);

            $after = $data['pageInfo']['endCursor'];
        } while ($data['pageInfo']['hasNextPage']);
    }

    protected function saveCustomers(array $customers)
    {
        foreach ($customers as $customerEdge) {
            $customer = $customerEdge['node'];

            // Customer::updateOrCreate(
            //     ['shopify_id' => $customer['id']],
            //     [
            //         'email' => $customer['email'],
            //         'first_name' => $customer['firstName'],
            //         'last_name' => $customer['lastName'],
            //         'orders_count' => $customer['ordersCount'],
            //         'total_spent' => $customer['totalSpent'],
            //     ]
            // );
        }
    }
}
