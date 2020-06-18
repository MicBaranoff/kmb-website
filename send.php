<?php
	if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

		$to = "metrological@ukr.net";
		
		$title = "Заявка с сайта ".$_SERVER['SERVER_NAME'];
		$from = "order@".$_SERVER['SERVER_NAME'];
		
		if(isset($_POST["name"])) $name = trim(htmlspecialchars($_POST["name"]));
		if(isset($_POST["namef"])) $phone = trim(htmlspecialchars($_POST["namef"]));
		if(isset($_POST["phone"])) $email = trim(htmlspecialchars($_POST["phone"]));
		if(isset($_POST["mess"])) $message = trim(htmlspecialchars($_POST["mess"]));
		
		$headers = "From: $from \r\n";
		$headers .= "Content-type: text/html; charset=utf-8";

		$msg = "<style>.td{font-size:18px;color:#000}</style><table>";
		if($name) $msg .= "<tr><td style='font-weight:bold'>Имя:&nbsp;&nbsp;</td><td>$name<br></td></tr>";
		if($phone) $msg .= "<tr><td style='font-weight:bold'>Название организации:&nbsp;&nbsp;</td><td>$phone<br></td></tr>";
		if($email) $msg .= "<tr><td style='font-weight:bold'>Телефон:&nbsp;&nbsp;</td><td><a href='mailto:$email'>$email</a><br></td></tr>";
		if($message) $msg .= "<tr><td style='font-weight:bold'>Сообщение:&nbsp;&nbsp;</td><td>$message<br></td></tr>";
		$msg .= "<tr><br></tr>";
		$msg .= "<tr><td style='font-weight:bold'>IP:&nbsp;&nbsp;</td><td>".$_SERVER['REMOTE_ADDR']."</td></tr>";
		$msg .= "</table>";

		session_start();
		ini_set('session.gc_maxlifetime', 86400);
		if(isset($_SESSION['phone'])) {
			if($_SESSION['phone'] != $phone) {
				$_SESSION['phone'] = $phone;
				mail($to, $title, $msg, $headers);
			}
		} else {
			$_SESSION['phone'] = $phone;
			mail($to, $title, $msg, $headers);
		}
	}
?>
