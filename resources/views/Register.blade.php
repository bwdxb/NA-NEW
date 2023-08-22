
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>PERSONAL INFORMATION</h2>
        <form action="{{url('register')}}" method="post">

            {{csrf_field()}}
            <div class="form-group">
                <label for="exampleInputEmail1" class="sign1">First Name:</label>
                <input type="text" class="form-control txt" name="fname" placeholder="First Name">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="sign1">Last Name:</label>
                <input type="text" class="form-control txt" name="lname" placeholder="Last Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="sign1">Phone Number:</label>
                <input type="text" class="form-control txt" name="pnumber" placeholder="Phone Number">
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1" name="gender" class="sign1">Select Gender:</label>
                <select class="form-control txt">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="date-picker-example" class="sign1">Select DOB:</label>
                <div class="datee">
                    <input type="date" class="form-control txt" name="dob" placeholder="dd-mm-yy">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
            </div>


            <div class="form-group">
                <label for="exampleInputPassword1" class="sign1">Password:</label>
                <input type="password" class="form-control txt" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1" class="sign1">Confirm password:</label>
                <input type="password" class="form-control txt" name="confirmpassword" placeholder="Confirm password">
            </div>

            <div class="form-check chkbox">
                <input type="checkbox" class="form-check-input chkkkk">
                <label class="form-check-label" for="exampleCheck1">I Agree to the Terms & Services</label>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
            <div class="bysign">
                By signing up you agree to our <a class="link link2" href="#">Terms & conditions</a> and <a
                    class="link link2" href="#">Privacy policy</a>
            </div>
            <div class="dontorsignup">
                Already have an account?
                <a class="link link2" href="#">Log in</a>
            </div>


        </form>






</body>

</html>