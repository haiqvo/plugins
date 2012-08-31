<?php
 
class Splurgy_Embeds_Block_Adminhtml_Embeds_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('embedsGrid');
        // This is the primary key of the database
        $this->setDefaultSort('splurgy_embed_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }
 
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('embeds/embeds')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
 
    protected function _prepareColumns()
    {
        $this->addColumn('splurgy_embed_id', array(
            'header'    => Mage::helper('embeds')->__('ID'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'splurgy_embed_id',
        ));
  
        $this->addColumn('title', array(
            'header'    => Mage::helper('embeds')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));
        
        
        $this->addColumn('entityid', array(
            'header'    => Mage::helper('embeds')->__('EntityID'),
            'width'     => '150px',
            'index'     => 'entityid',
        ));
        
        $this->addColumn('offerid', array(
            'header'    => Mage::helper('embeds')->__('OfferID'),
            'width'     => '150px',
            'index'     => 'offerid',
        ));
        
        $this->addColumn('created_time', array(
            'header'    => Mage::helper('embeds')->__('Creation Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'created_time',
        ));
 
        $this->addColumn('update_time', array(
            'header'    => Mage::helper('embeds')->__('Update Time'),
            'align'     => 'left',
            'width'     => '120px',
            'type'      => 'date',
            'default'   => '--',
            'index'     => 'update_time',
        ));   
 
 
        $this->addColumn('status', array(
 
            'header'    => Mage::helper('embeds')->__('Status'),
            'align'     => 'left',
            'width'     => '80px',
            'index'     => 'status',
            'type'      => 'options',
            'options'   => array(
                1 => 'Active',
                0 => 'Inactive',
            ),
        ));
        $offerid = Mage::getModel('embeds/embeds')->load(4);
        $data = $offerid->getData();
        $entityid = $data["entityid"];
        
        var_dump($entityid);
        
        var_dump($offerid);
        var_dump($offerid->getStatus());
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*');
        $embeds = Mage::getModel('embeds/embeds')->getCollection();
        foreach ($collection as $product) {
            $test=$product->getEntityId();
            foreach ($embeds as $product){
                $data = $product->getData();
                $entityId = $data["entityid"];
                if($test == $entityId){
                    var_dump($test .'='. $entityId);
                }
            }
        }
        return parent::_prepareColumns();
        
    }
 
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
 
 
}
