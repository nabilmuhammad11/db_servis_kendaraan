<?php
include "koneksi.php";

if (file_exists("header.php")) include "header.php";
if (file_exists("menu.php")) include "menu.php";
?>

<div class="content">
    <?php
    if (file_exists("buka_file.php")) {
        include "buka_file.php";
    }
    ?>
</div>

<?php
if (file_exists("footer.php")) include "footer.php";
?>