<section class="py-5">
    <style>
        .disabled-btn {
            background-color: #d3d3d3;
            /* Light background when disabled */
            color: #a9a9a9;
            /* Light text */
            cursor: not-allowed;
            /* Disabled cursor */
        }
    </style>
    <div class="container">
        <div class="account-inner">
            <div class="account-title" x-data="{ visible: true }">
                <h1>Where are you located?</h1>

                <div class="country-inner">
                    <label for="country" class="account-label">Search for country</label>
                    <input type="text" class="country-input" id="country" wire:model="country" wire:keyup="searchCountries($event.target.value);visible = true;" autocomplete="off">
                </div>
                <input type="hidden" value="" wire:model="country_hidden" wire:keyup="checkCountry($event.target.value)" name="country_hidden">
                @if (!empty($allCountries))
                <div class="country-item" x-show="visible">
                    <ul class="country-results">
                        @foreach ($allCountries as $result)
                        <li wire:click="setCountry('{{ $result['id'] }}','{{ $result['name'] }}')" x-show="visible" @click="visible = false">{{ $result['name']  }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @error('country_hidden')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="country-info">
                    <button wire:click="previousStep" class="nav-link back-btn">
                        <i class="fa-solid fa-arrow-left-long"></i> Back
                    </button>

                    <button wire:click="nextStep"
                        wire:loading.attr="disabled"
                        class="nav-link nav-link next-btn-inner {{ empty($country_hidden) ? 'disabled-btn' : '' }}" @if(!$country_hidden) disabled @endif>
                        Next <i class="fa-solid fa-lock"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>