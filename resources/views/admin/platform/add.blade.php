<x-app-layout>
    <section class="content-wrapper mt-3">
        <div class="container">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add Platform</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('platform.store') }}" method="post">
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