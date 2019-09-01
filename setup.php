<?php
    if ($_POST['dbname']) {
        $authFile = fopen("auth.php", "w");
        $authWrite = '<?php
            $mysql_username = "'.$_POST["username"].'";
            $mysql_password = "'.$_POST["password"].'";
            $mysql_server = "'.$_POST["server"].'";
            $mysql_dbname = "'.$_POST["dbname"].'";
        ?>';
        fwrite( $authFile, $authWrite );
        require "connect.php";
        echo "<h1>Setup</h1>";
        echo "<h2>Database</h2>";

        echo "<h3>Score</h3>";
        $sql = "CREATE TABLE score (
            id int NOT NULL AUTO_INCREMENT,
            reference text NOT NULL,
            player text NOT NULL,
            score text,
            uniqueId text,
            PRIMARY KEY (id)
        );";
        $query = $pdo->prepare($sql);
        $query->execute();  

        echo "<h2>Setup complete. Please delete setup.php from your server.</h2>";
    } else {
?>
    <h1>Setup</h1>
    <h2>Please enter database details</h2>
    
    <form method="POST" action="setup.php">
        Username: <input type="text" name="username" default="mysql_username" /> <br />
        Password: <input type="password" name="password" default="password" /> <br />
        Server address: <input type="text" name="server" default="mysql_server" /> <br />
        Database name: <input type="text" name="dbname" default="mysql_dbname" /> <br />
        <input type="submit" value="Install" /> <br />
    </form>
    <? } ?>
