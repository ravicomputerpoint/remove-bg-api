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
            <div class="col-lg-5 col-md-12 col-sm-12 p-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Update Api Key</h5>
                    </div>
                    <div class="card-body">
                        <form id="myform">
                            <label for="api">Update Api Key</label>
                            <input type="text" class="form-control mt-2" name="api" id="api" placeholder="Enter API Key">
                            <label for="pin" class="mt-2">Security Pin</label>
                            <input type="password" class="form-control mt-2" name="pin" id="pin" placeholder="Enter Pin">
                            <input type="submit" value="Update" class="btn btn-primary mt-3" id="submit" name="submit">
                        </form>
                    </div>
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
            $("#myform").on('submit',function(e){
                e.preventDefault();
                let api = $("#api").val();
                let pin = $("#pin").val();
                $.ajax({
                    url: 'assets/process.php',
                    type: 'post',
                    data: {api:api,pin:pin,update:'update'},
                    success: function(data){
                        if(data==1)
                        {
                            Swal.fire({
                                title: 'Nice!',
                                text: 'Api Key Updated Successfully!',
                                icon: 'success'
                            });
                            $("#myform").trigger('reset');

                        }
                        else
                        {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Enter Correct Pin!',
                                icon: 'success'
                            });
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>