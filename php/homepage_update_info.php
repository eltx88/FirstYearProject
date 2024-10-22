<?php
require("../homepage.php");

if (isset($_POST['task'])) {
	$pdo_change_info = new PDO("mysql:host=$host;dbname=" . $db_name . "", $username_db, $password);
	$pdo_change_info->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
   
    $task_string = "";
    if($tasks_array[$_POST['task']] == $_POST['task'])
    {
        $tasks_array[$_POST['task']] = '0';
    }
    else
    {
        
        $tasks_array[$_POST['task']] = $_POST['task'];
    }
    foreach($tasks_array as $task)
    {
        if($task !='0')
        {
            $task_string .= $task . ",";
        }
        
    }
    if($task_string == '')
    {
        $task_string = NULL;
    }else
    {
        $task_string = substr_replace($task_string, "", -1);
    }
    
    

    $sql_change_info = "UPDATE user_info SET tasks = :value WHERE user_id = :user_id";

    $stmt_change_info = $pdo_change_info->prepare($sql_change_info);

    $stmt_change_info->execute(['value' => $task_string, 'user_id' => $user_id]);
}

?>