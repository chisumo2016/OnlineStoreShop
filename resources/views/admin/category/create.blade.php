@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Categories</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Category</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form-->
                            <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Button tag -->

                                <div class="form-group">
                                    <label>Icon</label>
                                    <div>
                                        <button class="btn btn-primary" name="icon"  data-selected-class="btn-danger" data-unselected-class="btn-info" role="iconpicker"></button>
                                    </div>
{{--                                    <input type="text"  name="icon" value="{{ old('icon') }}" class="form-control">--}}
                                </div>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"  name="name"  value="{{ old('name') }}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option  value="1">Active</option>
                                        <option  value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
