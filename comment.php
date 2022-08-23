<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>
    <?php
    $connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );
    $query = "select * from comment";    //역순 출력
    $result = mysqli_query($connect, $query);
    $total = mysqli_num_rows($result);  //result set의 총 레코드(행) 수 반환
    $number = $_GET['number'];

    session_start();

    if (isset($_SESSION['userid'])) {
    ?><b><?php echo $_SESSION['userid']; ?></b>님 로그인 되었습니다.
        <button onclick="location.href='./logout_action.php'">로그아웃</button>
        <br />
    <?php
    } else {
    ?>
        <button onclick="location.href='./login.php'">로그인</button>
        <button onclick="location.href='./register.php'">회원가입</button>
        <br />
    <?php
    }
    ?>

    <p><b>댓글</b></p>

    <table>
        <thead>
            <tr>
                <td>| 작성자</td>
                <td width = 300>| 댓글</td>
                <td>| 날짜</td>
            </tr>
        </thead>

        <tbody>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {   //result set에서 레코드(행)를 1개씩 리턴
            ?>
            <?php
            if($number ==$rows['board_number']){
            ?>
            <td><?php echo $rows['id'] ?></td>
            <td><?php echo $rows['content'] ?></td>
            <td><?php echo $rows['date'] ?></td>
            </tr>
            <?php
            }
            ?>
            <?php
                $total--;
            }
            ?>
        </tbody>
        </table>

    <form method="post" action="comment_action.php">
    <p><b>댓글 작성하기</b></p>
    <table>
        <tr>
            <td>| 작성자</td>
            <td><?php echo $_SESSION['userid']; ?></td>
        </tr>
        <tr>
            <td>| 댓글</td>
            <td><textarea name="content" cols=50 rows=2></textarea></td>
        </tr>
    </table>
    <div>
        <br>
        <input type = "hidden" name = "number" value = "<?php echo $number; ?>">
        <input type = "submit" value = "댓글 작성">
    </div>
    </form>
    <br>
    <button onclick="history.back()">글로 돌아가기 </button>
</body>

</html>