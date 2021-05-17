<?php
include "conn.php";
$ip=$_POST["ip"];
$city=$_POST["city"];
$conn->query("set names utf8");
//检查IP是否已存在
$sql_checkIp="select count(*) as count from user_ip where ip='{$ip}'";
$result = $conn->query($sql_checkIp);
$row=$result->fetch_assoc();
if($row['count']!='0'){
    //已存在则修改最后一次登陆时间
    $sql="update user_ip set date_last_login=now(),login_time=login_time+1,user_ip.from='1' where ip='{$ip}'";
}
else{
    //不存在则插入新ip
    $sql="insert into user_ip(ip,city,date_last_login,date_first_login,user_ip.from) value('{$ip}','{$city}',now(),now(),'1')";
}

//$query = mysqli_query($conn, $sql);
$result = $conn->query($sql);
if($result){
    echo("ok");
}
else{
    echo("error");
}
