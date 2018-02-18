<?php

/**
 * 独自セッションディレクトリ設定
 */
function initSessionConfig(){
  ini_set('session_save_path', './session/');
  ini_set('session.gc_maxlifetime', 10*60*60); // 3 hours
  ini_set('session.gc_probability', 1);
  ini_set('session.gc_divisor', 100);
  ini_set('session.cookie_secure', TRUE);
  ini_set('session.use_only_cookies', TRUE);
}
  
?>
