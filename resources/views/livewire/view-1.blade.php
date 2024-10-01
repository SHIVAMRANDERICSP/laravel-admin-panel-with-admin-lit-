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
                <h1>Select account role</h1>

                <label for="role" class="account-label">Select account role...</label>
                <select class="account-select" id="role" wire:model="role" wire:change="changeRole($event.target.value)">
                    <option value="" selected>Select Role</option>
                    @foreach($roledata as $value)
                    <option value={{$value->name}}>{{$value->name}}</option>
                    @endforeach
                </select>
                @error('role')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="country-info">
                    <button wire:click="nextStep"
                        wire:loading.attr="disabled"
                        class="nav-link next-btn {{ empty($role) ? 'disabled-btn' : '' }}" @if(!$role) disabled @endif>
                        Next <i class="fa-solid fa-arrow-right-long"></i>
                    </button>

                </div>
            </div>
        </div>
    </div>
</section>