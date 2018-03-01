<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class o
{
    private static $cache;
    
    public function init()
    {
        define("DS",DIRECTORY_SEPARATOR);

        define("DIR",dirname(__FILE__).DS);
 
        self::$cache = array("dir"=>array(),
                             "inc"=>array(),
                             "tl"=>array(),
                             "api"=>array(),
                             "htm"=>array(),
                             "com"=>array(),
                             "classes"=>array(),
                             "model"=>array());
                            
    }
    
    function add($str)
    {
        if(array_key_exists($str,self::$cache) || !is_dir(DIR.$str))return false;
        
        self::$cache[$str] = array();
        
        return true;
    }
    function inc($dir,$name)
    {
        if(!array_key_exists($dir,self::$cache["inc"]))
        {
            self::$cache["dir"][$dir] = DIR.$dir.DS;
            
            self::$cache["inc"][$dir] = array();
        }
        else if(in_array($name,self::$cache["inc"][$dir]))
        return true;
       
        $file =  self::$cache["dir"][$dir].$name.".php";

        if(is_file($file))
        {
            self::$cache["inc"][$dir][] = $name;

            include_once($file);
            
            return true;
        }
        else
        {
             return false;
        } 
    }
   
    public function abt($s)
    {
        return self::inc("abt",$s);
    }
   
    public function tl($s)
    {
        if(!in_array($s,self::$cache["tl"]))
        {
            if(self::inc("tool",$s))
            {
            
            self::start($s);
            
            self::$cache["tl"][] = $s;
            }
            else
            {
                die("don't create tool ".$s);
                exit;
            }
        }
    }
    
    public function lb($s)
    {
        if(!self::inc("lib",$s))
        {
            die("don't create lib");
            
            exit;
        }
    }
    public function htm($s)
    {
        if(self::inc("html",$s)){
        
        return new $s();
        }
    }
    public function api($s,$arg=null)
    {
        if(!in_array($s,self::$cache["api"]))
        {
            if(!self::inc("api",$s))
                    {
            die("don't create api");
                exit;
        }
            
            self::$cache["api"][] = $s;
        }
        
         if($arg != null)
        return new $s($arg);
        else
        return new $s;
    }
  
     public function classes($s,$arg = null)
    {
        if(!in_array($s,self::$cache["classes"]))
        {
            self::inc("classes",$s);
            
            self::$cache["classes"][] = $s;
        }
        
        if($arg != null)
        return new $s($arg);
        else
        return new $s;
    }
   
    public function com($s)
    {
        if(!in_array($s,self::$cache["com"]))
        {
            self::inc("com",$s);
            
            self::start($s);
            
            self::$cache["com"][] = $s;
        }
    }
    public function model($s)
    {
        if(!in_array($s,self::$cache["model"]))
        {
            self::inc("model",$s);
            
            self::$cache["model"][] = $s;
        } 
        
        return self::single($s);
    }
   
   
    public function single($name)
    {
        eval("\$o = ".$name."::single();");
        
        return $o;
    }
    public function start($s)
    {
        eval($s."::start();");
    }
}

o::init();

function abt($name){o::abt($name);}
function tl($name){return o::tl($name);}
function lb($name){o::lb($name);}
function api($name,$arg = null){return o::api($name,$arg);}
function single($name){return o::single($name);}
function start($name){o::start($name);}
function htm($name){return o::htm($name);}
function com($name){o::com($name);}
function classes($name,$arg = null){return o::classes($name,$arg);}

lb("htm");
lb("util");

tl("session");
tl("db");
tl("http");

tl("cusr");

$uid = null;

tl("rememberme");

if(rememberme::is())
{
    $uid = rememberme::get();
}
elseif(session::is("u"))
{
    $uid = session::get();
}

if(is_numeric($uid))
{
tl("u");
u::load($uid);
}

tl("date");
 
tl("patient_wrapper");



?>