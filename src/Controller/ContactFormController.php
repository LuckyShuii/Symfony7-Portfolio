<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

#[Route('/contact')]
class ContactFormController extends AbstractController
{
    #[Route('/', name: 'app_contact_form_index', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactForm = new ContactForm();
        $form = $this->createForm(ContactFormType::class, $contactForm);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $contactForm->setSent(new \DateTime());

            $entityManager->persist($contactForm);
            $entityManager->flush();
            $this->addFlash('success', 'Votre message a bien été envoyé !');

            $firstname = $contactForm->getFirstname();
            $lastname = $contactForm->getLastname();
            $email = $contactForm->getEmail();

            $mail = new PHPMailer(true);
            $mail->setLanguage('fr', '/optional/path/to/language/directory/');

            // try {
            //     $mail->isSMTP();
            //     $mail->Host = '';
            //     $mail->SMTPAuth = true;
            //     $mail->Username = '';
            //     $mail->Password = '';
            //     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //     $mail->Port = 587;

            //     $mail->setFrom('no@reply.fr', 'Lucas Boillot');
            //     $mail->addAddress($email, $firstname . ' ' . $lastname);

            //     $mail->Subject = 'Nous avons bien reçu votre message';
            //     $mail->Body = 'Bonjour ' . $firstname . ' ' . $lastname . ',<br><br>Nous avons bien reçu votre message et nous vous en remercions.<br><br>Nous vous recontacterons dans les plus brefs délais.<br><br>Cordialement,<br><br>Lucas Boillot';

            //     $mail->isHTML(true);
            //     $mail->send();
            // } catch (Exception $e) {
            //     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            // }
            return $this->redirectToRoute('app_contact_form_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_form/new.html.twig', [
            'contact_form' => $contactForm,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_form_delete', methods: ['POST'])]
    public function delete(Request $request, ContactForm $contactForm, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $contactForm->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_form_index', [], Response::HTTP_SEE_OTHER);
    }
}
