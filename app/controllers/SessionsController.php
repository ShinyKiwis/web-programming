<?php
require_once "models/User.php";
class SessionsController {
  const DEFAULT_VIEW_FOLDER = 'views/sessions/';
  public function new() {
    ob_start();
    include(self::DEFAULT_VIEW_FOLDER . 'login.php');
    $content = ob_get_clean();
    return $content;
  }

  public function create($postData) {
    $email = $postData["email"];
    $password = $postData["password"];
    $result = User::get_user_by_email($email);
    if(!is_null($result)) {
      $fetchPassword = $result['password'];
      if (!password_verify($password, $fetchPassword)) {
        exit(json_encode(array("status" => "error", "message" => "Your email or password is wrong!")));
      } else {
        ini_set('session.gc_maxlifetime', 10800);
        session_set_cookie_params(10800);

        session_start();
        $_SESSION['user_id'] = $result['id'];

        exit(json_encode(array("status" => "success")));
      }
    } else {
      exit(json_encode(array("status" => "error", "message" => "Email doesn't exist in our system!")));
    }
  }

  public function destroy() {
    session_start();
    session_destroy();
    header("Location: " . "http://localhost:8080/home");
  }
}
?>
