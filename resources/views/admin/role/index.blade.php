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
                                    <h3 class="card-title">All roles</h3>
                                </div>

                                <div class="col-sm-6">
                                    <a href="{{ route('role.add') }}" class="btn btn-sm btn-primary">
                                        Add Roles
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $value)
                                    <tr>
                                        <td>{{ $value->id}}</td>
                                        <td>{{ $value->name}}</td>
                                        <td><a title="Edit" class="btn btn-sm btn-primary" href="{{ route('role.edit', $value->id) }}"><i class="fa fa-edit"></i></a></td>



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