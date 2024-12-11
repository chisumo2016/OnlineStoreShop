@extends('admin.layouts.master')

@section('content')
<!-- Main Content -->
<section class="section">
    <div class="section-header">
        <h1>Edit Product</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit  Product</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form-->
                        <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"  name="name"  value="{{ $product->name}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Preview</label>
                                <br>
                                <img src="{{ asset($product->thumb_image)}}" alt="" style="width:200px">
                            </div>
                            <div class="form-group">
                                <label>Thumb Image</label>
                                <input type="file"  name="thumb_image"  class="form-control">
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Category</label>
                                        <select id="inputState" class="form-control main-category"  name="category_id">
                                            <option value="">Select</option>
                                            @foreach ($categories as $category)
                                            <option {{  $category->id == $product->category_id  ? 'selected' : ''}}  value="{{ $category->id}}">{{ $category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Sub Category</label>
                                        <select id="inputState" class="form-control sub-category" name="sub_category_id">
                                            <option value="">Select</option>
                                            @foreach ($subCategories as $subCategory)
                                                <option {{  $subCategory->id == $product->sub_category_id  ? 'selected' : ''}}  value="{{ $subCategory->id}}">{{ $subCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="inputState">Child Category</label>
                                        <select id="inputState" class="form-control child-category" name="child_category_id">
                                            <option value="">Select</option>
                                            @foreach ($childCategories as $childCategory)
                                                 <option {{  $childCategory->id == $product->child_category_id  ? 'selected' : ''}}  value="{{ $childCategory->id}}">{{ $childCategory->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="inputState">Brand</label>
                                        <select id="inputState" class="form-control" name="brand_id">
                                            <option value="">Select</option>
                                            @foreach ($brands as $brand)
                                            <option {{  $brand->id == $product->brand_id  ? 'selected' : ''}} value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text"  name="sku"  value="{{ $product->sku}}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text"  name="price"  value="{{$product->price }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Offer Price</label>
                                        <input type="text"  name="offer_price"  value="{{$product->offer_price }}" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer Start Date</label>
                                        <input type="text"  name="offer_start_date"  value="{{$product->offer_start_date }}" class="form-control datepicker">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Offer End Date</label>
                                        <input type="text"  name="offer_end_date"  value="{{ $product->offer_end_date }}" class="form-control  datepicker">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Stock Quantity</label>
                                        <input type="number"  min="0" name="qty"  value="{{ $product->qty }}" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Video Link</label>
                                        <input type="text"   name="video_link"  value="{{$product->video_link }}" class="form-control">
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Short Description</label>
                                        <textarea name="short_description"  class="form-control">{!! $product->short_description !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Long Description</label>
                                        <textarea name="long_description"  class="form-control summernote">{!! $product->long_description !!}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputState">Product  Type</label>
                                <select id="inputState" class="form-control" name="product_type">
                                    <option value="">Select</option>
                                    <option {{ $product->product_type ==   'new_arrival'  ?   'selected' : '' }} value="new_arrival">New Arrival</option>
                                    <option {{ $product->product_type ==   'featured_product'     ?   'selected' : '' }} value="featured_product">Featured</option>
                                    <option {{ $product->product_type ==   'top_product'  ?   'selected' : '' }} value="top_product">Top Product</option>
                                    <option {{ $product->product_type ==   'best_product' ?   'selected' : '' }} value="best_product">Best Product</option>

                                </select>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Seo Title</label>
                                    <input type="text"  name="seo_title"  value="{{ $product->seo_title }}" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Seo Description</label>
                                <textarea name="seo_description"  class="form-control">{!! $product->seo_description !!}</textarea>
                            </div>


                            <div class="form-group">
                                <label for="inputState">Status</label>
                                <select id="inputState" class="form-control" name="status">
                                    <option   {{ $product->status == 1 ? 'selected' : ''   }} value="1">Active</option>
                                    <option   {{ $product->status == 0 ? 'selected' : ''   }}  value="0">Inactive</option>
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
            /*Reset Child Category*/
            $('.child-category').html('<option  value="">select</option>')
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



<!--<div class="row">-->
<!--    <div class="col-md-4">-->
<!--        <div class="form-group">-->
<!--            <label for="inputState">Is Top</label>-->
<!--            <select id="inputState" class="form-control" name="is_top">-->
<!--                <option value="">Select</option>-->
<!--                <option value="1">Yes</option>-->
<!--                <option  value="0">No</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <div class="form-group">-->
<!--            <label for="inputState">Is Best</label>-->
<!--            <select id="inputState" class="form-control" name="is_best">-->
<!--                <option value="">Select</option>-->
<!--                <option value="1">Yes</option>-->
<!--                <option  value="0">No</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-4">-->
<!--        <div class="form-group">-->
<!--            <label for="inputState">Is Featured</label>-->
<!--            <select id="inputState" class="form-control" name="is_featured">-->
<!--                <option value="">Select</option>-->
<!--                <option value="1">Yes</option>-->
<!--                <option  value="0">No</option>-->
<!--            </select>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
