@include('layouts.navbar')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <h1>Add Student</h1>
    <form id="studentForm" enctype="multipart/form-data">
        @csrf
        <p>Name:</p>
        <p><input type="text" name="name"></p>
        <p>Gender:</p>
        <p><input type="radio" name="gender" value='male'>Male</p>
        <p><input type="radio" name="gender" value='female'>Female</p>
        <p>Stream:</p>
        <select name='stream'>
            <option value="0">--Select--</option>
            <option value="BSc">BSc</option>
            <option value="BA">BA</option>
            <option value="BCom">BCom</option>
            <option value="BEng">BEng</option>
            <option value="BBA">BBA</option>
        </select>
        <p>Subject:</p>
        <input type="checkbox" name="sub[]" value='C'>C
        <input type="checkbox" name="sub[]" value='C++'>C++
        <input type="checkbox" name="sub[]" value='Java'>Java
        <input type="checkbox" name="sub[]" value='Python'>Python
        <input type="checkbox" name="sub[]" value='JavaScript'>JavaScript
        <input type="checkbox" name="sub[]" value='PHP'>PHP
        <p>Image:</p>
        <input type="file" name="stdimg" accept="image/*">
        <p><input type="submit" value="Add Student"></p>
    </form>
    <div id="studentTable"></div>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script>
        $(document).ready(function() {
            //Select
            var currentPage = 1;

            function loadTable(page = currentPage) {

                currentPage = page;

                $.ajax({
                    url: "{{ url('/show') }}?page=" + page,
                    type: "GET",

                    success: function(response) {
                        $("#studentTable").html(response.html);
                    },

                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }

            loadTable();


            // Pagination
            $(document).on("click", ".pagination-btn", function(e) {

                e.preventDefault();

                var page = $(this).data("page");

                loadTable(page);

            });

            //Insert
            $("#studentForm").on("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "{{ url('/') }}/add",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.status) {
                            $("#studentForm")[0].reset();
                            loadTable(currentPage);
                        } else {
                            alert("Failed to add student");
                        }
                    }
                });
            });
            //Delete
            //$(".delete-btn").on("click",function(){  <<<<----------Wrong way to bind event to dynamically created elements
            $(document).on("click", ".delete-btn", function() {
                var id = $(this).data("id");
                if (confirm("Are you sure you want to delete this student?")) {
                    // Proceed with deletion

                    $.ajax({
                        url: "{{ url('/') }}/delete",
                        type: "GET",
                        data: {
                            id: id
                        },
                        success: function(response) {
                            if (response.status) {
                                loadTable(currentPage);
                            } else {
                                alert(response.message);
                            }
                        }
                    });
                } else {
                    return; // Exit the function if the user cancels        

                }

            });


        });
    </script>
</body>

</html>
