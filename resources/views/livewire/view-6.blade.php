<section>
    <div class="container">
        <div class="account-inner">
            <div class="spotify-account-inner">
                <img src="images/1200px-Spotify (1).png" class="img-fluid spotify-images" alt="">
                <h1>Plug into your artist's Spotify account</h1>
                <p>If they have a Spotify profile then connect below to help us find their music.</p>
            </div>
            <ul class="nav artist-inner" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class=" artist-btn " id="artist-tab" data-bs-toggle="tab"
                        data-bs-target="#artist-tab-pane" type="button" role="tab" aria-controls="artist-tab-pane"
                        aria-selected="true">Search With Artist Link</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class=" artist-btn active" id="artistname-tab" data-bs-toggle="tab"
                        data-bs-target="#artistname-tab-pane" type="button" role="tab"
                        aria-controls="artistname-tab-pane" aria-selected="false">Search With Artist
                        Name</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="artist-tab-pane" role="tabpanel"
                    aria-labelledby="artist-tab" tabindex="0">

                    <div class="artist-title">
                        <h6>Please enter your Spotify URL or URI in the box below. You can find the link you
                            need by going to the Artist page on Spotify and copying it from the share options.
                            For more details please <a href="#" class="nav-link">see this guide from Spotify.
                            </a></h6>
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="country-inner">
                                    <label for="" class="account-label">Paste your Spotify URL Here</label>
                                    <input type="text" class="country-input-inner"  wire:model="spotify_url"  id="spotify_url" >


                                </div>
                                <button href="#" class="nav-link fetch-btn" wire:click="searchUrlArtist();visible = true;">
                                    Fetch Spotify Profile <i class="fa-solid fa-lock"></i>
                                </button>

                                @if($artist_hidden)
                                <div class="artistname-title">
                                    <div class="artist-info">
                                        @if($artist_image)
                                        <img src="{{ $artist_image }}" class="img-fluid" alt="">
                                        @endif
                                        <div class="artistname-item">
                                            <h3>{{ $artist_name }}</h3>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <h4 class="text-center text-white mt-3">Artist Not Found</h4>
                                @endif

                                <div class="country-info">
                                    <button wire:click="previousStep" class="nav-link back-btn">
                                        <i class="fa-solid fa-arrow-left-long"></i> Back
                                    </button>
                                    <button wire:click="nextStep" class="nav-link next-btn-inner">
                                        Next <i class="fa-solid fa-lock"></i>
                                    </button>
                                </div>
                                <a href="#" wire:click="nextStep" class=" nav-link skip-btn">
                                    Skip this step
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade show active" id="artistname-tab-pane" role="tabpanel" aria-labelledby="artistname-tab"
                    tabindex="0">
                    <div class="artistname-title">
                        <div class="artist-info">
                            @if($artist_image)
                            <img src="{{ $artist_image }}" class="img-fluid" alt="">
                            @endif
                            <div class="artistname-item">
                                <h3>{{ $artist_name }}</h3>
                                <button class="remove-btn">Remove</button>
                            </div>
                        </div>
                        <div class="country-info">
                            <button wire:click="previousStep" class="nav-link back-btn">
                                <i class="fa-solid fa-arrow-left-long"></i> Back
                            </button>
                            <button wire:click="nextStep" class="nav-link next-btn-inner">
                                Next <i class="fa-solid fa-lock"></i>
                            </button>
                        </div>
                        <a href="#" wire:click="nextStep" class=" nav-link skip-btn">
                            Skip this step
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>