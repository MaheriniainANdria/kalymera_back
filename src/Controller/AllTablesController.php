<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

class AllTablesController extends AbstractController
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    #[Route('/api/all-tables', name: 'all_tables', methods: ['GET'])]
    public function getTables(): JsonResponse
    {
        $tables = $this->connection->fetchAllAssociative('SELECT * FROM dining_table');
        return new JsonResponse($tables);
    }
}