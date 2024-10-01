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
            <div class="account-title">
                <h1>Add an artist to your account</h1>
                <div class="country-inner">
                    <label for="" class="account-label">Artist name</label>
                    <input type="text" class="country-input-inner" wire:model="artist_name" wire:keyup="searchArtist($event.target.value);visible = true;">
                </div>
                <input type="hidden" value="" wire:change="changeartisat($event.target.value)" wire:model=" artist_hidden" name="artist_hidden">

                @if (!empty($allArtist))
                <div class="country-item" x-show="visible">
                    <ul class="country-results">
                        @foreach ($allArtist as $result)
                        <li wire:click="setArtist('{{ $result['id'] }}','{{ $result['name'] }}',('{{ $result['images'] ? $result['images'][0]['url'] : '' }}'))" x-show="visible" @click="visible = false">{{ $result['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @error('artist_hidden')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="country-info">
                    <button wire:click="nextStep" wire.loading.attr="disabled" class="nav-link next-btn-inner {{ empty($artist_hidden) ? 'disabled-btn' :  '' }}" @if(!$artist_hidden) disabled @endif>
                        Next <i class="fa-solid fa-lock"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>