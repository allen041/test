<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $con = new mysqli("localhost", "root", "", "dbparking");
    
    if ($con->connect_error) {
        die("Failed to connect: " . $con->connect_error);
    } else {
        $stmt = $con->prepare("SELECT * FROM tb_parker WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            if (!empty($data) && isset($data['pwd']) && $data['pwd'] === $pwd) {
                echo "<h2>Login successfully</h2>";
                header("Location: redirect.html");
            } else {
                echo "<h2>Invalid Email or Password</h2>";
            }
        } else {
            echo "<h2>Invalid Email or Password</h2>";
        }
    }
}
?>


    



