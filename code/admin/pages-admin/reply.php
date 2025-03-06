<?php
$id = $_GET['id'];
include("../database/config.php");
$sql = "SELECT * FROM feedback WHERE id = $id";
$kq = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($kq);
?>
<div class="form-login">
    <h3>PHẢN HỒI BÌNH LUẬN</h3>
    <form class="form-login__container" action="../admin/pages-adminHandle/replycommentHandle.php?page=replycommentHandle&id=<?=$row['id']?> " method="POST">
    <p>Bình luận người dùng</p>
        <input type="text" name="comment" value="<?=$row['content']?>" placeholder="Bình luận người dùng" readonly>
    <p>Phản hồi bình luận</p>
        <input type="text" name="replyComment" value="<?=$row['content_reply']?>" placeholder="Phản hồi bình luận" required>
        <input type="submit" value="Thêm">
    </form>
</div>