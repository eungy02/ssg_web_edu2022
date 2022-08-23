<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>
    <?php
    $connect = mysqli_connect( 'localhost', 'root', '1234', 'ssg_web_edu2022' );
    $number = $_GET['number'];
    $query = "select title, content, date, id from board where number = $number";
    $result = $connect->query($query);
    $rows = mysqli_fetch_assoc($result);

    $title = $rows['title'];
    $content = $rows['content'];
    $userid = $rows['id'];

    session_start();

    $URL = "./index.php";
    ?>
        <form method="POST" action="modify_action.php">
            <p><b>게시글 수정</b></p>
            <table>
                <tr>
                    <td>작성자</td>
                    <td><?php echo $_SESSION['userid']; ?></td>
                </tr>

                <tr>
                    <td>제목</td>
                    <td><input type=text name=title size=55 value="<?= $title ?>"></td>
                </tr>

                <tr>
                    <td>내용</td>
                    <td><textarea name=content cols=50 rows=15><?= $content ?></textarea></td>
                </tr>    
            </table>
            <div>
                <input type="hidden" name="number" value="<?= $number ?>">
                <input type="submit" value="작성">
            </div>
        </form>
</body>

</html>