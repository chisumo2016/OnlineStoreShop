@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Product</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create  Slider</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form-->
                        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"  name="name"  value="{{ old('name') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Starting Price</label>
                                <input type="text"  name="starting_price"  value="{{ old('starting_price') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Thumb Image</label>
                                <input type="file"  name="thumb_image"  class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Category</label>
                                        <select id="inputState" class="form-control main-category"  name="status">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id}}">{{ $category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Sub Category</label>
                                        <select id="inputState" class="form-control sub-category" name="status">
                                            <option value="">Select</option>>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Child Category</label>
                                        <select id="inputState" class="form-control child-category" name="status">
                                            <option value="">Select</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option value="1">Active</option>
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

@push('scripts')
<script>
    $(document).ready(function () {
        $('body').on('change', '.main-category',function (e) {
            /**Grab  the current value**/
            var categoryId = $(this).val();

            /*AJAX request to fetch subcategories*/

            $.ajax({
                url: "{{ route('admin.product.get-subcategories') }}",
                method: 'GET',
                data: {
                    id:categoryId
                },
                success: function (data) {
                    /**removing the html*/
                    $('.sub-category').html('<option  value="">select</option>')

                    /**Loop the array of sub category  and  get the name*/
                    $.each(data,  function (i, item) {
                        /*Show/appending the name on sub category*/
                        $('.sub-category').append(`<option  value="${item.id}">${item.name}</option>`)
                        console.log(item.name)
                    })
                    console.log(data)
                },
                error: function (xhr, status, error) {
                    console.log(error)
                }

            });
        })

        /*Get Child Categories*/
        $('body').on('change', '.sub-category',function (e) {
            /**Grab  the current value**/
            var categoryId = $(this).val();

            /*AJAX request to fetch subcategories*/

            $.ajax({
                url: "{{ route('admin.product.get-child-categories') }}",
                method: 'GET',
                data: {
                    id:categoryId
                },
                success: function (data) {
                    /**removing the html*/
                    $('.child-category').html('<option  value="">select</option>')

                    /**Loop the array of sub category  and  get the name*/
                    $.each(data,  function (i, item) {
                        /*Show/appending the name on sub category*/
                        $('.child-category').append(`<option  value="${item.id}">${item.name}</option>`)
                        console.log(item.name)
                    })
                    console.log(data)
                },
                error: function (xhr, status, error) {
                    console.log(error)
                }

            });
        })
    })
</script>
@endpush
