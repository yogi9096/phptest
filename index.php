<?php
class ccc {

    private $servername = "localhost";
    private $password = "";
    private $username = "root";
    private $database = "student";
    public $createCommand;

    function __construct() {
        $dbconnection = $this->dbConnection();
        $this->createCommand = $dbconnection;
    }

    public function dbConnection() {
        // Create connection
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

}

class BaseController {

    public $post;
    public $get;

}

class abc extends ccc {

    public $first_name='';
    public $last_name = '';
    public $email='';
    public $password='';
    public $data;

    public function save() {
        $this->first_name = $this->data['first_name'];
        $this->email = $this->data['email'];
        $this->pocket_money = $this->data['pocket_money'];
        $this->password = $this->data['password'];

        $sql = "INSERT INTO student (first_name, last_name, email,pocket_moneys,password)
            VALUES ('" . $this->first_name . "', '" . $this->last_name . "','" . $this->email . "', '" . $this->pocket_money . "','" . $this->password . "')";
        if ($this->createCommand->query($sql) === true) {
            echo "New record for student created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    public function getStudents() {
        $sql = "SELECT * FROM student  order by pocket_money DESC";
        $result = $this->createCommand->query($sql);
        if(isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
           return  $result;
        } else {
            return  false;
        }
        $conn->close();
    }

}

class xyz extends BaseController {

    public function saveUser() {
        $model_user = new abc();
        $model_user->data = $this->post;
        $model_user->save($data);
        return $model_user;
    }

}

$xyz = new xyz();


if (isset($_POST) && !empty($_POST)) {
    $xyz->post = $_POST;
    $xyz->saveUser();
}

$students = new abc();
$student_data = $students->getStudents();
$i=0;
$name ='';
$pocket_money = 0;
if($student_data){
while($row = mysqli_fetch_assoc($student_data)) {
    $i++;
    if($i == 2){
        $name = $row["first_name"]. " " . $row["last_name"];
        $pocket_money =$row["pocket_money"];
        break;
    }
    }
}
?>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>User From</title>
    </head>
    <body>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">Instructions</h2>
                    <div class="card card-outline-secondary">
                        <div class="card-body">
                             <div class="form-group row">
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">1. This is a sample assignment to save student information and show saved data. This is unfinished work and there are some errors which you are supposed to identify and fix. 
                                    </div>
									<div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">2. The current code is written in a single file. You are expected to make it in a structured way.</label>
                                    </div>
									<div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">3. The sample code which we have provided does not follow Best coding practices. You're expected to follow the same in this assignment.</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">4. Database tables do not exist. Please use the migration script available.</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">5. Follow proper OOPs concepts.</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">6. Best coding practices should be followed. (Code structure, Naming conventions, File Structure, Comments, Validations, etc.)</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">7. The student information needs to be saved in the database with proper validations.</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">8. Data security should be kept in mind while implementing this assignment.</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">9. Show the 2nd highest pocket money of the student in an optimized way.</label>
                                    </div>
                                    <div class="col-lg-12">
                                         <label class="col-lg-12 col-form-label form-control-label">10. In the student list section write code to select/check records that are having prime number Id's only.</label>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
                <!--/col-->
            </div>

        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">Student From</h2>
                    <div class="card card-outline-secondary">
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" method="post" action="" >
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">First name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="first_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Last name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="last_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="email" value="" name="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Pocket Money</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Password</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Age</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="age">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">City</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="city">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">State</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="state">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Zip</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="zip">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Country</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" value="" name="country">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <input type="reset" class="btn btn-secondary" value="Cancel">
                                        <input type="submit" class="btn btn-primary" value="Save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!--/col-->
            </div>

        </div>
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">2nd Highest Pocket Money</h2>
                    <div class="card card-outline-secondary">
                        <div class="card-body">
                             <div class="form-group row">
                                    <div class="col-lg-9">
                                         <label class="col-lg-3 col-form-label form-control-label"><?php echo $name ?></label>
                                         <label class="col-lg-3 col-form-label form-control-label"><?php echo $pocket_money ?></label>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
                <!--/col-->
            </div>

        </div>
         <div class="container py-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center mb-5">Student List</h2>
                    <div class="card card-outline-secondary">
                        <div class="card-body">
                             <div class="form-group row">
                                 <div class="col-lg-9">
                                        <label class="col-lg-2 col-form-label form-control-label"><input type="checkbox"></label>
                                   
                                        <label class="col-lg-2 col-form-label form-control-label"><b>ID</b></label>
                                    
                                        <label class="col-lg-3 col-form-label form-control-label"><b>Name</b></label>
                                        <label class="col-lg-3 col-form-label form-control-label"><b>Pocket Money</b></label>
                                 </div>
                                 <?php
								 if($students->getStudents()){
									 while($row = mysqli_fetch_assoc($students->getStudents())) {
									 ?>
										<div class="col-lg-9">
											<label class="col-lg-2 col-form-label form-control-label"><input type="checkbox"></label>
									   
											<label class="col-lg-2 col-form-label form-control-label"><?php echo $row["id"]; ?></label>
										
											<label class="col-lg-3 col-form-label form-control-label"><?php echo $row["first_name"]." ".$row["last_name"]; ?></label>
										</div>
									 <?php
									 }
								 }
                                 ?>
                                </div>
                        </div>
                    </div>

                </div>
                <!--/col-->
            </div>

        </div>
        <!--/container-->
    </body>
</html>
