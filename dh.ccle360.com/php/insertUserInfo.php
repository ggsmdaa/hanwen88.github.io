<?php
header('Access-Control-Allow-Origin:*');
include "conn.php";
$ip=strFilter($_POST["ip"]);
$city=strFilter($_POST["city"]);
$conn->query("set names utf8");
//检查IP是否已存在
$sql_checkIp="select count(*) as count from user_ip where ip='{$ip}'";
$result = $conn->query($sql_checkIp);
$row=$result->fetch_assoc();
if($row['count']!='0'){
    //已存在则修改最后一次登陆时间
    $sql="update user_ip set date_last_login=now(),login_time=login_time+1 where ip='{$ip}'";
}
else{
    //不存在则插入新ip
    $sql="insert into user_ip(ip,city,date_last_login,date_first_login) value('{$ip}','{$city}',now(),now())";
}

//$query = mysqli_query($conn, $sql);
$result = $conn->query($sql);
if($result){
    echo("ok");
}
else{
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