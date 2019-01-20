<?php
echo json_encode(explode("\n", file_get_contents('list.csv')));
?>