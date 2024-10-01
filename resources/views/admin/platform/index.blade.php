<style>
    .artist-images {
        width: 50px !important;
    }
</style>
<x-app-layout>



    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <section class="content-wrapper">
        <div class="container">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h3 class="card-title">All Platform</h3>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('platform.add') }}" class="btn btn-sm btn-primary">
                                        Add Platform
                                    </a>
                                </div>


                            </div>

                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Link</th>

                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $value)
                                        <tr>
                                            <td>{{ $value->id}}</td>
                                            <td>{{ $value->name}}</td>
                                            <td>{{ $value->link }}</td>
                                            <td><a title="Edit" class="btn btn-sm btn-primary" href="{{ route('platform.edit', $value->id) }}"><i class="fa fa-edit"></i></a><a title="Delete" onclick="if(!confirm('Sure You Want To Delete Paper?')){return false;}" class="btn btn-sm btn-danger" href="{{ route('platform.delete', $value->id) }}"><i class="fa fa-trash"></i></a></td>


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