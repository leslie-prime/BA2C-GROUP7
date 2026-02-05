<?php
$tasks = ["Learn PHP", "Push code to GitHub", "Add contributors"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>PHP Starter App</title>
</head>
<body>

<h1>My PHP App</h1>

<ul>
    <?php foreach ($tasks as $task): ?>
        <li><?php echo $task; ?></li>
    <?php endforeach; ?>
</ul>

</body>
</html>