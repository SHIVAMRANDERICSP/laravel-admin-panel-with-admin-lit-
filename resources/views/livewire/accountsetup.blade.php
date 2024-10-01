<div>


    {{-- Step 1: Select Account Role --}}
    @if ($currentStep == 1)
    @include('livewire/view-1');
    @elseif ($currentStep == 2)
    @include('livewire/view-2');
    @elseif ($currentStep == 3)
    @include('livewire/view-3');
    @elseif ($currentStep == 4)
    @include('livewire/view-4');
    @elseif ($currentStep == 5)
    @include('livewire/view-5');
    @elseif ($currentStep == 6)
    @include('livewire/view-6');
    @elseif ($currentStep == 7)
    @include('livewire/view-7');
    @endif
</div>