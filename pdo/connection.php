<?php

$dsn  = 'mysql:host=localhost;dbname=teste;';
$user = 'root';
$pass = 'g8p6e5w8';

// connection
try{
    $conexao = new PDO($dsn, $user, $pass);

    $query = 'CREATE TABLE tb_teste (
        tb_id integer not null auto_increment primary key,
        tb_field character(1) not null
    );';

    // $conexao->exec($query);

    for($i = 0; $i <= 10; $i++){
        $query = 'INSERT INTO tb_teste (tb_field) VALUES ('. $i .')';
        // $conexao->exec($query);
    }

    $query = 'SELECT * FROM tb_teste';
    $pdoStmt = $conexao->query($query);
    $listData = $pdoStmt->fetchAll(PDO::FETCH_ASSOC);

    // $newStmt = $conexao->prepare($query);
    // $newStmt->bindValue(':value', $value);
    // $newStmt->execute();
    
    echo '<pre>';
    print_r($listData);
    echo '</pre>';


} catch(Exception $e){
    print_r($e);
}


