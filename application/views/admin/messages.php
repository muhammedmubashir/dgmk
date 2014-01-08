<?PHP
    $admin_user_id = $this->session->userdata('admin_uid');  
    if($admin_user_id != "")
    {
        $messages = new Modmessages();
        echo $messages->render();
    }
?>