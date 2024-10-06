<?php

namespace App\Controller;

use App\Entity\Flash;
use App\Form\FlashType;
use App\Repository\FlashRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/flash')]
class FlashController extends AbstractController
{
    #[Route('/', name: 'app_flash_index', methods: ['GET'])]
    public function index(FlashRepository $flashRepository): Response
    {
        return $this->render('flash/index.html.twig', [
            'flashes' => $flashRepository->findAll(),
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/new', name: 'app_flash_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager): Response
    {
        $flash = new Flash();
        $form = $this->createForm(FlashType::class, $flash);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($flash);

            $email = (new Email())
            ->from($this->getParameter('mailer_from'))
            ->to('your_email@example.com')
            ->subject('Un nouveau flash vient d\'être publié !')
            ->html($this->renderView(
                'Flash/newFlashEmail.html.twig',
                ['flash' => $flash]
            ));

            $mailer->send($email);

            $entityManager->flush();

            $this->addFlash('success', 'A new flash has been upload');

            return $this->redirectToRoute('app_flash_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('flash/new.html.twig', [
            'flash' => $flash,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_flash_show', methods: ['GET'])]
    public function show(Flash $flash): Response
    {
        return $this->render('flash/show.html.twig', [
            'flash' => $flash,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}/edit', name: 'app_flash_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Flash $flash, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FlashType::class, $flash);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_flash_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('flash/edit.html.twig', [
            'flash' => $flash,
            'form' => $form,
        ]);
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/{id}', name: 'app_flash_delete', methods: ['POST'])]
    public function delete(Request $request, Flash $flash, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $flash->getId(), $request->request->get('_token'))) {
            $entityManager->remove($flash);
            $entityManager->flush();

            $this->addFlash('danger', 'A flash has been deleted');
        }

        return $this->redirectToRoute('app_flash_index', [], Response::HTTP_SEE_OTHER);
    }
}
