<?php

class HtmlHelper{
    static function formOpen($method='get',$action=''){
        echo '<form method='.$method.' action='.$action.'>';
    }

    static function formClose(){
        echo '</form>';
    }
    static function input($type='text',$name,$class='',$id='',$placeholder=''){
        echo '<input type='.$type.' name='.$name.' class='.$class.' id='.$id.' placeholder='.$placeholder.'  />';
    }
}