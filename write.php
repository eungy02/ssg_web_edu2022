<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
</head>

<body>

<?php session_start(); ?>

    <form method="post" action="write_action.php" enctype = "multipart/form-data">
        <p><b>게시글 작성하기</b></p>
        <table>
            <tr>
                <td>작성자</td>
                <td><?php echo $_SESSION['userid']; ?></td>
            </tr>

            <tr>
                <td>제목</td>
                <td><input type="text" name="title" size=55></td>
            </tr>

            <tr>
                <td>내용</td>
                <td><textarea name="content" cols=50 rows=15></textarea></td>
            </tr>

        </table>
        <p>
            <input class=file id="input-file" type=file name=file>
        </p>
        <p>
            <input type="submit" value="작성">
        </p>
    </form>
    
</body>

</html>