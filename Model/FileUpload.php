<?php

namespace ZIMZIM\ToolsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use APY\DataGridBundle\Grid\Mapping as GRID;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class FileUpload
 * @ORM\HasLifecycleCallbacks
 */
abstract class FileUpload
{
    /**
     * @var \DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $updatedAt;

    /**
     * @Assert\File(maxSize="500000")
     */
    public $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMToolsBundle.grid.file")
     */
    public $path;


    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir() . '/' . $this->path;
    }

    public function getWebPath()
    {
        return null === $this->path ? null : $this->getUploadDir() . '/' . $this->path;
    }

    protected function getUploadRootDir()
    {
        return __DIR__ . '/../../../../../web/' . $this->getUploadDir();
    }


    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (isset($this->file)) {
            if (null !== $this->file) {

                $oldFile = $this->getAbsolutePath();
                if ($oldFile && isset($this->path)) {
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $random = rand(1, 1000);

                $extension = strrchr($this->file->getClientOriginalName(), '.');

                $filename = str_replace($extension, '', $this->file->getClientOriginalName());

                $this->path = urlencode($filename) . '-' . $random . '.' . $this->file->guessExtension();
            }
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (isset($this->file)) {
            if (null === $this->file) {
                return;
            }
            $this->file->move($this->getUploadRootDir(), $this->path);

            unset($this->file);
        }
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    public function getListAttrImg()
    {
        return array('path');
    }
}
