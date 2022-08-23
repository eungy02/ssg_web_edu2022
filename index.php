<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>
    <?php #phpinfo(); ?>
    <?php
    $connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );
    if($connect) echo(DB연결됨);
    else echo(DB연결안됨);

    $query = "select * from board order by number desc";    //역순 출력
    $result = mysqli_query($connect, $query);
    $total = mysqli_num_rows($result);  //result set의 총 레코드(행) 수 반환

    session_start();
    if (isset($_SESSION['userid'])) {
    ?><br><br><b><?php echo $_SESSION['userid']; ?></b>님 로그인 되었습니다.
        <button onclick="location.href='./logout_action.php'">로그아웃</button>
        <br />
    <?php
    } else {
    ?>
        <br><br>
        <button onclick="location.href='./login.php'">로그인</button>
        <button onclick="location.href='./register.php'">회원가입</button>
        <br />
    <?php
    }
    ?>

    <p><b>게시판</b></p>

    <table>
        <thead>
            <tr>
                <td>| 번호</td>
                <td>| 제목</td>
                <td>| 작성자</td>
                <td>| 날짜</td>
                <td>| 조회수</td>
            </tr>
        </thead>

        <tbody>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {   //result set에서 레코드(행)를 1개씩 리턴
            ?>

            <td><?php echo $total ?></td>
            <td>
                <a href="read.php?number=<?php echo $rows['number'] ?>">
                <?php echo $rows['title'] ?>
            </td>
            <td><?php echo $rows['id'] ?></td>
            <td><?php echo $rows['date'] ?></td>
            <td><?php echo $rows['hit'] ?></td>
            </tr>
            <?php
                $total--;
            }
            ?>
        </tbody>
    </table>
    
    <br>
    <button onclick="location.href='./write.php'">글쓰기</button>
</body>

</html>