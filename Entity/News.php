<?php

namespace BviNewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * News
 *
 * @ORM\Table(name="news")
 * @ORM\Entity(repositoryClass="BviNewsBundle\Repository\NewsRepository")
 */
class News
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;
    
    /**
     * @var string
     * @ORM\Column(name="content", type="string", nullable=false)
     */
    protected $content;
    
    /**
     * @var string
     * @ORM\Column(name="status", type="string", columnDefinition="ENUM('Active','Inactive')",nullable=false) 
     */
    protected $status;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdat;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_dt", type="datetime", nullable=true)
     */
    protected $updatedat;
    
    /**
     * @var \DateTime
     * @ORM\Column(name="created_by", type="integer", nullable=false)
     */
    protected $createdby;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_by", type="integer", nullable=true)
     */
    protected $updatedby;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return News
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return News
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return News
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     * @return News
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime 
     */
    public function getCreatedat()
    {
        return $this->createdat->format('Y-m-d H:i:s');
    }

    /**
     * Set updatedat
     *
     * @param \DateTime $updatedat
     * @return News
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

        return $this;
    }

    /**
     * Get updatedat
     *
     * @return \DateTime 
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Set createdby
     *
     * @param integer $createdby
     * @return News
     */
    public function setCreatedby($createdby)
    {
        $this->createdby = $createdby;

        return $this;
    }

    /**
     * Get createdby
     *
     * @return integer 
     */
    public function getCreatedby()
    {
        return $this->createdby;
    }

    /**
     * Set updatedby
     *
     * @param integer $updatedby
     * @return News
     */
    public function setUpdatedby($updatedby)
    {
        $this->updatedby = $updatedby;

        return $this;
    }

    /**
     * Get updatedby
     *
     * @return integer 
     */
    public function getUpdatedby()
    {
        return $this->updatedby;
    }
}
