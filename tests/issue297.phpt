--TEST--
ISSUE #297 (Yaf_Loader fail to load namespace class name)
--SKIPIF--
<?php
if (!extension_loaded("yaf")) die("skip");
if (substr(PHP_OS, 0, 3) == "WIN") die("skip Linux only");
?>
--INI--
yaf.lowcase_path=0
yaf.throw_exception=0
yaf.catch_exception=1
yaf.use_namespace=1
yaf.use_spl_autoload=0
--FILE--
<?php 
$loader = Yaf\Loader::getInstance(__DIR__, __DIR__);
var_dump($loader->autoload("Test\Test"));
var_dump(new \Test\Test\Test\Test\Test\Test\T\Test\Test); //for __SSE2__
?>
--EXPECTF--
Warning: Yaf\Loader::autoload(): Failed opening script %s%cTest/Test.php: No such file or directory in %sissue297.php on line %d
bool(true)

Warning: Yaf\Loader::autoload(): Failed opening script %s/Test/Test/Test/Test/Test/Test/T/Test/Test.php: No such file or directory in %sissue297.php on line %d

Fatal error: Uncaught Error: Class 'Test\Test\Test\Test\Test\Test\T\Test\Test' not found in %sissue297.php:%d
Stack trace:
#0 {main}
  thrown in %sissue297.php on line %d
