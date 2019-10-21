<?php

    session_start();
    if (isset($_SESSION['email'])) {
        $h1_text = "Sveiki sugrize \"{$_SESSION['email']}\"";
    } else {
        $h2_text = 'Prisijunkite!';
    }
      
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <link rel="stylesheet" href="includes/navigation-styles.css">
        <link rel="stylesheet" href="includes/form-styles.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php include './particles/navigation.php'; ?>
        <?php if (isset($h1_text)): ?>
            <h1><?php print $h1_text; ?></h2>
        <?php else: ?> 
            <h2><?php print $h2_text; ?></h2>
        <?php endif; ?>
    </body>
</html>
