<x-app-layout>
    <section class="content-wrapper mt-3">
        <div class="container">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Role</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('role.store') }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="roleName">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="" required placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="roleName">URL</label>
                            <input type="text" name="url" class="form-control" id="url" value="" required placeholder="Enter url">
                        </div>

                        <div class="form-group">
                            <label for="roleName">Add Permission</label></br>
                            @foreach($Permission as $setpermission)
                            {{ $setpermission->name  }}
                            <input type="checkbox" name="permission[]" class="form-control" value="{{ $setpermission->name }}" required>
                            @endforeach
                        </div>
                        <div class="col-md-6">
                            <h1>{{ __('Users') }}</h1>

                            <label for="users">{{ __('Users') }}</label>
                            <select class="form-control" name="users[]" id="users" multiple>
                                @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Check me out</label>
                        </div>
                    </div>

                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Add Platfrom">
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>