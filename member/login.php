<?php
//ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
session_start();
$token1 = $_SESSION['TOKEN'];
include "../serverdb/server.php";

$username = $_POST['id'];
$password = $_POST['pwd'];

$qry="SELECT * FROM userpro WHERE id='$username' and pwd='$password'";

$result=mysqli_query( $conn, $qry) or die(mysql_error($conn));
	
if($result) {
		    if(mysqli_num_rows($result) > 0) {
					//Login Successful
					session_regenerate_id();
					$row = mysqli_fetch_assoc($result);
					//session
					$_SESSION['USERPRO'] = $row['id'];
					$verifai = $row['verifymel'];
					//$_SESSION['pwd'] = $row['pwd'];
					$id = $row['id'];
					//$survey = $row['aktif'];
					//Update IP and Last login --> $time=NOW();
					$ipaddress = $_SERVER['REMOTE_ADDR'];
					$qry2="UPDATE userpro SET lastlogin= NOW() , ipaddress ='$ipaddress' WHERE id='$id'";
					$result2=mysqli_query($conn,$qry2);
					//tetapkan position utk akses sistem
					$position = $row['akaun'];
					$_SESSION['USER_TYPER'] = $row['akaun'];
					//Go to home page *but calculate point first :D
					
					if($token1=="go"){
					$_SESSION['TOKEN']="no";
					include "login2game.php";
					include "login2gameusdt.php";
					}
					else if($token1=="re"){ echo ("<script LANGUAGE='JavaScript'>window.location.href='../index.php';</script>"); exit(); }
					else { echo "We've detected you've lost network connection. Please use back button and refresh"; $_SESSION['TOKEN']="re"; }
					
					 if ($_SESSION['USER_TYPER'] == 'MASTER') {
					header("location: index_master.php");//echo $position;
					 }
					 else if ($_SESSION['USER_TYPER'] == 'AGENT') {
					header("location: page_po_agent.php");//echo $position;
					 }
					/*else if ($_SESSION['USER_TYPER'] == 'MEMBER'){
						if($survey!='A') { header("location: index.php"); }
						else { header("location: survey.php"); } 
						//echo $ipaddress;
						
					}
					else if ($_SESSION['USER_TYPER'] == 'LP'){
						header("location: index.php");
					}*/
					else{
						//echo"<script>alert('Wrong username or password!');document.location.href='index.php';</script>";
						//echo"<script>document.location.href='index.php?fbi=americansecurity&logon=check';</script>"; 
						if($verifai=="B"){ 
						header("location: deactivated.php?id=".$id."&gg=wp"); //xjadi buat [edit1] sebab ejas sini je deactivated.php
						//[edit1]echo"<script>document.location.href='../index.php?fbi=g9hy25496d&logon=check';</script>";
						}
						else if($verifai=="V"){ header("location: page_verify.php?id=".$id."&gg=wp"); }
						else{ header("location: index.php"); }
					}
					exit();
					}
			else{
				echo"<script>document.location.href='../index.php?fbi=americansecurity&logon=check';</script>";
			}
	}
	else {
		die("Query failed");
	}
?>