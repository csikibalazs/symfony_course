<?php
namespace Blog\AdminBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Blog\ModelBundle\Entity\Tag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
/**
 * Tag controller.
 *
 * @Route("/tag")
 */
class TagController extends Controller
{
    /**
     * Lists all Tag entities.
     *
     * @return array
     *
     * @Route("/")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $tags = $em->getRepository('ModelBundle:Tag')->findAll();
        return array(
            'tags' => $tags,
        );
    }
    /**
     * Creates a new Tag entity.
     *
     * @param Request $request
     *
     * @return array
     *
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Route("/new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm('Blog\ModelBundle\Form\TagType', $tag);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
            return $this->redirectToRoute('blog_admin_tag_index');
        }
        return array(
            'tag' => $tag,
            'form' => $form->createView(),
        );
    }
    /**
     * Displays a form to edit an existing Tag entity.
     *
     * @param Request $request
     * @param Tag  $tag
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Route("/{id}/edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Tag $tag)
    {
        $deleteForm = $this->createDeleteForm($tag);
        $editForm = $this->createForm('Blog\ModelBundle\Form\TagType', $tag);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tag);
            $em->flush();
            return $this->redirectToRoute('blog_admin_tag_index');
        }
        return array(
            'tag' => $tag,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Tag entity.
     *
     * @param Request $request
     * @param Tag  $tag
     *
     * @throws NotFoundHttpException
     * @return array
     *
     * @Security("has_role('ROLE_SUPER_ADMIN')")
     * @Route("/{id}")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tag $tag)
    {
        $form = $this->createDeleteForm($tag);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tag);
            $em->flush();
        }
        return $this->redirectToRoute('blog_admin_tag_index');
    }
    /**
     * Creates a form to delete a Tag entity.
     *
     * @param Tag $tag The Tag entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tag $tag)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('blog_admin_tag_delete', array('id' => $tag->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}