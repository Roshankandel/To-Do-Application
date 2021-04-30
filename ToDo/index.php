<?php
require "dbconn.php";
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-List</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="main-section">
        <div class="add-section">

            <form action="add.php" method="POST" autocomplete="off">

                <!-- Showing Error message  -->
                <?php if (isset($_GET['mess'])) { ?>

                    <input type="text" name="title" placeholder="This field is required" style="border-color: red;">

                    <button type="submit" name="submit">Add &nbsp; <span>&#43;</span></button>
                <?php } else { ?>

                    <input type="text" name="title" placeholder="What do you need to do?">
                    <button type="submit" name="submit">Add &nbsp; <span>&#43;</span></button>
                <?php } ?>
                <!-- End of the error messsage  -->

            </form>
        </div>


        <?php
        $result = $conn->query("SELECT*FROM todos ORDER BY id DESC");
        ?>

        <div class="show-todo-section">
            <?php if ($result->num_rows <= 0) { ?>
                <div class="empty">
                    <img src="img/file.png " alt="" width="100%">
                    <img src="img/Ellipsis.gif " alt="" width="80px">

                </div>

            <?php } ?>

            <?php while ($row = $result->fetch_assoc()) { ?>

                <div class="todo-item">
                    <span id="<?php echo $row['id'] ?>" class="remove-to-do">x</span>

                    <!-- if check button is selected  -->
                    <?php if ($row['checked']) { ?>

                        <input type="checkbox" data-todo-id="<?php echo $row['id'] ?>" class="check-box" checked>
                        <h2 class="checked"><?php echo $row['title'] ?> </h2>


                    <?php } else { ?>
                        <input type="checkbox" data-todo-id="<?php echo $row['id'] ?>" class="check-box">
                        <h2><?php echo $row['title'] ?> </h2><br>

                        <small>created:<?php echo $row['date_time'] ?></small>
                    <?php } ?>

                    <!-- end of checkbox selected  -->




                </div>
            <?php } ?>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js">
    </script>

    <script>
        $(document).ready(function() {
            $('.remove-to-do').click(function() {
                const id = $(this).attr('id');
                $.post("remove.php", {
                        id: id
                    },
                    (data) => {
                        if (data) {
                            $(this).parent().hide(600);
                        }
                    }

                );

            });
            $(".check-box").click(function(e) {
                const id = $(this).attr('data-todo-id');
                $.post("check.php", {
                        id: id
                    },
                    (data) => {

                        if (data != 'error') {
                            const h2 = $(this).next();
                            if (data === '1') {
                                h2.removeClass('checked');
                            } else {
                                h2.addClass('checked');
                            }
                        }

                    }

                );

            });
        });
    </Script>
</body>

</html>