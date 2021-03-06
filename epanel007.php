<<<<<<< HEAD
           <?php
            //            session_start();
            // if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=ture){
            //     header("location: login.php");
            //     exit;
            // }

            include("./include/db_connect.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $blog_heading = $_POST["blog_heading"];
                $blog_desc = $_POST["blog_desc"];
                $blog_date = $_POST["blog_date"];
                $blog_file = $_FILES["file"];
                $blog_summary = $_POST["blog_summary"];


                // for image upload 
                 $filename = $blog_file['name'];
                 $filerror = $blog_file['error'];
                 $filetmp = $blog_file['tmp_name'];

                 $fileext = explode('.',$filename);
                 $filecheck = strtolower(end($fileext));


                $fileextstored = array('png', 'jpg', 'jpeg');

                if(in_array($filecheck,$fileextstored)){
                    $destinationfile ='blogimage/'.$filename;
                    move_uploaded_file($filetmp,$destinationfile);

                }
                
                $sql = "INSERT INTO `blogs`(`blog_heading`, `blog_desc`,`blog_image`,`timestamp`,`blog_summary`) VALUES ('$blog_heading','$blog_desc','$destinationfile','$blog_date','$blog_summary')";
                $result = mysqli_query($conn, $sql);
                
                // Assesments Post

                $asses_id = $_POST["asses_id"];
                $asses_name = $_POST["asses_name"];
                $s_code = $_POST["s_code"];

                $sql2 = "INSERT INTO `assesments`(`a_id`, `a_name`, `s_code`) VALUES ('$asses_id','$asses_name','$s_code')";
                $result2 = mysqli_query($conn, $sql2);

                //Video Post

                $v_id = $_POST["video_id"];
                $v_title = $_POST["video_title"];
                $v_desc = $_POST["video_desc"];
                $v_code = $_POST["v_code"];

                $sql3 = "INSERT INTO `video`( `b_id` , `v_title`, `v_desc`, `v_code` ) VALUES ('$v_id', '$v_title','$v_desc','$v_code')";
                $result3 = mysqli_query($conn, $sql3);
            }
            ?>

           <!DOCTYPE html>
           <html lang="en">

           <head>
               <meta charset="UTF-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
               <link rel="stylesheet" type="text/css" href="css/first-screen.css" />
               <link rel="stylesheet" type="text/css" href="css/first-screen-inner.css" />
               <link rel="preload " href="fonts/AleoBold.woff2" as="font" crossorigin>
               <link rel="preload " href="fonts/Lato/LatoRegular.woff2" as="font" crossorigin>
               <link rel="preload " href="fonts/Lato/LatoBold.woff2" as="font" crossorigin>
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
               <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
               <link rel="stylesheet" href="css/admin.css">
               <title>Admin</title>
           </head>

           <body>

               <nav class="navbar">
                   <ul>
                       <a href="index.php">
                           <li>
                               <img src="./img/uploaded/elogo.png" alt="" srcset="">
                           </li>
                       </a>
                       <li class="d">
                           Dashboard
                       </li>
                       <li class="b">
                           Brochure
                       </li>
                       <li class="c">
                           Consultation
                       </li>
                       <li class="n">
                           Newsletter
                       </li>
                       <li class="s">
                           Students Data
                       </li>
                       <li class="r">
                           Students Registered
                       </li>
                       <li class="pb">
                           Post Blog
                       </li>
                       <li class="As">
                           Assesments
                       </li>
                       <li class="cf">
                           Contact Form
                       </li>
                       <li class="cf">
                           Video 
                       </li>
                       <li class="cf">
                           Notes 
                       </li>
                       <li class="cf">
                           Ebook 
                       </li>

                   </ul>
               </nav>

               <section class="main-container">
                   <div id="dashboard" class="sub-section">
                       <h2> Dashboard </h2>
                       <div class="d-card-container">
                           <div class="b d-card">
                               <h3> Brochure </h3>
                               <?php
                                $sql = "SELECT * FROM `brochure`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result);
                                ?>
                           </div>
                           <div class="c d-card">
                               <h3> Consultation </h3>
                               <?php
                                $sql2 = "SELECT * FROM `consultation`";
                                $result2 = mysqli_query($conn, $sql2);
                                echo mysqli_num_rows($result2);
                                ?>
                           </div>
                           <div class="n d-card">
                               <h3> Newsletter </h3>
                               <?php
                                $sql3 = "SELECT * FROM `newsletter`";
                                $result3 = mysqli_query($conn, $sql3);
                                echo mysqli_num_rows($result3);
                                ?>
                           </div>
                           <div class="s d-card">
                               <h3> Students </h3>
                               <?php
                                $sql4 = "SELECT * FROM `students_data`";
                                $result4 = mysqli_query($conn, $sql4);
                                echo mysqli_num_rows($result4);
                                ?>
                           </div>
                           <div class="s d-card">
                               <h3> Registered Students </h3>
                               <?php
                                $sql5 = "SELECT * FROM `students`";
                                $result5 = mysqli_query($conn, $sql5);
                                echo mysqli_num_rows($result5);
                                ?>
                           </div>
                           <div class="s d-card">
                               <h3> Blog </h3>
                               <?php
                                $sql6 = "SELECT * FROM `blogs`";
                                $result6 = mysqli_query($conn, $sql6);
                                echo mysqli_num_rows($result6);
                                ?>
                           </div>
                       </div>
                   </div>
                   <form id="blog_post" action="" method="post" enctype="multipart/form-data">
                       <div>
                           <label for="blog_heading">Blog heading</label>
                           <input type="text" name="blog_heading" required>
                       </div>
                       <div>
                           <label for="blog_summary">Blog summary</label>
                           <input type="text" name="blog_summary" required>
                       </div>
                       <div>
                           <label for="blog_desc">Blog Description</label>
                           <textarea name="blog_desc" id="blog_desc" cols="80" rows="20" required></textarea>
                       </div>
                       <div>
                           <label for="image">Select Image</label>
                           <input type="file" name="file" id="file" class="image" required>
                       </div>
                       <div>
                           <label for="">Blog Date</label>
                           <input type="date" name="blog_date" class="date">
                       </div>
                       <div>
                           <button id="submit" type="submit" class="btn btn-primary">Post</button>
                       </div>
                   </form>
                   <form id="assessment" action="" method="post" enctype="multipart/form-data">
                       <div>
                           <label for="asses_id">Assesments ID</label>
                           <input type="number" name="asses_id" id="asses_id" required>
                       </div>
                       <div>
                           <label for="asses_name">Assesments Name</label>
                           <input type="text" name="asses_name" id="asses_name" required>
                       </div>
                       <div>
                           <label for="s_code">Source Code</label>
                           <textarea name="s_code" id="s_code" cols="30" rows="10"></textarea>
                       </div>
                       <div>
                           <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                       </div>
                   </form>
                   <form id="video" action="" method="post" enctype="multipart/form-data">
                       <div>
                           <label for="video_id">Video Id</label>
                           <input type="number" name="video_id" id="video_id" required>
                       </div>
                       <div>
                           <label for="video_title">Video Title</label>
                           <input type="text" name="video_title" id="video_title" required>
                       </div>
                       <div>
                           <label for="video_desc">Video Description</label>
                           <input type="text" name="video_desc" id="video_desc" required>
                       </div>
                       <div>
                           <label for="v_code">Video Code</label>
                           <textarea name="v_code" id="v_code" cols="30" rows="10"></textarea>
                       </div>
                       <div>
                           <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                       </div>
                   </form>

                       <table>
  <tr>
    <th>Student Id</th>
    <th>Courses</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Wordpress development
  </tr>
  <tr>
    <td>2</td>
    <td>Web development
  </tr>
  <tr>
    <td>3</td>
    <td>Google Ads
  </tr>
  <tr>
    <td>4</td>
    <td>Facebook Ads
  </tr>
  <tr>
    <td>5</td>
    <td>Social Media Marketing
  <tr>
    <td>6</td>
    <td>Search Engine Optimization
  </tr>
  <tr>
    <td>7</td>
    <td>Graphic Designing
  </tr>
  <tr>
    <td>8</td>
    <td>Content Marketing
  </tr>
