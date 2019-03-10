<?php
$records_per_page = 5;
$page =isset($_GET['page']) ? $_GET['page'] : 1;
$from_record_num = ($records_per_page*$page)-$records_per_page;
?>