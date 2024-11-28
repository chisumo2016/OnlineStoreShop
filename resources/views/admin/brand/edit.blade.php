@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Brand</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update  Brand</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form-->
                            <form action="{{ route('admin.brand.update', $brand) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"  name="name"  value="{{ $brand->name }}" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>Preview Logo</label>
                                    <br>
                                    <img src="{{ asset($brand->logo) }}" alt="" width="100">
                                </div>

                                <div class="form-group">
                                    <label>Logo</label>
                                    <input type="file"  name="logo"  value="{{ $brand->logo }}" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label for="inputState">Is Featured</label>
                                    <select id="inputState" class="form-control" name="is_featured">
                                        <option value="">Select</option>
                                        <option {{ $brand->is_featured == 1 ?  'selected'   : '' }} value="1">Yes</option>
                                        <option  {{ $brand->is_featured == 0 ?  'selected'  : ''}} value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $brand->status == 1 ?  'selected'   : '' }} value="1">Active</option>
                                        <option {{ $brand->status == 0 ?  'selected'   : '' }}  value="0">Inactive</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
