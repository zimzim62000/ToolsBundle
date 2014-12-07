<?php

namespace ZIMZIM\ToolsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use ZIMZIM\ToolsBundle\Entity\UploadTinymce;
use ZIMZIM\ToolsBundle\Form\UploadTinymceType;

/**
 * UploadTinymce controller.
 *
 */
class UploadTinymceController extends MainController
{

    /**
     * Lists all UploadTinymce entities.
     *
     */
    public function indexAction()
    {

        $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');

        $data = array(
            'manager' => $manager,
            'dir' => 'ZIMZIMToolsBundle:UploadTinymce',
            'show' => 'zimzim_toolsbundle_uploadtinymce_show',
            'edit' => 'zimzim_toolsbundle_uploadtinymce_edit'
        );

        $this->gridList($data);


        return $this->grid->getGridResponse('ZIMZIMToolsBundle:UploadTinymce:index.html.twig');
    }

    /**
     * Creates a new UploadTinymce entity.
     *
     */
    public function createAction(Request $request)
    {
        $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');

        $entity = $manager->createEntity();
        $form = $this->createCreateForm($entity, $manager);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $this->createSuccess();
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect(
                $this->generateUrl('zimzim_toolsbundle_uploadtinymce_show', array('id' => $entity->getId()))
            );
        }

        return $this->render(
            'ZIMZIMToolsBundle:UploadTinymce:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Creates a form to create a UploadTinymce entity.
     *
     * @param UploadTinymce $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm($entity, $manager)
    {
        $form = $this->createForm(
            $manager->getFormName(),
            $entity,
            array(
                'action' => $this->generateUrl('zimzim_toolsbundle_uploadtinymce_create'),
                'method' => 'POST',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.create'));

        return $form;
    }

    /**
     * Displays a form to create a new UploadTinymce entity.
     *
     */
    public function newAction()
    {
        $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');

        $entity = $manager->createEntity();
        $form = $this->createCreateForm($entity, $manager);

        return $this->render(
            'ZIMZIMToolsBundle:UploadTinymce:new.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView(),
            )
        );
    }

    /**
     * Finds and displays a UploadTinymce entity.
     *
     */
    public function showAction($id)
    {
        $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UploadTinymce entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMToolsBundle:UploadTinymce:show.html.twig',
            array(
                'entity' => $entity,
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Displays a form to edit an existing UploadTinymce entity.
     *
     */
    public function editAction($id)
    {
        $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UploadTinymce entity.');
        }

        $editForm = $this->createEditForm($entity, $manager);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render(
            'ZIMZIMToolsBundle:UploadTinymce:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Creates a form to edit a UploadTinymce entity.
     *
     * @param UploadTinymce $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(UploadTinymce $entity, $manager)
    {
        $form = $this->createForm(
            $manager->getFormName(),
            $entity,
            array(
                'action' => $this->generateUrl(
                    'zimzim_toolsbundle_uploadtinymce_update',
                    array('id' => $entity->getId())
                ),
                'method' => 'PUT',
            )
        );

        $form->add('submit', 'submit', array('label' => 'button.update'));

        return $form;
    }

    /**
     * Edits an existing UploadTinymce entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');

        $entity = $manager->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find UploadTinymce entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity, $manager);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entity->preUpload();
            $this->updateSuccess();
            $em->flush();

            return $this->redirect($this->generateUrl('zimzim_toolsbundle_uploadtinymce_edit', array('id' => $id)));
        }

        return $this->render(
            'ZIMZIMToolsBundle:UploadTinymce:edit.html.twig',
            array(
                'entity' => $entity,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            )
        );
    }

    /**
     * Deletes a UploadTinymce entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $manager = $this->container->get('zimzim_tools_uploadtinymcemanager');
            $entity = $manager->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find UploadTinymce entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->deleteSuccess();
        }

        return $this->redirect($this->generateUrl('zimzim_toolsbundle_uploadtinymce'));
    }

    /**
     * Creates a form to delete a UploadTinymce entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zimzim_toolsbundle_uploadtinymce_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'button.delete'))
            ->getForm();
    }
}
