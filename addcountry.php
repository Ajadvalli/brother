<?php
extract($_POST);
if(isset($add))
{
	require_once "includes/dbconnect.php";
	$count=count($cnames);
	for($i=0;$i<$count;$i++)
	{
	$sql_qry="insert into country_tbl(country_name) values('$cnames[$i]')";
	mysql_query($sql_qry);
	}
}

?>





<form method="post" action="">
Country : <input type="text" name="cnames[]"/><br/><br/>
Country : <input type="text" name="cnames[]"/><br/><br/>
Country : <input type="text" name="cnames[]"/><br/><br/>
<input type="submit" name="add" value="Add"/>
</form>