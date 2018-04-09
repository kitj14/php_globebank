<?php

function url_for($script_path) {
    // add the leading '/' if not present
    if($script_path[0] != '/') {
      $script_path = "/" . $script_path;
    }
    return WWW_ROOT . $script_path;
  }
// converts spaces in url to '+', etc.
function u($url){
  return urlencode($url);
}

function rawu($url){
  return urlencode($url);
}
// ignores html chars and cross-site scipting
function h($string=""){
  return htmlspecialchars($string);
}

function error_404(){
  header($_SERVER["SERVER_PROTOCOL"] . "404 Not Found");
  exit();
}
function error_500(){
  header($_SERVER["SERVER_PROTOCOL"] . "500 Internal Server Error");
  exit();
}

function redirect_to($loc){
  header("Location: " . $loc);
  exit();
}
// check if request is post method
function  is_post_request(){
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}
// check if request is get method
function  is_get_request(){
  return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function get_and_clear_session_msg(){
  if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }
}

function display_session_message(){
  $msg = get_and_clear_session_msg();
  if(!is_blank($msg)){
    return '<div style="color: #0055DD;background: #fff;border: 2px solid #0055DD;padding: 1em 15px;margin: 1em 30px;width: 890px;">' .h($msg). '</div>';
  }
}