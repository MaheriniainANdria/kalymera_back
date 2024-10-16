<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

    class TableController extends AbstractController
    {
        private $connection;

        public function __construct(Connection $connection)
        {
            $this->connection = $connection;
        }

        #[Route('/api/tables', name: 'get_tables', methods: ['GET'])]
        public function getTables(): JsonResponse
        {
            $sql = 'SELECT * FROM dining_table';
            $tables = $this->connection->fetchAllAssociative($sql);

            return $this->json($tables);
        }

        #[Route('/api/tables', name: 'create_table', methods: ['POST'])]
        public function createTable(Request $request): JsonResponse
        {
            $data = json_decode($request->getContent(), true);
            
            if (empty($data['name'])) {
                return new JsonResponse(['message' => 'Name is required'], 400);
            }

            $tableNumber = isset($data['tableNumber']) ? $data['tableNumber'] : null;
            $name = $data['name'];
            $numberOfSeats = isset($data['number_of_seats']) ? $data['number_of_seats'] : 0;
            $type = isset($data['type']) ? $data['type'] : 'normal';
            $location = isset($data['location']) ? $data['location'] : 'interieur';

            $sql = 'INSERT INTO dining_table (table_number, name, number_of_seats, type, location) VALUES (:tableNumber, :name, :numberOfSeats, :type, :location)';
            $this->connection->executeStatement($sql, [
                'tableNumber' => $tableNumber,
                'name' => $name,
                'numberOfSeats' => $numberOfSeats,
                'type' => $type,
                'location' => $location,
            ]);

            return new JsonResponse(['message' => 'Table created successfully'], 201);
        }
    }
