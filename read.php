<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>
    <?php
    $connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );
    $number = $_GET['number'];  // GET 방식 사용
    session_start();
    $query = "select title, content, date, hit, id, file from board where number = $number";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);

    $hit = "update board set hit = hit + 1 where number = $number";
    $connect->query($hit);

    if (isset($_SESSION['userid'])) {
    ?><b><?php echo $_SESSION['userid']; ?></b>님 로그인 되었습니다.
        <button onclick="location.href='./logout_action.php'" >로그아웃</button>
        <br />
    <?php
    } else {
    ?>
        <button onclick="location.href='./login.php'">로그인</button>
        <br />
    <?php
    }
    ?>

    <table>
        <tr>
            <td>제목</td>
            <td><?php echo $rows['title'] ?></td>
        </tr>
        <tr>
            <td>작성자</td>
            <td><?php echo $rows['id'] ?></td>
            <td>조회수</td>
            <td><?php echo $rows['hit'] + 1 ?></td>
        </tr>

        <tr>
            첨부파일: <a href="./file/upload/<?php echo $rows['file'] ?>" download><?php echo $rows['file'] ?></a>
        </tr>

        <tr>
            <td>내용</td>
            <td><?php echo $rows['content'] ?></td>
        </tr>
    </table>

    <div>
        <br>
        <button onclick="location.href='./index.php'">목록</button>
        <?php
        if ($_SESSION['userid'] == $rows['id']) { ?>
            <button onclick="location.href='./modify.php?number=<?= $number ?>'">수정</button>
            <button onclick="ask();">삭제</button>

            <script>
                function ask() {
                    if (confirm("게시글을 삭제하시겠습니까?")) {
                        window.location = "./delete.php?number=<?= $number ?>"
                    }
                }
            </script>
        <?php } ?>
    </div>
    <div>
        <br>
        <a href="comment.php?number=<?=$number?>"></a>
        <button onclick="location.href='./comment.php?number=<?= $number ?>'">댓글 보러가기</button>
    </div>
</body>

</html>