<x-app-layout>
    <section class="content-wrapper mt-3">
        <div class="container">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Search Weather</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                    <div class="form-group">
                        <label for="roleName">Search Country Or city or pincode</label>
                        <input type="text" name="name" class="form-control name" id="name" value="" required placeholder="Enter Name">
                    </div>

                    <div class="card-footer">
                        <input type="button" class="btn btn-primary ajax_call" value="Find current Weather">
                    </div>
                    </form>
                </div>
            </div>
            <div class="container mt-4 weatherDisplayold">
                <h2 class="text-center">Current Weather in {{ $response->location->name }}</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Temperature: {{ $response->current->temp_c }} °C ({{$response->current->temp_f}} °F)</h5>
                        <p class="card-text">Condition: {{ $response->current->condition->text}}</p>
                        <img src="https:{{$response->current->condition->icon}}" alt="{{$response->current->condition->text}}">
                        <p>Humidity: {{$response->current->humidity}}%</p>
                        <p>Wind: {{$response->current->wind_kph}} kph ({{$response->current->wind_mph}} mph)</p>
                        <p>Pressure: {{$response->current->pressure_mb}} mb</p>
                        <p>Feels Like: {{$response->current->feelslike_c}} °C ({{$response->current->feelslike_f}} °F)</p>
                        <p>Dew Point: {{$response->current->dewpoint_c}} °C ({{$response->current->dewpoint_f}} °F)</p>
                        <h6>Air Quality:</h6>
                        <p>CO: {{$response->current->air_quality->co}}</p>
                        <p>NO2: {{$response->current->air_quality->no2}}</p>
                        <p>O3: {{$response->current->air_quality->o3}}</p>
                        <p>SO2: {{$response->current->air_quality->so2}}</p>
                        <p>PM2.5: {{$response->current->air_quality->pm2_5}}</p>
                        <p>PM10: {{$response->current->air_quality->pm10}}</p>
                    </div>
                </div>
            </div>
            <div id="weatherDisplay"></div>
        </div>
    </section>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $('.ajax_call').on('click', function() {
            var name = $('.name').val();
            $.ajax({
                type: 'POST',
                url: "{{ route('getweather') }}",
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}", // Correct CSRF token syntax
                    'name': name
                },
                success: function(data) {
                    $('.weatherDisplayold').hide();
                    displayWeather(data);
                },
                complete: function() {
                    alert('complete');
                },
                error: function(result) {
                    alert('error');
                }
            });

        });

        function displayWeather(data) {
            const location = data.location.name + ', ' + data.location.region + ', ' + data.location.country;
            const current = data.current;

            const weatherHtml = `
        <div class="container mt-4">
            <h2 class="text-center">Current Weather in ${location}</h2>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Temperature: ${current.temp_c} °C (${current.temp_f} °F)</h5>
                    <p class="card-text">Condition: ${current.condition.text}</p>
                    <img src="https:${current.condition.icon}" alt="${current.condition.text}">
                    <p>Humidity: ${current.humidity}%</p>
                    <p>Wind: ${current.wind_kph} kph (${current.wind_mph} mph)</p>
                    <p>Pressure: ${current.pressure_mb} mb</p>
                    <p>Feels Like: ${current.feelslike_c} °C (${current.feelslike_f} °F)</p>
                    <p>Dew Point: ${current.dewpoint_c} °C (${current.dewpoint_f} °F)</p>
                    <h6>Air Quality:</h6>
                    <p>CO: ${current.air_quality.co}</p>
                    <p>NO2: ${current.air_quality.no2}</p>
                    <p>O3: ${current.air_quality.o3}</p>
                    <p>SO2: ${current.air_quality.so2}</p>
                    <p>PM2.5: ${current.air_quality.pm2_5}</p>
                    <p>PM10: ${current.air_quality.pm10}</p>
                </div>
            </div>
        </div>
    `;

            // Append the generated HTML to a div with id 'weatherDisplay'
            $('#weatherDisplay').html(weatherHtml);
        }
    </script>
</x-app-layout>