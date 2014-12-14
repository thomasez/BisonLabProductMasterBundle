<?php

namespace BisonLab\ProductMasterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BisonLab\ProductMasterBundle\Entity\ProductCampaign;
use BisonLab\ProductMasterBundle\Form\ProductCampaignType;

/**
 * ProductCampaign controller.
 *
 * @Route("/productcampaign")
 */
class ProductCampaignController extends Controller
{
    /**
     * Lists all ProductCampaign entities.
     *
     * @Route("/", name="productcampaign")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BisonLabProductMasterBundle:ProductCampaign')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Lists all ProductCampaign entities by Campaign.
     *
     * @Route("/campaign/{id}", name="productcampaign_list_by_campaign")
     * @Template()
     */
    public function listAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BisonLabProductMasterBundle:ProductCampaign')->findByProduct($id);

        return $this->render('BisonLabProductMasterBundle:ProductCampaign:index.html.twig', array('entities' => $entities));

    }

    /**
     * Finds and displays a ProductCampaign entity.
     *
     * @Route("/{id}/show", name="productcampaign_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCampaign')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCampaign entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new ProductCampaign entity.
     *
     * @Route("/new", name="productcampaign_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductCampaign();
        $form   = $this->createForm(new ProductCampaignType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new ProductCampaign entity.
     *
     * @Route("/create", name="productcampaign_create")
     * @Method("post")
     * @Template("BisonLabProductMasterBundle:ProductCampaign:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new ProductCampaign();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProductCampaignType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productcampaign_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ProductCampaign entity.
     *
     * @Route("/{id}/edit", name="productcampaign_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCampaign')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCampaign entity.');
        }

        $editForm = $this->createForm(new ProductCampaignType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ProductCampaign entity.
     *
     * @Route("/{id}/update", name="productcampaign_update")
     * @Method("post")
     * @Template("BisonLabProductMasterBundle:ProductCampaign:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCampaign')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCampaign entity.');
        }

        $editForm   = $this->createForm(new ProductCampaignType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productcampaign_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ProductCampaign entity.
     *
     * @Route("/{id}/delete", name="productcampaign_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCampaign')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductCampaign entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productcampaign'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
