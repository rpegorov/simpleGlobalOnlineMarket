<?php

namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

trait TimestampableTrait {
    #[ORM\Column(type: 'datetime')]
    private \DateTime $dateCreated;
    #[ORM\Column(type: 'datetime')]
    private \DateTime $dateUpdated;
    #[ORM\Column(type: 'datetime', nullable: true)]
    private \DateTime $dateDeleted;

    /**
     * @return \DateTime
     */
    public function getDateCreated(): \DateTime {
        return $this->dateCreated;
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated(): \DateTime {
        return $this->dateUpdated;
    }

    /**
     * @return \DateTime
     */
    public function getDateDeleted(): \DateTime {
        return $this->dateDeleted;
    }

    /**
     * @param   \DateTime  $dateCreated
     */
    public function setDateCreated(\DateTime $dateCreated): self {

        $this->dateCreated = $dateCreated;
        return $this;
    }

    /**
     * @param   \DateTime  $dateUpdated
     */
    public function setDateUpdate(\DateTime $dateUpdated): self {
        $this->dateUpdated = $dateUpdated;
        return $this;
    }

    /**
     * @param   \DateTime  $dateDeleted
     */
    public function setDateDeleted(\DateTime $dateDeleted): self {
        $this->dateDeleted = $dateDeleted;
        return $this;
    }
    #[Orm\PrePersist]

    public final function onCreateTimestampable()
    {
       $this->setDateCreated(new \DateTime())->setDateUpdate(new \DateTime());
    }
    #[Orm\PreUpdate]
    public final function onUpdateTimestampable()
    {
       $this->setDateUpdate(new \DateTime());
    }


}