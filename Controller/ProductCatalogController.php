<?php

namespace BisonLab\ProductMasterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use BisonLab\ProductMasterBundle\Entity\ProductCatalog;
use BisonLab\ProductMasterBundle\Form\ProductCatalogType;

/**
 * ProductCatalog controller.
 *
 * @Route("/productcatalog")
 */
class ProductCatalogController extends Controller
{
    /**
     * Lists all ProductCatalog entities.
     *
     * @Route("/", name="productcatalog")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BisonLabProductMasterBundle:ProductCatalog')->findAll();

        return array('entities' => $entities);
    }

    /**
     * Lists all ProductCatalog entities by Catalog.
     *
     * @Route("/catalog/{id}", name="productcatalog_list_by_catalog")
     * @Template()
     */
    public function listAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('BisonLabProductMasterBundle:ProductCatalog')->findByCatalog($id);

        return $this->render('BisonLabProductMasterBundle:ProductCatalog:index.html.twig', array('entities' => $entities));

    }

    /**
     * Finds and displays a ProductCatalog entity.
     *
     * @Route("/{id}/show", name="productcatalog_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCatalog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCatalog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new ProductCatalog entity.
     *
     * @Route("/new", name="productcatalog_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProductCatalog();
        $form   = $this->createForm(new ProductCatalogType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new ProductCatalog entity.
     *
     * @Route("/create", name="productcatalog_create")
     * @Method("post")
     * @Template("BisonLabProductMasterBundle:ProductCatalog:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new ProductCatalog();
        $request = $this->getRequest();

$data = $request->request->get('bisonlab_productmasterbundle_productcatalogtype');
error_log("Catalog:" . $data['catalog']);

        $pc = new ProductCatalogType();
        $form    = $this->createForm(new ProductCatalogType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productcatalog_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing ProductCatalog entity.
     *
     * @Route("/{id}/edit", name="productcatalog_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCatalog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCatalog entity.');
        }

        $editForm = $this->createForm(new ProductCatalogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing ProductCatalog entity.
     *
     * @Route("/{id}/update", name="productcatalog_update")
     * @Method("post")
     * @Template("BisonLabProductMasterBundle:ProductCatalog:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCatalog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProductCatalog entity.');
        }

        $editForm   = $this->createForm(new ProductCatalogType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('productcatalog_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a ProductCatalog entity.
     *
     * @Route("/{id}/delete", name="productcatalog_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('BisonLabProductMasterBundle:ProductCatalog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProductCatalog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('productcatalog'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
