<?php
include('./includes/header.php');
    

if(isset($_POST['addCashier']))
{
    $firstname = cleanForm($_POST['firstname']);
    $middlename = cleanForm($_POST['middlename']);
    $lastname = cleanForm($_POST['lastname']);
    $gender = cleanForm($_POST['gender']);
    $nationalId =cleanForm($_POST['nationalId']);
    $countryCode = cleanForm($_POST['countryCode']);
    $phonenumber = cleanForm($_POST['phonenumber']);
    $email = cleanForm($_POST['email']); 
    $cashierRole = cleanForm($_POST['cashierRole']);
    $password = cleanForm($_POST['password']);

    
    if(empty($firstname))
    {
        $error = true;
        $firstnameError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>First name can't be empty</div>";
    }
    elseif( !preg_match("/^[a-zA-Z]*$/", $firstname) )
    {
        $error = true;
        $firstnameError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Only letters are allowed</div>";
    }

    
    if(empty($middlename))
    {
        $error = true;
        $middlenameError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Middle name can't be empty</div>";
    }
    elseif( !preg_match("/^[a-zA-Z]*$/", $middlename) )
    {
        $error = true;
        $middlenameError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Only letters are allowed</div>";
    }


    if(empty($lastname))
    {
        $error = true;
        $lastnameError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Last name can't be empty</div>";
    }
    elseif( !preg_match("/^[a-zA-Z]*$/", $lastname) )
    {
        $error = true;
        $lastnameError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Only letters are allowed</div>";
    }


    if(empty($gender))
    {
        $error = true;
        $genderError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Gender field can't be empty</div>";
    }


    if(empty($nationalId))
    {
        $error = true;
        $nationalIdError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>National ID can't be empty</div>";
    }
    elseif( !preg_match("/^[0-9]*$/", $nationalId) )
    {
        $nationalIdError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Only numbers are allowed</div>";
    } 


    if(empty($countryCode))
    {
        $error = true;
        $countryCodeError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Country code can't be empty</div>";
    }


    if(empty($phonenumber))
    {
        $error = true;
        $phonenumberError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Phone number can't be empty</div>";
    }
    elseif( !preg_match("/^[0-9]*$/", $phonenumber) )
    {
        $error = true;
        $phonenumberError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Only numbers are allowed</div>";
    }


    if(empty($cashierRole))
    {
        $error = true;
        $cashierRoleError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Cashier role can't be empty</div>";
    }


    if(empty($password))
    {
        $error = true;
        $passwordError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Password can't be empty</div>";
    }
    elseif( !preg_match("/^\S*(?=\S{6,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])S\*$/", $password) )
    {
        $error = true;
        $passwordError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Password must be between 6 and 15 charecters
         and must contain atleast one lower case letter one upper case letter and one digit.</div>";
    }


    if(empty($email))
    {
        $error = true;
        $emailError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Email can't be empty</div>";
    }
    elseif( !filter_var($email, FILTER_VALIDATE_EMAIL) )
    {
        $error = true;
        $emailError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Email is invalid.</div>";
    }


    $selectEmail = "select * from cashier where email = '$email' ";
    $emailQuery = mysqli_query($connection, $selectEmail) or die ("There was an error" . mysqli_error($connection));

    $checkEmail = mysqli_num_rows($emailQuery);

    if( $checkEmail > 0 )
    {
        $error = true;
        $emailError = "<div class='alert alert-danger'>
        <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>Email already exists, please choose another.</div>";
    }
    


    
    $phonenumber = $countryCode . $phonenumber;
    $password = md5($password);

    if(!$error)
    {
        $sql = "insert into cashier(firstname, middlename, lastname, gender, nationalId, phonenumber, email, cashierRole, password, dateRegistered) 
        values ('$firstname', '$middlename', '$lastname', '$gender', '$nationalId', '$phonenumber', '$email', '$cashierRole', '$password', Now() )";

        $result = mysqli_query($connection, $sql) or die("We couldn't insert data into the table".mysqli_error($connection));

        if($result)
        {
            $addManagerSuccess = "<div class='alert alert-success'>
            <a href='#' class='close' data-dismiss='alert' area-label='close'>&times</a>You have successfully added cashier</div>";
        }
    }  
}

// Sanitize form input values (Validation)
function cleanForm($data)
{
    global $connection;
    $data = trim($data);
    $data = stripslashes($data);  //It removes bug thrases
    $data = htmlspecialchars($data);

    $data = mysqli_escape_string($connection, $data);

    return $data;
}


?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Main Sidebar Container -->
        <?php include('includes/aside.php'); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="text-uppercase m-2">Add Cashier</h1>
                        </div>
                        <!-- /.col -->
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->

