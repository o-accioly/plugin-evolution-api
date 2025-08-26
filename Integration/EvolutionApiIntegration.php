<?php

namespace MauticPlugin\MauticEvolutionApiBundle\Integration;

use Mautic\PluginBundle\Integration\AbstractIntegration;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class EvolutionApiIntegration extends AbstractIntegration
{
    public function getName(): string
    {
        return 'evolutionapi';
    }

    public function getDisplayName(): string
    {
        return 'WhatsApp Evolution API';
    }

    public function getAuthenticationType(): string
    {
        return 'key';
    }

    /**
     * @return array<string, string>
     */
    public function getRequiredKeyFields(): array
    {
        return [
            'api_url' => 'mautic.whatsapp_evolution.api_url',
            'api_key' => 'mautic.whatsapp_evolution.api_key',
            'instance_id' => 'mautic.whatsapp_evolution.instance_id',
        ];
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $data
     * @param string $formArea
     */
    public function appendToForm(&$builder, $data, $formArea): void
    {
        if ('keys' === $formArea) {
            $builder->add(
                'timeout',
                TextType::class,
                [
                    'label' => 'Timeout (seconds)',
                    'attr' => ['class' => 'form-control'],
                    'data' => empty($data['timeout']) ? '30' : $data['timeout'],
                    'required' => false,
                ]
            );
        }
    }

    public function getSupportedFeatures(): array
    {
        return ['push_lead'];
    }
}
