<?php

namespace MyML;

interface Model {
    public function train(Matrix $samples, array $labels): void;
    public function predict(Matrix $newSamples): array;
}
