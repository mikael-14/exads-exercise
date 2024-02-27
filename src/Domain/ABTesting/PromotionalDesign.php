<?php

namespace ExadsExercises\Domain\ABTesting;

use Exads\ABTestData;
use ExadsExercises\Domain\ABTesting\Exceptions\DesignNotFoundException;
use ExadsExercises\Domain\ABTesting\Exceptions\FailLoadDataException;

/**
 * Domain Promotional design
 */
class PromotionalDesign
{
    /**
     * @var string
     */
    private ?string $promotion = null;
    /**
     * @var array<Design>
     */
    private array $designs = [];
    /**
     * @var int id of the promotion
     */
    private int $id;

    /**
     * @param int $id of promotion
     */
    public function __construct(int $id)
    {
        $this->id = $id;
        $this->loadData();
    }
    /**
     * @return [type]
     * 
     * @throws FailLoadDataException
     */
    private function loadData()
    {
        try {
            $abTest = new ABTestData($this->id);
            $this->promotion = $abTest->getPromotionName();
            $this->designs = $abTest->getAllDesigns();
        } catch (\Exception $e) {
            throw new FailLoadDataException('Fail to load data ' . $e->getMessage());
        }
    }
    /**
     * @return string|null promotion name
     */
    public function getName(): ?string
    {
        return $this->promotion;
    }
    /**
     * @return design
     * 
     * @throws DesignNotFoundException
     */
    public function randomDesign(): Design
    {

        $rand = mt_rand(1, 100); //random number between 1 and 100 (percent)

        $cumulativeSplit = 0;
        foreach ($this->designs as $design) {
            $cumulativeSplit += $design['splitPercent'];

            if ($rand <= $cumulativeSplit) {
                return new Design($design['designId'], $design['designName'], $design['splitPercent']);
            }
        }

        throw new DesignNotFoundException('Could not pick one desing');
    }
}
