@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>Edit Child Categories</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Child Category</h4>
                        </div>
                        <div class="card-body">
                            <!-- Form-->
                            <form action="{{ route('admin.child-category.update',$childCategory) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">Category</label>
                                    <select id="inputState" class="form-control  main-category" name="category_id">
                                        <option  value="">select</option>
                                        @foreach($categories as $category)
                                            <option {{ $category->id == $childCategory->category_id ? 'selected' : ''  }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Sub Category</label>
                                    <select id="inputState" class="form-control sub-category" name="sub_category_id">
                                        <option  value="">select</option>
                                        @foreach($subCategories as $subCategory)
                                            <option  {{ $subCategory->id == $childCategory->sub_category_id ? 'selected' : ''  }}  value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text"  name="name"  value="{{ $childCategory->name}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option  {{ $childCategory->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $childCategory->status == 0 ?  'selected' : '' }}  value="0">Inactive</option>
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

@push('scripts')
    <script>
        $(document).ready(function () {
            $('body').on('change', '.main-category',function (e) {
                /**Grab  the current value**/
                var categoryId = $(this).val();

                /*AJAX request to fetch subcategories*/

                $.ajax({
                    url: "{{ route('admin.get-subcategories') }}",
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
        })
    </script>
@endpush
