<?php

namespace App\Http\Controllers;


class ClusterController extends Controller
{
    const ROW = 5;
    const COL = 5;

    private function isSafe(&$grid, $row, $col, &$scanned)
    {
        return ($row >= 0) && ($row < self::ROW) &&
            ($col >= 0) && ($col < self::COL) &&
            ($grid[$row][$col] === 'S' && !isset($scanned[$row][$col]));
    }

    private function DFS(&$grid, $row, $col, &$scanned)
    {
        $rowNeighbours = [-1, -1, -1, 0, 0, 1, 1, 1];
        $colNeighbours = [-1, 0, 1, -1, 1, -1, 0, 1];

        $scanned[$row][$col] = true;

        for ($k = 0; $k < 8; $k++) {
            if ($this->isSafe($grid, $row + $rowNeighbours[$k],
                $col + $colNeighbours[$k], $scanned)) {
                self::DFS($grid, $row + $rowNeighbours[$k],
                    $col + $colNeighbours[$k], $scanned);
            }
        }
    }

    private function countCluster(&$grid)
    {
        $scanned = [[]];

        $count = 0;

        for ($i = 0; $i < self::ROW; $i++) {
            for ($j = 0; $j < self::COL; $j++) {
                if ($grid[$i][$j] === 'S' && !isset($scanned[$i][$j])) {
                    $this->DFS($grid, $i, $j, $scanned);
                    $count++;
                }
            }
        }

        return $count;
    }

    public function index()
    {
        $grid = [
            ['S', 'S', 'P', 'P', 'P'],
            ['S', 'S', 'P', 'S', 'P'],
            ['S', 'P', 'P', 'S', 'P'],
            ['P', 'P', 'P', 'S', 'P'],
            ['P', 'S', 'P', 'S', 'P']
        ];

        dd("Number of islands is: " .
            $this->countCluster($grid));
    }
}
