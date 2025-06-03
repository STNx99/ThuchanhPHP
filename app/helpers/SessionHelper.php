<?php

class SessionHelper 
{
    public static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public static function isLoggedIn()
    {
        self::startSession();
        return isset($_SESSION['username']);
    }
    
    public static function isAdmin()
    {
        self::startSession();
        return isset($_SESSION['role']) && $_SESSION['role'] == 'admin';
    }
    
    public static function getUsername()
    {
        self::startSession();
        return $_SESSION['username'] ?? null;
    }
    
    public static function getRole()
    {
        self::startSession();
        return $_SESSION['role'] ?? null;
    }
    
    public static function requireAdmin()
    {
        if (!self::isAdmin()) {
            header('Location: /webbanhang/account/authorize');
            exit;
        }
    }
    
    public static function requireLogin()
    {
        if (!self::isLoggedIn()) {
            header('Location: /webbanhang/account/login');
            exit;
        }
    }
}
