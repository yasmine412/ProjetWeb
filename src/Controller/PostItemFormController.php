<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\ImagesLogement;
use App\Entity\Logement;
use App\Form\LogementType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

class PostItemFormController extends AbstractController
{
    private ObjectManager $manager;
    private ObjectRepository $repository;

    public function __construct(private ManagerRegistry $doctrine)
    {
        $this->manager = $this->doctrine->getManager();
        $this->repository = $this->doctrine->getRepository(Logement::class);
    }

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/postItemForm', name: 'app_post_item_form')]
    public function addLogement(Request $request): Response
    {
        $logement = new Logement();
        $form = $this->createForm(LogementType::class, $logement);
        $form->handleRequest($request);


        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $logement->setTypeLogement($form->get('TypeLogement')->getData());
                $logement->setTypeEspace($form->get('TypeEspace')->getData());
                $countryCode = $form->get('Pays')->getData();
                $countryName = Countries::getName($countryCode);
                $logement->setPays($countryName);
                $eq = $form->get('Equipements')->getData();
                $values = array_values($eq);
                $equip = array("wifi" => 0,
                    "television" => 0,
                    "climatisation" => 0,
                    "Chauffage" => 0,
                    "parking" => 0,
                    "cuisine" => 0,
                    "laveLinge" => 0,
                    "sècheLinge" => 0,
                    "espaceTravail" => 0,
                    "sècheCheveux" => 0,
                    "recharge" => 0,
                    "fer" => 0,
                    "piscine" => 0,
                    "jacuzzi" => 0,
                    "litBebe" => 0,
                    "salleSport" => 0,
                    "barbecue" => 0,
                    "petitDej" => 0,
                    "cheminee" => 0,
                    "detectionMonoxyde" => 0,
                    "detectionFumee" => 0,
                    "fumeur" => 0,
                    "bordMer" => 0,
                    "frontMer" => 0);
                foreach ($values as $val) {
                    $equip[$val] = 1;
                }
                $logement->setEquipements($equip);
                $logement->setprix_nuite($form->get('prix_nuite')->getData());
                $logement->setIdUser($this->getUser());


                $uploadedFiles = $request->files->get('logement')['images'];

                foreach ($uploadedFiles as $file) {
                    $filePath = $file->getPathname();

                    // Read the file contents and convert to a binary string (Blob)
                    $fileContent = fread(fopen($filePath, 'rb'), filesize($filePath));

                        $imagesLogement = new ImagesLogement();
                        $imagesLogement->setData($fileContent);
                        $imagesLogement->setName('image de' . $logement->getTitre());
                        $imagesLogement->setIdLogement($logement);
                        $this->manager->persist($imagesLogement);
                    }



                $this->manager->persist($logement);

                /*                $email = (new Email())
                                    ->from('ymaraentreprise@gmail.com')
                                    ->to('bendhiab.aziz2@gmail.com')
                                    ->subject('Logement accepté')
                                    ->html('<h1>Votre logement a été déposé avec succès!</h1>
                                          <h3>Visitez votre espace personnel pour voir les réservations  </h3>');

                                $mailer->send($email);*/


                $this->manager->flush();
                $this->addFlash('success', 'Votre logement est ajouté avec succés');
                return $this->redirectToRoute('app_post_item_form');
            }}

        return $this->render('post_item_form/index.html.twig', [
            'controller_name' => 'PostItemFormController',
            'form' => $form->createView()
        ]);
    }


}
