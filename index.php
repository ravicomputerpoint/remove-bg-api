<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ravi Computer Point</title>
    <link rel="shortcut icon" href="Transparent Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: Inter;
        }
    </style>
</head>
<body>
    <h3 class="bg-primary bg-gradient p-3 text-light shadow">Ravi Computer Point</h3>
    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-4 col-md-12 col-sm-12 p-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Upload Photo</h5>
                    </div>
                    <div class="card-body">
                        <form id="myform">
                            <label for="photo">Upload Photo (Only JPG, JPEG, PNG)</label>
                            <input type="file" class="form-control mt-2" id="photo" name="photo" oninput="preview.src=window.URL.createObjectURL(this.files[0])" accept="image/png, image/jpg, image/jpeg" required>
                            <label for="color" class="mt-2">Select Color</label>
                            <input type="color" class="d-block mt-2" id="color" name="color" value="#BAE9FD">
                            <label for="preview" class="mt-2">Image Preview</label>
                            <img src="" alt="" width="150px" height="150px" class="d-block mt-2 rounded" id="preview">
                            <input type="submit" value="Upload" class="btn btn-primary mt-3" id="submit" name="submit">
                        </form>
                        <div class="progress mt-3" style="display: none;">
                            <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 p-3">
                <div class="card p-3 shadow">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo</th>
                            <th>Download</th>
                            <th>Print</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody id="table-data">
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Jquery, Bootstrap and Sweet Alert CDN Links -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            function loadTable(){
                $.ajax({
                    url: 'assets/fetch.php',
                    type: 'post',
                    data: {fetch:'fetch'},
                    success: function(data){
                        $("#table-data").html(data);
                    }
                });
            }
            loadTable();
            $("#myform").on('submit',function(e){
                e.preventDefault();
                let formData = new FormData(this);
                formData.append('sub','sub');
                $("#submit").prop('disabled',true);
                $.ajax({
                    url: 'assets/process.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                          if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('.progress').show();
                            $('.progress-bar').width(percentComplete.toFixed(2) + '%');
                            $('.progress-bar').html(percentComplete.toFixed(2) + '%');
                          }
                        }, false);
                        return xhr;
                      },
                    success: function(data){
                        if(data==1)
                        {
                            loadTable();
                            $("#submit").prop('disabled',false);
                            $("#submit").val('Upload');
                            $("#myform").trigger('reset');
                            $("#preview").src = '';
                            Swal.fire({
                                title: "Nice!",
                                text: "Photo Uploaded Successfully",
                                icon: "success",
                            });
                            $('.progress').hide();
                        }
                        else
                        {
                            loadTable();
                            $("#submit").prop('disabled',false);
                            $("#submit").val('Upload')
                            $("#photo").prop('disabled',false);
                            $("#color").prop('disabled',false);
                            Swal.fire({
                                title: "Error!",
                                text: "Photo Not Uploaded Successfully",
                                icon: "error",
                            });
                        }
                    }
                });

            });

            $(document).on('click','.btn-danger',function(){
                let id = $(this).data('delete');
                $.ajax({
                    url: 'assets/delete.php',
                    type: 'post',
                    data: {id:id,delete:'delete'},
                    success: function(data){
                        if(data==1)
                        {
                            Swal.fire({
                                title: "Nice!",
                                text: "File Deleted Successfully",
                                icon: "success",
                            });
                            loadTable();
                        }
                        else if(data==0)
                        {
                            Swal.fire({
                                title: "Error!",
                                text: "File Not Deleted Successfully",
                                icon: "error",
                            });
                            loadTable();
                        }
                        else
                        {
                            Swal.fire({
                                title: "Error!",
                                text: "File Not Deleted Successfully",
                                icon: "error",
                            });
                            loadTable();
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>