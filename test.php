<?php
// Example Usage
require __DIR__.'/vendor/autoload.php'; // If using Composer

use MyML\Matrix;
use MyML\Classification\KNearestNeighbors;
use MyML\Preprocessing\StandardScaler;

// $samples = new Matrix([
//     [1, 2],
//     [2, 1],
//     [3, 3],
//     [5, 4]
// ]);

$samples = new Matrix([
    [1, 2, 3],
    [2, 1, 3],
    [3, 3, 3],
    [5, 4, 6]
]);
$labels = ['A', 'A', 'B', 'B'];

// Preprocessing (optional)
$scaler = new StandardScaler();
$scaler->fit($samples);
$scaledSamples = $scaler->transform($samples);

$classifier = new KNearestNeighbors(k: 3);
$classifier->train($scaledSamples, $labels);

$prediction = $classifier->predict(new Matrix([[3, 2]]));
echo "Prediction: " . $prediction[0]; // Output: B