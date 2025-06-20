<?php

	$inData = getRequestInfo();

	$phone = $inData["Phone"];
	$email = $inData["Email"];
	$firstName = $inData["First Name"];
	$lastName = $inData["Last Name"];
	$id = $inData["id"];


	$conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");
		if ($conn->connect_error)
		{
			returnWithError( $conn->connect_error );
		}
		else
		{
			$stmt = $conn->prepare("UPDATE contacts SET FirstName = ?, LastName=?, Phone= ?, Email= ? WHERE ID= ?");
			$stmt->bind_param("ssssi", $firstName, $lastName, $phone, $email, $id);
			$stmt->execute();

			$stmt->close();
			$conn->close();
			returnWithError("");
		}



	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError( $err )
	{
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}


?>