<?php

namespace App\Livewire;

use App\Models\UserProfile;
use App\Models\role;
use App\Models\Platform;

use App\Services\ElasticsearchService;
use Livewire\Component;
use Elasticsearch\ClientBuilder;


class AccountSetup extends Component
{
    public $currentStep = 1;
    public $role; // To store selected role
    public $country;
    public $country_hidden;
    public $roledata;


    public $address_1;
    public $address_2;
    public $city;
    public $city_hidden;
    public $state;
    public $state_hidden;
    public $postcode;

    public $first_address;

    public $how_hear;
    public $tnc;
    public $platform;
    public $countryResults = []; // To store country search results
    public $allCountries = []; // To store all countries
    public $allStates = []; // To store all countries
    public $allCities = []; // To store all countries
    public $allCitiesStates = []; // To store all countries

    public $allArtist = []; // To store all countries

    public $artist_name;
    public $artist_hidden;
    public $artist_image;

    public $spotify_url;

    public $artist_info;

    protected $rules = [
        // Role is required
    ];

    public function messages()
    {
        return [
            'artist_hidden.required' => 'The artist field is required.',
            'country_hidden.required' => 'The country field is required.',
            'state_hidden.required' => 'The county field is required.',
            'city_hidden.required' => 'The town field is required.',
        ];
    }

    protected $elasticsearchService;

    public function mount(ElasticsearchService $elasticsearchService)
    {
        $this->roledata = role::all();
        $this->platform = Platform::all();

        $this->elasticsearchService = $elasticsearchService;
        if ($this->currentStep == 6) {
        }
    }
    public function nextStep()
    {
        if ($this->currentStep == 1) {

            $this->rules = [
                'role' => 'required',
            ];


            $this->validate(); // Validate role selection
        } elseif ($this->currentStep == 2) {
            $this->rules = [
                'country_hidden' => 'required',
            ];

            $this->validate(); // Validate country selection
        } elseif ($this->currentStep == 4) {
            $this->rules = [
                'how_hear' => 'required',
                'tnc' => 'required',
            ];

            $this->validate(); // Validate country selection
        } elseif ($this->currentStep == 5) {
            $this->rules = [
                'artist_hidden' => 'required'
            ];

            $this->validate(); // Validate country selection
        }

        if ($this->currentStep == 6) {

            // Insert the data into the database
            //dd($this->country_hidden);
            UserProfile::create([
                'role' => !empty($this->role) ? $this->role : "",
                'country' => !empty($this->country) ? $this->country : "",
                'country_id' => !empty($this->country_hidden) ? $this->country_hidden : "",
                'state' => !empty($this->state) ? $this->state : "",
                'state_id' => !empty($this->state_hidden) ? $this->state_hidden : "",
                'city' => !empty($this->city) ? $this->city : "",
                'city_id' => !empty($this->city_hidden) ? $this->city_hidden : "",
                'address_1' => !empty($this->address_1) ? $this->address_1 : "",
                'address_2' => !empty($this->address_2) ? $this->address_2 : "",
                'postcode' => !empty($this->postcode) ? $this->postcode : "",
                'how_hear' => !empty($this->how_hear) ? $this->how_hear : "",
                'tnc' => !empty($this->tnc) ? $this->tnc : "",
                'artist_name' => !empty($this->artist_name) ? $this->artist_name : "",
                'artist_hidden' => !empty($this->artist_hidden) ? $this->artist_hidden : "",
                'artist_image' => !empty($this->artist_image) ? $this->artist_image : "",
                'spotify_url' => !empty($this->spotify_url) ? $this->spotify_url : "",
            ]);

            // session()->flash('message', 'Account setup complete, and data stored in the database!');
        }
        $this->currentStep++;
        // $this->emit('roleSelected', $this->role); // Emit event for JS to handle localStorage
    }

    public function previousStep()
    {
        $this->currentStep--;
    }

    public function searchCountries(ElasticsearchService $elasticsearchService, $query = "")
    {
        $this->allCountries =  $elasticsearchService->searchCountries($query);
    }

