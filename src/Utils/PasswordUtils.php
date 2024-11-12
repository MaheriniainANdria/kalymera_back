<?php

namespace App\Utils;

class PasswordUtils
{
    public static function hashPasswordWithSalt(string $password): string
    {
        $salt = bin2hex(random_bytes(16));
        $hash = hash('sha256', $salt . $password);
        return $salt . ':' . $hash;
    }

    public static function verifyPassword(string $enteredPassword, string $storedHash): bool
    {
        list($salt, $storedPasswordHash) = explode(':', $storedHash);
        $hash = hash('sha256', $salt . $enteredPassword);
        return hash_equals($storedPasswordHash, $hash);
    }
}
