<?php

return [
    'name'        => 'Evolution API',
    'description' => 'Evolution API Integration',
    'version'     => '1.0',
    'author'      => 'Mautic Community',

    'services' => [
        'integrations' => [
            'mautic.integration.accioly_evolution' => [
                'class'     => \MauticPlugin\MauticEvolutionApiBundle\Integration\EvolutionApiIntegration::class,
                'arguments' => [
                    'event_dispatcher',
                    'mautic.helper.cache_storage',
                    'doctrine.orm.entity_manager',
                    'session',
                    'request_stack',
                    'router',
                    'translator',
                    'logger',
                    'mautic.helper.encryption',
                    'mautic.lead.model.lead',
                    'mautic.lead.model.company',
                    'mautic.helper.paths',
                    'mautic.core.model.notification',
                    'mautic.lead.model.field',
                    'mautic.plugin.model.integration_entity',
                    'mautic.lead.model.dnc',
                ],
            ],
        ],
    ],
];
