<?php

namespace MauticPlugin\MauticEvolutionApiBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;
use Symfony\Component\Form\FormBuilderInterface;

class EvolutionApiIntegration extends AbstractIntegration
{
    public function getName(): string
    {
        return 'EvolutionApi';
    }

    public function getDisplayName(): string
    {
        return 'WhatsApp Evolution API';
    }

    public function getAuthenticationType(): string
    {
        return 'api';
    }

    /**
     * Return array of key => label elements that will be converted to inputs to obtain from the user.
     *
     * @return array<string,string>
     */
    public function getRequiredKeyFields(): array
    {
        return [
            'api_url'    => 'mautic.whatsapp_evolution.api_url',
            'api_key'    => 'mautic.whatsapp_evolution.api_key',
            'instance_id'=> 'mautic.whatsapp_evolution.instance_id',
        ];
    }

    /**
     * Additional fields (feature settings) for the plugin configuration form.
     */
    public function appendToForm(&$builder, $data, $formArea): void
    {
        if ('features' !== $formArea) {
            return;
        }

        if ($builder instanceof FormBuilderInterface) {
            // Placeholder for future feature toggles (e.g., default sender name)
        }
    }

    public function getSupportedFeatures(): array
    {
        // We expose a custom feature hint. Core will still list the integration for API auth.
        return ['push_lead'];
    }
}
