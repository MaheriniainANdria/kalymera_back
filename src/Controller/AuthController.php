<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    #[Route('/api/signup', name: 'signup', methods: ['POST'])]
    public function signup(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            return new JsonResponse(['error' => 'Username and password are required'], 400);
        }

        // Verify if the username already exist on the database
        $existingUser = $this->connection->fetchOne('SELECT 1 FROM users WHERE username = ?', [$username]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already taken'], 400);
        }

        // insert the username and the pwd into the table users
        $this->connection->executeStatement(
            'INSERT INTO users (username, password) VALUES (?, ?)',
            [$username, $password]
        );

        return new JsonResponse(['message' => 'User registered successfully'], 201);
    }

    #[Route('/api/login', name: 'login', methods: ['POST'])]
    public function login(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $username = $data['username'] ?? null;
        $password = $data['password'] ?? null;

        if (!$username || !$password) {
            return new JsonResponse(['error' => 'Username and password are required'], 400);
        }

        // verification of the usename and the psswd
        $user = $this->connection->fetchAssociative(
            'SELECT * FROM users WHERE username = ? AND password = ?',
            [$username, $password]
        );

        if (!$user) {
            return new JsonResponse(['error' => 'Invalid credentials'], 401);
        }

        return new JsonResponse(['message' => 'Login successful']);
    }
}
