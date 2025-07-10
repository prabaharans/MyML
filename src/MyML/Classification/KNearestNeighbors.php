<?php
// src/MyML/Classification/KNearestNeighbors.php
namespace MyML\Classification;

use MyML\Matrix;
use MyML\Model; // Interface

class KNearestNeighbors implements Model {
    private int $k;
    private Matrix $samples;
    private array $labels;

    public function __construct(int $k) {
        $this->k = $k;
    }

    public function train(Matrix $samples, array $labels): void {
        $this->samples  = $samples;
        $this->labels  = $labels;
    }

    public function predict(Matrix $newSamples): array {
        $predictions = [];
        foreach ($newSamples->getRows() as $newSample) {
            // Calculate distances to all training samples
            // Find K nearest neighbors
            // Determine class based on majority vote
            $distances = [];
            foreach ($this->samples->getRows() as $index => $samples) {
                $distances[$index] = $this->euclideanDistance($newSample, $samples);
            }
            asort($distances);
            $nearestNeighbors = array_slice($distances, 0, $this->k, true);
            $predictedClass = $this->majorityVote($nearestNeighbors);
            $predictions[] = $predictedClass;
        }
        return $predictions;
    }


    private function euclideanDistance(array $a, array $b): float {
        $sum = 0;
        foreach ($a as $i => $value) {
            $sum += pow($value - $b[$i], 2);
        }
        return sqrt($sum);
    }

    private function majorityVote(array $nearestNeighbors): string {
        $votes = [];
        foreach ($nearestNeighbors as $index => $distance) {
            $label = $this->labels[$index];
            if (!isset($votes[$label])) {
                $votes[$label] = 0;
            }
            $votes[$label]++;
        }
        arsort($votes);
        return key($votes);
    }
}

