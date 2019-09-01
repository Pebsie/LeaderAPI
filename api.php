<?php
    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
    require "connect.php";
    

    $apiKey = "";
    $output = false;

    foreach (getallheaders() as $name => $value) {
        if ($name == "Authorisation") {
            $apiKey = $value;
        }
    }

    switch ($request_uri[0]) {
        case 'get':
            getScoreboard();
            break;
        case 'update':
            updatedScoreboard();
            break;
        default:
            header('HTTP/1.0 404 Not Found');
            echo 'Request not found.';
            break;
    }

    function getScoreboard() {
        try {
            $scoreboard = $_POST['scoreboard'];
            $limit = intval($_POST['limit']);
            $upper = intval($_POST['upper']);

            $sql = "SELECT * FROM score WHERE reference='".$scoreboard."' ORDER BY score ASC";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $displayResults;

            for ($i = $limit; $i < $limit + $upper; $i++) {
                $displayResults += $results[$i];
            }

            echo '{ok: true, data: '.json_encode($displayResults).'}';
        } catch(Exception $e) {
            echo '{ok: false, message: '.$e->getMessage().'}';
        }
    }

    function updatedScoreboard() {
        try {
            $sql = "INSERT INTO score (reference,player,score,uniqueId) VALUES ('".$_POST['scoreboard']."', '".$_POST['player']."', ".$_POST['score'].", '".$_POST['uniqueId']."')";
            $statement = $pdo->prepare($sql);
            $statement->execute();

            $sql = "SELECT * FROM score WHERE reference='".$scoreboard."' ORDER BY score ASC";
            $statement = $pdo->prepare($sql);
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            $position = 1;

            for ($i = 0; $i < count(array_len); $i++) {
                if ($results[$i]["uniqueId"] == $_POST['uniqueId']) {
                    $position = i;
                }
            }

            echo "{ok: true, position: ".$position."}";
        } catch(Exception $e) {
            echo '{ok: false, message: '.$e->getMessage().'}';
        }
    }
?>