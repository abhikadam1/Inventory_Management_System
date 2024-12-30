@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add New Product</h3></div>
                    <div class="card-body">
                        <form id="appProductForm" enctype="multipart/form-data">
                        @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputProductCode">Product Code</label>
                                        <input class="form-control py-4" id="inputProductCode" name="code" type="text" placeholder="Enter product code" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputProductName">Product Name</label>
                                        <input class="form-control py-4" id="inputProductName" name="name" type="text" placeholder="Enter product name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputCategory">Category</label>
                                        <input class="form-control py-4" id="inputCategory" name="category" type="text" placeholder="Enter product category" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputStock">Stock</label>
                                        <input class="form-control py-4" id="inputStock" name="stock" type="text" placeholder="Enter stock quantity" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputUnitPrice">Buy Price (per Unit)</label>
                                        <input class="form-control py-4" id="inputUnitPrice" name="unit_price" type="text" placeholder="Enter buy price per unit" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputSalePrice">Sale Price (per Unit)</label>
                                        <input class="form-control py-4" id="inputSalePrice" name="sale_price" type="text" placeholder="Enter sale price per unit" />
                                    </div>
                                </div>

                                <!-- Uncomment if you need file upload -->
                                <!-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPhoto">Gallery</label>
                                        <input class="form-control-file" id="inputPhoto" name="photo" type="file" />
                                    </div>
                                </div> -->
                            </div>

                            <div class="form-group mt-4 mb-0">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('appProductForm');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch("{{ route('products.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                if (data.success) {
                    alert('Product added successfully!');
                    form.reset();
                } else {
                    alert('There was an error adding the product.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>
@endsection
