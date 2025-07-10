<?php
// src/MyML/Matrix.php
namespace MyML;

class Matrix {
    private array $data;

    public function __construct(array $data) {
        // Basic validation
        if (empty($data) || !is_array($data[0])) {
            throw new \InvalidArgumentException("Data must be a non-empty 2D array.");
        }

        $numCols = count($data[0]);
        foreach ($data as $row) {
            if (count($row) !== $numCols) {
                throw new \InvalidArgumentException("All rows must have the same number of columns.");
            }
        }

        $this->data = $data;
    }

    public function getNumColumns(): int {
        return count($this->data[0]);
    }

    public function getColumn(int $index): array {
        return array_column($this->data, $index);
    }

    public function getRows(): array {
        return $this->data;
    }

    public function multiply(Matrix $other): Matrix {
        // Implement matrix multiplication
        // ... (this is where FFI would be beneficial)
        $numRowsA = count($this->data);
        $numColsA = count($this->data[0]);
        $numRowsB = count($other->data);
        $numColsB = count($other->data[0]);

        if ($numColsA !== $numRowsB) {
            throw new \InvalidArgumentException("Number of columns in A must match number of rows in B.");
        }

        $result = [];
        for ($i = 0; $i < $numRowsA; $i++) {
            $result[$i] = [];
            for ($j = 0; $j < $numColsB; $j++) {
                $sum = 0;
                for ($k = 0; $k < $numColsA; $k++) {
                    $sum += $this->data[$i][$k] * $other->data[$k][$j];
                }
                $result[$i][$j] = $sum;
            }
        }
        return new Matrix($result);
    }

    // Add other matrix operations: add, subtract, transpose, etc.

    public function transpose(): Matrix {
        $transposed = [];
        foreach ($this->data as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $transposed[$colIndex][$rowIndex] = $value;
            }
        }
        return new Matrix($transposed);
    }

}
