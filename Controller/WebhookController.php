<?php

namespace MauticPlugin\MauticEvolutionApiBundle\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebhookController extends AbstractController
{
    #[Route(path: '/evolution/webhook', name: 'mautic_evolution_webhook', methods: ['POST'])]
    public function index(Request $request, LoggerInterface $logger): Response
    {
        $content = $request->getContent();
        $data = json_decode($content, true);
        if (!is_array($data)) {
            return new Response('Invalid payload', Response::HTTP_BAD_REQUEST);
        }

        // Here you would map message status updates to Mautic Message/Contact tracking.
        // For now, just log the webhook for troubleshooting.
        $logger->info('Evolution API webhook received', ['payload' => $data]);

        return new Response('ok', Response::HTTP_OK);
    }
}
