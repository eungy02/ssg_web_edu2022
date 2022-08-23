<?php
$connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );

session_start();

$id = $_SESSION['userid'];
$content = $_POST['content'];
$date = date('Y-m-d H:i:s');
$number = $_POST['number'];
$URL = './index.php';

$query = "INSERT INTO comment (board_number, content, date, id) 
        values($number, '$content', '$date', '$id')";

$result = $connect->query($query);
?> <script>
        alert("<?php echo "댓글이 작성되었습니다." ?>");
        location.replace("<?php echo $URL ?>");
    </script>
<?php
mysqli_close($connect);
?>