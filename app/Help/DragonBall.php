<?php

namespace App\Help;

class DragonBall
{
    public int $ballCount = 0;

    public function iFoundaBall(): void
    {
        $this->ballCount++;

        if ($this->ballCount === 7) {
            echo "You can ask for your wish.";
            $this->ballCount = 0;
        }
    }
}
