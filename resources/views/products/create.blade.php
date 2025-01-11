@extends('layouts.admin_master')

@section('content')
    <style>
        /* Include the CSS defined above here */
        /* Toaster container */
        .toaster {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }

        /* Individual toast */
        .toast {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateX(100%);
            transition: opacity 0.3s, transform 0.3s;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast.success {
            background-color: #28a745;
        }

        .toast.error {
            background-color: #dc3545;
        }

        .toast.info {
            background-color: #17a2b8;
        }

        .toast.warning {
            background-color: #ffc107;
        }

        /* Close button */
        .toast .close-btn {
            margin-left: 20px;
            cursor: pointer;
        }
    </style>

    <main>
        <div class="toaster" id="toaster">
            <!-- Example toasts, will be dynamically added/removed in practice -->
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <!-- @if (session('success'))
    <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
    @endif

                        @if (session('error'))
    <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
    @endif -->
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Add New Product</h3>
                        </div>
                        <div class="card-body">
                            <form id="appProductForm" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputProductCode">Product Code</label>
                                            <input class="form-control py-4" id="inputProductCode" name="code"
                                                type="text" placeholder="Enter product code" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputProductName">Product Name</label>
                                            <input class="form-control py-4" id="inputProductName" name="name"
                                                type="text" placeholder="Enter product name" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputCategory">Category</label>
                                            <input class="form-control py-4" id="inputCategory" name="category"
                                                type="text" placeholder="Enter product category" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputStock">Stock</label>
                                            <input class="form-control py-4" id="inputStock" name="stock" type="text"
                                                placeholder="Enter stock quantity" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputUnitPrice">Buy Price (per Unit)</label>
                                            <input class="form-control py-4" id="inputUnitPrice" name="unit_price"
                                                type="text" placeholder="Enter buy price per unit" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputSalePrice">Sale Price (per Unit)</label>
                                            <input class="form-control py-4" id="inputSalePrice" name="sale_price"
                                                type="text" placeholder="Enter sale price per unit" />
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
                                <!-- <h6>{{ getMonth('03-04-2024') }}</h6> -->
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
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('appProductForm');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);

                fetch("{{ route('products.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: formData
                    })
                    // .then(response => {
                    //         if (response.status === 422) {
                    //             return response.json().then(data => {
                    //                 // Handle validation errors
                    //                 for (const [field, messages] of Object.entries(data.errors)) {
                    //                     showToast(messages.join(', '), 'error');
                    //                 }
                    //             });
                    //         } else if (response.ok) {
                    //             return response.json();
                    //         } else {
                    //             throw new Error('Network response was not ok.');
                    //         }
                    //     })
                    //     .then(data => {
                    //         if (data.success) {
                    //             showToast(data.success, 'success');
                    //             form.reset();
                    //         }
                    //     })
                    //     .catch(error => {
                    //         console.error('Error:', error);
                    //         showToast('There was an error processing your request.', 'error');
                    //     });

                    .then(response => {
                        if (response.ok) {
                            return response.json();
                        }
                        throw new Error('Network response was not ok.');
                    })
                    .then(data => {
                        if (data.success) {
                            // alert('Product added successfully!');
                            showToast('Product added successfully!');
                            form.reset();
                        } else if (data.errors) {
                            // Handle validation errors
                            for (const [field, messages] of Object.entries(data.errors)) {
                                showToast(messages.join(', '), 'error');
                            }

                            // return data.json().then(data => {
                            //     for (const [field, messages] of Object.entries(data.errors)) {
                            //         showToast(messages.join(', '), 'error');
                            //     }
                            // });
                        } else {
                            showToast('There was an error adding the product.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });

            });
        });


        function showToast(message, type = 'info') {
            const toaster = document.getElementById('toaster');

            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <span>${message}</span>
                <span class="close-btn" onclick="this.parentElement.remove();">&times;</span>
            `;

            toaster.appendChild(toast);

            // Show the toast
            setTimeout(() => {
                toast.classList.add('show');
            }, 100);

            // Remove the toast after 3 seconds
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300); // Match the CSS transition duration
            }, 3000);
        }
    </script>
@endsection
