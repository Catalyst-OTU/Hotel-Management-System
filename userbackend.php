  <!--============ signup =============-->
  <?php      
  
    include 'config.php';
    session_start();



    if (isset($_POST['user_signup'])) {
        $Username = $_POST['Username'];
        $Email = $_POST['Email'];
        $Password = $_POST['Password'];
        $CPassword = $_POST['CPassword'];

        if($Username == "" || $Email == "" || $Password == ""){
            echo "<script>swal({
                title: 'Fill the proper details',
                icon: 'error',
            });
            </script>";
        }
        else{
            if ($Password == $CPassword) {
                $sql = "SELECT * FROM guest WHERE email = '$Email'";
                $result = mysqli_query($conn, $sql);

                if ($result->num_rows > 0) {
                    echo "<script>swal({
                        title: 'Email already exits',
                        icon: 'error',
                    });
                    </script>";
                } else {
                    $sql = "INSERT INTO guest (username,email,password) VALUES ('$Username', '$Email', '$Password')";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        $_SESSION['useremail']=$Email;
                        $Username = "";
                        $Email = "";
                        $Password = "";
                        $CPassword = "";
                        header("Location: home.php");
                    } else {
                        echo "<script>swal({
                            title: 'Something went wrong',
                            icon: 'error',
                        });
                        </script>";
                    }
                }
            } else {
                echo "<script>swal({
                    title: 'Password does not matched',
                    icon: 'error',
                });
                </script>";
            }
        }
        
    }
?>