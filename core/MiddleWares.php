<?php
abstract class MiddleWares{
    public $db;
    abstract function handle();
}