    public function changeRole($role)
    {
        //dd($countryName);
        $this->role = $role;
    }
    public function checkCountry($country)
    {

        $this->country_hidden = $country;
    }
    public function changehow_hear($how_hear)
    {
        $this->how_hear = $how_hear;
    }
    public function changeartisat($data)
    {
        $this->artist_hidden = $data;
    }

    public function setCountry($countryId, $countryName)
    {
        //dd($countryName);
        $this->country = $countryName;
        $this->country_hidden = $countryId;

        $this->allCountries = [];
    }

    public function searchStates(ElasticsearchService $elasticsearchService, $query = "", $country_id = "")
    {
        $this->allStates =  $elasticsearchService->searchStates($query, $country_id);
    }

    public function setState($stateId, $stateName)
    {
        //dd($stateName);
        $this->state = $stateName;
        $this->state_hidden = $stateId;

        $this->allStates = [];
    }

    public function searchCities(ElasticsearchService $elasticsearchService, $query = "", $country_id = "", $state_id = "")
    {
        $this->allCities =  $elasticsearchService->searchCities($query, $country_id, $state_id);
    }

    public function setCity($cityId, $cityName)
    {
        //dd($cityName);
        $this->city = $cityName;
        $this->city_hidden = $cityId;

        $this->allCities = [];
    }

    public function searchCitiesState(ElasticsearchService $elasticsearchService, $query = "", $country_id = "")
    {
        $this->allCitiesStates =  $elasticsearchService->searchCitiesState($query, $country_id);
    }

    public function setCityState($cityId, $cityName, $stateId, $stateName)
    {
        //dd($cityName);
        $this->city = $cityName;
        $this->city_hidden = $cityId;


        $this->state = $stateName;
        $this->state_hidden = $stateId;

        $this->first_address = $cityName . ($stateName ? " , " . $stateName : "");

        $this->allCitiesStates = [];
    }

    public function getAuth()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://accounts.spotify.com/api/token',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=cdfb3ae491ec40ab979270be37c6bd96&client_secret=ae4b691422924007ba531b9e8765992f',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Basic Y2RmYjNhZTQ5MWVjNDBhYjk3OTI3MGJlMzdjNmJkOTY6YWU0YjY5MTQyMjkyNDAwN2JhNTMxYjllODc2NTk5MmY=',
                'Content-Type: application/x-www-form-urlencoded',
                'Cookie: __Host-device_id=AQAt9Ul1T38tdT1SwPtHuVsipDwgjWNMRnqE9BPvENKXXSCTyw_pP0kMGuoJ_9yD4MRK8cUg5upjc9AYJfOo1w5MXXbi6p6Dprw; sp_tr=false'
            ),
        ));

        $response = curl_exec($curl);

        $response = json_decode($response, 1);

        curl_close($curl);
        return $response;
    }
    public function searchArtist($query = "")
    {

        $response = $this->getAuth();
        $this->allArtist = [];

        if (!empty($response['access_token'])) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.spotify.com/v1/search?q=' . $query . '&type=artist',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $response['access_token']
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response, 1);

            if (isset($response['artists']['items'])) {
                $this->allArtist = $response['artists']['items'];
            }
        }
    }
    public function searchUrlArtist()
    {
        $response = $this->getAuth();
        $this->allArtist = [];

        $this->artist_name = "";
        $this->artist_hidden = "";
        $this->artist_image = "";

        if (!empty($response['access_token'])) {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.spotify.com/v1/artists/' . basename($this->spotify_url),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $response['access_token']
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $response = json_decode($response, 1);

            if (isset($response['id'])) {
                $this->artist_name = $response['name'];
                $this->artist_hidden = $response['id'];
                $this->artist_image = $response['images'] ? $response['images'][0]['url'] : '';
            }
        }
    }

    public function setArtist($artistId, $artistName, $artistImage)
    {
        //dd($countryName);
        $this->artist_name = $artistName;
        $this->artist_hidden = $artistId;
        $this->artist_image = $artistImage;

        $this->allArtist = [];
    }

    public function render()
    {

        return view('livewire.accountsetup');
    }
}
