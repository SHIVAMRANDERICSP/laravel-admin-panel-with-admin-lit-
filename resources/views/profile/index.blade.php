<style>
    .artist-images {
        width: 50px !important;
    }
</style>
<x-app-layout>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <section class=" content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with minimal features & hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Country</th>
                                        <th>state</th>
                                        <th>city</th>
                                        <th>address_1</th>
                                        <th>how_hear</th>
                                        <th>artist_name</th>
                                        <th>artist_image</th>
                                        <th>spotify_url</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($user as $value)
                                    <tr>
                                        <td>{{ $value->role}}</td>
                                        <td>{{ $value->country}}</td>

                                        <td> {{ $value->state}}</td>
                                        <td>{{ $value->city}}</td>
                                        <td>{{ $value->address_1}}</td>
                                        <td>{{ $value->how_hear}}</td>
                                        <td>{{ $value->artist_name}}</td>
                                        <td><img src="{{ $value->artist_image}}" class="artist-images"></img></td>
                                        <td>{{ $value->spotify_url}}</td>


                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
    </section>
</x-app-layout>