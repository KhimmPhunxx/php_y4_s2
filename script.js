$(document).ready(function() {

    // call function to fetch data from database
    fetchData();

    // initialize datatable
    let table = new DataTable("#myTable");
    
    // function to display image before upload
    $("input.image").change(function() {
        var file = this.files[0];
        var url = URL.createObjectURL(file);
        $(this).closest('.row').find('.preview_img').attr('src', url);
    });

    // function to fetch data from database
    function fetchData() {
        $.ajax({
            url: "server.php?action=fetchData",
            type: "POST",
            dataType: "json",
            success: function(response) {
               var data = response.data;
               table.clear().draw();
               $.each(data, function(index, value) {
                table.row.add([
                    index + 1,
                    value.first_name,
                    `<span>${value.last_name} $</span> `,
                    value.email,
                    value.carer,
                    value.gender,
                    `<img src="uploads/${value.image}" 
                    style="width: 50px;
                        height: 50px;
                        object-fit: 
                        cover; border: 2px solid gray;
                        border-radius: 5px;
                        ">`,
                    `<Button class="btn btn-primary btn-sm editBtn" value="${value.id}"><i class="fa-regular fa-pen-to-square"></i></Button>`
                    + " " +
                    `<Button class="btn btn-danger btn-sm deleteBtn" value="${value.id}"><i class="fa-solid fa-trash"></i></Button>`
                    +
                    `<input type="hidden" value="${value.image}" class="delete_image">`
                   
                ]).draw(false);
               })
            }
        })
    }


    // function to insert data to database
    $("#insertForm").on("submit", function(e) {
        $("#insertBtn").attr("disabled", "disabled");
        e.preventDefault();
        $.ajax({
            url: "server.php?action=insertData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               var response = JSON.parse(response);
               if(response.statusCode == 200){
                $("#offcanvasAddUser").offcanvas('hide');
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                $(".preview_img").attr("src", "images/df_pf.jpg");
                $("#successToast").toast("show");
                $("#successMsg").html(response.message);
               } else if (response.statusCode == 500) {
                $("#offcanvasAddUser").offcanvas('hide');
                $("#insertBtn").removeAttr("disabled");
                $("#insertForm")[0].reset();
                $(".preview_img").attr("src", "images/df_pf.jpg");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
               } else if (response.statusCode == 400) {
                $("#insertBtn").removeAttr("disabled");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
               }
            } 
        }) 
    })


    // function to edit data
    $("#myTable").on("click", ".editBtn", function() {
        var id = $(this).val();
        $.ajax({
            url: "server.php?action=fetchSingleData",
            type: "POST",
            dataType: "json",
            data: {id:id},
            success: function(response) {
               var data = response.data;
               $("#editForm #id").val(data.id);
                $("#editForm input[name='first_name']").val(data.first_name);
                $("#editForm input[name='last_name']").val(data.last_name);
                $("#editForm input[name='email']").val(data.email);
                $("#editForm select[name='carer']").val(data.carer);
                $("#editForm .preview_img").attr("src", "uploads/"+data.image + "");
                $("#editForm #image_old").val(data.image);
                $("#editForm select[name='gender']").val(data.gender);
                // if (data.gender === "new") {
                //     $("#editForm input[name='gender'][value='new']").attr("checked", true);
                // } else if (data.gender === "second_hand") {
                //     $("#editForm input[name='gender'][value='second_hand']").attr("checked", true);
                // }

                $("#offcanvasEditUser").offcanvas('show');

            }
        })
    })
        


    // function to update data
    $("#editForm").on("submit", function(e) {
        $("#editBtn").attr("disabled", "disabled");
        e.preventDefault();
        $.ajax({
            url: "server.php?action=updateData",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(response) {
               var response = JSON.parse(response);
               if(response.statusCode == 200){
                $("#offcanvasEditUser").offcanvas('hide');
                $("#editBtn").removeAttr("disabled");
                $("#editForm")[0].reset();
                $(".preview_img").attr("src", "images/df_pf.jpg");
                $("#successToast").toast("show");
                $("#successMsg").html(response.message);
               } else if (response.statusCode == 500) {
                $("#offcanvasEditUser").offcanvas('hide');
                $("#editBtn").removeAttr("disabled");
                $("#editForm")[0].reset();
                $(".preview_img").attr("src", "images/df_pf.jpg");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
               } else if (response.statusCode == 400) {
                $("#editBtn").removeAttr("disabled");
                $("#errorToast").toast("show");
                $("#errorMsg").html(response.message);
               }
            } 
        }) 
    })


    // function to delete data
    $("#myTable").on("click", ".deleteBtn", function() {
        var id = $(this).val();
        var delete_image = $(this).closest("tr").find(".delete_image").val();
        if(confirm("Are you sure you want to delete this record?")){
            $.ajax({
                url: "server.php?action=deleteData",
                type: "POST",
                data: {
                    id,
                    delete_image
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    if(response.statusCode == 200){
                        $("#successToast").toast("show");
                        $("#successMsg").html(response.message);
                        fetchData();
                    } else {
                        $("#errorToast").toast("show");
                        $("#errorMsg").html(response.message);

                    }
                }
            })
        }
    })

});