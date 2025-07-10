<?php
// src/MyML/Preprocessing/StandardScaler.php
namespace MyML\Preprocessing;

use MyML\Matrix;

class StandardScaler {
    private array $means;
    private array $stdDevs;

    public function fit(Matrix $data): void {
        // Calculate means and standard deviations for each feature
        $numFeatures = $data->getNumColumns();
        $this->means = [];
        $this->stdDevs = [];

        for ($i = 0; $i < $numFeatures; $i++) {
            $column = $data->getColumn($i);
            $this->means[$i] = array_sum($column) / count($column);
            $this->stdDevs[$i] = $this->calculateStdDev($column, $this->means[$i]);
        }
    }

    private function calculateStdDev(array $column, float $mean): float {
        $sum = 0;
        foreach ($column as $value) {
            $sum += pow($value - $mean, 2);
        }
        return sqrt($sum / count($column));
    }

    public function transform(Matrix $data): Matrix {
        // Apply scaling
        $numFeatures = $data->getNumColumns();
        $scaledData = [];

        foreach ($data->getRows() as $row) {
            $scaledRow = [];
            for ($i = 0; $i < $numFeatures; $i++) {
                $scaledRow[] = ($row[$i] - $this->means[$i]) / $this->stdDevs[$i];
            }
            $scaledData[] = $scaledRow;
        }

        return new Matrix($scaledData);
    }
}

