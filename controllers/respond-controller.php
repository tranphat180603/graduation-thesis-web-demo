<?php
    require_once ($_SERVER['DOCUMENT_ROOT'] . "/NTP-Sports-Hub/models/respond-model.php");

    class Respond_Controller {
        public $respond;

        public function __construct() {
            $this->respond = new respond();
        }

        public function getResponsesByCommentId($comment_id)
        {
            return $this->respond->getResponsesByCommentId($comment_id);
        }
    
        public function getResponsesByRespondId($respond_id)
        {
            return $this->respond->getResponsesByRespondId($respond_id);
        }
    
        public function insertResponse($respond_content, $comment_id, $respond_respond_id, $account_id, $created_on_date = "")
        {
            return $this->respond->insert_response($respond_content, $comment_id, $respond_respond_id, $account_id, $created_on_date);
        }
    }

    $respondController = new Respond_Controller(); // Instantiate the controller
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["respond_content"])) {

        // Retrieve the data from the form
        $respond_content = isset($_POST["respond_content"]) ? $_POST["respond_content"] : '';
        $comment_id = isset($_POST["comment_id"]) ? $_POST["comment_id"] : 'NULL';
        $respond_respond_id = isset($_POST["respond_respond_id"]) ? $_POST["respond_respond_id"] : 'NULL'; // This can be set based on your requirements
        $account_id = isset($_POST['account_id']) ? $_POST['account_id'] : null;
        $created_on_date = date('Y-m-d H:i:s'); // Format the current date and time
    
        // Call the insertResponse method of the Respond_Controller
        $result = $respondController->insertResponse($respond_content, $comment_id, $respond_respond_id, $account_id, $created_on_date);
    
    }}
?>