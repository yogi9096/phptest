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

    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';
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
        if (isset($result->num_rows) && $result->num_rows > 0) {
            // output data of each row
            return $result;
        } else {
            return false;
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
$i = 0;
$name = '';
$pocket_money = 0;
if ($student_data) {
    while ($row = mysqli_fetch_assoc($student_data)) {
        $i++;
        if ($i == 2) {
            $name = $row["first_name"] . " " . $row["last_name"];
            $pocket_money = $row["pocket_money"];
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
                            <div class="col-md-12">
                                <h3 class="text-center mb-5">PHP + Reactjs Machine Test Instructions</h3>
                                <div class="card card-outline-secondary">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">1. The current code is written in a single file. You are expected to make it in a structured MVC way. The code shared does not follow best coding practices, you are supposed to correct the same where necessary. </label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">2. Database tables do not exist, you are expected to use the migration script for the same.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">3. Follow proper OOPs concepts.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">4. The final code should be ready to be released to Production without any additional code reviews. Consider you have verified all the code review checkpoints in terms of Standard coding practices (Code structure, Naming conventions, File Structure, Comments, Validations, Error Handling, Data Security, Application Design Pattern, Layered Approach, Proper Separation of Business Logic)</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">5. We would like this code to be of Production Release Level, if you are unable to write code to that standards due to time constraints, it would be helpful if you can list down things which you could have done.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">6. This application is used to save student information and show saved data. This is unfinished work and there are some errors which you are supposed to identify and fix.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">7. Data security should be kept in mind while implementing this assignment.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">8. The technology stack should be PHP (Core, Yii2, CI) for backend React Js for frontend.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">9. There is no time restriction for completing this MT, you can take the time needed however make sure that you cover all points mentioned above.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">10. In the student list section write code to select/check records that are having prime number Id's only.</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <h3 class="text-center mb-5" style="margin-top: 50px">API & Implement</h3>
                                <div class="card card-outline-secondary">
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">1. You have to write an API and Implement the API using (React Js or Angular) for below points. </label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">2. The student information needs to be saved in the database with proper validations.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">3. Data security should be kept in mind while implementing this assignment.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">4. Show the 2nd highest pocket money of the student in an optimized way.</label>
                                            </div>
                                            <div class="col-lg-12">
                                                <label class="col-lg-12 col-form-label form-control-label">5. In the student list section write code to select/check records that are having prime number Id's only.</label>
                                            </div>
                                        </div>
                                    </div>
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
                                if ($students->getStudents()) {
                                    while ($row = mysqli_fetch_assoc($students->getStudents())) {
                                        ?>
                                        <div class="col-lg-9">
                                            <label class="col-lg-2 col-form-label form-control-label"><input type="checkbox"></label>

                                            <label class="col-lg-2 col-form-label form-control-label"><?php echo $row["id"]; ?></label>

                                            <label class="col-lg-3 col-form-label form-control-label"><?php echo $row["first_name"] . " " . $row["last_name"]; ?></label>
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
