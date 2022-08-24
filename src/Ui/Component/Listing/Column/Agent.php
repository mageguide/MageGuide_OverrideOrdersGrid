<?php

namespace MageGuide\OverrideOrdersGrid\Ui\Component\Listing\Column;

use \Magento\Sales\Api\OrderRepositoryInterface;
use \Magento\Framework\View\Element\UiComponent\ContextInterface;
use \Magento\Framework\View\Element\UiComponentFactory;
use \Magento\Ui\Component\Listing\Columns\Column;
use \Magento\Framework\Api\SearchCriteriaBuilder;
use \Magento\Framework\App\ResourceConnection;

class Agent extends Column
{
    protected $_orderRepository;
    protected $_searchCriteria;
    protected $_resourceConnection;

    public function __construct(
        ContextInterface $context, 
        UiComponentFactory $uiComponentFactory, 
        OrderRepositoryInterface $orderRepository, 
        SearchCriteriaBuilder $criteria, 
        ResourceConnection $resourceConnection,
        array $components = [], 
        array $data = []
    )
    {
        $this->_orderRepository = $orderRepository;
        $this->_searchCriteria  = $criteria;
        $this->_resourceConnection  = $resourceConnection;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        $connection = $this->_resourceConnection->getConnection();
        $orderTableName = $this->_resourceConnection->getTableName('amasty_order_attribute_grid_flat');
        $agentTableName = $this->_resourceConnection->getTableName('admin_user');

        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // $order  = $this->_orderRepository->get($item["entity_id"]);
                $ordersql = "SELECT agent_id FROM " . $orderTableName . " WHERE parent_id = " . $item["entity_id"];
                $agent_id = $connection->fetchOne($ordersql);
                if ($agent_id):
                    $agentsql = "SELECT username FROM " . $agentTableName . " WHERE user_id = " . $agent_id;
                    $username = $connection->fetchOne($agentsql);
                    $item[$this->getData('name')] = $username;
                else:
                    $item[$this->getData('name')] = null;
                endif;
            }
        }

        return $dataSource;
    }
}
?>