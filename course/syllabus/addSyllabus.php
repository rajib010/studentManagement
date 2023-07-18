<?php
include("../../navbar.php");
if (isset($_POST['addBtn'])) {
    include("../../config.php");
    $syllabus = $_POST['syllabus'];
    $cid = $_GET['cid'];
    $sql = "INSERT INTO syllabus(courseID, Syllabus) VALUES($cid,'$syllabus')";
    $result = $conn->query($sql);
}
?>
<form action="addSyllabus.php?cid=<?= $_GET['cid'] ?>" method="post">
    <div id="addmore">
        Enter Syllabus: <br>
        <input type="text" name="syllabus" class="syllabus">
        <button type="submit" id="plusBtn">+</button> <br>
    </div>
    <button type="submit" name="addBtn">Add</button>
</form>



<!-- <script>
    $(document).ready(function() {
        $(".plusBtn").click(function(e) {
            e.preventDefault();
            $("#show_item").prepend(
                `<div id="addmore">
                <label>Syllabus </label>
                <input type="text" class="syllabus" name="syllabus" required>
                <button type="button">+ </button>
                `
            )
        })
    })

    </script> -->

