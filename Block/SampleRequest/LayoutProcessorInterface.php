<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Block\SampleRequest;

/**
 * Layout processor interface.
 *
 * Can be used to provide a custom logic for Sample Request Form JS layout preparation.
 *
 * @see \Infiright\SampleRequest\Block\SampleRequest
 */
interface LayoutProcessorInterface
{
    /**
     * Process js Layout of block
     */
    public function process(array $jsLayout): array;
}