<?php
                    
    if(isset($addManagerSuccess))
    {
        echo $addManagerSuccess;
    }
                    
?>

                    <!-- Main row -->

                    <div class="row">
                        <!-- Left col -->
                        <section class="col-lg-12">
                            <!-- Custom tabs (Charts with tabs)-->

                            <!-- /.card -->
                            <div class="card">
                                <div class="card-header">Enter cashier Details</div>
                                <div class="card-body">
                                    <form method="post" action="#">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="firstname">Firstname</label>
                                                    <input type="text"
                                                        class="form-control" name="firstname"
                                                        id="firstname"
                                                        placeholder="Firstname">
                                                        <?php
                                                            if(isset($firstnameError))
                                                            {
                                                                echo $firstnameError;
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="middlename">Middlename</label>
                                                    <input type="text"
                                                        class="form-control" name="middlename"
                                                        id="middlename"
                                                        placeholder="middlename">

                                                        <?php
                                                            if(isset($middlenameError))
                                                            {
                                                                echo $middlenameError;
                                                            }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="lastname">Lastname</label>
                                            <input type="text"
                                                class="form-control" name="lastname"
                                                id="lastname"
                                                placeholder="lastname">

                                                <?php
                                                        if(isset($lastnameError))
                                                        {
                                                            echo $lastnameError;
                                                        }
                                                ?>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="gender">Gender</label>
                                                    <select class="custom-select form-control-border" name="gender"
                                                        id="gender">
                                                        <option value="">Select Gender</option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>

                                                    <?php
                                                        if(isset($genderError))
                                                        {
                                                            echo $genderError;
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="idNumber">National ID Number</label>
                                                    <input type="text"
                                                        class="form-control" name="nationalId"
                                                        id="idNumber"
                                                        placeholder="22334455">

                                                        <?php
                                                            if(isset($nationalIdError))
                                                            {
                                                                echo $nationalIdError;
                                                            }
                                                        ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Select Country code</label>
                                                <select class="custom-select form-control-border"
                                                    name="countryCode"
                                                    id="countryCode">
                                                    <option value="">Select country code</option>
                                                    <option value="+250">+250 Rwanda</option>
                                                    <option value="+251">+251 Ethiopia</option>
                                                    <option value="+254">+254 Kenya</option>
                                                    <option value="+255">+255 Tanzania</option>
                                                    <option value="+256">+256 Uganda</option>
                                                    <option value="+257">+257 Burundi</option>
                                                    <option value="+260">+260 Zambia</option>
                                                </select>
                                                <span id="errorcountryCode"></span>

                                                <?php
                                                    if(isset($countryCodeError))
                                                    {
                                                        echo $countryCodeError;
                                                    }
                                                ?>

                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="Phonenumber">Manager Phonenumber </label>
                                                    <input type="text"
                                                        class="form-control"
                                                        name="phonenumber"
                                                        id="phonenumber"
                                                        placeholder="700100100">
                                                    <span id="errorPhonenumber"></span>

                                                    <?php
                                                        if(isset($phonenumberError))
                                                        {
                                                            echo $phonenumberError;
                                                        }
                                                    ?>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email"
                                                        class="form-control" name="email"
                                                        id="email"
                                                        placeholder="manager@domain.com">

                                                        <?php
                                                            if(isset($emailError))
                                                            {
                                                                echo $emailError;
                                                            }
                                                        ?>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cashierRole">Cashier Role</label>
                                                    <select class="custom-select form-control-border" name="cashierRole"
                                                        id="cashierRole">
                                                        <option value="">Select Role</option>
                                                        <option value="casheer">cashier</option>
                                                        <option value="manager">Manager</option>
                                                    </select>

                                                    <?php
                                                        if(isset($cashierRoleError))
                                                        {
                                                            echo $cashierRoleError;
                                                        }
                                                    ?>


                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Cashier Password</label>
                                            <input type="password"
                                                class="form-control" name="password"
                                                id="password"
                                                placeholder="Manager Password">

                                                <?php
                                                    if(isset($passwordError))
                                                    {
                                                        echo $passwordError;
                                                    }
                                                ?>

                                        </div>
                                        <button type="submit" name="addCashier"
                                            class="btn btn-outline-primary btn-lg w-100 text-uppercase">Add
                                            Cashier</button>
                                    </form>
                                </div>
                            </div>


                        </section>
                        <!-- /.Left col -->
                        <!-- right col (We are only adding the ID to make the widgets sortable)-->

                    </div>
                    <!-- /.row (main row) -->


                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <?php
        include('./includes/footer.php');
        ?>