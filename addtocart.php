<?php 

extract($_POST);
if(isset($add))
{
//echo $pid;exit;
 //$pid=$_GET['pid'];
//echo $pid;exit;
session_start();
require_once "includes/dbconnect.php";
/*get sp from products_tbl*/
$sql_qry="select product_sp from ms_products_tbl where product_id=$pid";
$res=mysql_query($sql_qry);
$row=mysql_fetch_assoc($res);
$sp=$row['product_sp'];
$user_id=$_SESSION['user_id'];;
$qty=1;
/*check for product existancy in cart tbl*/
$sql_chk="select product_id,qty from ms_cart_tbl where product_id=$pid and user_id=$user_id and cart_status=0";
$pres=mysql_query($sql_chk);
$count=mysql_num_rows($pres);
if($count>0)
{
	$prow=mysql_fetch_assoc($pres);
	$uqty=$prow['qty']+1;
	$total=$uqty*$sp;
	$sql_update="update ms_cart_tbl set qty=$uqty,total=$total where product_id=$pid and user_id=$user_id and cart_status=0";
	$resp=mysql_query($sql_update);
	if($resp)
		header('location:mycart.php');
	else
		echo "Not update successfully";
	
}
else
{
	$total=$qty*$sp;
	$added_on=date('Y-m-d');
	$sql_insert="insert into ms_cart_tbl(product_id,user_id,qty,sp,total,added_on) values($pid,$user_id,$qty,$sp,$total,'$added_on')";
	$res=mysql_query($sql_insert);
	if($res)
		header('location:mycart.php');
	else
		echo "Not added";
}
}
else
	header('location:index.php');


?>