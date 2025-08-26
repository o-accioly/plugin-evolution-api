<?php

namespace MauticPlugin\MauticWhatsAppConnectorBundle\Api;

use MauticPlugin\MauticWhatsAppConnectorBundle\Integration\WhatsAppConnectorIntegration;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpClient\HttpClient;

class EvolutionApiClient
{
    private WhatsAppConnectorIntegration $integration;
    private HttpClientInterface $httpClient;

    public function __construct(WhatsAppConnectorIntegration $integration, ?HttpClientInterface $httpClient = null)
    {
        $this->integration = $integration;
        $this->httpClient  = $httpClient ?: HttpClient::create();
    }

    private function getBaseConfig(): array
    {
        $keys = $this->integration->getKeys();
        $apiUrl = rtrim((string)($keys['api_url'] ?? ''), '/');
        $apiKey = (string)($keys['api_key'] ?? '');
        $instanceId = (string)($keys['instance_id'] ?? '');

        return [$apiUrl, $apiKey, $instanceId];
    }

    public function sendText(string $toPhoneE164, string $message): array
    {
        [$apiUrl, $apiKey, $instanceId] = $this->getBaseConfig();
        $endpoint = sprintf('%s/message/sendText/%s', $apiUrl, $instanceId);
        return $this->request('POST', $endpoint, [
            'json' => [
                'number'  => $toPhoneE164,
                'text'    => $message,
            ],
            'headers' => [
                'apikey' => $apiKey,
            ],
        ]);
    }

    public function sendImageUrl(string $toPhoneE164, string $imageUrl, ?string $caption = null): array
    {
        [$apiUrl, $apiKey, $instanceId] = $this->getBaseConfig();
        $endpoint = sprintf('%s/message/sendImage/%s', $apiUrl, $instanceId);
        return $this->request('POST', $endpoint, [
            'json' => [
                'number'   => $toPhoneE164,
                'image'    => $imageUrl,
                'caption'  => $caption,
            ],
            'headers' => [
                'apikey' => $apiKey,
            ],
        ]);
    }

    public function sendVideoUrl(string $toPhoneE164, string $videoUrl, ?string $caption = null): array
    {
        [$apiUrl, $apiKey, $instanceId] = $this->getBaseConfig();
        $endpoint = sprintf('%s/message/sendVideo/%s', $apiUrl, $instanceId);
        return $this->request('POST', $endpoint, [
            'json' => [
                'number'   => $toPhoneE164,
                'video'    => $videoUrl,
                'caption'  => $caption,
            ],
            'headers' => [
                'apikey' => $apiKey,
            ],
        ]);
    }

    public function getMessageStatus(string $messageId): array
    {
        [$apiUrl, $apiKey, $instanceId] = $this->getBaseConfig();
        $endpoint = sprintf('%s/message/status/%s/%s', $apiUrl, $instanceId, urlencode($messageId));
        return $this->request('GET', $endpoint, [
            'headers' => [
                'apikey' => $apiKey,
            ],
        ]);
    }

    private function request(string $method, string $url, array $options): array
    {
        $response = $this->httpClient->request($method, $url, $options);
        $status = $response->getStatusCode();
        $content = $response->getContent(false);
        $data = json_decode($content, true);
        if ($status >= 400) {
            throw new \RuntimeException('Evolution API error: '.($data['message'] ?? $content));
        }
        return is_array($data) ? $data : ['raw' => $content];
    }
}
