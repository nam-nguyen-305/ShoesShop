<?php
require_once ('../../database/dbhelper.php');

if (!empty($_POST)) {
	if (isset($_POST['action'])) {
		$action = $_POST['action'];

		switch ($action) {
			case 'delete':
				if (isset($_POST['CategoryId'])) {
					$CategoryId = $_POST['CategoryId'];

					$sql = 'delete from categories where CategoryId = '.$CategoryId;
					execute($sql);
				}
				break;
		}
	}
}