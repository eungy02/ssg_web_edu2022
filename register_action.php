<?php
$connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );

$id = $_POST['id'];
$pw = $_POST['pw'];

$date = date('Y-m-d H:i:s');

//id 중복 확인
$query1 = "select * from member where id='$id'";
$result1 = $connect->query($query1);
$count = mysqli_num_rows($result1);

if ($count) { //만약 중복된 id가 있다면
    ?><script>
        alert('이미 존재하는 ID입니다.');
        history.back();
    </script>
    <?php }
    else {
        $query = "insert into member(id, password) values('$id', '$pw')";
        $result = $connect->query($query);
        ?>
        <script>
            alert('회원가입이 완료되었습니다.');
            location.replace("./index.php");
        </script>
        <?php
}
mysqli_close($connect);
?>