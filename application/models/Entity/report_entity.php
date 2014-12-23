<?php

namespace Entity;

use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/** @Entity **/
class Report_entity implements JsonSerializable
{
    public function _construct()
    {
    }
    
    /**
     * @Id @Column(type="integer") @GeneratedValue
     */
    protected $id;

    /**
     * @Column(type="integer", nullable=false)
     **/
    protected $type;
    
    /**
     * @Column(type="blob", nullable=false) 
     */
    protected $value;
    
    /**
     * @Column(type = "integer", nullable = false) 
     */
    protected $level;

    /**
     * @Column(type="integer", nullable=false) 
     */
    protected $entity_order;

    public function getId()
    {
        return $this->id;
    }

    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    
    public function getValue()
    {
        return $this->value;
    }
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    public function getLevel()
    {
        return $this->level;
    }
    public function setLevel($level)
    {
        $this->level = $level;
    }

    public function getEntityOrder()
    {
        return $this->entity_order;
    }
    public function setEntityOrder($entity_order)
    {
        $this->entity_order = $entity_order;
    }

    public function setReportEntityInfo($info)
    {
        foreach($info as $key => $value)
        {
            if($key == 'type')
            {
                $this->setType($value);
            }
            else if($key == 'value')
            {
                $this->setValue($value);
            }
            else if($key == 'level')
            {
                $this->setLevel($value);
            }
            else if($key == 'entity_order')
            {
                $this->setEntityOrder($value);
            }
        }
    }

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'type' => $this->type,
            'value' => $this->value,
            'level' => $this->level,
            'entity_order' => $this->entity_order,
        );
    }
}