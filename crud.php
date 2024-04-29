<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone Store Controller</title>
    <!-- Link Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <!--Link CSS -->
    <link rel="stylesheet" href="style.css">
    <!-- datatable css -->
    <link href="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar  fs-4 mb-3"
        style=" color: #0d6efd; font-weight: bold; border-bottom: 1px solid #DFDFDF;
                shadow: 0 0 10px rgba(0, 0, 0, 0.1); background-color: #f8f9fa;
        ">
       
        <div class="d-flex justify-content-between container">
            <div
                style=" color: white; font-size: 1.5rem; display: flex; justify-content: center; align-items: center; border-radius: 5px; cursor: pointer;"
            >
               <img
                    style="width: 80px; height: 40px; object-fit: cover;"
               src="./images/logo.png" alt="">
            </div>
        </div>
        
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-item-center mb-3">
            <div class="text-body-secondary">
                <span class="h5">
                    All Products
                </span>
                <br>
                Manage all your existing users or add new one
            </div>
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
                <i class="fa-solid fa-user-plus"></i> Add New Products
            </button>

        </div>

        <table class="table table-bordered table-striped table-hover align-middle" 
                id="myTable"
                style="width: 100%;"
        >
            <!-- Thead -->
            <thead class="table-dark">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Price $</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Option</th>
                    <th>Image</th>
                    <th>Action</th>  
                </tr>
            </thead>
            <!-- Tbody -->
            <tbody>

            </tbody>
        </table>
    </div>

    <!-- add new user offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
        style="width: 600px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add New Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <form method="POST" id="insertForm" >
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="first_name" id="first_name">
                    </div>
                    <div class="col">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripton</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="row mb-3">
                    <label class="form-label">Uplaod Image</label>
                    <div class="col-2">
                        <img class="preview_img" src="images/df_pf.jpg">
                    </div>
                    <div class="col-10">
                        <div class="file-upload text-secondary">
                            <input type="file" name="image" class="image" accept="image/*">
                            <span class="fs-4 fw-2">Choose file Image</span>
                            <span> or drag drop file here </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Choose Category</label>
                    <!-- select carer  -->
                    <select class="form-select" name="carer" id="carer"  >
                        <option value="">Select...</option>
                        <option value="IOS">IOS</option>
                        <option value="Android">Android</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <!-- groub choose Gender -->
                <div class="mb-3 form-group">
                    <label class="form-label">Option:</label>
                    <select class="form-select" name="gender" id="gender"  >
                        <option value="">Select...</option>
                        <option value="New">New</option>
                        <option value="Second_Hand">Second Hand</option>
                    </select>
                </div>
                <div>
                    <!-- Button Submit -->
                    <button type="submit" class="btn btn-primary me-1" id="insertBtn">Submit</button>
                    <!-- Button Cancel -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>

                </div>
            </form>
            
        </div>
    </div>

    <!-- edit new user offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEditUser" 
        style="width: 600px;">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Edite Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body">
            <form method="POST" id="editForm" >
                <input type="hidden" name="id" id="id">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="first_name" id="first_name">
                    </div>
                    <div class="col">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="row mb-3">
                    <label class="form-label">Uplaod Image</label>
                    <div class="col-2">
                        <img class="preview_img" src="images/df_pf.jpg">
                    </div>
                    <div class="col-10">
                        <div class="file-upload text-secondary">
                            <input type="file" name="image" class="image" accept="image/*">
                            <input type="hidden" name="image_old" id="image_old" >
                            <span class="fs-4 fw-2">Choose file Image</span>
                            <span> or drag drop file here </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Choose Category</label>
                    <!-- select carer  -->
                    <select class="form-select" name="carer" id="carer"  >
                    <option value="">Select...</option>
                        <option value="IOS">IOS</option>
                        <option value="Android">Android</option>
                        <option value="Other">Other</option>

                    </select>
                </div>
                <!-- groub choose Gender -->
                <div class="mb-3 form-group">
                    <label class="form-label">Option:</label>
                    <select class="form-select" name="gender" id="gender"  >
                        <option value="">Select...</option>
                        <option value="New">New</option>
                        <option value="Second_Hand">Second Hand</option>
                    </select>
                </div>
                <div>
                    <!-- Button Submit -->
                    <button type="submit" class="btn btn-primary me-1" id="editBtn">Update</button>
                    <!-- Button Cancel -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>

                </div>
            </form>
            
        </div>
    </div>


    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 start-0 p-3">
        <!-- success toast -->
        <div class="toast align-items-center text-bg-success" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
            <div class="d-flex">
                <div class="toast-body">
                <strong>Success!</strong>
                <span id="successMsg"></span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
         <!-- Error toast -->
         <div class="toast align-items-center text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
            <div class="d-flex">
                <div class="toast-body">
                <strong>Error!</strong>
                <span id="errorMsg"></span>
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>



    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- JS -->
    <script src="script.js"></script>
    <!-- datatable -->
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.5/datatables.min.js"></script>
</body>
</html>