</table>
                   </form>
                   <div id="brochure" class="sub-section">
                       <h2> Brochure </h2>
                       <h3 align="center">Data of who Download Brochure</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td>Name &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                       <td>Phone No &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                   </tr>
                               </thead>
                               <?php
                                $sql = "SELECT * FROM `brochure`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '  
                                <tr>  
                                <td>' . $row["b_name"] . '</td>  
                                <td>' . $row["b_phoneno"] . '</td>  
                                <td>' . $row["b_email"] . '</td>   
                                </tr>  
                                ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="consultation" class="sub-section">
                       <h2> Consultation </h2>
                       <h3 align="center">Data of who Want Consultation</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data2" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Message &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql2 = "SELECT * FROM `consultation`";
                                $result2 = mysqli_query($conn, $sql2);
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    echo '  
                                <tr>  
                                <td>' . $row["s_name"] . '</td>  
                                <td>' . $row["s_email"] . '</td>   
                                <td>' . $row["s_message"] . '</td>  
                                </tr>  
                                ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="newsletter" class="sub-section">
                       <h2> Newsletter </h2>
                       <h3 align="center">Data of who want Newsletter</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data3" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql3 = "SELECT * FROM `newsletter`";
                                $result3 = mysqli_query($conn, $sql3);
                                while ($row = mysqli_fetch_assoc($result3)) {
                                    echo '  
                                <tr>  
                                <td>' . $row["s_email"] . '</td>   
                                </tr>  
                                ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="students-data" class="sub-section">
                       <h2> Students Data </h2>
                       <h3 align="center">Data of Students for Contact Them</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data4" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td> Student Name &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Student Surname &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Phone no &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql4 = "SELECT * FROM `students_data`";
                                $result4 = mysqli_query($conn, $sql4);
                                while ($row = mysqli_fetch_assoc($result4)) {
                                    echo '  
                            <tr>  
                            <td>' . $row["s_name"] . '</td>  
                            <td>' . $row["s_surname"] . '</td>  
                            <td>' . $row["s_phoneno"] . '</td>  
                            <td>' . $row["s_email"] . '</td>   
                            </tr>  
                            ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="students-reg" class="sub-section">
                       <h2> Students Data </h2>
                       <h3 align="center">Data of Students for Contact Them</h3>
                       <a href="newstudent.php" target="blank">Add New Student</a>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data5" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td> So.No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td> Student Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Student Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Phone no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Joining Date &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql5 = "SELECT * FROM `benefits_users`";
                                $result5 = mysqli_query($conn, $sql5);
                                while ($row = mysqli_fetch_assoc($result5)) {
                                    echo '  
                            <tr>  
                            <td>' . $row["sno"] . '</td>  
                            <td>' . $row["s_id"] . '</td>   
                            <td>' . $row["username"] . '</td>  
                            <td>' . $row["password"] . '</td>  
                            <td>' . $row["s_phone"] . '</td>  
                            <td>' . $row["email"] . '</td>   
                            <td>' . $row["date"] . '</td>   
                            </tr>  
                            ';
                                }
                                ?>
                           </table>
                       </div>
                       <div id="cf-s" class="sub-section">
                           <h2> Contact Data </h2>
                           <h3 align="center">Who Fill the Contact Form</h3>
                           <br />
                           <div class="table-responsive">
                               <table id="employee_data6" class="table table-striped table-bordered">
                                   <thead>
                                       <tr>
                                           <td> So.No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td> Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td>Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td>Message &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       </tr>
                                   </thead>
                                   <?php
                                    $sql6 = "SELECT * FROM `contact_details`";
                                    $result6 = mysqli_query($conn, $sql6);
                                    while ($row = mysqli_fetch_assoc($result6)) {
                                        echo '  
                            <tr>  
                            <td>' . $row["s_no"] . '</td>  
                            <td>' . $row["c_name"] . '</td>   
                            <td>' . $row["c_email"] . '</td>  
                            <td>' . $row["c_phone"] . '</td>  
                            <td>' . $row["c_message"] . '</td>  
                            </tr>  
                            ';
                                    }
                                    ?>
                               </table>
                           </div>
                       </div>

                    


               </section>
               <script src="js/jquery-3.5.1.min.js"></script>
               <script src="js/admin.js"></script>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
               <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
               <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
               <script src="./ckeditor/ckeditor.js"></script>
               <script>
                   CKEDITOR.replace('blog_desc');
               </script>
           </body>

=======
           <?php
            //            session_start();
            // if(isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=ture){
            //     header("location: login.php");
            //     exit;
            // }

            include("./include/db_connect.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $blog_heading = $_POST["blog_heading"];
                $blog_desc = $_POST["blog_desc"];
                $blog_date = $_POST["blog_date"];
                $blog_file = $_FILES["file"];
                $blog_summary = $_POST["blog_summary"];


                // for image upload 
                 $filename = $blog_file['name'];
                 $filerror = $blog_file['error'];
                 $filetmp = $blog_file['tmp_name'];

                 $fileext = explode('.',$filename);
                 $filecheck = strtolower(end($fileext));


                $fileextstored = array('png', 'jpg', 'jpeg');

                if(in_array($filecheck,$fileextstored)){
                    $destinationfile ='blogimage/'.$filename;
                    move_uploaded_file($filetmp,$destinationfile);

                }
                
                $sql = "INSERT INTO `blogs`(`blog_heading`, `blog_desc`,`blog_image`,`timestamp`,`blog_summary`) VALUES ('$blog_heading','$blog_desc','$destinationfile','$blog_date','$blog_summary')";
                $result = mysqli_query($conn, $sql);
                
                // Assesments Post

                $asses_id = $_POST["asses_id"];
                $asses_name = $_POST["asses_name"];
                $s_code = $_POST["s_code"];

                $sql2 = "INSERT INTO `assesments`(`a_id`, `a_name`, `s_code`) VALUES ('$asses_id','$asses_name','$s_code')";
                $result2 = mysqli_query($conn, $sql2);

                //Video Post

                $v_id = $_POST["video_id"];
                $v_title = $_POST["video_title"];
                $v_desc = $_POST["video_desc"];
                $v_code = $_POST["v_code"];

                $sql3 = "INSERT INTO `video`( `b_id` , `v_title`, `v_desc`, `v_code` ) VALUES ('$v_id', '$v_title','$v_desc','$v_code')";
                $result3 = mysqli_query($conn, $sql3);
            }
            ?>

           <!DOCTYPE html>
           <html lang="en">

           <head>
               <meta charset="UTF-8">
               <meta http-equiv="X-UA-Compatible" content="IE=edge">
               <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
               <link rel="stylesheet" type="text/css" href="css/first-screen.css" />
               <link rel="stylesheet" type="text/css" href="css/first-screen-inner.css" />
               <link rel="preload " href="fonts/AleoBold.woff2" as="font" crossorigin>
               <link rel="preload " href="fonts/Lato/LatoRegular.woff2" as="font" crossorigin>
               <link rel="preload " href="fonts/Lato/LatoBold.woff2" as="font" crossorigin>
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
               <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
               <link rel="stylesheet" href="css/admin.css">
               <title>Admin</title>
           </head>

           <body>

               <nav class="navbar">
                   <ul>
                       <a href="index.php">
                           <li>
                               <img src="./img/uploaded/elogo.png" alt="" srcset="">
                           </li>
                       </a>
                       <li class="d">
                           Dashboard
                       </li>
                       <li class="b">
                           Brochure
                       </li>
                       <li class="c">
                           Consultation
                       </li>
                       <li class="n">
                           Newsletter
                       </li>
                       <li class="s">
                           Students Data
                       </li>
                       <li class="r">
                           Students Registered
                       </li>
                       <li class="pb">
                           Post Blog
                       </li>
                       <li class="As">
                           Assesments
                       </li>
                       <li class="cf">
                           Contact Form
                       </li>
                       <li class="cf">
                           Video 
                       </li>
                       <li class="cf">
                           Notes 
                       </li>
                       <li class="cf">
                           Ebook 
                       </li>

                   </ul>
               </nav>

               <section class="main-container">
                   <div id="dashboard" class="sub-section">
                       <h2> Dashboard </h2>
                       <div class="d-card-container">
                           <div class="b d-card">
                               <h3> Brochure </h3>
                               <?php
                                $sql = "SELECT * FROM `brochure`";
                                $result = mysqli_query($conn, $sql);
                                echo mysqli_num_rows($result);
                                ?>
                           </div>
                           <div class="c d-card">
                               <h3> Consultation </h3>
                               <?php
                                $sql2 = "SELECT * FROM `consultation`";
                                $result2 = mysqli_query($conn, $sql2);
                                echo mysqli_num_rows($result2);
                                ?>
                           </div>
                           <div class="n d-card">
                               <h3> Newsletter </h3>
                               <?php
                                $sql3 = "SELECT * FROM `newsletter`";
                                $result3 = mysqli_query($conn, $sql3);
                                echo mysqli_num_rows($result3);
                                ?>
                           </div>
                           <div class="s d-card">
                               <h3> Students </h3>
                               <?php
                                $sql4 = "SELECT * FROM `students_data`";
                                $result4 = mysqli_query($conn, $sql4);
                                echo mysqli_num_rows($result4);
                                ?>
                           </div>
                           <div class="s d-card">
                               <h3> Registered Students </h3>
                               <?php
                                $sql5 = "SELECT * FROM `students`";
                                $result5 = mysqli_query($conn, $sql5);
                                echo mysqli_num_rows($result5);
                                ?>
                           </div>
                           <div class="s d-card">
                               <h3> Blog </h3>
                               <?php
                                $sql6 = "SELECT * FROM `blogs`";
                                $result6 = mysqli_query($conn, $sql6);
                                echo mysqli_num_rows($result6);
                                ?>
                           </div>
                       </div>
                   </div>
                   <form id="blog_post" action="" method="post" enctype="multipart/form-data">
                       <div>
                           <label for="blog_heading">Blog heading</label>
                           <input type="text" name="blog_heading" required>
                       </div>
                       <div>
                           <label for="blog_summary">Blog summary</label>
                           <input type="text" name="blog_summary" required>
                       </div>
                       <div>
                           <label for="blog_desc">Blog Description</label>
                           <textarea name="blog_desc" id="blog_desc" cols="80" rows="20" required></textarea>
                       </div>
                       <div>
                           <label for="image">Select Image</label>
                           <input type="file" name="file" id="file" class="image" required>
                       </div>
                       <div>
                           <label for="">Blog Date</label>
                           <input type="date" name="blog_date" class="date">
                       </div>
                       <div>
                           <button id="submit" type="submit" class="btn btn-primary">Post</button>
                       </div>
                   </form>
                   <form id="assessment" action="" method="post" enctype="multipart/form-data">
                       <div>
                           <label for="asses_id">Assesments ID</label>
                           <input type="number" name="asses_id" id="asses_id" required>
                       </div>
                       <div>
                           <label for="asses_name">Assesments Name</label>
                           <input type="text" name="asses_name" id="asses_name" required>
                       </div>
                       <div>
                           <label for="s_code">Source Code</label>
                           <textarea name="s_code" id="s_code" cols="30" rows="10"></textarea>
                       </div>
                       <div>
                           <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                       </div>
                   </form>
                   <form id="video" action="" method="post" enctype="multipart/form-data">
                       <div>
                           <label for="video_id">Video Id</label>
                           <input type="number" name="video_id" id="video_id" required>
                       </div>
                       <div>
                           <label for="video_title">Video Title</label>
                           <input type="text" name="video_title" id="video_title" required>
                       </div>
                       <div>
                           <label for="video_desc">Video Description</label>
                           <input type="text" name="video_desc" id="video_desc" required>
                       </div>
                       <div>
                           <label for="v_code">Video Code</label>
                           <textarea name="v_code" id="v_code" cols="30" rows="10"></textarea>
                       </div>
                       <div>
                           <button id="submit" type="submit" class="btn btn-primary">Submit</button>
                       </div>
                   </form>

                       <table>
  <tr>
    <th>Student Id</th>
    <th>Courses</th>
  </tr>
  <tr>
    <td>1</td>
    <td>Wordpress development
  </tr>
  <tr>
    <td>2</td>
    <td>Web development
  </tr>
  <tr>
    <td>3</td>
    <td>Google Ads
  </tr>
  <tr>
    <td>4</td>
    <td>Facebook Ads
  </tr>
  <tr>
    <td>5</td>
    <td>Social Media Marketing
  <tr>
    <td>6</td>
    <td>Search Engine Optimization
  </tr>
  <tr>
    <td>7</td>
    <td>Graphic Designing
  </tr>
  <tr>
    <td>8</td>
    <td>Content Marketing
  </tr>
</table>
                   </form>
                   <div id="brochure" class="sub-section">
                       <h2> Brochure </h2>
                       <h3 align="center">Data of who Download Brochure</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td>Name &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                       <td>Phone No &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                                   </tr>
                               </thead>
                               <?php
                                $sql = "SELECT * FROM `brochure`";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '  
                                <tr>  
                                <td>' . $row["b_name"] . '</td>  
                                <td>' . $row["b_phoneno"] . '</td>  
                                <td>' . $row["b_email"] . '</td>   
                                </tr>  
                                ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="consultation" class="sub-section">
                       <h2> Consultation </h2>
                       <h3 align="center">Data of who Want Consultation</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data2" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td>Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Message &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql2 = "SELECT * FROM `consultation`";
                                $result2 = mysqli_query($conn, $sql2);
                                while ($row = mysqli_fetch_assoc($result2)) {
                                    echo '  
                                <tr>  
                                <td>' . $row["s_name"] . '</td>  
                                <td>' . $row["s_email"] . '</td>   
                                <td>' . $row["s_message"] . '</td>  
                                </tr>  
                                ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="newsletter" class="sub-section">
                       <h2> Newsletter </h2>
                       <h3 align="center">Data of who want Newsletter</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data3" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql3 = "SELECT * FROM `newsletter`";
                                $result3 = mysqli_query($conn, $sql3);
                                while ($row = mysqli_fetch_assoc($result3)) {
                                    echo '  
                                <tr>  
                                <td>' . $row["s_email"] . '</td>   
                                </tr>  
                                ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="students-data" class="sub-section">
                       <h2> Students Data </h2>
                       <h3 align="center">Data of Students for Contact Them</h3>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data4" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td> Student Name &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Student Surname &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Phone no &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql4 = "SELECT * FROM `students_data`";
                                $result4 = mysqli_query($conn, $sql4);
                                while ($row = mysqli_fetch_assoc($result4)) {
                                    echo '  
                            <tr>  
                            <td>' . $row["s_name"] . '</td>  
                            <td>' . $row["s_surname"] . '</td>  
                            <td>' . $row["s_phoneno"] . '</td>  
                            <td>' . $row["s_email"] . '</td>   
                            </tr>  
                            ';
                                }
                                ?>
                           </table>
                       </div>
                   </div>
                   <div id="students-reg" class="sub-section">
                       <h2> Students Data </h2>
                       <h3 align="center">Data of Students for Contact Them</h3>
                       <a href="newstudent.php" target="blank">Add New Student</a>
                       <br />
                       <div class="table-responsive">
                           <table id="employee_data5" class="table table-striped table-bordered">
                               <thead>
                                   <tr>
                                       <td> So.No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td> Student Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Student Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Phone no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Email &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       <td>Joining Date &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                   </tr>
                               </thead>
                               <?php
                                $sql5 = "SELECT * FROM `benefits_users`";
                                $result5 = mysqli_query($conn, $sql5);
                                while ($row = mysqli_fetch_assoc($result5)) {
                                    echo '  
                            <tr>  
                            <td>' . $row["sno"] . '</td>  
                            <td>' . $row["s_id"] . '</td>   
                            <td>' . $row["username"] . '</td>  
                            <td>' . $row["password"] . '</td>  
                            <td>' . $row["s_phone"] . '</td>  
                            <td>' . $row["email"] . '</td>   
                            <td>' . $row["date"] . '</td>   
                            </tr>  
                            ';
                                }
                                ?>
                           </table>
                       </div>
                       <div id="cf-s" class="sub-section">
                           <h2> Contact Data </h2>
                           <h3 align="center">Who Fill the Contact Form</h3>
                           <br />
                           <div class="table-responsive">
                               <table id="employee_data6" class="table table-striped table-bordered">
                                   <thead>
                                       <tr>
                                           <td> So.No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td> Name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td>Email &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td>Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                           <td>Message &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                       </tr>
                                   </thead>
                                   <?php
                                    $sql6 = "SELECT * FROM `contact_details`";
                                    $result6 = mysqli_query($conn, $sql6);
                                    while ($row = mysqli_fetch_assoc($result6)) {
                                        echo '  
                            <tr>  
                            <td>' . $row["s_no"] . '</td>  
                            <td>' . $row["c_name"] . '</td>   
                            <td>' . $row["c_email"] . '</td>  
                            <td>' . $row["c_phone"] . '</td>  
                            <td>' . $row["c_message"] . '</td>  
                            </tr>  
                            ';
                                    }
                                    ?>
                               </table>
                           </div>
                       </div>

                    


               </section>
               <script src="js/jquery-3.5.1.min.js"></script>
               <script src="js/admin.js"></script>
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
               <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
               <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
               <script src="./ckeditor/ckeditor.js"></script>
               <script>
                   CKEDITOR.replace('blog_desc');
               </script>
           </body>

>>>>>>> 15c75d656427878c8328379825e4f90974220de7
           </html>