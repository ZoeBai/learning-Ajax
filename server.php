<?php
    //set content-Type & charset
    header("Content-Type: application/json;charset=utf-8");
    //"Content-Type: application/json || application/plain
    //               application/xml  || application/html  || application/javascript

    $staff = array(
                array("name" => "洪七", "number" => "101", "sex" => "男", "job" => "总经理"),
                array("name" => "郭靖", "number" => "102", "sex" => "男", "job" => "开发工程师"),
                array("name" => "黄蓉", "number" => "103", "sex" => "女", "job" => "产品经理")
            );

    //$_SERVER is a superglobal variable，which is available in all the scopes without using "global" keyword
    if($_SERVER["REQUEST_METHOD"] == "GET"){//if request mothod is GET, do search
        search();
    }elseif($_SERVER["REQUEST_METHOD"] == "POST"){//else if request mothod is POST, do create
        create();
    }

    function search(){
        if(!isset($_GET["number"]) || empty($_GET["number"])){
            echo '{"success":false, "msg":"param error"}';
            return;
        }
        //$staff is a global variable, any function calls it should declare it with "global" keywords first
        global $staff;
        $number = $_GET["number"];
        $result = '{"sucess":false, "msg":"The number is not found"}';
        foreach ($staff as $value) {
            if($value['number'] == $number){
                $result = '{"success":true, "msg":"找到员工: 编号：' . $value["number"] . ', 员工姓名：' . $value["name"].
                            '，员工性别：' . $value["sex"] . '，员工职位：' . $value["job"].'"}';
                break;
            }
        }
        echo $result;
        return;
    }

    function create(){
        if(!isset($_POST["number"]) || empty($_POST["number"])
           || !isset($_POST["name"]) || empty($_POST["name"])
           || !isset($_POST["sex"]) || empty($_POST["sex"])
           || !isset($_POST["job"]) || empty($_POST["job"])){
            echo '{"seccess":false, "msg":"params error"}';
            return;
        }
        echo '{"success":true,"msg":"员工：".$_POST["name"]."信息保存成功！"}';
    }
?>