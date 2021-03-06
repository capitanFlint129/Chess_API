<?php


namespace App\Figures;


class Bishop extends AbstractFigure
{
    static protected $moveMatrix;

    static public function initStatic()
    {
        self::$moveMatrix = self::getEmptyMoveMatrix();
        for ($i = 0; $i < 15; $i++) {
            self::$moveMatrix[$i][$i] = true;
            self::$moveMatrix[14 - $i][$i] = true;
        }
        self::$moveMatrix[7][7] = false;
    }

    protected function isCorrectMove($destination)
    {
        return self::$moveMatrix[$destination[0] - $this->coordinates[0] + 7][$destination[1] - $this->coordinates[1] + 7];
    }

    public function getAbbreviation()
    {
        if ($this->color == 'white') {
            return 'WB';
        } else {
            return 'BB';
        }
    }
}
