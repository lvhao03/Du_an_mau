<?php 
    function getDataWithOutParam($sql){
        include './db.php';
        return $conn->query($sql)->fetchAll();
    }

    function getDataWithParams($sql, $param){
        include './db.php';
        $stmt = $conn->prepare($sql);
        $stmt->execute($param);
        return $stmt->fetchAll();
    }

    function executePDO($sql, $param){
        include './db.php';
        $stmt = $conn->prepare($sql);
        $stmt->execute($param);
    }