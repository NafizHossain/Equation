<?php
session_start();


if(!array_key_exists('m_1',$_SESSION)) {
	$_SESSION['m_1'] = 'A';
	$_SESSION['m_2'] = 'B';
	$_SESSION['m_3'] = 'C';
	$_SESSION['m_4'] = 'D';
	$_SESSION['m_5'] = 'E';
}


?>
<form method="post">
b: <input name="b" type="text" /><br />
n: <input name="n" type="text" /><br />
<input type="submit" />
</form>


<?php


if(array_key_exists('n',$_POST)) {
	$b = intval($_POST['b']);
	$n = intval($_POST['n']);


	for($i = 0; $i < $n; $i++) {
		if($b == 1) {
			$start = $_SESSION['m_1'];
			$_SESSION['m_1'] = $_SESSION['m_2'];
			$_SESSION['m_2'] = $_SESSION['m_3'];
			$_SESSION['m_3'] = $_SESSION['m_4'];
			$_SESSION['m_4'] = $_SESSION['m_5'];
			$_SESSION['m_5'] = $start;
		} else if($b == 2) {
			$m1 = $_SESSION['m_1'];
			$_SESSION['m_1'] = $_SESSION['m_5'];
			$_SESSION['m_5'] = $_SESSION['m_4'];
			$_SESSION['m_4'] = $_SESSION['m_3'];
			$_SESSION['m_3'] = $_SESSION['m_2'];
			$_SESSION['m_2'] = $m1;
		} else if($b == 3) {
			$one = $_SESSION['m_1'];
			$_SESSION['m_1'] = $_SESSION['m_2'];
			$_SESSION['m_2'] = $one;
		} else if($b == 4) {
			echo $_SESSION['m_1'] . ', ' . $_SESSION['m_2'] . ', ' . $_SESSION['m_3'] . ', ' . $_SESSION['m_4'] . ', ' . $_SESSION['m_5'];
		}
	}
}


?>

