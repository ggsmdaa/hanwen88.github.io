<?php
    include "conn.php";
    $ip=strFilter($_POST["ip"]);
    $city=strFilter($_POST["city"]);
    $tit=strFilter($_POST["tit"]);
    $content=strFilter($_POST["content"]);
    $contact=strFilter($_POST["contact"]);
    $conn->query("set names utf8");
    //检查IP提交次数
    $sql_checkIp="select complainTime from user_ip where ip='{$ip}'";
    $result = $conn->query($sql_checkIp);
    $row=$result->fetch_assoc();
    if((int)$row['complainTime']<=20||$row['complainTime']==null||(int)$row['complainTime']==0){
        //提交次数合理
        $sql="insert into user_complain(ip,tit,content,contact,date) value('{$ip}','{$tit}','{$content}','{$contact}',now())";
        $sql2="update user_ip set complainTime=complainTime+1 where ip='{$ip}'";
        $result = $conn->query($sql);
        $result2 = $conn->query($sql2);
        if($result&&$result2){
            echo("ok");
        }
        else{
            echo("error");
            echo($sql);
            echo("</br>");
            echo($sql2);
           
        }

    }
    else{
        //不合理
        echo("error");
    }
function strFilter($str){
    //特殊字符的过滤方法
    $str = str_replace('`', '', $str);
    $str = str_replace('~', '', $str);
    $str = str_replace('!', '', $str);
    $str = str_replace('！', '', $str);
    $str = str_replace('@', '', $str);
    $str = str_replace('#', '', $str);
    $str = str_replace('$', '', $str);
    $str = str_replace('￥', '', $str);
    $str = str_replace('%', '', $str);
    $str = str_replace('^', '', $str);
    $str = str_replace('……', '', $str);
    $str = str_replace('&', '', $str);
    $str = str_replace('*', '', $str);
    $str = str_replace('(', '', $str);
    $str = str_replace(')', '', $str);
    $str = str_replace('（', '', $str);
    $str = str_replace('）', '', $str);
    $str = str_replace('-', '', $str);
    $str = str_replace('_', '', $str);
    $str = str_replace('——', '', $str);
    $str = str_replace('+', '', $str);
    $str = str_replace('=', '', $str);
    $str = str_replace('|', '', $str);
    $str = str_replace('\\', '', $str);
    $str = str_replace('[', '', $str);
    $str = str_replace(']', '', $str);
    $str = str_replace('【', '', $str);
    $str = str_replace('】', '', $str);
    $str = str_replace('{', '', $str);
    $str = str_replace('}', '', $str);
    $str = str_replace(';', '', $str);
    $str = str_replace('；', '', $str);
    $str = str_replace(':', '', $str);
    $str = str_replace('：', '', $str);
    $str = str_replace('\'', '', $str);
    $str = str_replace('"', '', $str);
    $str = str_replace('“', '', $str);
    $str = str_replace('”', '', $str);
    $str = str_replace(',', '', $str);
    $str = str_replace('，', '', $str);
    $str = str_replace('<', '', $str);
    $str = str_replace('>', '', $str);
    $str = str_replace('《', '', $str);
    $str = str_replace('》', '', $str);
    $str = str_replace('。', '', $str);
    $str = str_replace('/', '', $str);
    $str = str_replace('、', '', $str);
    $str = str_replace('?', '', $str);
    $str = str_replace('？', '', $str);
    //防sql防注入代码的过滤方法
    for($i=0;$i<3;$i++){
    $str = str_replace('and','',$str);
    $str = str_replace('execute','',$str);
    $str = str_replace('update','',$str);
    $str = str_replace('count','',$str);
    $str = str_replace('chr','',$str);
    $str = str_replace('mid','',$str);
    $str = str_replace('master','',$str);
    $str = str_replace('truncate','',$str);
    $str = str_replace('char','',$str);
    $str = str_replace('declare','',$str);
    $str = str_replace('select','',$str);
    $str = str_replace('create','',$str);
    $str = str_replace('delete','',$str);
    $str = str_replace('insert','',$str);
    $str = str_replace('or','',$str);
    }
    return trim($str);
}