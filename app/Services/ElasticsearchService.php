<?php

namespace App\Services;



use Elasticsearch\ClientBuilder;

// namespace App\Services;

class ElasticsearchService
{
    protected $client;

    public function __construct()
    {


        $this->client = ClientBuilder::create()
            ->setHosts([config('elasticsearch.host') . ':' . config('elasticsearch.port')])
            ->build();
    }

    public function bulk($params)
    {
        $response = $this->client->bulk($params);
        dd($response);
    }
    public function searchCountries($query)
    {
        $response = $this->client->search([
            'index' => 'countries',  // Make sure the index exists
            'body' => [
                'query' => [
                    'wildcard' => [
                        'name' => [
                            'value' =>  '*' . strtolower($query) . '*',
                            'case_insensitive' => false,
                         
                        ]
                    ]
                ]
            ]
        ]);

        // Extract and return the matched countries

        return array_map(function ($hit) {
            return [
                'id' => $hit['_source']['country_id'],
                'name' => $hit['_source']['name'],
            ];
        }, $response['hits']['hits']);
    }
    public function searchStates($query, $country_id = "")
    {
        $response = $this->client->search([
            'index' => 'states',  // Make sure the index exists
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'term' => [
                                    'country_id' => $country_id,
                                ]
                            ]
                        ],
                        'should' => [
                            [
                                'wildcard' => [
                                    'name' => [
                                        'value' =>  '*' . strtolower($query) . '*',
                                        'case_insensitive' => false
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]);

        // Extract and return the matched states

        return array_map(function ($hit) {
            return [
                'id' => $hit['_source']['state_id'],
                'name' => $hit['_source']['name'],
            ];
        }, $response['hits']['hits']);
    }
    public function searchCities($query, $country_id = "", $state_id = "")
    {

        $response = $this->client->search([
            'index' => 'cities',  // Make sure the index exists
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            [
                                'term' => [
                                    'country_id' => $country_id,
                                ]
                            ],
                            [
                                'term' => [
                                    'state_id' => $state_id,
                                ]
                            ]
                        ],
                        'should' => [
                            [
                                'match' => [
                                    'name' => [
                                        'query' => '*' . strtolower($query) . "*",
                                        'fuzziness' => "AUTO"
                                    ]
                                ]
                            ]
                        ],

                    ]
                ]
            ]
        ]);

        // Extract and return the matched states

        return array_map(function ($hit) {
            return [
                'id' => $hit['_source']['city_id'],
                'name' => $hit['_source']['name'],
            ];
        }, $response['hits']['hits']);
    }
    public function searchCitiesState($query, $country_id = "")
    {

        // $response = $this->client->search([
        //     'index' => 'cities',  // Make sure the index exists
        //     'body' => [
        //         'query' => [
        //             'bool' => [
        //                 'must' => [
        //                     [
        //                         'term' => [
        //                             'country_id' => $country_id,
        //                         ]
        //                     ]
        //                 ],
        //                 'should' => [
        //                     [
        //                         'match' => [
        //                             'name' => [
        //                                 'query' => '*' . strtolower($query) . "*",
        //                                 'fuzziness' => "AUTO"
        //                             ]
        //                         ]
        //                     ]
        //                 ]
        //             ]
        //         ]
        //     ]
        // ]);
        $response = $this->client->search([
    'index' => 'cities',  // Ensure the index exists
    'body' => [
        'query' => [
            'bool' => [
                'must' => [
                    [
                        'term' => [
                            'country_id' => $country_id,
                        ]
                    ]
                ],
                'should' => [
                    [
                        'wildcard' => [
                            'name' => [
                                'value' => strtolower($query) . '*',  // Use wildcard for partial matching
                                'boost' => 1.0  // Optional: boost the score for wildcard matches
                            ]
                        ]
                    ],
                    [
                        'match' => [
                            'name' => [
                                'query' => strtolower($query),
                                'fuzziness' => "AUTO"  // Use fuzzy matching for spelling errors
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
]);

        // Extract and return the matched states

        return array_map(function ($hit) {

            $params = [
                'index' => 'states', // Your index name
                'body'  => [
                    'query' => [
                        'match' => [
                            'state_id' => $hit['_source']['state_id']
                        ]
                    ]
                ]
            ];

            // Execute the search
            $response_state = $this->client->search($params);

            // Handle the response_state
            $location = null;
            $state_id = "";
            $state_name = "";
            if (isset($response_state['hits']['hits']) && count($response_state['hits']['hits']) > 0) {
                $state_id = $response_state['hits']['hits'][0]['_source']['state_id']; // Get the first matching document
                $state_name = $response_state['hits']['hits'][0]['_source']['name']; // Get the first matching document
            }

            return [
                'id' => $hit['_source']['city_id'],
                'name' => $hit['_source']['name'],
                'state_id' => $state_id,
                'state_name' => $state_name,
            ];
        }, $response['hits']['hits']);
    }
}
