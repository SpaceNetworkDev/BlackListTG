<?php

$functions = glob("functions/*.php");
foreach ($functions as $function) {
  require_once "$function";
}
