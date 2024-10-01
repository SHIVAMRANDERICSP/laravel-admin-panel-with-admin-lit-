<section class="py-5">
    <style>
        /* Default button style */

        .disabled-btn {
            background-color: #d3d3d3;
            /* Light background when disabled */
            color: #a9a9a9;
            /* Light text */
            cursor: not-allowed;
            /* Disabled cursor */
        }


        /* Disabled button style */
    </style>
    <div class="container">
        <div class="account-inner">
            <div class="account-title" x-data="{ visible_address: false }">
                <h1>Where are you located?</h1>

                <div class="country-inner">
                    <label for="country" class="account-label">Search for country</label>
                    <input type="text" class="country-input" id="country" wire:model="country" wire:keyup="searchCountries($event.target.value);visible = true;">
                </div>
                <input type="hidden" value="" wire:model="country_hidden" wire:keyup="checkCountry($event.target.value)" name="country_hidden">
                @if (!empty($allCountries))
                <div class="country-item" x-show="visible">
                    <ul class="country-results">
                        @foreach ($allCountries as $result)
                        <li wire:click="setCountry('{{ $result['id'] }}','{{ $result['name'] }}')" x-show="visible" @click="visible = false">{{ $result['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="country-inner">
                    <label for="" class="account-label">Start typing first line of address...</label>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" class="country-input" value="" wire:model="first_address" wire:keyup=" searchCitiesState($event.target.value,{{ $country_hidden }});visible=true;">

                    @if (!empty($allCitiesStates))
                    <div class="country-item" x-show="visible">
                        <ul class="country-results">
                            @foreach ($allCitiesStates as $result)
                            <li wire:click="setCityState('{{ $result['id'] }}','{{ $result['name'] }}','{{ $result['state_id'] }}','{{ $result['state_name'] }}')" x-show="visible" @click="visible = false">{{ $result['name']  }} {{ $result['state_name'] ? " , ".$result['state_name'] : ""  }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                <p class="account-label cursor-pointer" x-show="!visible_address" @click="visible_address = true">or enter your address manually</p>

                <div class="viewMoreAddress" x-show="visible_address">
                    <div class="country-inner">
                        <label for="" class="account-label">Address</label>
                        <input type="text" class="country-input-inner" wire:model="address_1">
                    </div>
                    <div class="country-inner">
                        <label for="" class="account-label">Address 2 (optional)</label>
                        <input type="text" class="country-input-inner" wire:model="address_2">
                    </div>
                    <div class="country-inner">
                        <label for="" class="account-label">County</label>
                        <input type="text" class="country-input-inner" value="" wire:model="state" wire:keyup="searchStates($event.target.value,{{ $country_hidden }});visible = true;">

                        <input type="hidden" value="" wire:model="state_hidden" name="state_hidden">
                        @if (!empty($allStates))
                        <div class="country-item" x-show="visible">
                            <ul class="country-results">
                                @foreach ($allStates as $result)
                                <li wire:click="setState('{{ $result['id'] }}','{{ $result['name'] }}')" x-show="visible" @click="visible = false">{{ $result['name']  }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="country-inner">
                        <label for="" class="account-label">Town</label>
                        <input type="text" class="country-input-inner" value="" wire:model="city" wire:keyup="searchCities($event.target.value,{{ $country_hidden }},{{ $state_hidden }});visible = true;">

                        <input type="hidden" value="" wire:model="city_hidden" name="city_hidden">
                        @if (!empty($allCities))
                        <div class="country-item" x-show="visible">
                            <ul class="country-results">
                                @foreach ($allCities as $result)
                                <li wire:click="setCity('{{ $result['id'] }}','{{ $result['name'] }}')" x-show="visible" @click="visible = false">{{ $result['name']  }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="country-inner">
                        <label for="" class="account-label">Postcode</label>
                        <input type="text" class="country-input-inner" wire:model="postcode">
                    </div>
                </div>

                @error('country_hidden')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="country-info">
                    <button wire:click="previousStep" class="nav-link back-btn">
                        <i class="fa-solid fa-arrow-left-long"></i> Back
                    </button>
                    <button wire:click="nextStep" wire:loading.attr="disabled" class="nav-link nav-link next-btn-inner {{ empty($first_address) ? 'disabled-btn' : '' }}" @if(!$first_address) disabled @endif>
                        Next <i class="fa-solid fa-lock"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>