<?php

declare(strict_types=1);

namespace Infiright\SampleRequest\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const XML_PATH_SAMPLE_REQUEST_ACTIVE = 'sample_request_base_config/general/active';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    public function isModuleActive(string $scopeType = ScopeConfigInterface::SCOPE_TYPE_DEFAULT): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_SAMPLE_REQUEST_ACTIVE, $scopeType);
    }
}
