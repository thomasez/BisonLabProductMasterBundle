<?php

namespace BisonLab\ProductMasterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BisonLab\ProductMasterBundle\Entity\Product;
use BisonLab\ProductMasterBundle\Entity\ProductCatalog;
use BisonLab\ProductMasterBundle\Entity\ProductCampaign;
use BisonLab\ProductMasterBundle\Form\ProductType;
use BisonLab\ProductMasterBundle\Form\ProductCatalogType;
use BisonLab\ProductMasterBundle\Form\ProductCampaignType;

/**
 * Product controller.
 *
 * @Route("/product")
 */
class ProductController extends Controller
{
    /**
     * Lists all Product entities.
     *
     * @Route("/", name="product")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BisonLabProductMasterBundle:Product')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Product entity.
     *
     * @Route("/{id}/show", name="product_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Product entity.
     *
     * @Route("/new", name="product_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Product();
        $form   = $this->createForm(new ProductType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Product entity.
     *
     * @Route("/create", name="product_create")
     * @Method("post")
     * @Template("BisonLabProductMasterBundle:Product:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Product();
        $request = $this->getRequest();
        $form    = $this->createForm(new ProductType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $catalogs = $em->getRepository('BisonLabProductMasterBundle:Catalog')->findAll();
        $campaigns = $em->getRepository('BisonLabProductMasterBundle:Campaign')->findAll();

        $product_catalog  = new ProductCatalog();
        $product_campaign  = new ProductCampaign();
        $product_catalog->setProduct($entity);
        $product_campaign->setProduct($entity);

        $product_catalog_form    = $this->createForm(new ProductCatalogType(), $product_catalog);
        $product_campaign_form    = $this->createForm(new ProductCampaignType(), $product_campaign);

        $editForm = $this->createForm(new ProductType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'                => $entity,
            'edit_form'             => $editForm->createView(),
            'delete_form'           => $deleteForm->createView(),
            'product_catalog_form'  => $product_catalog_form->createView(),
            'product_campaign_form' => $product_campaign_form->createView(),
        );
    }

    /**
     * Edits an existing Product entity.
     *
     * @Route("/{id}/update", name="product_update")
     * @Method("post")
     * @Template("BisonLabProductMasterBundle:Product:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:Product')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Product entity.');
        }

        $editForm   = $this->createForm(new ProductType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('product_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Product entity.
     *
     * @Route("/{id}/delete", name="product_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BisonLabProductMasterBundle:Product')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Product entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('product'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
