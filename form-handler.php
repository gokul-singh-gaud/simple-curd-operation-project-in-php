<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'test';

$conn = mysqli_connect($host, $user, $password, $database) or die("conn fail: " . mysqli_connect_error());

if(isset($_POST['addPerson'])){
    
    $stmt = $conn->prepare("INSERT INTO tb_11(name, age, gender, address, department) VALUES(?,?,?,?,?)");

        $stmt->bind_param("sisss", $_POST['data']['name'], $_POST['data']['age'], $_POST['data']['gender'], $_POST['data']['address'], $_POST['data']['department']);

        if($stmt->execute()){

            echo json_encode("data inserted successfully.");
            $stmt->close();
        }
        $conn->close();
}
if(isset($_POST['update'])){
    // die(json_encode($_POST['data']));
    $stmt = $conn->prepare("UPDATE tb_11 SET name = ?, age = ?, gender = ?, address = ?, department = ? WHERE id =?");

        $stmt->bind_param("sisssi", $_POST['data']['name'], $_POST['data']['age'], $_POST['data']['gender'], $_POST['data']['address'], $_POST['data']['department'], $_POST['data']['id']);
        $stmt->execute();
        if(mysqli_stmt_affected_rows($stmt) > 0){

            echo json_encode("information updated successfully.");
        }else{
            
            echo json_encode("no information updated");
        }
        $stmt->close();
        $conn->close();
}
if(isset($_POST['delete'])){
    $stmt = $conn->prepare("DELETE FROM tb_11 WHERE id = ?");

        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        if(mysqli_stmt_affected_rows($stmt) > 0){

            echo json_encode("information deleted successfully.");
        }else{

            echo json_encode(["error",$stmt->error]);
        }
        $stmt->close();
        $conn->close();
}
if(isset($_POST['showAllRecord'])){
    $stmt = $conn->prepare("SELECT * FROM tb_11 WHERE 1");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
              $data[] = $row;
            }
            $json = json_encode($data); 
            echo $json;
        } else {
            $json = ['res'=>"No results found"];
          echo json_encode($json);
        }
        $stmt->close();
        $conn->close();
}
