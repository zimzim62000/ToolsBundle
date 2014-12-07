<?php

namespace ZIMZIM\ToolsBundle\Controller;


use APY\DataGridBundle\Grid\Action\MassAction;
use APY\DataGridBundle\Grid\Action\RowAction;
use APY\DataGridBundle\Grid\Row;
use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{

    protected $grid;

    protected function gridList($data, $setSource = true)
    {

        $grid = $this->get('grid');

        $source = $this->setSource($data);

        if (isset($data['show'])) {
            $rowAction = new RowAction("ZIMZIMToolsBundle.button.show", $data['show']);
            $grid->addRowAction($rowAction);
        }

        if (isset($data['edit'])) {
            $rowAction = new RowAction("ZIMZIMToolsBundle.button.update", $data['edit']);
            $grid->addRowAction($rowAction);
        }


        if (isset($data['deletemass'])) {
            $massAction = new MassAction('ZIMZIMToolsBundle.button.delete', $data['deletemass']);
            $grid->addMassAction($massAction);
        }

        if ($setSource) {
            $grid->setSource($source);
        }

        $data['manager']->getRepository()->getList($source);

        $object = $this;

        $source->manipulateRow(
            function (Row $row) use ($object) {
                $object->manipulateRow($row);

                return $row;
            }
        );

        $this->grid = $grid;

        return $this->grid->getGridResponse($data['dir'] . ':index.html.twig');
    }

    protected function setSource($data)
    {
        $type = 'default';
        if (isset($data['type'])) {
            $type = $data['type'];
        }

        return new Entity($data['manager']->getClassName(), $type);
    }

    protected function manipulateRow(Row $row)
    {

        if (method_exists($row->getEntity(), 'getListAttrImg')) {
            foreach ($row->getEntity()->getListAttrImg() as $attr) {
                $method = 'get' . ucfirst($attr);
                $methodWeb = 'getWeb' . ucfirst($attr);
                if ($row->getEntity()->{$method}() !== null) {
                    $row->setField(
                        $attr,
                        '<img style="max-height:50px;"  src="/' . $row->getEntity()->{$methodWeb}() . '"/>'
                    );
                }
            }
        }

        return $row;
    }

    protected function createSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'ZIMZIMToolsBundle.flashbag.success.create'
            )
        );
    }

    protected function updateSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'ZIMZIMToolsBundle.flashbag.success.update'
            )
        );
    }

    protected function deleteSuccess()
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => 'ZIMZIMToolsBundle.flashbag.success.delete'
            )
        );
    }

    private function addFlashMessage($data)
    {

        $this->get('session')->getFlashBag()->add(
            $data['type'],
            $data['message']
        );
    }

    protected function displayError($message)
    {
        $this->addFlashMessage(
            array(
                'type' => 'errors',
                'message' => $message
            )
        );
    }

    protected function displaySuccess($message)
    {
        $this->addFlashMessage(
            array(
                'type' => 'success',
                'message' => $message
            )
        );
    }
}
