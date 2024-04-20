<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Web Year4</title>
    <!-- Link Bootsrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- link fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <!--Link CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar justify-content-center fs-4 mb-3"
        style="background-color: #f8f9fa; color: #0d6efd; font-weight: bold;">
        PHP CRUD Operation Assignment Web Year4
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-item-center mb-3">
            <div class="text-body-secondary">
                <span class="h5">
                    All Users
                </span>
                <br>
                Manage all your existing users or add new one
            </div>
            <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasAddUser">
                <i class="fa-solid fa-user-plus"></i> Add New User
            </button>

        </div>
    </div>

    <!-- add new user offcanvas -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
        style="width: 600px;"
    >
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add New User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form method="POST" id="insertForm" >
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="first_name" id="first_name">
                    </div>
                    <div class="col">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="last_name" id="last_name">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
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
                    <label class="form-label">Choose Carer</label>
                    <!-- select carer  -->
                    <select class="form-select" name="carer" id="carer"  >
                        <option value="">Select Carer</option>
                        <option value="Mobile_App">Mobile App</option>
                        <option value="Web_Developer">Web Developer</option>
                        <option value="Backend_Developer">Backend Developer</option>
                    </select>
                </div>
                <!-- groub choose Gender -->
                <div class="mb-3 form-group">
                    <label class="form-label">Gender:</label>
                    <input type="radio" class="form-check-input" name="gender" value="male">
                    <label class="form-input-label">Male</label>
                    <input type="radio" class="form-check-input" name="gender" value="female">
                    <label class="form-input-label">Female</label>
                </div>
                <div>
                    <!-- Button Submit -->
                    <button type="submit" class="btn btn-primary me-1" id="inputBtn">Submit</button>
                    <!-- Button Cancel -->
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="offcanvas">Cancel</button>

                </div>

            </form>
            
        </div>
    </div>


    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
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
</body>
</html>