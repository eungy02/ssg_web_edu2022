<?php
$connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );

session_start();

$id = $_SESSION['userid'];
$title = $_POST['title'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
$URL = './index.php';

$error = $_FILES['file']['error'];
$tmpfile = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$folder = "./file/upload/".$filename;

if( $error != UPLOAD_ERR_OK ){
	switch( $error ) {
    		case UPLOAD_ERR_INI_SIZE:
        	case UPLOAD_ERR_FORM_SIZE:
        		echo "<script>alert('파일이 너무 큽니다.');";
            		echo "window.history.back()</script>";
            		exit;
	}
}

move_uploaded_file($tmpfile, $folder);

$query = "INSERT INTO board (number, title, content, date, hit, id, file) 
        values(null,'$title', '$content', '$date', 0, '$id', '$filename')";

$result = $connect->query($query);
?> <script>
        alert("<?php echo "게시글이 등록되었습니다." ?>");
        location.replace("<?php echo $URL ?>");
    </script>
<?php
mysqli_close($connect);
?>