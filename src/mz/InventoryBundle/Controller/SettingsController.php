<?php
namespace mz\InventoryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use mz\InventoryBundle\Entity\Category;
use mz\InventoryBundle\Entity\Condition;
use mz\InventoryBundle\Entity\Location;
use mz\InventoryBundle\Entity\Status;
use mz\InventoryBundle\Form\SettingFormType;

class SettingsController extends Controller
{
    private $namespace = 'mz\\InventoryBundle\\Entity\\';

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('mzInventoryBundle:Category')->findAll();
        $conditions = $em->getRepository('mzInventoryBundle:Condition')->findAll();
        $locations = $em->getRepository('mzInventoryBundle:Location')->findAll();
        $statuses = $em->getRepository('mzInventoryBundle:Status')->findAll();

        return $this->render('mzInventoryBundle:Settings:index.html.twig', array(
            'categories' => $categories,
            'conditions' => $conditions,
            'locations' => $locations,
            'statuses' => $statuses
        ));
    }

    /**
     * Displays a form to create a new entity.
     *
     */
    public function newAction($className)
    {
        $entity = $this->getEntity($className);
        $form = $this->getForm($entity);

        return $this->render('mzInventoryBundle:Settings:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a new entity.
     *
     */
    public function createAction(Request $request, $className)
    {
        $entity = $this->getEntity($className);
        $form = $this->getForm($entity);

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Item has been successfully created.');
            return $this->redirect($this->generateUrl('mz_settings'));

        }else{

            $this->get('session')->getFlashBag()->add('error', 'An error has occurred during item creation.');
        }

        return $this->render('mzInventoryBundle:Settings:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing entity.
     *
     */
    public function editAction($id, $className)
    {
        $entity = $this->getEntityFromDB($className, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Entity not found.');
        }

        $editForm = $this->getForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('mzInventoryBundle:Settings:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing entity.
     *
     */
    public function updateAction(Request $request, $id, $className)
    {
        $entity = $this->getEntityFromDB($className, $id);

        if (!$entity) {
            throw $this->createNotFoundException('Entity not found.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->getForm($entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            $this->get('session')->getFlashBag()->add('success', 'Item has been successfully updated.');
            return $this->redirect($this->generateUrl('mz_settings'));

        }else{

            $this->get('session')->getFlashBag()->add('error', 'An error has occurred during item update.');
        }

        return $this->render('mzInventoryBundle:Settings:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes an entity.
     *
     */
    public function deleteAction(Request $request, $id, $className)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $entity = $this->getEntityFromDB($className, $id);

            if (!$entity) {
                throw $this->createNotFoundException('Entity not found.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'Item has been deleted successfully.');

        }else{

            $this->get('session')->getFlashBag()->add('error', 'An Error has occurred during item deletion.');
        }

        return $this->redirect($this->generateUrl('settings_index'));
    }

    protected function getEntity($className)
    {
        $entityClass = $this->namespace . ucfirst(strtolower($className));

        $entity = new $entityClass();

        return $entity;
    }

    protected function getEntityFromDB($className, $id)
    {
        $entities = array('category', 'condition', 'location', 'status');

        if (in_array(strtolower($className), $entities)) {
            $em = $this->getDoctrine()->getManager();
            return $em->getRepository('mzInventoryBundle:'.ucfirst(strtolower($className)))->find($id);
        }else{
            throw $this->createNotFoundException('Entity: <<' . $className . '>> not found.');
        }
    }

    protected function getForm($entity)
    {
        $className = $entity->getClassName();
        $entities = array('category', 'condition', 'location', 'status');
        $withDisplayField = array('condition', 'status');

        if (!in_array(strtolower($className), $entities)) {
            throw $this->createNotFoundException('Entity: <<' . $className . '>> not found.');
        }

        if (in_array(strtolower($className), $withDisplayField)) {
            return $form = $this->createForm(new SettingFormType(true), $entity);
        } else {
            return $form = $this->createForm(new SettingFormType(), $entity);
        }
    }

    /**
     * Creates a form to delete an entity by id.
     *
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}