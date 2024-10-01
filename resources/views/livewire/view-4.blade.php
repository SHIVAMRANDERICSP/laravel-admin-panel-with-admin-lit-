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
                <h1>How did you hear about us</h1>
                <label for="" class="account-label">Please select</label>
                <select class="account-select" aria-label="Default select example" wire:change="changehow_hear($event.target.value)" wire:model="how_hear">


                    @if($platform)
                    @foreach($platform as $values)
                    <option value="{{$values->name}}">{{$values->name}}</option>
                    @endforeach
                    @endif

                </select>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" wire:model="tnc">
                    <label class="accept-label" for="flexCheckDefault">
                        To continue please read & accept <a href="#" class="nav-link">Terms & Conditions</a>
                    </label>
                </div>
                @error('how_hear')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                @error('tnc')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="country-info">
                    <button wire:click="previousStep" class="nav-link back-btn">
                        <i class="fa-solid fa-arrow-left-long"></i> Back
                    </button>
                    <button wire:click="nextStep" wire:loading.attr="disabled" class="nav-link next-btn-inner {{ empty($how_hear) ? 'disabled-btn' : '' }}" @if(!$how_hear) disabled @endif>
                        Next <i class="fa-solid fa-lock"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>