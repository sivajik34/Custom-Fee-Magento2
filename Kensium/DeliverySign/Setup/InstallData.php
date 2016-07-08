<?php

namespace Kensium\DeliverySign\Setup;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Sales\Setup\SalesSetupFactory;
use Magento\Quote\Setup\QuoteSetupFactory;


/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Sales setup factory
     *
     * @var SalesSetupFactory
     */
    protected $salesSetupFactory;
    /**
     * Quote setup factory
     *
     * @var QuoteSetupFactory
     */
    protected $quoteSetupFactory;

    public function __construct(
        SalesSetupFactory $salesSetupFactory,QuoteSetupFactory $quoteSetupFactory
    ) {
        $this->salesSetupFactory = $salesSetupFactory;
        $this->quoteSetupFactory = $quoteSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        /** @var \Magento\Sales\Setup\SalesSetup $salesSetup */
        $salesSetup = $this->salesSetupFactory->create(['setup' => $setup]);
        $options = ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,'size'=>'12,4', 'required' => false];
        $salesSetup->addAttribute('order', 'fee', $options);
        $salesSetup->addAttribute('order', 'base_fee', $options);
        /** @var \Magento\Quote\Setup\QuoteSetup $quoteSetup */
        $quoteSetup = $this->quoteSetupFactory->create(['setup' => $setup]);
        $quoteSetup->addAttribute('quote', 'fee', $options);
        $quoteSetup->addAttribute('quote', 'base_fee', $options); 
        $quoteSetup->addAttribute('quote_address', 'fee', $options);
        $quoteSetup->addAttribute('quote_address', 'base_fee', $options);         

    }
}
