<?php
abstract class ServiceProvider{
    public $db=null;
    abstract function boot();
}