<?php

namespace ZIMZIM\ToolsBundle\Model;

use ZIMZIM\ToolsBundle\Model\APYDataGrid\ApyDataGridFilePathInterface;
use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;


/**
 * UploadTinymce
 *
 * @ORM\MappedSuperclass
 *
 */
class UploadTinymce extends FileUpload implements ApyDataGridFilePathInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     */
    protected $id;

    /**
     * @var string
     *
     * @GRID\Column(operatorsVisible=false, title="ZIMZIMCategoryProduct.name")
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /******************************** IMAGE **************************/
    /**
     * @Assert\File(maxSize="500000")
     */
    public $file;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @GRID\Column(operatorsVisible=false, safe=false, title="ZIMZIMToolsBundle.grid.file")
     */
    public $path;

    protected function getUploadDir()
    {
        return 'resources/upload';
    }

    use FileUploadTrait;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}
