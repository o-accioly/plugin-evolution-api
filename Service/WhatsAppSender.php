<?php

namespace MauticPlugin\MauticEvolutionApiBundle\Service;

use MauticPlugin\MauticEvolutionApiBundle\Api\EvolutionApiClient;

class WhatsAppSender
{
    public function __construct(private EvolutionApiClient $client)
    {
    }

    public function sendText(string $toPhoneE164, string $message): array
    {
        return $this->client->sendText($toPhoneE164, $message);
    }

    public function sendImageUrl(string $toPhoneE164, string $imageUrl, ?string $caption = null): array
    {
        return $this->client->sendImageUrl($toPhoneE164, $imageUrl, $caption);
    }

    public function sendVideoUrl(string $toPhoneE164, string $videoUrl, ?string $caption = null): array
    {
        return $this->client->sendVideoUrl($toPhoneE164, $videoUrl, $caption);
    }
}
